// Get the labels and content divs
const labels = document.querySelectorAll('.tabbed .tab-list label');
const contentDivs = document.querySelectorAll('.account-content > div');

// Set the initial activated label and content div
labels[0].classList.add('activated');
contentDivs[0].classList.add('activated');

// Add click event listeners to the labels
labels.forEach((label) => {
    label.addEventListener('click', () => {
        // Remove the 'activated' class from all labels and content divs
        labels.forEach((label) => {
            label.classList.remove('activated');
        });
        contentDivs.forEach((div) => {
            div.classList.remove('activated');
        });

        // Add the 'activated' class to the clicked label and content div
        label.classList.add('activated');
        const contentDiv = document.getElementById(label.classList[0]);
        contentDiv.classList.add('activated');
    });
});

const labels1 = document.querySelectorAll('.tabbed .tab-list label');
const labels2 = document.querySelectorAll('.account-content label');
const contentDivs2 = document.querySelectorAll('.account-content > div');

// Add click event listeners to the labels2
labels2.forEach((label2) => {
    label2.addEventListener('click', () => {
        // Remove the 'activated' class from all labels2 and content divs
        labels2.forEach((label2) => {
            labels1.forEach((label1) => {
                label1.classList.remove('activated');
            });
        });
        contentDivs2.forEach((div) => {
            div.classList.remove('activated');
        });

        // Add the 'activated' class to the clicked label and content div
        const label5 = document.getElementById(label2.classList[0] + '-id');
        label5.classList.add('activated');
        const contentDiv = document.getElementById(label2.classList[0]);
        contentDiv.classList.add('activated');
    });
});
