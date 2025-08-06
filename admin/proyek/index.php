<?php
require __DIR__ . '/../header.php';
require __DIR__ . '/../topbar.php';
require __DIR__ . '/../sidebar.php';
require __DIR__ . '/../../inc/koneksi.php';

$proyek = mysqli_query($conn, "SELECT * FROM proyek ORDER BY id DESC");
?>

<div class="p-4 flex-grow-1">
  <h4>📋 Data Proyek</h4>
  <a href="tambah.php" class="btn btn-success mb-3">➕ Tambah Proyek</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nama Proyek</th>
        <th>Lokasi</th>
        <th>Klien</th>
        <th>Mulai</th>
        <th>Selesai</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($proyek)) : ?>
        <tr>
          <td><?= $row['nama_proyek'] ?></td>
          <td><?= $row['lokasi'] ?></td>
          <td><?= $row['klien'] ?></td>
          <td><?= $row['tanggal_mulai'] ?></td>
          <td><?= $row['tanggal_selesai'] ?></td>
          <td><?= $row['status'] ?></td>
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
