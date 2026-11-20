<?php
declare(strict_types=1);
require __DIR__ . '/config.php';
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="HealthCare AI provides general health information and helps you prepare questions for a healthcare professional.">
  <title><?= htmlspecialchars(APP_NAME, ENT_QUOTES, 'UTF-8') ?></title>
  <link rel="stylesheet" href="assets/app.css">
</head>
<body>
  <main class="shell">
    <header class="topbar">
      <a class="brand" href="./"><span class="brand-mark">+</span><span>HealthCare <b>AI</b></span></a>
      <span class="status"><i></i> Health information assistant</span>
    </header>

    <section class="hero">
      <p class="eyebrow">YOUR WELLNESS COMPANION</p>
      <h1>How can I help you<br><span>feel more informed?</span></h1>
      <p class="intro">Ask general health questions, understand common terms, or prepare for a conversation with your doctor.</p>
    </section>

    <section class="chat-card" aria-label="Healthcare chat">
      <div class="chat-heading">
        <div class="avatar">✚</div>
        <div><strong>HealthCare Assistant</strong><small>General information · Not a doctor</small></div>
        <button class="clear-btn" id="clear-chat" type="button">Clear chat</button>
      </div>
      <div class="messages" id="messages" aria-live="polite">
        <article class="message assistant">
          <div class="bubble">Hello! I'm your health information assistant. What would you like to know today? I can share general information, but I can't diagnose conditions or replace a healthcare professional.</div>
        </article>
      </div>
      <div class="suggestions" id="suggestions">
        <button type="button" data-prompt="How can I build healthy daily habits?">Healthy habits</button>
        <button type="button" data-prompt="What should I prepare before a doctor appointment?">Doctor visit checklist</button>
        <button type="button" data-prompt="Explain what blood pressure numbers mean in simple terms.">Understand blood pressure</button>
      </div>
      <form id="chat-form" class="composer">
        <input type="hidden" id="csrf-token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
        <label class="sr-only" for="message-input">Your health question</label>
        <textarea id="message-input" rows="1" maxlength="2000" placeholder="Type your health question..." required></textarea>
        <button id="send-btn" type="submit" aria-label="Send message">Send <span>➤</span></button>
      </form>
      <p class="fine-print">For emergencies, call your local emergency number immediately. Please don't share personal identifiers or private medical records here.</p>
    </section>
    <footer>Educational prototype · AI responses can be inaccurate · Always verify medical information with a qualified professional.</footer>
  </main>
  <script src="assets/app.js" defer></script>
</body>
</html>
