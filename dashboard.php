<?php include 'auth_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard • MyAdmin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container py-5">
  <h1 class="display-6 mb-4">Bienvenue 👋</h1>

  <div class="row g-4">
    <div class="col-md-4">
      <a class="text-decoration-none" href="add_product.php">
        <div class="card shadow-sm h-100">
          <div class="card-body text-center">
            <h2 class="card-title fs-4 mb-2">Ajouter un produit</h2>
            <p class="card-text">Créer un nouveau produit</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-4">
      <a class="text-decoration-none" href="view_products.php">
        <div class="card shadow-sm h-100">
          <div class="card-body text-center">
            <h2 class="card-title fs-4 mb-2">Liste de produits</h2>
            <p class="card-text">Parcourir / Chercher un produit existant</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-4">
      <a class="text-decoration-none" href="view_users.php">
        <div class="card shadow-sm h-100">
          <div class="card-body text-center">
            <h2 class="card-title fs-4 mb-2">Liste des utilisateurs</h2>
            <p class="card-text">Voir les utilisateurs enregistrés</p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>