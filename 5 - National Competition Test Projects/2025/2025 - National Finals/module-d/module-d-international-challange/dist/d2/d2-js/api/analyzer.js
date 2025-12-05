/* eslint-env node */
/* eslint no-undef: "off" */
// PATH: d2-js/api/analyzer.js

// PUT YOUR CODE FROM THIS POINT ONWARD
// Main function that handles text analysis requests
function handleRequest(req, res) {
  // TODO: Implement your solution here
  // This function should handle POST requests only
  // - POST: Accept JSON body with { text: "..." }
  // - Validate that text is provided and non-empty
  // - Return analysis results from analyzeText()
  // Response format:
  // Success: { success: true, analysis: {...} }
  // Error: { success: false, message: "..." }
}

// TODO: Implement the analyzeText function
// function analyzeText(text) {
//   Return an object with the following properties:
//   - charCount: total character count (with spaces)
//   - charCountNoSpaces: character count without spaces
//   - wordCount: total word count
//   - sentenceCount: number of sentences (split by .!?)
//   - paragraphCount: number of paragraphs (split by double newlines)
//   - avgWordLength: average word length (1 decimal place)
//   - readingTime: estimated reading time (e.g., "1 min", "2 min")
//   - topWords: array of top 5 words [{word, count}] excluding common words
// }

module.exports = {
  handleRequest,
};
