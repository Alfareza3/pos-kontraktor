<?php
require __DIR__ . '/../header.php';
require __DIR__ . '/../topbar.php';
require __DIR__ . '/../sidebar.php';
require __DIR__ . '/../../inc/koneksi.php';


$data = mysqli_query($conn, "SELECT pekerja.*, proyek.nama_proyek 
                             FROM pekerja 
                             LEFT JOIN proyek ON pekerja.proyek_id = proyek.id 
                             ORDER BY pekerja.id DESC");
?>

<div class="p-4 flex-grow-1">
  <h4>👷 Data Pekerja</h4>
  <a href="tambah.php" class="btn btn-success mb-3">➕ Tambah Pekerja</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Upah Harian</th>
        <th>Proyek</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($data)) : ?>
        <tr>
          <td><?= $row['nama'] ?></td>
          <td><?= $row['jabatan'] ?></td>
          <td>Rp <?= number_format($row['upah_harian'], 0, ',', '.') ?></td>
          <td><?= $row['nama_proyek'] ?? '-' ?></td>
          <td>
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php include '../footer.php'; ?>
