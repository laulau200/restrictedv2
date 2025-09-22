<?php
// register.php (continuation)

// Initialize an errors array
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and retrieve inputs
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $pass1    = $_POST['password'];
    $pass2    = $_POST['confirm_password'];

    // Basic validation
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    }
    if (empty($pass1)) {
        $errors[] = "Password is required";
    }
    if ($pass1 !== $pass2) {
        $errors[] = "Passwords do not match";
    }

    // If no errors, proceed to insert
    if (empty($errors)) {
        // Hash the password securely
        $hashedPassword = password_hash($pass1, PASSWORD_DEFAULT);
        
        // Check if the username or email already exists
        $stmt = $db->prepare("SELECT id FROM users WHERE username=? OR email=? LIMIT 1");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows === 0) {
            // Insert new user record
            $stmt->close();
            $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashedPassword);
            $stmt->execute();
            $stmt->close();

            // Registration successful - redirect to login
            header("Location: login.php");
            exit();
        } else {
            // Username or email taken
            $errors[] = "Username or email already exists";
        }
    }
}

// Display errors (if any)
if (!empty($errors)) {
    echo '<div class="alert alert-danger"><ul>';
    foreach ($errors as $e) {
        echo "<li>" . htmlspecialchars($e) . "</li>";
    }
    echo '</ul></div>';
}
?>