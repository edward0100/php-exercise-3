<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['file']['name']);

    if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (preg_match('/^[0-9]{10,15}$/', $phone)) {
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
                    echo "File is valid, and was successfully uploaded.\n";
                    echo "Email: $email\n";
                    echo "Phone: $phone\n";
                    echo "File: $uploadFile\n";
                } else {
                    echo "Possible file upload attack!\n";
                }
            } else {
                echo "Invalid phone number. Please enter a valid phone number.\n";
            }
        } else {
            echo "Invalid email address. Please enter a valid email address.\n";
        }
    } else {
        echo "File upload error: " . $_FILES['file']['error'] . "\n";
    }
} else {
    echo "Invalid request method.\n";
}
