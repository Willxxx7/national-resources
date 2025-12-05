<?php

// PATH: php/contact.php
// PUT YOUR CODE FROM THIS POINT ONWARD

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$dataFile = __DIR__ . '/../data/contacts.json';

// TODO: Implement your solution here
// This script should handle POST requests and validate/save contact data

// Requirements:
// - Only accept POST requests (return 405 for other methods)
// - Read JSON input from request body
// - Validate input data:
//   * Name: minimum 2 characters
//   * Email: valid email format
//   * Message: minimum 10 characters
// - Save valid data to data/contacts.json (append to existing data)
// - Return appropriate JSON responses

// Response format:
// Success: { "success": true, "message": "Contact saved successfully", "id": "unique_id" }
// Validation errors: { "success": false, "errors": ["error1", "error2"] }
// Server error: { "success": false, "message": "Error message" }

// Data format for new contact:
// {
//   "id": "unique_id",
//   "name": "Contact Name",
//   "email": "email@example.com",
//   "message": "Contact message",
//   "timestamp": "2025-01-20 14:30:00"
// }
