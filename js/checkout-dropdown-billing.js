const dropdownBilling = document.querySelector(
    '.checkout-steps-dropdown-billing'
);
const selectedOptionBilling = dropdownBilling.querySelector(
    '.selected-option-billing'
);
const options = dropdownBilling.querySelector('.bill-address-options');
const dropDownArrow = selectedOptionBilling.querySelector(
    '.dropdown-down-arrow'
);
const checkoutDataBilling = document.querySelector('.checkout-data-billing');
const billArrowContainer = document.querySelector(
    '.header-arrow-container-billing'
);
const billCheckContainer = document.querySelector(
    '.header-check-container-billing'
);
const billEditContainer = document.querySelector(
    '.header-edit-container-billing'
);
const submitContinueBill = document.getElementById('submitContinueBill');
const checkoutInformationBilling = document.querySelector(
    '.checkout-information-billing'
);
const checkoutInformationShipping = document.querySelector(
    '.checkout-information-shipping'
);
const checkoutBackShip = document.querySelector('.checkout-back-ship');

selectedOptionBilling.addEventListener('click', (event) => {
    options.classList.toggle('active');
    if (
        !dropDownArrow.classList.contains('active') &&
        !dropDownArrow.classList.contains('inactive')
    ) {
        dropDownArrow.classList.toggle('active');
    } else {
        dropDownArrow.classList.toggle('active');
        dropDownArrow.classList.toggle('inactive');
    }
});

let optionClicked = false;

options.addEventListener('click', (event) => {
    if (event.target.tagName === 'LI') {
        selectedOptionBilling.textContent = event.target.textContent;
        checkoutDataBilling.textContent = event.target.textContent;
        options.classList.remove('active');
        optionClicked = true;
    }
});

submitContinueBill.addEventListener('click', () => {
    if (optionClicked) {
        billArrowContainer.classList.remove('active');
        billCheckContainer.classList.add('active');
        billEditContainer.classList.add('active');
        checkoutInformationBilling.classList.remove('active');
        checkoutInformationShipping.classList.add('active');
    }
});

billEditContainer.addEventListener('click', () => {
    billArrowContainer.classList.add('active');
    billCheckContainer.classList.remove('active');
    billEditContainer.classList.remove('active');
    checkoutInformationBilling.classList.add('active');
    checkoutInformationShipping.classList.remove('active');
});

checkoutBackShip.addEventListener('click', () => {
    billArrowContainer.classList.add('active');
    billCheckContainer.classList.remove('active');
    billEditContainer.classList.remove('active');
    checkoutInformationBilling.classList.add('active');
    checkoutInformationShipping.classList.remove('active');
});
