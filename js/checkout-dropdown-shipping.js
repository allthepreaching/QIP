function refreshListeners() {
    if (optionClickedBill) {
        const dropdownShippingAddress = document.querySelector(
            '.checkout-steps-dropdown-shipping-address'
        );
        const dropdownShippingBillType = document.querySelector(
            '.checkout-steps-dropdown-shipping-bill-type'
        );
        const dropdownShippingBackorder = document.querySelector(
            '.checkout-steps-dropdown-shipping-backorder'
        );
        const selectedOptionShippingAddress =
            dropdownShippingAddress.querySelector(
                '.selected-option-shipping-address'
            );
        const selectedOptionShippingBillType =
            dropdownShippingBillType.querySelector(
                '.selected-option-shipping-bill-type'
            );
        const selectedOptionShippingBackorder =
            dropdownShippingBackorder.querySelector(
                '.selected-option-shipping-backorder'
            );
        const optionsShipAddress = dropdownShippingAddress.querySelector(
            '.ship-address-options'
        );
        const optionsShipBillType = dropdownShippingBillType.querySelector(
            '.ship-bill-type-options'
        );
        const optionsShipBackorder = dropdownShippingBackorder.querySelector(
            '.ship-backorder-options'
        );
        const dropDownArrowShipAddress =
            selectedOptionShippingAddress.querySelector('.dropdown-down-arrow');
        const dropDownArrowShipBillType =
            selectedOptionShippingBillType.querySelector(
                '.dropdown-down-arrow'
            );
        const dropDownArrowShipBackorder =
            selectedOptionShippingBackorder.querySelector(
                '.dropdown-down-arrow'
            );
        const checkoutDataShippingAddress = document.querySelector(
            '.checkout-data-shipping-address'
        );
        const checkoutDataShippingBillType = document.querySelector(
            '.checkout-data-shipping-bill-type'
        );
        const checkoutDataShippingBackorder = document.querySelector(
            '.checkout-data-shipping-backorder'
        );
        const submitContinueShip =
            document.getElementById('submitContinueShip');
        const checkoutInformationShipMethod = document.querySelector(
            '.checkout-information-ship-method'
        );
        const checkoutBackShipMethod = document.querySelector(
            '.checkout-back-ship-method'
        );

        window.optionClickedShipAddress = false;
        window.optionClickedShipBillType = false;
        window.optionClickedShipBackorder = false;

        selectedOptionShippingAddress.addEventListener('click', (event) => {
            let selOptShipAddText = event.target.textContent;
            if (selOptShipAddText === 'Select Shipping Address') {
                optionsShipAddress.classList.toggle('active');
                if (
                    !dropDownArrowShipAddress.classList.contains('active') &&
                    !dropDownArrowShipAddress.classList.contains('inactive')
                ) {
                    dropDownArrowShipAddress.classList.toggle('active');
                } else {
                    dropDownArrowShipAddress.classList.toggle('active');
                    dropDownArrowShipAddress.classList.toggle('inactive');
                }
            } else {
                window.optionClickedShipAddress = true;
            }
        });

        optionsShipAddress.addEventListener('click', (event) => {
            if (event.target.tagName === 'LI') {
                selectedOptionShippingAddress.textContent =
                    event.target.textContent;
                checkoutDataShippingAddress.textContent =
                    event.target.textContent;
                optionsShipAddress.classList.remove('active');
                window.optionClickedShipAddress = true;
            }
        });

        selectedOptionShippingBillType.addEventListener('click', (event) => {
            let selOptShipBillTypeText = event.target.textContent;
            if (selOptShipBillTypeText === 'Select Shipment Billing Type') {
                optionsShipBillType.classList.toggle('active');
                if (
                    !dropDownArrowShipBillType.classList.contains('active') &&
                    !dropDownArrowShipBillType.classList.contains('inactive')
                ) {
                    dropDownArrowShipBillType.classList.toggle('active');
                } else {
                    dropDownArrowShipBillType.classList.toggle('active');
                    dropDownArrowShipBillType.classList.toggle('inactive');
                }
            } else {
                window.optionClickedShipBillType = true;
            }
        });

        optionsShipBillType.addEventListener('click', (event) => {
            const billTypeContent = event.target.textContent;
            if (event.target.tagName === 'LI') {
                selectedOptionShippingBillType.textContent =
                    event.target.textContent;
                checkoutDataShippingBillType.textContent =
                    event.target.textContent;
                optionsShipBillType.classList.remove('active');
                window.optionClickedShipBillType = true;
                if (billTypeContent === 'Pre-Pay & Add') {
                    window.shipBillType = false;
                } else {
                    window.shipBillType = true;
                }
            }
        });

        selectedOptionShippingBackorder.addEventListener('click', (event) => {
            let selOptShipBackText = event.target.textContent;
            if (selOptShipBackText === 'Select Shipment Billing Type') {
                optionsShipBackorder.classList.toggle('active');
                if (
                    !dropDownArrowShipBackorder.classList.contains('active') &&
                    !dropDownArrowShipBackorder.classList.contains('inactive')
                ) {
                    dropDownArrowShipBackorder.classList.toggle('active');
                } else {
                    dropDownArrowShipBackorder.classList.toggle('active');
                    dropDownArrowShipBackorder.classList.toggle('inactive');
                }
            } else {
                window.optionClickedShipBackorder = true;
            }
        });

        optionsShipBackorder.addEventListener('click', (event) => {
            if (event.target.tagName === 'LI') {
                selectedOptionShippingBackorder.textContent =
                    event.target.textContent;
                checkoutDataShippingBackorder.textContent =
                    event.target.textContent;
                optionsShipBackorder.classList.remove('active');
                window.optionClickedShipBackorder = true;
            }
        });

        submitContinueShip.addEventListener('click', () => {
            if (
                window.optionClickedShipBillType &&
                window.optionClickedShipBackorder &&
                window.optionClickedShipAddress
            ) {
                shipArrowContainer.classList.remove('active');
                shipCheckContainer.classList.add('active');
                shipEditContainer.classList.add('active');
                checkoutInformationShipping.classList.remove('active');
                checkoutInformationShipMethod.classList.add('active');
            }
        });

        shipEditContainer.addEventListener('click', () => {
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
            checkoutInformationShipping.classList.add('active');
            checkoutInformationShipMethod.classList.remove('active');
            checkoutInformationPayment.classList.remove('active');
            checkoutInformationReview.classList.remove('active');
        });

        checkoutBackShipMethod.addEventListener('click', () => {
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
            checkoutInformationShipping.classList.add('active');
            checkoutInformationShipMethod.classList.remove('active');
            checkoutInformationPayment.classList.remove('active');
            checkoutInformationReview.classList.remove('active');
        });
    }
}
refreshListeners();
submitContinueBill.addEventListener('click', refreshListeners);
