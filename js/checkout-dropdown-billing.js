const dropdownBilling = document.querySelector(
    '.checkout-steps-dropdown-billing'
);
const selectedOptionBilling = dropdownBilling.querySelector(
    '.selected-option-billing'
);
const optionsBill = dropdownBilling.querySelector('.bill-address-options');
const dropDownArrowBill = selectedOptionBilling.querySelector(
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
const shipArrowContainer = document.querySelector(
    '.header-arrow-container-shipping'
);
const shipCheckContainer = document.querySelector(
    '.header-check-container-shipping'
);
const shipEditContainer = document.querySelector(
    '.header-edit-container-shipping'
);
const shipMethodArrowContainer = document.querySelector(
    '.header-arrow-container-ship-method'
);
const shipMethodCheckContainer = document.querySelector(
    '.header-check-container-ship-method'
);
const shipMethodEditContainer = document.querySelector(
    '.header-edit-container-ship-method'
);
const paymentArrowContainer = document.querySelector(
    '.header-arrow-container-payment'
);
const paymentCheckContainer = document.querySelector(
    '.header-check-container-payment'
);
const paymentEditContainer = document.querySelector(
    '.header-edit-container-payment'
);
const reviewArrowContainer = document.querySelector(
    '.header-arrow-container-review'
);
const submitContinueBill = document.getElementById('submitContinueBill');
const checkoutInformationBilling = document.querySelector(
    '.checkout-information-billing'
);
const checkoutInformationShipping = document.querySelector(
    '.checkout-information-shipping'
);
const checkoutInformationShipMethod = document.querySelector(
    '.checkout-information-ship-method'
);
const checkoutInformationPayment = document.querySelector(
    '.checkout-information-payment'
);
const checkoutInformationReview = document.querySelector(
    '.checkout-information-review'
);
const checkoutBackShip = document.querySelector('.checkout-back-ship');

selectedOptionBilling.addEventListener('click', () => {
    optionsBill.classList.toggle('active');
    if (
        !dropDownArrowBill.classList.contains('active') &&
        !dropDownArrowBill.classList.contains('inactive')
    ) {
        dropDownArrowBill.classList.toggle('active');
    } else {
        dropDownArrowBill.classList.toggle('active');
        dropDownArrowBill.classList.toggle('inactive');
    }
});

let optionClickedBill = false;

optionsBill.addEventListener('click', (event) => {
    if (event.target.tagName === 'LI') {
        selectedOptionBilling.textContent = event.target.textContent;
        checkoutDataBilling.textContent = event.target.textContent;
        optionsBill.classList.remove('active');
        optionClickedBill = true;
    }
});

submitContinueBill.addEventListener('click', () => {
    if (optionClickedBill) {
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
    shipArrowContainer.classList.add('active');
    shipCheckContainer.classList.remove('active');
    shipEditContainer.classList.remove('active');
    shipMethodArrowContainer.classList.add('active');
    shipMethodCheckContainer.classList.remove('active');
    shipMethodEditContainer.classList.remove('active');
    paymentArrowContainer.classList.add('active');
    paymentCheckContainer.classList.remove('active');
    paymentEditContainer.classList.remove('active');
    reviewArrowContainer.classList.add('active');
    checkoutInformationBilling.classList.add('active');
    checkoutInformationShipping.classList.remove('active');
    checkoutInformationShipMethod.classList.remove('active');
    checkoutInformationPayment.classList.remove('active');
    checkoutInformationReview.classList.remove('active');
});

checkoutBackShip.addEventListener('click', () => {
    billArrowContainer.classList.add('active');
    billCheckContainer.classList.remove('active');
    billEditContainer.classList.remove('active');
    shipArrowContainer.classList.add('active');
    shipCheckContainer.classList.remove('active');
    shipEditContainer.classList.remove('active');
    shipMethodArrowContainer.classList.add('active');
    shipMethodCheckContainer.classList.remove('active');
    shipMethodEditContainer.classList.remove('active');
    paymentArrowContainer.classList.add('active');
    paymentCheckContainer.classList.remove('active');
    paymentEditContainer.classList.remove('active');
    reviewArrowContainer.classList.add('active');
    checkoutInformationBilling.classList.add('active');
    checkoutInformationShipping.classList.remove('active');
    checkoutInformationShipMethod.classList.remove('active');
    checkoutInformationPayment.classList.remove('active');
    checkoutInformationReview.classList.remove('active');
});
