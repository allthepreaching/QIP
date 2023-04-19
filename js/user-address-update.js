const editButtons = document.querySelectorAll('.user-address-edit-icon');
const formAddressUpdate = document.querySelector('.form-address-update');
const btnAddressUpdateSubmit = document.getElementById(
    'btn-address-update-submit'
);
const btnAddressUpdateCancel = document.querySelector(
    '.btn-address-update-cancel'
);

// show hide address form
btnAddressUpdateCancel.addEventListener('click', () => {
    formAddressUpdate.classList.toggle('active');
    btnAddressUpdateSubmit.classList.toggle('active');
    btnAddressUpdateCancel.classList.toggle('active');
    btnAddressAdd.classList.toggle('active');
});

btnAddressUpdateSubmit.addEventListener('click', () => {
    formAddressUpdate.classList.toggle('active');
    btnAddressUpdateSubmit.classList.toggle('active');
    btnAddressUpdateCancel.classList.toggle('active');
});

editButtons.forEach((button) => {
    button.addEventListener('click', handleEditClick);
});

function handleEditClick(event) {
    const clickedIcon = event.target;

    if (!formAddressUpdate.classList.contains('active')) {
        formAddressUpdate.classList.toggle('active');
        btnAddressUpdateSubmit.classList.toggle('active');
        btnAddressUpdateCancel.classList.toggle('active');
        if (btnAddressAdd.classList.contains('active')) {
            btnAddressAdd.classList.toggle('active');
        }
    }
    if (formAddressAdd.classList.contains('active')) {
        formAddressAdd.classList.toggle('active');
        btnAddressAddCancel.classList.toggle('active');
    }
    if (formAddressDelete.classList.contains('active')) {
        formAddressDelete.classList.toggle('active');
        btnAddressDeleteSubmit.classList.toggle('active');
        btnAddressDeleteCancel.classList.toggle('active');
    }

    const parentListing = clickedIcon.closest('.user-address-listing');
    const uAddIdElement = parentListing.querySelector(
        '.user-address-main-info .u-add-id'
    );
    const companyElement = parentListing.querySelector(
        '.user-address-main-info .u-add-company'
    );
    const street1Element = parentListing.querySelector(
        '.user-address-main-info .u-add-street1'
    );
    const street2Element = parentListing.querySelector(
        '.user-address-main-info .u-add-street2'
    );
    const street3Element = parentListing.querySelector(
        '.user-address-main-info .u-add-street3'
    );
    const cityElement = parentListing.querySelector(
        '.user-address-main-info .u-add-city'
    );
    const stateElement = parentListing.querySelector(
        '.user-address-main-info .u-add-state'
    );
    const zipElement = parentListing.querySelector(
        '.user-address-main-info .u-add-zip'
    );
    const shipElement = parentListing.querySelector(
        '.user-address-main-ship-bill .user-address-ship-value'
    );
    const billElement = parentListing.querySelector(
        '.user-address-main-ship-bill .user-address-bill-value'
    );

    const uAddIdValue = uAddIdElement.textContent;
    const companyValue = companyElement.textContent;
    const street1Value = street1Element.textContent;
    const street2Value = street2Element.textContent;
    const street3Value = street3Element.textContent;
    const cityValue = cityElement.textContent;
    const stateValue = stateElement.textContent;
    const zipValue = zipElement.textContent;
    const shipValue = parseInt(shipElement.textContent);
    const billValue = parseInt(billElement.textContent);
    const checkboxShip = formAddressUpdate.querySelector(
        '[name="u_add_shipto"]'
    );
    const checkboxBill = formAddressUpdate.querySelector(
        '[name="u_add_billto"]'
    );

    // fill out the form fields with address data
    formAddressUpdate.querySelector('#u_add_id').value = uAddIdValue;
    formAddressUpdate.querySelector('#u_add_company').value = companyValue;
    formAddressUpdate.querySelector('#u_add_street1').value = street1Value;
    formAddressUpdate.querySelector('#u_add_street2').value = street2Value;
    formAddressUpdate.querySelector('#u_add_street3').value = street3Value;
    formAddressUpdate.querySelector('#u_add_city').value = cityValue;
    formAddressUpdate.querySelector('#u_add_state').value = stateValue;
    formAddressUpdate.querySelector('#u_add_zip').value = zipValue;
    if (shipValue > 0) {
        checkboxShip.checked = true;
    } else {
        checkboxShip.checked = false;
    }
    if (billValue > 0) {
        checkboxBill.checked = true;
    } else {
        checkboxBill.checked = false;
    }
}
