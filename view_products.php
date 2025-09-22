<?php include 'auth_check.php'; include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>All Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container py-4">
  <h2 class="mb-3">All Products</h2>
  <?php if (isset($_GET['added'])): ?>
    <div class="alert alert-success">Product saved successfully.</div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th><th>Name</th><th>Price ($)</th><th>Category</th><th>Created At</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $res = $db->query("SELECT * FROM products ORDER BY id DESC");
        while ($row = $res->fetch_assoc()):
        ?>
          <tr>
            <td><?=$row['id']?></td>
            <td><?=htmlspecialchars($row['product_name'])?></td>
            <td><?=number_format($row['product_price'],2)?></td>
            <td><?=htmlspecialchars($row['product_cat'])?></td>
            <td><?=$row['created_at']?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>