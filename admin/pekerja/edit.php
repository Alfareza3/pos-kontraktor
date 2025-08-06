<?php
include '../header.php';
include '../topbar.php';
include '../sidebar.php';
require '../../inc/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pekerja WHERE id=$id"));
$proyek = mysqli_query($conn, "SELECT * FROM proyek");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $proyek_id = $_POST['proyek_id'];
  $nama = $_POST['nama'];
  $jabatan = $_POST['jabatan'];
  $upah = $_POST['upah_harian'];

  mysqli_query($conn, "UPDATE pekerja SET 
    proyek_id='$proyek_id', nama='$nama', jabatan='$jabatan', upah_harian='$upah'
    WHERE id=$id");

  header("Location: index.php");
  exit;
}
?>

<div class="p-4 flex-grow-1">
  <h4>✏️ Edit Pekerja</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Nama</label>
      <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Jabatan</label>
      <input type="text" name="jabatan" class="form-control" value="<?= $data['jabatan'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Upah Harian (Rp)</label>
      <input type="number" name="upah_harian" class="form-control" value="<?= $data['upah_harian'] ?>" required>
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
