<?php include 'auth_check.php'; include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tous les utilisateurs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container py-4">
  <h2 class="mb-3">Utilisateurs enregistrés</h2>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Date inscription</th></tr>
      </thead>
      <tbody>
        <?php
        $result = $db->query("SELECT id, username, email, created_at FROM users ORDER BY id DESC");
        while ($u = $result->fetch_assoc()):
        ?>
          <tr>
            <td><?=$u['id']?></td>
            <td><?=htmlspecialchars($u['username'])?></td>
            <td><?=htmlspecialchars($u['email'])?></td>
            <td><?=$u['created_at']?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>