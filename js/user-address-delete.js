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
    const uAddIdValue = uAddIdElement.textContent;
    formAddressDelete.querySelector('#u_add_id').value = uAddIdValue;
}
