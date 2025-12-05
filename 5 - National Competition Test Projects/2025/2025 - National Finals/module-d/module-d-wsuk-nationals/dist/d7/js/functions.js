/*
  js/functions.js
  =================
  Write your solutions in this file.
*/

/**
 * isPalindrome(str) → Boolean
 * Return true if the cleaned text (lower-case, alphanumeric only) reads the same forwards and backwards.
 * Examples: "racecar" → true, "A man, a plan, a canal: Panama" → true, "hello" → false, "" or non-string → false
 */

//isPalindrome - code here ↓

/**
 * sum(a, b) → number
 * Add two values and return a number. Accept numeric strings and negatives.
 * Examples: (2,3) → 5, ("5","10") → 15, (-5,10) → 5
 */

//sum - code here ↓

/**
 * isEven(n) → Boolean
 * Return true if n is an integer evenly divisible by 2.
 * Examples: 8 → true, 7 → false, 0 → true, -4 → true, non-integer or NaN → false
 */

//isEven - code here ↓

/**
 * initials(fullName) → string
 * Return uppercase initials with dots. Ignore extra spaces.
 * Examples: "John Doe" → "J.D.", "Grace Murray Hopper" → "G.M.H.", "Cher" → "C."
 */

//initials - code here ↓

/**
 * reverseWords(sentence) → string
 * Return the sentence with words in reverse order, trimming extra spaces.
 * Examples: "one two three" → "three two one", " hello world " → "world hello"
 */

//reverseWords - code here ↓

// DO NOT MODIFY BELOW THIS LINE - It's make functions available to the test harness
// ----------------------------------------------------------------------------------
if (typeof window !== 'undefined') {
  if (typeof isPalindrome === 'function') window.isPalindrome = isPalindrome;
  if (typeof sum === 'function') window.sum = sum;
  if (typeof isEven === 'function') window.isEven = isEven;
  if (typeof initials === 'function') window.initials = initials;
  if (typeof reverseWords === 'function') window.reverseWords = reverseWords;
}
