<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

require __DIR__ . '/../inc/koneksi.php';
require __DIR__ . '/header.php';
require __DIR__ . '/topbar.php';
require __DIR__ . '/sidebar.php';

$jumlah_proyek    = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM proyek"));
$jumlah_pekerja   = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM pekerja"));
$jumlah_bahan     = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM bahan"));
$jumlah_absensi   = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM absensi"));
$jumlah_pengeluaran = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM pengeluaran_lain"));
?>

<div class="flex-grow-1 p-4">
  <h4 class="mb-4">📊 Dashboard Admin</h4>
  <div class="row g-3">

    <div class="col-md-4">
      <div class="card border-success shadow-sm">
        <div class="card-body">
          <h5 class="card-title">🏗️ Proyek</h5>
          <p class="card-text fs-4"><?= $jumlah_proyek ?> data</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-success shadow-sm">
        <div class="card-body">
          <h5 class="card-title">👷 Pekerja</h5>
          <p class="card-text fs-4"><?= $jumlah_pekerja ?> data</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-success shadow-sm">
        <div class="card-body">
          <h5 class="card-title">🧱 Bahan</h5>
          <p class="card-text fs-4"><?= $jumlah_bahan ?> data</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-success shadow-sm">
        <div class="card-body">
          <h5 class="card-title">🗓️ Absensi</h5>
          <p class="card-text fs-4"><?= $jumlah_absensi ?> entri</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-success shadow-sm">
        <div class="card-body">
          <h5 class="card-title">💸 Pengeluaran</h5>
          <p class="card-text fs-4"><?= $jumlah_pengeluaran ?> data</p>
        </div>
      </div>
    </div>

  </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>
