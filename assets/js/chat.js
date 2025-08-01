document.addEventListener('DOMContentLoaded', () => {
    const faqData = {
        'How to book a tour?': 'You can book a tour by clicking the "packages"  on our homepage or visiting our booking page. Select your desired package, dates, and follow the simple booking process.',
        'What payment methods are accepted?': 'We accept various payment methods including check payment, bank transfers, and cash. All payments are processed securely.',
        'What is the cancellation policy?': 'Cancellation Policy. Free cancellation up to 7 days before the trip. 50% refund between 3-7 days before the trip.No refund within 3 days of the trip.',
        'Are meals included?': 'Meal inclusions vary by package. Most tours include breakfast, and some include additional meals. Check the specific tour details for meal information.',
        'What documents do I need to bring for the tour?': 'You should bring a valid government-issued photo ID (such as passport, Aadhaar card). For international tours, carry your passport, visa, and any required travel documents. Please also bring your booking confirmation and any other documents mentioned in your package details.'
    };

    const chatContainer = document.createElement('div');
    chatContainer.className = 'chat-container hidden';
    chatContainer.innerHTML = `
        <div class="chat-header">
            <span>Tour FAQ Chat</span>
            <i class='bx bx-x' id="close-chat"></i>
        </div>
        <div class="chat-body">
            <div class="bot-message chat-message">Hello! How can I help you today?</div>
            <div class="faq-buttons"></div>
        </div>
    `;

    const chatToggle = document.createElement('div');
    chatToggle.className = 'chat-toggle';
    chatToggle.innerHTML = '<i class="bx bx-message-dots"></i>';

    document.body.appendChild(chatContainer);
    document.body.appendChild(chatToggle);

    const faqButtons = chatContainer.querySelector('.faq-buttons');
    Object.keys(faqData).forEach(question => {
        const button = document.createElement('button');
        button.className = 'faq-button';
        button.textContent = question;
        button.onclick = () => addMessage(question, faqData[question]);
        faqButtons.appendChild(button);
    });

    function addMessage(question, answer) {
        const chatBody = chatContainer.querySelector('.chat-body');
        
        const userMessage = document.createElement('div');
        userMessage.className = 'chat-message user-message';
        userMessage.textContent = question;
        chatBody.appendChild(userMessage);

        setTimeout(() => {
            const botMessage = document.createElement('div');
            botMessage.className = 'chat-message bot-message';
            botMessage.textContent = answer;
            chatBody.appendChild(botMessage);
            chatBody.scrollTop = chatBody.scrollHeight;
        }, 500);
    }

    chatToggle.onclick = () => chatContainer.classList.toggle('hidden');
    document.getElementById('close-chat').onclick = () => chatContainer.classList.add('hidden');
});