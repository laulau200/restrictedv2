<?php
// navbar.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();          // safe: runs only if no session yet
}
?>

<!-- navbar.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php">Administration des informations</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarsExample" aria-controls="navbarsExample"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="add_product.php">Ajouter un produit</a></li>
        <li class="nav-item"><a class="nav-link" href="view_products.php">Tous les produits</a></li>
        <li class="nav-item"><a class="nav-link" href="view_users.php">Tous les utilisateurs</a></li>
      </ul>
      <span class="navbar-text text-white me-3">Hi, <?=htmlspecialchars($_SESSION['username'])?></span>
      <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
    </div>
  </div>
</nav>