<?php

// SOLUTION: api/contact.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed. Use POST.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid JSON data']);
    exit;
}

$name = trim($input['name'] ?? '');
$email = trim($input['email'] ?? '');
$message = trim($input['message'] ?? '');

$errors = [];
if (strlen($name) < 2) {
    $errors[] = 'Name must be at least 2 characters';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email format required';
}
if (strlen($message) < 10) {
    $errors[] = 'Message must be at least 10 characters';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

$dataDir = __DIR__ . '/../data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}
$filePath = $dataDir . '/contacts.json';

$contacts = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) ?: [] : [];

$contactData = [
    'id' => rand(10000000, 99999999),
    'name' => $name,
    'email' => $email,
    'message' => $message,
    'timestamp' => date('Y-m-d H:i:s')
];

array_unshift($contacts, $contactData);

if (file_put_contents($filePath, json_encode($contacts, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true, 'message' => 'Contact saved successfully', 'id' => $contactData['id']]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Failed to save contact data']);
}
