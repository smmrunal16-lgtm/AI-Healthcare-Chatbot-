<?php
declare(strict_types=1);
require dirname(__DIR__) . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['error' => 'Method not allowed.'], 405);
}
$providedToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!hash_equals($_SESSION['csrf_token'], $providedToken)) {
    json_response(['error' => 'Invalid session token.'], 403);
}
unset($_SESSION['chat_history']);
json_response(['success' => true]);
