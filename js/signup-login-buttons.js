const createAccountButton = document.getElementById('create-account-button');
const loginButton = document.getElementById('login-button');
const logoutButton = document.getElementById('logout-button');
const signUpContainer = document.getElementById('sign-up-container');
const signInContainer = document.getElementById('sign-in-container');

createAccountButton.addEventListener('click', () => {
    signUpContainer.style.display = 'block';
    signInContainer.style.display = 'none';
});

loginButton.addEventListener('click', () => {
    signInContainer.style.display = 'block';
    signUpContainer.style.display = 'none';
});

// show hide signup / login form based on popup
const signupPopupMessage = document.querySelector('.signup-popup-message');
const loginPopupMessage = document.querySelector('.login-popup-message');
if (signupPopupMessage) {
    signupPopupMessage.addEventListener('click', () => {
        const popupOverlay = document.getElementById('popup-overlay');
        signInContainer.style.display = 'none';
        signUpContainer.style.display = 'block';
        popupOverlay.style.backgroundColor = 'var(--bg-light)';
        popupOverlay.style.zIndex = '0';
    });
} else if (loginPopupMessage) {
    loginPopupMessage.addEventListener('click', () => {
        const popupOverlay = document.getElementById('popup-overlay');
        signInContainer.style.display = 'block';
        signUpContainer.style.display = 'none';
        popupOverlay.style.backgroundColor = 'var(--bg-light)';
        popupOverlay.style.zIndex = '0';
    });
}
