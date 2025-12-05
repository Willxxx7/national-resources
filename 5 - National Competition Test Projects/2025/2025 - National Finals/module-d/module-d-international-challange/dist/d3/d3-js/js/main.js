// PATH: d3/d3-js/js/main.js - DO NOT CHANGE

// Initialize the page
document.addEventListener('DOMContentLoaded', function () {
  // Set footer copyright
  document.getElementById('dynamicFooter').innerHTML =
    '&copy; ' +
    new Date().getFullYear() +
    ' WorldSkills | All rights reserved.';

  // Get form elements
  const form = document.getElementById('contactForm');
  const clearBtn = document.getElementById('clearBtn');
  const resultElement = document.getElementById('result');

  // Handle form submission
  form.addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const data = {
      name: formData.get('name').trim(),
      email: formData.get('email').trim(),
      message: formData.get('message').trim(),
    };

    try {
      const response = await fetch('/api/contacts', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
      });

      const result = await response.json();
      displayResult(result, response.ok);

      if (response.ok && result.success) {
        form.reset();
      }
    } catch (_error) {
      displayResult(
        {
          success: false,
          message: 'Network error occurred',
        },
        false
      );
    }
  });

  // Handle clear button
  clearBtn.addEventListener('click', function () {
    form.reset();
    resultElement.textContent = 'Submit the form to test the API';
    resultElement.style.color = '#333';
    resultElement.style.backgroundColor = '';
    resultElement.style.border = '';
    resultElement.style.padding = '';
    resultElement.style.borderRadius = '';
  });

  // Display result function with proper styling
  function displayResult(result, isSuccess) {
    if (result.success || isSuccess) {
      // Green styling for success
      resultElement.style.color = '#155724';
      resultElement.style.backgroundColor = '#d4edda';
      resultElement.style.border = '1px solid #c3e6cb';
      resultElement.style.padding = '10px';
      resultElement.style.borderRadius = '4px';

      resultElement.textContent = JSON.stringify(
        {
          success: true,
          message: result.message || 'Contact saved successfully',
          id: result.id || Date.now(),
        },
        null,
        2
      );
    } else {
      // Red styling for errors
      resultElement.style.color = '#721c24';
      resultElement.style.backgroundColor = '#f8d7da';
      resultElement.style.border = '1px solid #f5c6cb';
      resultElement.style.padding = '10px';
      resultElement.style.borderRadius = '4px';

      const errorResponse = {
        success: false,
      };

      if (result.errors && Array.isArray(result.errors)) {
        errorResponse.errors = result.errors;
      } else if (result.error) {
        errorResponse.error = result.error;
      } else if (result.message) {
        errorResponse.message = result.message;
      } else {
        errorResponse.message = 'An error occurred';
      }

      resultElement.textContent = JSON.stringify(errorResponse, null, 2);
    }
  }
});
