<?php
require __DIR__ . '/../header.php';
require __DIR__ . '/../topbar.php';
require __DIR__ . '/../sidebar.php';
require __DIR__ . '/../../inc/koneksi.php';


$data = mysqli_query($conn, "SELECT absensi.*, pekerja.nama AS nama_pekerja, proyek.nama_proyek 
                             FROM absensi 
                             LEFT JOIN pekerja ON absensi.pekerja_id = pekerja.id 
                             LEFT JOIN proyek ON absensi.proyek_id = proyek.id 
                             ORDER BY absensi.tanggal DESC");
?>

<div class="p-4 flex-grow-1">
  <h4>📅 Data Absensi</h4>
  <a href="tambah.php" class="btn btn-success mb-3">➕ Tambah Absensi</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Nama Pekerja</th>
        <th>Proyek</th>
        <th>Hadir</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($data)) : ?>
        <tr>
          <td><?= $row['tanggal'] ?></td>
          <td><?= $row['nama_pekerja'] ?></td>
          <td><?= $row['nama_proyek'] ?></td>
          <td><?= $row['hadir'] ? '✅ Hadir' : '❌ Tidak Hadir' ?></td>
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
