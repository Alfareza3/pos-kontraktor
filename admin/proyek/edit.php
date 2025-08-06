<?php
include '../header.php';
include '../topbar.php';
include '../sidebar.php';
require '../../inc/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM proyek WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama_proyek'];
  $lokasi = $_POST['lokasi'];
  $klien = $_POST['klien'];
  $mulai = $_POST['tanggal_mulai'];
  $selesai = $_POST['tanggal_selesai'];
  $status = $_POST['status'];

  mysqli_query($conn, "UPDATE proyek SET 
    nama_proyek='$nama', lokasi='$lokasi', klien='$klien',
    tanggal_mulai='$mulai', tanggal_selesai='$selesai', status='$status'
    WHERE id=$id");

  header("Location: index.php");
  exit;
}
?>

<div class="p-4 flex-grow-1">
  <h4>✏️ Edit Proyek</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Nama Proyek</label>
      <input type="text" name="nama_proyek" class="form-control" value="<?= $data['nama_proyek'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Lokasi</label>
      <input type="text" name="lokasi" class="form-control" value="<?= $data['lokasi'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Klien</label>
      <input type="text" name="klien" class="form-control" value="<?= $data['klien'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Tanggal Mulai</label>
      <input type="date" name="tanggal_mulai" class="form-control" value="<?= $data['tanggal_mulai'] ?>">
    </div>
    <div class="mb-3">
      <label>Tanggal Selesai</label>
      <input type="date" name="tanggal_selesai" class="form-control" value="<?= $data['tanggal_selesai'] ?>">
    </div>
    <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-control">
        <option <?= $data['status'] == 'Berjalan' ? 'selected' : '' ?>>Berjalan</option>
        <option <?= $data['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
      </select>
    </div>
    <button class="btn btn-success">Update</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include '../footer.php'; ?>
