
const stages = document.getElementsByClassName('form-stage');
const tabs = document.getElementsByClassName('form-tab');
const nextButtons = document.getElementsByClassName('next-button');
const prevButtons = document.getElementsByClassName('prev-button');

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