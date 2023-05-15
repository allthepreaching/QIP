function refreshListeners() {
    if (
        window.optionClickedShipAddress &&
        window.optionClickedShipBillType &&
        window.optionClickedShipAddress
    ) {
        const dropdownShipMethod = document.querySelector(
            '.checkout-steps-dropdown-ship-method'
        );
        const selectedOptionShipMethod = dropdownShipMethod.querySelector(
            '.selected-option-ship-method'
        );
        const optionsShipMethod = dropdownShipMethod.querySelector(
            '.ship-method-options'
        );
        const dropdownArrowShipMethod = selectedOptionShipMethod.querySelector(
            '.dropdown-down-arrow'
        );
        const shipMethodAccount = document.getElementById(
            'ship-method-account-number'
        );
        const shipMethodDeliveryInstructions = document.getElementById(
            'ship-method-delivery-instructions'
        );
        const checkoutDataShipMethodMethod = document.querySelector(
            '.checkout-data-ship-method-method'
        );
        const checkoutDataShipMethodAccount = document.querySelector(
            '.checkout-data-ship-method-account'
        );
        const checkoutDataShipMethodNotes = document.querySelector(
            '.checkout-data-ship-method-notes'
        );
        const submitContinueShipMethod = document.getElementById(
            'submitContinueShipMethod'
        );
        const checkoutInformationShipMethod = document.querySelector(
            '.checkout-information-ship-method'
        );
        const checkoutBackPayment = document.querySelector(
            '.checkout-back-ship-payment'
        );
        const shipMethodAccountNumber = document.querySelector(
            '.ship-method-account-number'
        );

        if (!window.shipBillType) {
            shipMethodAccountNumber.classList.remove('active');
        }

        selectedOptionShipMethod.addEventListener('click', () => {
            optionsShipMethod.classList.toggle('active');
            if (
                !dropdownArrowShipMethod.classList.contains('active') &&
                !dropdownArrowShipMethod.classList.contains('inactive')
            ) {
                dropdownArrowShipMethod.classList.toggle('active');
            } else {
                dropdownArrowShipMethod.classList.toggle('active');
                dropdownArrowShipMethod.classList.toggle('inactive');
            }
        });

        let optionClickedShipMethod = false;

        optionsShipMethod.addEventListener('click', (event) => {
            if (event.target.tagName === 'LI') {
                selectedOptionShipMethod.textContent = event.target.textContent;
                checkoutDataShipMethodMethod.textContent =
                    event.target.textContent;
                optionsShipMethod.classList.remove('active');
                optionClickedShipMethod = true;
            }
        });

        shipMethodAccount.addEventListener('change', (event) => {
            checkoutDataShipMethodAccount.textContent =
                event.target.value.toUpperCase();
        });

        shipMethodDeliveryInstructions.addEventListener('change', (event) => {
            checkoutDataShipMethodNotes.textContent = event.target.value
                .toLowerCase()
                .replace(/\b\w/g, (c) => c.toUpperCase());
        });

        submitContinueShipMethod.addEventListener('click', () => {
            if (optionClickedShipMethod) {
                shipMethodArrowContainer.classList.remove('active');
                shipMethodCheckContainer.classList.add('active');
                shipMethodEditContainer.classList.add('active');
                checkoutInformationShipMethod.classList.remove('active');
                checkoutInformationPayment.classList.add('active');
            }
        });

        shipMethodEditContainer.addEventListener('click', () => {
            shipMethodArrowContainer.classList.add('active');
            shipMethodCheckContainer.classList.remove('active');
            shipMethodEditContainer.classList.remove('active');
            checkoutInformationShipMethod.classList.add('active');
            checkoutInformationPayment.classList.remove('active');
        });

        checkoutBackPayment.addEventListener('click', () => {
            shipMethodArrowContainer.classList.add('active');
            shipMethodCheckContainer.classList.remove('active');
            shipMethodEditContainer.classList.remove('active');
            checkoutInformationShipMethod.classList.add('active');
            checkoutInformationPayment.classList.remove('active');
        });
    }
}
refreshListeners();
submitContinueShip.addEventListener('click', refreshListeners);
