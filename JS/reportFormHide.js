function handleFormSubmission(event) {
    event.preventDefault();

    const form2 = document.getElementById('formCreateReport');
    const successMessage = document.getElementById('success-message');

    form2.style.display = 'none';
    successMessage.style.display = 'block';
  }

  const form = document.getElementById('formCreateReport');
  form.addEventListener('submit', handleFormSubmission);