/* eslint-env node */
/* eslint no-undef: "off" */
/*
  api/contact.js
  ==============
  Implement the contact form API endpoint.

  Requirements:
  - Handle GET requests: return all contacts from data/contacts.json
  - Handle POST requests: validate and save new contact
  - Validation: name (min 2 chars), email (valid format), message (min 10 chars)
  - Return JSON responses with success/error status
*/

const fs = require('fs');
const path = require('path');
const dataFile = path.join(__dirname, '..', 'data', 'contacts.json');

// TODO: Implement handleRequest(req, res)
// - Route to GET or POST handler based on req.method
// - Return 405 for other methods

// TODO: Implement handleGetRequest(req, res)
// - Read and return contacts from dataFile

// TODO: Implement handlePostRequest(req, res)
// - Parse JSON body, validate, save contact

// TODO: Implement validateInput(data)
// - Return array of error messages

// TODO: Implement saveContact(data)
// - Add contact to file with id and timestamp

module.exports = { handleRequest };
