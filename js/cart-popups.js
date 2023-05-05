// show hide checkout popups
const popupMessage = document.querySelector('.cart-popup-message');
if (popupMessage) {
    popupMessage.addEventListener('click', () => {
        const popupOverlay = document.getElementById('popup-overlay');
        popupOverlay.style.backgroundColor = 'var(--bg-light)';
        popupOverlay.style.zIndex = '-10';
    });
}
