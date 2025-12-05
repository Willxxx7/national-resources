/*
  js/functions.js
  =================
*/

/**
 * Checks if a string is a palindrome, ignoring case and non-alphanumeric characters.
 */
const isPalindrome = (str) => {
  if (typeof str !== 'string') return false;
  const cleaned = str.toLowerCase().replace(/[^a-z0-9]/g, '');
  return cleaned.length > 0 && cleaned === cleaned.split('').reverse().join('');
};

/**
 * Adds two values after converting them to numbers.
 */
const sum = (a, b) => Number(a) + Number(b);

/**
 * Returns true if a value can be considered an even integer.
 */
const isEven = (n) => {
  const num = Number(n);
  return Number.isInteger(num) && num % 2 === 0;
};

/**
 * Converts a full name into initials, e.g., "John doe" -> "J.D."
 */
const initials = (fullName) => {
  if (typeof fullName !== 'string' || !fullName.trim()) return '';
  return (
    fullName
      .trim()
      .split(/\s+/)
      .map((word) => word[0].toUpperCase())
      .join('.') + '.'
  );
};

/**
 * Reverses the order of words in a sentence.
 */
const reverseWords = (sentence) => {
  if (typeof sentence !== 'string') return '';
  return sentence.trim().split(/\s+/).reverse().join(' ');
};

// Make functions available to the test harness
if (typeof window !== 'undefined') {
  window.isPalindrome = isPalindrome;
  window.sum = sum;
  window.isEven = isEven;
  window.initials = initials;
  window.reverseWords = reverseWords;
}
