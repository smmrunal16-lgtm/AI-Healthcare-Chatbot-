const form = document.querySelector('#chat-form');
const input = document.querySelector('#message-input');
const messages = document.querySelector('#messages');
const sendButton = document.querySelector('#send-btn');
const csrfToken = document.querySelector('#csrf-token').value;

function addMessage(text, role, mode = '') {
  const article = document.createElement('article');
  article.className = `message ${role}`;
  const bubble = document.createElement('div');
  bubble.className = 'bubble';
  bubble.textContent = text;
  article.appendChild(bubble);
  if (mode === 'demo') {
    const note = document.createElement('small');
    note.className = 'mode-note';
    note.textContent = 'Demo mode · No live AI response';
    article.appendChild(note);
  }
  messages.appendChild(article);
  messages.scrollTop = messages.scrollHeight;
}

async function sendMessage(text) {
  const question = text.trim();
  if (!question || sendButton.disabled) return;

  addMessage(question, 'user');
  input.value = '';
  sendButton.disabled = true;
  sendButton.textContent = 'Thinking…';

  try {
    const response = await fetch('api/chat.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-Token': csrfToken
      },
      body: JSON.stringify({ message: question })
    });
    const data = await response.json();
    if (!response.ok) throw new Error(data.error || 'Unable to send your message.');
    addMessage(data.reply, 'assistant', data.mode);
  } catch (error) {
    addMessage(error.message || 'Something went wrong. Please try again.', 'assistant');
  } finally {
    sendButton.disabled = false;
    sendButton.innerHTML = 'Send <span>➤</span>';
    input.focus();
  }
}

form.addEventListener('submit', (event) => {
  event.preventDefault();
  sendMessage(input.value);
});

input.addEventListener('keydown', (event) => {
  if (event.key === 'Enter' && !event.shiftKey) {
    event.preventDefault();
    form.requestSubmit();
  }
});

document.querySelectorAll('[data-prompt]').forEach((button) => {
  button.addEventListener('click', () => sendMessage(button.dataset.prompt));
});

document.querySelector('#clear-chat').addEventListener('click', async () => {
  messages.replaceChildren();
  addMessage('Chat cleared. What would you like to ask?', 'assistant');
  try {
    await fetch('api/clear.php', {
      method: 'POST',
      headers: { 'X-CSRF-Token': csrfToken }
    });
  } catch (_) {
    // The visible chat is cleared even if the session reset request fails.
  }
});
