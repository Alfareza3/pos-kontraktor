<?php
include '../header.php';
include '../topbar.php';
include '../sidebar.php';
require '../../inc/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bahan WHERE id=$id"));
$proyek = mysqli_query($conn, "SELECT * FROM proyek");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $proyek_id   = $_POST['proyek_id'];
  $nama_bahan  = $_POST['nama_bahan'];
  $supplier    = $_POST['supplier'];
  $jumlah      = $_POST['jumlah'];
  $satuan      = $_POST['satuan'];
  $harga_total = $_POST['harga_total'];
  $tanggal     = $_POST['tanggal'];

  mysqli_query($conn, "UPDATE bahan SET 
    proyek_id='$proyek_id', nama_bahan='$nama_bahan', supplier='$supplier',
    jumlah='$jumlah', satuan='$satuan', harga_total='$harga_total', tanggal='$tanggal'
    WHERE id=$id");

  header("Location: index.php");
  exit;
}
?>

<div class="p-4 flex-grow-1">
  <h4>✏️ Edit Bahan Bangunan</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Nama Bahan</label>
      <input type="text" name="nama_bahan" class="form-control" value="<?= $data['nama_bahan'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Supplier</label>
      <input type="text" name="supplier" class="form-control" value="<?= $data['supplier'] ?>">
    </div>
    <div class="mb-3">
      <label>Jumlah</label>
      <input type="number" step="0.01" name="jumlah" class="form-control" value="<?= $data['jumlah'] ?>">
    </div>
    <div class="mb-3">
      <label>Satuan</label>
      <input type="text" name="satuan" class="form-control" value="<?= $data['satuan'] ?>">
    </div>
    <div class="mb-3">
      <label>Harga Total</label>
      <input type="number" name="harga_total" class="form-control" value="<?= $data['harga_total'] ?>">
    </div>
    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal'] ?>">
    </div>
    <div class="mb-3">
      <label>Proyek</label>
      <select name="proyek_id" class="form-control" required>
        <option value="">-- Pilih Proyek --</option>
        <?php while ($p = mysqli_fetch_assoc($proyek)) : ?>
          <option value="<?= $p['id'] ?>" <?= $data['proyek_id'] == $p['id'] ? 'selected' : '' ?>>
            <?= $p['nama_proyek'] ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>
    <button class="btn btn-success">Update</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include '../footer.php'; ?>
