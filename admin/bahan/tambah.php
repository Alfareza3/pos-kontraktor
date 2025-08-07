<?php
require '../../inc/koneksi.php';
$proyek = mysqli_query($conn, "SELECT * FROM proyek");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $proyek_id   = $_POST['proyek_id'];
  $nama_bahan  = $_POST['nama_bahan'];
  $supplier    = $_POST['supplier'];
  $jumlah      = $_POST['jumlah'];
  $satuan      = $_POST['satuan'];
  $harga_total = $_POST['harga_total'];
  $tanggal     = $_POST['tanggal'];

  mysqli_query($conn, "INSERT INTO bahan (proyek_id, nama_bahan, supplier, jumlah, satuan, harga_total, tanggal)
    VALUES ('$proyek_id', '$nama_bahan', '$supplier', '$jumlah', '$satuan', '$harga_total', '$tanggal')");

  header("Location: index.php");
  exit;
}
?>

<?php include '../header.php'; ?>
<?php include '../topbar.php'; ?>
<?php include '../sidebar.php'; ?>

<div class="p-4 flex-grow-1">
  <h4>➕ Tambah Bahan Bangunan</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Nama Bahan</label>
      <input type="text" name="nama_bahan" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Supplier</label>
      <input type="text" name="supplier" class="form-control">
    </div>
    <div class="mb-3">
      <label>Jumlah</label>
      <input type="number" name="jumlah" step="0.01" class="form-control">
    </div>
    <div class="mb-3">
      <label>Satuan</label>
      <input type="text" name="satuan" class="form-control">
    </div>
    <div class="mb-3">
      <label>Harga Total</label>
      <input type="number" name="harga_total" class="form-control">
    </div>
    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control">
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
