// show hide address form
const btnAddressAdd = document.querySelector('.btn-address-add');
const btnAddressAddCancel = document.querySelector('.btn-address-add-cancel');
const formAddressAdd = document.querySelector('.form-address-add');
const btnAddressAddSubmit = document.getElementById('btn-address-add-submit');

btnAddressAdd.addEventListener('click', () => {
    formAddressAdd.classList.toggle('active');
    btnAddressAdd.classList.toggle('active');
    btnAddressAddCancel.classList.toggle('active');
    if (formAddressUpdate.classList.contains('active')) {
        formAddressUpdate.classList.toggle('active');
        btnAddressUpdateSubmit.classList.toggle('active');
        btnAddressUpdateCancel.classList.toggle('active');
    }
    if (formAddressDelete.classList.contains('active')) {
        formAddressDelete.classList.toggle('active');
        btnAddressDeleteSubmit.classList.toggle('active');
        btnAddressDeleteCancel.classList.toggle('active');
    }
});

btnAddressAddCancel.addEventListener('click', () => {
    formAddressAdd.classList.toggle('active');
    btnAddressAdd.classList.toggle('active');
    btnAddressAddCancel.classList.toggle('active');
});

btnAddressAddSubmit.addEventListener('click', () => {
    formAddressAdd.classList.toggle('active');
    btnAddressAdd.classList.toggle('active');
    btnAddressAddCancel.classList.toggle('active');
});

// show hide add address form based on popup
const popupMessage = document.querySelector('.popup-message');
const listElements = document.querySelectorAll('.list-element');
if (popupMessage) {
    popupMessage.addEventListener('click', (event) => {
        const addressTab = document.getElementById('address-tab-id');
        const addressContent = document.getElementById('address-tab');
        const popupOverlay = document.getElementById('popup-overlay');
        for (let element of listElements) {
            element.classList.remove('activated');
        }
        addressTab.classList.add('activated');
        addressContent.classList.add('activated');
        popupOverlay.style.backgroundColor = 'var(--bg-light)';
        popupOverlay.style.zIndex = '-10';
    });
}
