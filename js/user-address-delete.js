const deleteButtons = document.querySelectorAll('.user-address-delete-icon');
const formAddressDelete = document.querySelector('.form-address-delete');
const btnAddressDeleteSubmit = document.getElementById(
    'btn-address-delete-submit'
);
const btnAddressDeleteCancel = document.querySelector(
    '.btn-address-delete-cancel'
);

// show hide address form
btnAddressDeleteCancel.addEventListener('click', () => {
    formAddressDelete.classList.toggle('active');
    btnAddressDeleteSubmit.classList.toggle('active');
    btnAddressDeleteCancel.classList.toggle('active');
    btnAddressAdd.classList.toggle('active');
});

btnAddressDeleteSubmit.addEventListener('click', () => {
    formAddressDelete.classList.toggle('active');
    btnAddressDeleteSubmit.classList.toggle('active');
    btnAddressDeleteCancel.classList.toggle('active');
});

deleteButtons.forEach((button) => {
    button.addEventListener('click', handleDeleteClick);
});

function handleDeleteClick(event) {
    const clickedIcon = event.target;
    if (!formAddressDelete.classList.contains('active')) {
        formAddressDelete.classList.toggle('active');
        btnAddressDeleteSubmit.classList.toggle('active');
        btnAddressDeleteCancel.classList.toggle('active');
        if (btnAddressAdd.classList.contains('active')) {
            btnAddressAdd.classList.toggle('active');
        }
    }
    if (formAddressAdd.classList.contains('active')) {
        formAddressAdd.classList.toggle('active');
        btnAddressAdd.classList.toggle('active');
        btnAddressAddCancel.classList.toggle('active');
    }
    if (formAddressUpdate.classList.contains('active')) {
        formAddressUpdate.classList.toggle('active');
        btnAddressUpdateSubmit.classList.toggle('active');
        btnAddressUpdateCancel.classList.toggle('active');
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

    const uAddIdValue = uAddIdElement.textContent;
    const companyValue = companyElement.textContent;
    const street1Value = street1Element.textContent;
    const street2Value = street2Element.textContent;
    const street3Value = street3Element.textContent;
    const cityValue = cityElement.textContent;
    const stateValue = stateElement.textContent;
    const zipValue = zipElement.textContent;

    formAddressDelete.querySelector('#u_add_id').value = uAddIdValue;
    formAddressDelete.querySelector('#u_add_company').value = companyValue;
    formAddressDelete.querySelector('#u_add_street1').value = street1Value;
    formAddressDelete.querySelector('#u_add_street2').value = street2Value;
    formAddressDelete.querySelector('#u_add_street3').value = street3Value;
    formAddressDelete.querySelector('#u_add_city').value = cityValue;
    formAddressDelete.querySelector('#u_add_state').value = stateValue;
    formAddressDelete.querySelector('#u_add_zip').value = zipValue;
}
