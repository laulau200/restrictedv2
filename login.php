<!-- login.php -->
<?php include('db_connect.php'); session_start(); ?>
<?php
// login.php (continuation)
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        $errors[] = "Username and password are required";
    } else {
        // Fetch user from database
        $stmt = $db->prepare("SELECT id, password FROM users WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        // Check if user exists
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($user_id, $hashedPassword);
            $stmt->fetch();
            $stmt->close();
            
            // Verify the password against the hash
            if (password_verify($password, $hashedPassword)) {  
                // Password is correct
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");  // redirect to dashboard after login
                exit();
            } else {
                $errors[] = "Incorrect username or password";
            }
        } else {
            $stmt->close();
            $errors[] = "Incorrect username or password";
        }
    }
}

// Display errors
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
  <title>connexion</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2>Login</h2>
  <form action="login.php" method="post">
    <div class="mb-3">
      <label for="username" class="form-label">Nom d'utilisateur</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Mot de passe</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Connexion</button>
    <p class="mt-3">Don't have an account? <a href="register.php">Register here</a>.</p>
  </form>
</div>


    <h1>Bienvenue sur la page du club !</h1> 
    <p>Parcourez nos victoires</p>
    <ul>grandes courses<li></li>
    <li>semi</li>
    <li>10km ou moins</li></ul>
    
</body>
</html>