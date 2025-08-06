<?php
include '../header.php';
include '../topbar.php';
include '../sidebar.php';
require '../../inc/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pengeluaran_lain WHERE id=$id"));
$proyek = mysqli_query($conn, "SELECT * FROM proyek");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $proyek_id  = $_POST['proyek_id'];
  $keterangan = $_POST['keterangan'];
  $jumlah     = $_POST['jumlah'];
  $tanggal    = $_POST['tanggal'];

  mysqli_query($conn, "UPDATE pengeluaran_lain SET 
    proyek_id='$proyek_id', keterangan='$keterangan', jumlah='$jumlah', tanggal='$tanggal' 
    WHERE id=$id");

  header("Location: index.php");
  exit;
}
?>

<div class="p-4 flex-grow-1">
  <h4>✏️ Edit Pengeluaran</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Proyek</label>
      <select name="proyek_id" class="form-control" required>
        <?php while ($p = mysqli_fetch_assoc($proyek)) : ?>
          <option value="<?= $p['id'] ?>" <?= $data['proyek_id'] == $p['id'] ? 'selected' : '' ?>>
            <?= $p['nama_proyek'] ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Keterangan</label>
      <textarea name="keterangan" class="form-control" required><?= $data['keterangan'] ?></textarea>
    </div>
    <div class="mb-3">
      <label>Jumlah (Rp)</label>
      <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal'] ?>" required>
    </div>
    <button class="btn btn-success">Update</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include '../footer.php'; ?>
