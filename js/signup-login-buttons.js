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
