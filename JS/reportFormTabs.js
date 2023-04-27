
const stages = document.getElementsByClassName('form-stage');
const tabs = document.getElementsByClassName('form-tab');
const nextButtons = document.getElementsByClassName('next-button');
const prevButtons = document.getElementsByClassName('prev-button');
const descriptionStageButton = document.querySelector('.description-button');

let currentStage = 0;
tabs[currentStage].classList.add('active');
stages[currentStage].classList.add('active');

for (let i = 0; i < nextButtons.length; i++) {
    nextButtons[i].addEventListener('click', () => {
        stages[currentStage].classList.remove('active');
        tabs[currentStage].classList.remove('active');

        currentStage++;
        stages[currentStage].classList.add('active');
        tabs[currentStage].classList.add('active');
    });
}

for (let i = 0; i < prevButtons.length; i++) {
    prevButtons[i].addEventListener('click', () => {
        stages[currentStage].classList.remove('active');
        tabs[currentStage].classList.remove('active');

        currentStage--;
        stages[currentStage].classList.add('active');
        tabs[currentStage].classList.add('active');
    });
}

descriptionStageButton.addEventListener('click', function (event) {
    if (document.getElementById("problemDescription").value.trim() === "") {
        const existingError = document.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }
        document.getElementById("problemDescription").style.borderColor = "red";
        var errorMessage = document.createElement("span");
        errorMessage.className = 'error-message';
        errorMessage.innerHTML = "This field is required *";
        errorMessage.style.color = "red";
        errorMessage.style.fontweight = "bold";
        errorMessage.style.fontSize = "12px";

        var errorContainer = document.getElementById("problemDescription").parentNode;
        var existingErrorMessage = errorContainer.querySelector(".error-message");

        if (existingErrorMessage) {
            errorContainer.removeChild(existingErrorMessage);
        }

        errorContainer.appendChild(errorMessage);

        stages[currentStage].classList.remove('active');
        tabs[currentStage].classList.remove('active');
        currentStage--;
        stages[currentStage].classList.add('active');
        tabs[currentStage].classList.add('active');
    }
});