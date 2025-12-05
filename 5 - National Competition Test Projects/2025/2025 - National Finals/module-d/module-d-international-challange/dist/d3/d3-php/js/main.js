// PATH: d3/d3-php/js/main.js - DO NOT MODIFY
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

    // Client-side validation
    const validation = validateForm(data);
    if (!validation.isValid) {
      displayResult(
        {
          success: false,
          errors: validation.errors,
        },
        false
      );
      return;
    }

    try {
      const response = await fetch('api/contact.php', {
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
    } catch (error) {
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

  // Validation function
  function validateForm(data) {
    const errors = [];

    // Name validation (minimum 2 characters)
    if (!data.name || data.name.length < 2) {
      errors.push('Name must be at least 2 characters');
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!data.email || !emailRegex.test(data.email)) {
      errors.push('Valid email format required');
    }

    // Message validation (minimum 10 characters)
    if (!data.message || data.message.length < 10) {
      errors.push('Message must be at least 10 characters');
    }

    return {
      isValid: errors.length === 0,
      errors: errors,
    };
  }

  // Display result function with proper styling
  function displayResult(result, isSuccess) {
    if (result.success || isSuccess) {
      // Green styling for success (exactly matching JS version)
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
