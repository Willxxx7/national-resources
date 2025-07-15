// Form Handling
(() => {
  const form = document.querySelector('#interest-form');
  const formContent = document.querySelector('#form-content');
  const successMessage = document.querySelector('#success-message');
  const submitButton = document.querySelector('#submit-button');
  const registerAnother = document.querySelector('#register-another');

  const resetForm = () => {
    form.reset();
    formContent.style.display = 'none';
    successMessage.style.display = 'block';
  };

  const enableForm = () => {
    successMessage.style.display = 'none';
    formContent.style.display = 'block';
    submitButton.textContent = 'Register Interest';
    submitButton.disabled = false;
  };

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    // The HTML validation will handle required fields and email format
    if (form.checkValidity()) {
      // Simulate form submission
      submitButton.textContent = 'Submitting...';
      submitButton.disabled = true;

      setTimeout(() => {
        resetForm();
      }, 1500);
    } else {
      // Browser handle displaying validation errors
      form.reportValidity();
    }
  });

  registerAnother.addEventListener('click', enableForm);
})();
