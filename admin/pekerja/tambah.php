<?php
require '../../inc/koneksi.php';

$proyek = mysqli_query($conn, "SELECT * FROM proyek");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $proyek_id = $_POST['proyek_id'];
  $nama = $_POST['nama'];
  $jabatan = $_POST['jabatan'];
  $upah = $_POST['upah_harian'];

  mysqli_query($conn, "INSERT INTO pekerja (proyek_id, nama, jabatan, upah_harian) 
    VALUES ('$proyek_id', '$nama', '$jabatan', '$upah')");

  header("Location: index.php");
  exit;
}

include '../header.php';
include '../topbar.php';
include '../sidebar.php';
?>

<div class="p-4 flex-grow-1">
  <h4>➕ Tambah Pekerja</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Nama</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Jabatan</label>
      <input type="text" name="jabatan" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Upah Harian (Rp)</label>
      <input type="number" name="upah_harian" class="form-control" required>
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
    <button class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include '../footer.php'; ?>
