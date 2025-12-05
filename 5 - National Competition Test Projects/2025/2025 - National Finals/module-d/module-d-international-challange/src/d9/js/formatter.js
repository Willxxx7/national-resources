// Phone Number Formatter - Solution
// Place your code here

function formatPhoneNumber(phone, format) {
  // Remove all non-digit characters
  var digits = phone.replace(/\D/g, '');

  // Normalize to 10-digit format (without leading 0 or 44)
  var normalized = '';

  if (digits.startsWith('0') && digits.length === 11) {
    // UK format starting with 0
    normalized = digits.substring(1);
  } else if (digits.startsWith('44') && digits.length === 12) {
    // International format starting with 44
    normalized = digits.substring(2);
  } else {
    return { success: false, error: 'Invalid phone number' };
  }

  // Split into parts: area code (4 digits) + subscriber (6 digits)
  var areaCode = normalized.substring(0, 4);
  var subscriber = normalized.substring(4);

  // Format based on selected option
  var formatted = '';

  switch (format) {
    case 'standard':
      formatted = '+44 ' + areaCode + ' ' + subscriber;
      break;
    case 'spaces':
      formatted = '0' + areaCode + ' ' + subscriber;
      break;
    case 'dashes':
      formatted = '0' + areaCode + '-' + subscriber;
      break;
    case 'international':
      formatted = '00 44 ' + areaCode + ' ' + subscriber;
      break;
    default:
      return { success: false, error: 'Invalid format' };
  }

  return { success: true, formatted: formatted };
}

// DOM event handlers
document.getElementById('formatBtn').addEventListener('click', function () {
  var phone = document.getElementById('phoneInput').value;
  var format = document.getElementById('formatSelect').value;

  var result = formatPhoneNumber(phone, format);

  var resultContainer = document.getElementById('resultContainer');
  var errorContainer = document.getElementById('errorContainer');

  if (result.success) {
    document.getElementById('formattedNumber').textContent = result.formatted;
    document.getElementById('originalNumber').textContent = phone;
    resultContainer.style.display = 'block';
    errorContainer.style.display = 'none';
  } else {
    document.getElementById('errorMessage').textContent = result.error;
    errorContainer.style.display = 'block';
    resultContainer.style.display = 'none';
  }
});

document.getElementById('clearBtn').addEventListener('click', function () {
  document.getElementById('phoneInput').value = '';
  document.getElementById('resultContainer').style.display = 'none';
  document.getElementById('errorContainer').style.display = 'none';
});
