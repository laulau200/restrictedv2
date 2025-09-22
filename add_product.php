<?php include 'auth_check.php'; include 'db_connect.php'; ?>
<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name']);
    $price = trim($_POST['price']);
    $cat   = trim($_POST['category']);
    $details = trim($_POST['details']);

    if ($name === '' || $price === '' || $cat === '') {
        $errors[] = 'Name, price and category are mandatory.';
    } elseif (!filter_var($price, FILTER_VALIDATE_FLOAT)) {
        $errors[] = 'Price must be numeric.';
    }

    if (!$errors) {
        $stmt = $db->prepare(
            "INSERT INTO products (product_name, product_price, product_cat, product_details)
             VALUES (?,?,?,?)"
        );
        $stmt->bind_param("sdss", $name, $price, $cat, $details);   // s = string, d = double
        $stmt->execute();
        $stmt->close();
        header('Location: view_products.php?added=1');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container py-4">
  <h2>Ajouter un produit</h2>
  <?php if ($errors): ?>
    <div class="alert alert-danger"><ul>
      <?php foreach ($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?>
    </ul></div>
  <?php endif; ?>

  <form method="post">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Nom du produit</label>
        <input class="form-control" name="name" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Prix en euros(€)</label>
        <input class="form-control" name="price" type="number" step="0.01" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Catégorie</label>
        <input class="form-control" name="category" required>
      </div>
      <div class="col-12">
        <label class="form-label">Détails</label>
        <textarea class="form-control" rows="3" name="details"></textarea>
      </div>
      <div class="col-12">
        <button class="btn btn-success">Sauver produit</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>