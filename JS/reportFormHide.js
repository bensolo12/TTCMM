function handleFormSubmission(event) {
    event.preventDefault();

    if (document.getElementById("problemDescription").value.trim() === "") {
      event.preventDefault(); 

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

    else {
      const form2 = document.getElementById('formCreateReport');
    const successMessage = document.getElementById('success-message');

    form2.style.display = 'none';
    successMessage.style.display = 'block';
    }
  }

  const form = document.getElementById('formCreateReport');
  form.addEventListener('submit', handleFormSubmission);