<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>POS Kontraktor | PT Green Sukses Lestari</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="POS Kontraktor - Sistem Manajemen Proyek Konstruksi PT Green Sukses Lestari.">
  <meta name="author" content="PT Green Sukses Lestari">
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    body {
      background: linear-gradient(135deg, #e8fce8, #c9f9c9);
      color: #1b5e20;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }

    .welcome-container {
      min-height: 100vh;
      padding: 20px;
      animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .logo {
      width: 120px;
      margin-bottom: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.05);
    }

    .btn-green {
      background-color: #43a047;
      color: white;
      border-radius: 50px;
      padding: 10px 25px;
      font-size: 1.1rem;
      box-shadow: 0 4px 10px rgba(0, 128, 0, 0.2);
      transition: background-color 0.3s ease;
    }

    .btn-green:hover {
      background-color: #2e7d32;
    }

    footer {
      margin-top: 50px;
      font-size: 0.875rem;
      color: #4e944f;
    }

    @media (max-width: 576px) {
      h1 {
        font-size: 1.8rem;
      }
      .lead {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="container welcome-container d-flex flex-column justify-content-center align-items-center text-center">
    <img src="assets/img/logo.png" alt="Logo PT Green Sukses Lestari" class="logo">
    
    <h1 class="fw-bold">POS Kontraktor</h1>
    
    <p class="lead mb-2">Sistem Manajemen Proyek Konstruksi<br><strong>PT Green Sukses Lestari</strong></p>
    
    <p class="fst-italic text-muted mb-4">"Bangun dengan Cerdas, Kelola dengan Profesional."</p>

    <a href="admin/login.php" class="btn btn-green">🔐 Masuk Sebagai Admin</a>
    
    <p class="text-muted small mt-3">Versi 1.0 - Stabil</p>

    <footer class="text-center mt-4">
      &copy; <?= date('Y') ?> PT Green Sukses Lestari. All rights reserved.
    </footer>
  </div>
</body>
</html>
