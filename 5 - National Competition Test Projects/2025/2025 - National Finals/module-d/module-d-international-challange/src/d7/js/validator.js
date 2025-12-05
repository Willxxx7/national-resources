/*
  js/validator.js
  =================
  Defines the test cases to be run.
*/

window.__TESTS__ = [
  // isPalindrome
  {
    name: 'Palindrome - racecar',
    fn: 'isPalindrome',
    args: ['racecar'],
    expected: true,
  },
  {
    name: 'Palindrome - hello',
    fn: 'isPalindrome',
    args: ['hello'],
    expected: false,
  },
  {
    name: 'Palindrome - with case/punctuation',
    fn: 'isPalindrome',
    args: ['A man, a plan, a canal: Panama'],
    expected: true,
  },
  {
    name: 'Palindrome - empty string',
    fn: 'isPalindrome',
    args: [''],
    expected: false,
  },
  {
    name: 'Palindrome - non-string input',
    fn: 'isPalindrome',
    args: [null],
    expected: false,
  },

  // sum
  { name: 'Sum - small numbers', fn: 'sum', args: [2, 3], expected: 5 },
  { name: 'Sum - string numbers', fn: 'sum', args: ['5', '10'], expected: 15 },
  { name: 'Sum - negative numbers', fn: 'sum', args: [-5, 10], expected: 5 },
  { name: 'Sum - with zero', fn: 'sum', args: [0, 100], expected: 100 },

  // isEven
  { name: 'Is Even - 8', fn: 'isEven', args: [8], expected: true },
  {
    name: 'Is Even - odd number (7)',
    fn: 'isEven',
    args: [7],
    expected: false,
  },
  { name: 'Is Even - zero', fn: 'isEven', args: [0], expected: true },
  {
    name: 'Is Even - negative even (-4)',
    fn: 'isEven',
    args: [-4],
    expected: true,
  },
  {
    name: 'Is Even - non-integer (4.5)',
    fn: 'isEven',
    args: [4.5],
    expected: false,
  },

  // initials
  {
    name: 'Initials - John Doe',
    fn: 'initials',
    args: ['John Doe'],
    expected: 'J.D.',
  },
  {
    name: 'Initials - extra whitespace',
    fn: 'initials',
    args: ['  Ada   Lovelace  '],
    expected: 'A.L.',
  },
  {
    name: 'Initials - middle name',
    fn: 'initials',
    args: ['Grace Murray Hopper'],
    expected: 'G.M.H.',
  },
  {
    name: 'Initials - single name',
    fn: 'initials',
    args: ['Cher'],
    expected: 'C.',
  },
  {
    name: 'Initials - lowercase input',
    fn: 'initials',
    args: ['jane doe'],
    expected: 'J.D.',
  },

  // reverseWords
  {
    name: 'Reverse Words - basic sentence',
    fn: 'reverseWords',
    args: ['one two three'],
    expected: 'three two one',
  },
  {
    name: 'Reverse Words - extra spacing',
    fn: 'reverseWords',
    args: ['  hello   world  '],
    expected: 'world hello',
  },
];
