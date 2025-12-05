<?php

// PATH: d2-php/api/analyzer.php

// PUT YOUR CODE FROM THIS POINT ONWARD

// Set headers for JSON response
// header('Content-Type: application/json');

// TODO: Implement your solution here
// This script should handle POST requests only
// - POST: Accept JSON body with { text: "..." }
// - Validate that text is provided and non-empty
// - Return analysis results
// Response format:
// Success: { success: true, analysis: {...} }
// Error: { success: false, message: "..." }

// TODO: Calculate and return the following metrics:
//   - charCount: total character count (with spaces)
//   - charCountNoSpaces: character count without spaces
//   - wordCount: total word count
