<?php
header('Content-Type: application/json');

// Initialize response array
$response = array('status' => 'error', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Input validation
    $errors = [];

    // Check for username
    if (empty($_POST['user_username'])) {
        $errors[] = "Username is required.";
    }

    // Check for full name
    if (empty($_POST['user_fullname']) || !preg_match("/^[a-zA-Z\s]+$/", $_POST['user_fullname'])) {
        $errors[] = "Valid full name is required (letters and spaces only).";
    }

    // Check for email
    if (empty($_POST['user_email']) || !filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }

    // Check for contact
    if (empty($_POST['user_contact']) || !preg_match("/^\d{10}$/", $_POST['user_contact'])) {
        $errors[] = "Contact number must be exactly 10 digits.";
    }

    // If there are errors
    if (!empty($errors)) {
        $response['message'] = implode('<br>', $errors);
    } else {
        // Process the form and save data into database here
        $response['status'] = 'success';
        $response['message'] = 'Registration successful!';
    }
}

echo json_encode($response);
?>
