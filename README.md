# HealthCare AI — AI Healthcare Chatbot

A PHP + MySQL academic project for a final-year Computer Science Engineering submission.

## Features
- User registration and secure login (PHP password hashing)
- AI healthcare chat interface
- Persistent conversations and chat history
- General symptom education page
- Basic admin dashboard
- Responsive blue-and-white interface
- OpenAI-compatible API integration from the PHP server

## Tech stack
PHP 8+, MySQL/MariaDB, HTML5, CSS3, JavaScript, XAMPP and an optional AI API provider.

## Run locally
1. Install [XAMPP](https://www.apachefriends.org/).
2. Put the project folder in `C:\xampp\htdocs\healthcare_ai_chatbot`.
3. Start Apache and MySQL.
4. Import `database/healthcare.sql` using phpMyAdmin.
5. Configure `config/database.php`.
6. Set server environment variables `AI_API_KEY`, `AI_API_URL`, and `AI_MODEL` for live AI. Without an API key, the app uses a clearly labelled demo response.
7. Open `http://localhost/healthcare_ai_chatbot/`.

## Admin setup
Register a user, then run this SQL in phpMyAdmin (replace the email):
`UPDATE users SET role='admin' WHERE email='your-email@example.com';`
Log out and back in.

## Safety
This is an educational prototype, not a medical device. It does not diagnose, prescribe medication or provide dosage recommendations. AI responses can be inaccurate. Users should consult qualified healthcare professionals; severe or rapidly worsening symptoms require urgent medical care. Do not enter sensitive personal information.

## Security before deployment
Keep API keys server-side and out of Git. Use HTTPS, rate limiting, secure session settings, backups, privacy controls and qualified clinical review before any real-world use.

## License

This project is licensed under the MIT License.

Copyright (c) 2026 smmrunal16-lgtm

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
