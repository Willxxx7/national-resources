<?php

// PATH: d2-php/api/analyzer.php

// PUT YOUR CODE FROM THIS POINT ONWARD

// Set headers for JSON response and CORS
// header('Content-Type: application/json');
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST, OPTIONS');
// header('Access-Control-Allow-Headers: Content-Type');

// TODO: Implement your solution here
// This script should handle POST requests only
// - Handle OPTIONS request for CORS preflight
// - POST: Accept JSON body with { text: "..." }
// - Validate that text is provided and non-empty
// - Return analysis results from analyzeText()
// Response format:
// Success: { success: true, analysis: {...} }
// Error: { success: false, message: "..." }

// TODO: Implement the analyzeText function
// function analyzeText($text) {
//   Return an array with the following keys:
//   - charCount: total character count (with spaces)
//   - charCountNoSpaces: character count without spaces
//   - wordCount: total word count
//   - sentenceCount: number of sentences (split by .!?)
//   - paragraphCount: number of paragraphs (split by double newlines)
//   - avgWordLength: average word length (1 decimal place)
//   - readingTime: estimated reading time (e.g., "1 min", "2 min")
//   - topWords: array of top 5 words [{word, count}] excluding common words
// }
