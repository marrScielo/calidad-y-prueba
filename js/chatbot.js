document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('chat-modal');
    const openButton = document.getElementById('open-chat');
    const closeButton = document.getElementsByClassName('close')[0];
    const chatMessages = document.getElementById('chat-messages');
    const userInput = document.getElementById('user-input');
    const sendButton = document.getElementById('send-message');
    const userForm = document.getElementById('user-form');

    openButton.onclick = () => modal.style.display = "block";
    closeButton.onclick = () => modal.style.display = "none";
    window.onclick = (event) => {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    sendButton.addEventListener('click', sendMessage);
    userInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    userForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;

        fetch('save_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&phone=${encodeURIComponent(phone)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                addMessage('bot', '¡Gracias por proporcionar tus datos! Nos pondremos en contacto contigo pronto.');
                userForm.style.display = 'none';
            } else {
                addMessage('bot', 'Lo siento, hubo un problema al guardar tus datos. Por favor, intenta de nuevo más tarde.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            addMessage('bot', 'Lo siento, hubo un problema al procesar tu solicitud. Por favor, intenta de nuevo más tarde.');
        });
    });

    function sendMessage() {
        const message = userInput.value.trim();
        if (message) {
            addMessage('user', message);
            processMessage(message);
            userInput.value = '';
        }
    }

    function addMessage(sender, message) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', sender);
        messageElement.textContent = message;
        chatMessages.appendChild(messageElement);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function processMessage(message) {
        const lowerMessage = message.toLowerCase();
        if (lowerMessage.includes('hola') || lowerMessage.includes('buenos días') || lowerMessage.includes('buenas tardes')) {
            addMessage('bot', '¡Hola! Bienvenido a Contigo Voy. ¿En qué puedo ayudarte hoy?');
        } else if (lowerMessage.includes('ayuda') || lowerMessage.includes('apoyo')) {
            addMessage('bot', 'Estamos aquí para brindarte apoyo emocional y psicológico. ¿Quieres contarme más sobre lo que estás experimentando?');
        } else if (lowerMessage.includes('cita') || lowerMessage.includes('consulta')) {
            addMessage('bot', 'Para agendar una cita, necesitaré algunos datos. ¿Te parece bien si te hago algunas preguntas?');
            userForm.style.display = 'block';
        } else if (lowerMessage.includes('gracias')) {
            addMessage('bot', 'De nada. Estamos aquí para ayudarte. ¿Hay algo más en lo que pueda asistirte?');
        } else if (lowerMessage.includes('servicios')) {
            addMessage('bot', 'Ofrecemos una variedad de servicios para ayudarte a encontrar equilibrio y bienestar emocional. Algunos de nuestros servicios incluyen apoyo para adicciones, ansiedad, depresión, estrés, y más.');
        } else if (lowerMessage.includes('contacto')) {
            addMessage('bot', 'Puedes contactarnos a través de nuestro correo electrónico CONTIGO.VOY@gmail.com o llamarnos al (+51) 666 666 666 Ext. 1111.');
        } else {
            addMessage('bot', 'Entiendo. ¿Podrías decirme más sobre cómo te sientes o qué tipo de apoyo estás buscando?');
        }
    }

    // Mensaje de bienvenida
    addMessage('bot', '¡Bienvenido a Contigo Voy! Estoy aquí para escucharte y brindarte apoyo. ¿En qué puedo ayudarte hoy?');
});