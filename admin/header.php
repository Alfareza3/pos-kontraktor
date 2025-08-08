<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel | PT Green Sukses Lestari</title>
  <link rel="icon" href="/pos-kontraktor/assets/img/logo.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <script src="/pos-kontraktor/assets/js/script.js" defer></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }
  </style>
</head>
<body>
