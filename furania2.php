<?php
// conversion

include './config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:furania.php');

      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/hero.css">
    <meta name="description" content="Exemple de structure d'une page web">
   <meta name="keywords" content="HTML, CSS, Javascript, JQuery">
   <meta name="author" content="Laurent DEMAZY">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="keywords" content="technicien informatique, administrateur réseaux, windows, linux">
   <meta name="author" content="Laurent DEMAZY">
   <meta http-equiv="refresh" content="300">
   <meta name="color-scheme" content="dark light">
   <meta http-equiv="Cache-Control" content="no-cache">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

   <style>
      /* https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_hero_image */
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.hero-image {
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("photographer.jpg");
  height: 50%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}

.hero-text button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 10px 25px;
  color: black;
  background-color: #ddd;
  text-align: center;
  cursor: pointer;
}

.hero-text button:hover {
  background-color: #555;
  color: white;
}
</style>
    <title>Accueil</title>
</head>
<body>
    <header class="hero">
        <div class="hero-content">
            <h1 class="hero-title">le sport pour le plaisir ! </h1>
            <p class="hero-subtitle">Pour la santé, rien de mieux qu'un peu de course...</p>
            <a href="./furania.php" class="hero-button">Découvrez...</a>
        </div>
    </header>
    <h1>Bienvenue sur la page des Furania Runners</h1>
    <br>
    <!-- zone de log -->
<form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="submit" name="submit" value="login now" class="btn">
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>
<!-- fin log -->
 <div class="container">
   <article>
          <img src="./img/runner.gif" alt="smiley qui court"><br>
          
            
        </article>
        <article>
         <p>Equipe de courreurs amateurs mais mordus de course à pied sans objectif perf ! </p>
        </article>
    

 </div>

    
    <footer>
        <p style="color:green">Nous contacter : <a href="mailto:laurent.demazy@gmail.com">Envoyer Email</a></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>