# D7 - JS Functions (L2)

Using JavaScript only (no libraries), implement five small functions in `js/functions.js` file so that the index page shows PASS/FAIL for each test automatically. Do not modify any other of the provided files.

## Requirements

Implement the following 5 functions that will validate the functionality. Function names must match exactly as below (case-sensitive) in order to pass automatic tests.

### 1. `isPalindrome(str)` → Boolean

- Return true if the cleaned text (lower-case, alphanumeric only) reads the same forwards and backwards.
- `"racecar"` → true, `"hello"` → false, `""` or non-string → false.

### 2. `sum(a, b)` → number

- Add two values and return a number. Accept numeric strings and negatives.
- Examples: `(2,3)` → 5, `("5","10")` → 15, `(-5,10)` → 5.

### 3. `isEven(n)` → Boolean

- Return true if n is an integer evenly divisible by 2.
- `8` → true, `7` → false, `0` → true, `-4` → true, non-integer or NaN → false.

### 4. `initials(fullName)` → string

- Return uppercase initials with dots. Ignore extra spaces.
- `"John Doe"` → "J.D.", `"Grace Murray Hopper"` → "G.M.H.", `"Cher"` → "C.".

### 5. `reverseWords(sentence)` → string

- Return the sentence with words in reverse order, trimming extra spaces.
- `"one two three"` → "three two one", `" hello world "` → "world hello".

## Notes

- Check the browser console for error messages if results do not appear.
- Each function is tested independently — one failing function will not affect the rest.
- There are **10 tests** in total (2 per function).

Place your code in `js/functions.js`
