<?php
session_start();
require '../inc/koneksi.php';

$error = '';
if (isset($_SESSION['admin'])) {
  header("Location: dashboard.php");
  exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = $_POST['password'];
  $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE username = ?");
  mysqli_stmt_bind_param($stmt, 's', $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($data = mysqli_fetch_assoc($result)) {
    if ($password === $data['password']) {
      $_SESSION['admin'] = $data['username'];
      header("Location: dashboard.php");
      exit;
    } else {
      $error = "Password salah.";
    }
  } else {
    $error = "Username tidak ditemukan.";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin | PT Green Sukses Lestari</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #e8fce8, #c8f7c5);
      font-family: 'Segoe UI', sans-serif;
    }
    .login-card {
      width: 100%;
      max-width: 380px;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      background: #fff;
    }
  </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

  <div class="login-card">
    <h4 class="text-center text-success mb-3">🔐 Login Admin</h4>

    <?php if (!empty($error)) : ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" novalidate>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input autofocus type="text" id="username" name="username" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" required>
      </div>

      <button class="btn btn-success w-100" type="submit">Login</button>
    </form>

    <p class="text-center mt-3 mb-0 text-muted small">&copy; <?= date('Y') ?> PT Green Sukses Lestari</p>
  </div>

</body>
</html>
