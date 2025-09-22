<!-- register.php -->
<?php include('db_connect.php'); session_start(); ?>

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
<!DOCTYPE html>
<html>
<head>
  <title>User Registration</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2>Register</h2>
  <form action="register.php" method="post">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
      <label for="email"    class="form-label">Email</label>
      <input type="email"   class="form-control" id="email"    name="email"    required>
    </div>
    <div class="mb-3">
      <label for="pass1"    class="form-label">Password</label>
      <input type="password" class="form-control" id="pass1"   name="password" required>
    </div>
    <div class="mb-3">
      <label for="pass2"    class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="pass2"   name="confirm_password" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
    <p class="mt-3">Already have an account? <a href="login.php">Log in here</a>.</p>
  </form>
</div>