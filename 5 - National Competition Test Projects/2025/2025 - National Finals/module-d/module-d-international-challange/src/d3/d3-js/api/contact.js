/* eslint-env node */
/* eslint no-undef: "off" */
// SOLUTION: api/contact.js
// PUT YOUR CODE FROM THIS POINT ONWARD

const fs = require('fs');
const path = require('path');
const dataFile = path.join(__dirname, '..', 'data', 'contacts.json');

// Main function that handles all requests to /api/contacts
function handleRequest(req, res) {
  if (req.method === 'GET') return handleGetRequest(req, res);
  if (req.method === 'POST') return handlePostRequest(req, res);
  res.writeHead(405, { 'Content-Type': 'application/json' });
  res.end(JSON.stringify({ success: false, message: 'Method not allowed' }));
}

// Handle GET requests - retrieve all contacts
function handleGetRequest(req, res) {
  try {
    const contacts = JSON.parse(fs.readFileSync(dataFile, 'utf8'));
    res.writeHead(200, { 'Content-Type': 'application/json' });
    res.end(JSON.stringify({ success: true, contacts }));
  } catch {
    res.writeHead(500, { 'Content-Type': 'application/json' });
    res.end(JSON.stringify({ success: false, message: 'Server error' }));
  }
}

// Handle POST requests - add new contact
function handlePostRequest(req, res) {
  let body = '';
  req.on('data', (chunk) => (body += chunk));
  req.on('end', () => {
    try {
      const data = JSON.parse(body);
      // Validate input
      const errors = validateInput(data);
      if (errors.length > 0) {
        res.writeHead(400, { 'Content-Type': 'application/json' });
        return res.end(JSON.stringify({ success: false, errors }));
      }
      // Save contact
      const result = saveContact(data);
      res.writeHead(result.success ? 200 : 500, {
        'Content-Type': 'application/json',
      });
      res.end(JSON.stringify(result));
    } catch {
      res.writeHead(400, { 'Content-Type': 'application/json' });
      res.end(JSON.stringify({ success: false, message: 'Invalid JSON data' }));
    }
  });
}

// Validate input data according to requirements
function validateInput(data) {
  const errors = [];
  // Name validation - minimum 2 characters
  if (!data.name || data.name.trim().length < 2)
    errors.push('Name must be at least 2 characters');
  // Email validation - valid email format
  if (!data.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.email.trim()))
    errors.push('Valid email format required');
  // Message validation - minimum 10 characters
  if (!data.message || data.message.trim().length < 10)
    errors.push('Message must be at least 10 characters');
  return errors;
}

// Save contact to existing JSON file
function saveContact(data) {
  try {
    const contacts = JSON.parse(fs.readFileSync(dataFile, 'utf8'));
    // Create new contact with required fields
    const newContact = {
      id: Math.floor(Math.random() * 90000000 + 10000000).toString(),
      name: data.name.trim(),
      email: data.email.trim(),
      message: data.message.trim(),
      timestamp: new Date().toISOString().slice(0, 19).replace('T', ' '),
    };
    // Add to beginning of array (newest first)
    contacts.unshift(newContact);
    fs.writeFileSync(dataFile, JSON.stringify(contacts, null, 2));
    return {
      success: true,
      message: 'Contact saved successfully',
      id: newContact.id,
    };
  } catch {
    return { success: false, message: 'Failed to save contact' };
  }
}

module.exports = { handleRequest };
