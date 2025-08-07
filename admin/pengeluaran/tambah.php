<?php
require '../../inc/koneksi.php';

$proyek = mysqli_query($conn, "SELECT * FROM proyek");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $proyek_id  = $_POST['proyek_id'];
  $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
  $jumlah     = $_POST['jumlah'];
  $tanggal    = $_POST['tanggal'];

  $query = "INSERT INTO pengeluaran_lain (proyek_id, keterangan, jumlah, tanggal) 
            VALUES ('$proyek_id', '$keterangan', '$jumlah', '$tanggal')";
  mysqli_query($conn, $query);

  header("Location: index.php");
  exit;
}

include '../header.php';
include '../topbar.php';
include '../sidebar.php';
?>

<div class="p-4 flex-grow-1">
  <h4>➕ Tambah Pengeluaran</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Proyek</label>
      <select name="proyek_id" class="form-control" required>
        <option value="">-- Pilih Proyek --</option>
        <?php while ($p = mysqli_fetch_assoc($proyek)) : ?>
          <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nama_proyek']) ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Keterangan</label>
      <textarea name="keterangan" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label>Jumlah (Rp)</label>
      <input type="number" name="jumlah" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" required>
    </div>
    <button class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include '../footer.php'; ?>
