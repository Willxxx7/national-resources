/*
  js/validator.js
  =================
  Defines the test cases to be run.
  10 tests total - 2 per function
*/

window.__TESTS__ = [
  // isPalindrome (2 tests)
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

  // sum (2 tests)
  { name: 'Sum - small numbers', fn: 'sum', args: [2, 3], expected: 5 },
  { name: 'Sum - string numbers', fn: 'sum', args: ['5', '10'], expected: 15 },

  // isEven (2 tests)
  { name: 'Is Even - 8', fn: 'isEven', args: [8], expected: true },
  {
    name: 'Is Even - odd number (7)',
    fn: 'isEven',
    args: [7],
    expected: false,
  },

  // initials (2 tests)
  {
    name: 'Initials - John Doe',
    fn: 'initials',
    args: ['John Doe'],
    expected: 'J.D.',
  },
  {
    name: 'Initials - middle name',
    fn: 'initials',
    args: ['Grace Murray Hopper'],
    expected: 'G.M.H.',
  },

  // reverseWords (2 tests)
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
