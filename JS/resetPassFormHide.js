var stepVal = document.getElementById('step').value;

  function handleFormSubmission(event) {
    event.preventDefault();
    if (stepVal == "step1"){
      const form3 = document.getElementById('formResetPassword');
      const successMessage = document.getElementById('success-message');

      form3.style.display = 'none';
      successMessage.style.display = 'block';
    }
    else{
      const password = document.getElementById("password");
      const confirm_password = document.getElementById("confirm_password");
      const error_message = document.getElementById("error-message");

      if (password.value !== confirm_password.value) {
        error_message.textContent = "Passwords do not match"
      }
      else{
        const form4 = document.getElementById('formResetPassword2');
        const successMessage = document.getElementById('success-message2');

        form4.style.display = 'none';
        successMessage.style.display = 'block';
      }
    }
  }

  if (stepVal == "step1"){
  const form = document.getElementById('formResetPassword');
  form.addEventListener('submit', handleFormSubmission);
  }
  else{
    const form2 = document.getElementById('formResetPassword2');
    form2.addEventListener('submit', handleFormSubmission);
  }