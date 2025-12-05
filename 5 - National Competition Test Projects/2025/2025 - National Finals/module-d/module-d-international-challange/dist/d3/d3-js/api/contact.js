// PATH: d3-js/api/contact.js

const fs = require('fs');
const path = require('path');
const dataFile = path.join(__dirname, '..', 'data', 'contacts.json');

// PUT YOUR CODE FROM THIS POINT ONWARD
// Main function that handles all requests to /api/contacts
function handleRequest(req, res) {
  // TODO: Implement your solution here
  // This function should handle both GET and POST requests
  // - GET: Return all contacts from data/contacts.json
  // - POST: Validate and save new contact to data/contacts.json
  // Validation requirements:
  // - Name: minimum 2 characters
  // - Email: valid email format
  // - Message: minimum 10 characters
  // Response format:
  // Success: { success: true, message: "...", id: "..." }
  // Error: { success: false, errors: [...] } or { success: false, message: "..." }
}

module.exports = {
  handleRequest,
};
