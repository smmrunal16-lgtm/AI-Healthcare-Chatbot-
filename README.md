# HealthCare AI — Advanced AI Healthcare Chatbot

A PHP 8+ and MySQL academic prototype for a final-year Computer Science Engineering project.

## Advanced modules
- Secure registration, login, logout, password hashing, session cookies and CSRF validation.
- AI health-information chat using an OpenAI-compatible API, with saved conversations and recent chat context.
- Clearly labelled demo mode when no AI API key is configured.
- Symptom safety guide with emergency keyword escalation; it does not diagnose or store symptom text.
- Appointment request workflow with date validation and request status tracking (prototype only; not connected to clinics).
- User profile settings for display name, language and theme preference.
- Admin dashboard with aggregate application statistics.
- Responsive PHP, MySQL, HTML, CSS and vanilla JavaScript interface.

## Download the advanced source package
The complete advanced source package is available as the **HealthCare AI Chatbot Advanced ZIP** attached in the project conversation. Extract it into your XAMPP htdocs folder to run the full application. The ZIP includes all PHP source files, database schema, CSS, JavaScript and setup documentation.

## Run with XAMPP
1. Install XAMPP and extract the project into `C:\xampp\htdocs\healthcare_ai_chatbot`.
2. Start Apache and MySQL.
3. Import `database/healthcare.sql` using phpMyAdmin. If upgrading an existing database, run the new `appointments` and `user_preferences` table definitions at the bottom of the SQL file.
4. Configure `DB_HOST`, `DB_NAME`, `DB_USER` and `DB_PASS` in the PHP environment or in `config/database.php`.
5. For live AI, configure `AI_API_KEY`, `AI_API_URL` and `AI_MODEL` as server environment variables. Never commit API keys. Without a key, demo mode is used.
6. Open `http://localhost/healthcare_ai_chatbot/`. Adjust `BASE_URL` in `config/app.php` if the folder name differs.
7. Register an account. To grant admin access, run `UPDATE users SET role='admin' WHERE email='your-email@example.com';` in phpMyAdmin, then sign in again.

## Safety and limitations
This is an educational prototype, not a medical device. The chatbot and symptom guide cannot diagnose, prescribe medicines or recommend dosages. The symptom keyword check can miss emergencies. AI responses may be inaccurate; consult a qualified healthcare professional. Appointment requests are stored locally and are not sent to a real clinic. Do not enter sensitive personal or medical records.

Before real-world deployment, add HTTPS, rate limiting, audit controls, backups, privacy/consent and retention workflows, accessibility testing, and qualified clinical, legal and security review.
