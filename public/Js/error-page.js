const imageBox = document.querySelector('.image-box');
const confettiContainer = document.getElementById('confetti-container');

imageBox.addEventListener('mouseenter', () => {
    triggerConfettiExplosion();
});

function triggerConfettiExplosion() {
    const colors = ['#ff4081', '#4caf50', '#ffeb3b', '#00bcd4', '#ff9800'];
    const numConfetti = 40;

    const rect = imageBox.getBoundingClientRect();
    const originX = rect.left + rect.width / 2;
    const originY = rect.top + rect.height / 2;

    for (let i = 0; i < numConfetti; i++) {
        const confetti = document.createElement('div');
        confetti.classList.add('confetti');
        confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.left = originX + 'px';
        confetti.style.top = originY + 'px';

        const angle = Math.random() * 2 * Math.PI;
        const distance = 600 + Math.random() * 60;
        const dx = Math.cos(angle) * distance;
        const dy = Math.sin(angle) * distance;

        confetti.style.setProperty('--dx', `${dx}px`);
        confetti.style.setProperty('--dy', `${dy}px`);

        confetti.style.animationDuration = 0.9 + Math.random() * 0.3 + 's';
        confettiContainer.appendChild(confetti);

        setTimeout(() => {
            confetti.remove();
        }, 1500);
    }
}

const bubblesContainer = document.getElementById('bubbles-container');
const bubbleCount = 30;

for (let i = 0; i < bubbleCount; i++) {
    const bubble = document.createElement('div');
    bubble.classList.add('bubble');

    const size = Math.random() * 100 + 40;
    const left = Math.random() * 100; 
    const delay = Math.random() * 20; 
    const duration = 15 + Math.random() * 10; 

    bubble.style.width = `${size}px`;
    bubble.style.height = `${size}px`;
    bubble.style.left = `${left}%`;
    bubble.style.animationDelay = `${delay}s`;
    bubble.style.animationDuration = `${duration}s`;

    bubblesContainer.appendChild(bubble);
}

