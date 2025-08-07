<nav class="navbar navbar-expand-lg navbar-light bg-success p-3 shadow-sm">
  <div class="container-fluid d-flex justify-content-between align-items-center">

    <!-- Logo dan Brand -->
    <a href="/pos-kontraktor/admin/dashboard.php" class="navbar-brand d-flex align-items-center text-white">
      <img src="/pos-kontraktor/assets/img/logo.png" alt="Logo"
           width="40" height="40"
           class="me-2"
           style="object-fit: contain; border-radius: 6px; background: white; padding: 2px;">
      <span class="fw-bold fs-5">PT Green Sukses Lestari</span>
    </a>

    <!-- Jam Digital (hanya muncul di md ke atas) -->
    <div class="text-white fw-semibold d-none d-md-block">
      <i class="bi bi-clock-history me-1"></i><span id="digitalClock"></span>
    </div>

    <!-- Info Admin -->
    <div class="d-flex align-items-center text-white">
      <span class="me-2">
        <i class="bi bi-person-circle"></i> <?= $_SESSION['admin'] ?>
      </span>
      <a href="/pos-kontraktor/admin/logout.php" class="btn btn-sm btn-outline-light ms-2">
        <i class="bi bi-box-arrow-right me-1"></i> Logout
      </a>
    </div>

  </div>
</nav>

<!-- Script Jam -->
<script>
  function updateClock() {
    const now = new Date();
    const jam = now.getHours().toString().padStart(2, '0');
    const menit = now.getMinutes().toString().padStart(2, '0');
    const detik = now.getSeconds().toString().padStart(2, '0');
    document.getElementById('digitalClock').textContent = `${jam}:${menit}:${detik}`;
  }
  setInterval(updateClock, 1000);
  updateClock();
</script>

<!-- CDN Bootstrap Icons (jika belum ada) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
