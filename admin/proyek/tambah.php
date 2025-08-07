<?php
require '../../inc/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama_proyek'];
  $lokasi = $_POST['lokasi'];
  $klien = $_POST['klien'];
  $mulai = $_POST['tanggal_mulai'];
  $selesai = $_POST['tanggal_selesai'];
  $status = $_POST['status'];

  mysqli_query($conn, "INSERT INTO proyek (nama_proyek, lokasi, klien, tanggal_mulai, tanggal_selesai, status) 
    VALUES ('$nama', '$lokasi', '$klien', '$mulai', '$selesai', '$status')");

  header("Location: index.php");
  exit;
}
?>

<?php include '../header.php'; ?>
<?php include '../topbar.php'; ?>
<?php include '../sidebar.php'; ?>

<div class="p-4 flex-grow-1">
  <h4>➕ Tambah Proyek</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Nama Proyek</label>
      <input type="text" name="nama_proyek" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Lokasi</label>
      <input type="text" name="lokasi" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Klien</label>
      <input type="text" name="klien" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Tanggal Mulai</label>
      <input type="date" name="tanggal_mulai" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Tanggal Selesai</label>
      <input type="date" name="tanggal_selesai" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-control">
        <option value="Berjalan">Berjalan</option>
        <option value="Selesai">Selesai</option>
      </select>
    </div>
    <button class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include '../footer.php'; ?>
