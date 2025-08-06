<?php
include '../header.php';
include '../topbar.php';
include '../sidebar.php';
require '../../inc/koneksi.php';

$pekerja = mysqli_query($conn, "SELECT * FROM pekerja");
$proyek = mysqli_query($conn, "SELECT * FROM proyek");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pekerja_id = $_POST['pekerja_id'];
  $proyek_id = $_POST['proyek_id'];
  $tanggal = $_POST['tanggal'];
  $hadir = isset($_POST['hadir']) ? 1 : 0;

  mysqli_query($conn, "INSERT INTO absensi (pekerja_id, proyek_id, tanggal, hadir) 
    VALUES ('$pekerja_id', '$proyek_id', '$tanggal', '$hadir')");

  header("Location: index.php");
  exit;
}
?>

<div class="p-4 flex-grow-1">
  <h4>➕ Tambah Absensi</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Nama Pekerja</label>
      <select name="pekerja_id" class="form-control" required>
        <option value="">-- Pilih Pekerja --</option>
        <?php while ($p = mysqli_fetch_assoc($pekerja)) : ?>
          <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Proyek</label>
      <select name="proyek_id" class="form-control" required>
        <option value="">-- Pilih Proyek --</option>
        <?php while ($p = mysqli_fetch_assoc($proyek)) : ?>
          <option value="<?= $p['id'] ?>"><?= $p['nama_proyek'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" required>
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" name="hadir" class="form-check-input" checked>
      <label class="form-check-label">Hadir</label>
    </div>
    <button class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include '../footer.php'; ?>
