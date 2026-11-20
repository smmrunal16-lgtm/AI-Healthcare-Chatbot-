# HealthCare AI — Healthcare Information Chatbot

A responsive PHP 8+ academic prototype for a Computer Science Engineering project. It provides a simple chat interface for general health-information questions, with an optional OpenAI-compatible chat-completions API connection.

## Features

- Responsive chat interface built with PHP, HTML, CSS and vanilla JavaScript.
- PHP JSON endpoints for sending and clearing chat messages.
- Optional AI API integration configured through server environment variables.
- Clearly labelled demo mode when AI credentials are not configured.
- Basic emergency-keyword escalation for selected urgent phrases.
- Session-based short chat context and CSRF-token validation.
- No database is required for this starter version.

## Project structure

```text
AI-Healthcare-Chatbot-/
├── api/
│   ├── chat.php
│   └── clear.php
├── assets/
│   ├── app.css
│   └── app.js
├── config.php
├── index.php
├── .env.example
└── README.md
```

## Run locally with XAMPP

1. Install PHP 8.0+ (XAMPP includes PHP and Apache).
2. Copy this repository folder into `C:\\xampp\\htdocs\\AI-Healthcare-Chatbot-`.
3. Start Apache from the XAMPP Control Panel.
4. Open `http://localhost/AI-Healthcare-Chatbot-/`.
5. The app works in demo mode without an API key.

## Enable an AI API

Set the following as environment variables in the Apache/PHP server environment:

- `AI_API_URL`: full URL of an OpenAI-compatible chat-completions endpoint.
- `AI_API_KEY`: your secret API key.
- `AI_MODEL`: model identifier supported by your provider.

Restart Apache after changing environment variables. Do not place API keys in JavaScript, HTML, GitHub, or any public file. If the endpoint is unavailable or returns an unexpected response, the application falls back to demo mode.

## Important safety notice

This is an educational prototype, not a medical device or a substitute for a doctor. It cannot diagnose conditions, prescribe medicines, or recommend dosages. Its emergency keyword check is incomplete and may miss serious situations. If someone may be experiencing a medical emergency, contact local emergency services immediately. AI-generated information can be wrong; verify health decisions with a qualified healthcare professional. Do not enter identifying details or private medical records.

Before real-world use, add authentication, rate limiting, secure production hosting with HTTPS, privacy and consent controls, logging and retention policies, accessibility testing, and qualified clinical, legal, and security review.
