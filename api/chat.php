<?php
declare(strict_types=1);
require dirname(__DIR__) . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['error' => 'Method not allowed.'], 405);
}

$providedToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!hash_equals($_SESSION['csrf_token'], $providedToken)) {
    json_response(['error' => 'Your session expired. Refresh the page and try again.'], 403);
}

$payload = json_decode(file_get_contents('php://input'), true);
$message = trim((string)($payload['message'] ?? ''));

if ($message === '' || mb_strlen($message) > 2000) {
    json_response(['error' => 'Enter a question of up to 2,000 characters.'], 422);
}

$emergencyTerms = [
    'chest pain', 'cannot breathe', 'can not breathe', 'difficulty breathing',
    'shortness of breath', 'unconscious', 'not responding', 'severe bleeding',
    'stroke', 'face drooping', 'suicidal', 'overdose', 'seizure'
];

$lowerMessage = mb_strtolower($message);
foreach ($emergencyTerms as $term) {
    if (str_contains($lowerMessage, $term)) {
        json_response([
            'reply' => 'This may be an emergency. Please contact your local emergency number or go to the nearest emergency department now. Do not wait for an online response. If possible, ask someone nearby to help you.',
            'mode' => 'safety'
        ]);
    }
}

$history = $_SESSION['chat_history'] ?? [];
$history[] = ['role' => 'user', 'content' => $message];
$history = array_slice($history, -10);

if (AI_API_URL !== '' && AI_API_KEY !== '') {
    $messages = array_merge(
        [[
            'role' => 'system',
            'content' => 'You are a careful health information assistant. Provide general educational information only. Never diagnose, prescribe medicines, recommend dosages, or claim certainty. Encourage a qualified healthcare professional for personal symptoms, treatment decisions, pregnancy, children, or worsening symptoms. Ask users not to share identifying or sensitive records. If symptoms sound urgent, advise emergency care. Use simple language and mention uncertainty.'
        ]],
        $history
    );

    $body = json_encode([
        'model' => AI_MODEL,
        'messages' => $messages,
        'temperature' => 0.3,
        'max_tokens' => 500
    ]);

    $context = stream_context_create(['http' => [
        'method' => 'POST',
        'header' => "Content-Type: application/json\r\nAuthorization: Bearer " . AI_API_KEY . "\r\n",
        'content' => $body,
        'timeout' => 25,
        'ignore_errors' => true
    ]]);

    $result = @file_get_contents(AI_API_URL, false, $context);
    $decoded = $result !== false ? json_decode($result, true) : null;
    $reply = $decoded['choices'][0]['message']['content'] ?? null;

    if (is_string($reply) && trim($reply) !== '') {
        $history[] = ['role' => 'assistant', 'content' => trim($reply)];
        $_SESSION['chat_history'] = array_slice($history, -10);
        json_response(['reply' => trim($reply), 'mode' => 'ai']);
    }
}

$demoReply = 'Thanks for your question. I can share general health education, but this demo mode does not have a live AI connection. For advice about your own symptoms, diagnosis, or treatment, please speak with a qualified healthcare professional. You can configure AI_API_URL, AI_API_KEY, and AI_MODEL on the server to enable the AI connection.';
$history[] = ['role' => 'assistant', 'content' => $demoReply];
$_SESSION['chat_history'] = array_slice($history, -10);
json_response(['reply' => $demoReply, 'mode' => 'demo']);
