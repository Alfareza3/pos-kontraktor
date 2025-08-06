<?php
require __DIR__ . '/../header.php';
require __DIR__ . '/../topbar.php';
require __DIR__ . '/../sidebar.php';
require __DIR__ . '/../../inc/koneksi.php';


$data = mysqli_query($conn, "SELECT pengeluaran_lain.*, proyek.nama_proyek 
                             FROM pengeluaran_lain 
                             LEFT JOIN proyek ON pengeluaran_lain.proyek_id = proyek.id 
                             ORDER BY pengeluaran_lain.tanggal DESC");
?>

<div class="p-4 flex-grow-1">
  <h4>💸 Data Pengeluaran Lain-Lain</h4>
  <a href="tambah.php" class="btn btn-success mb-3">➕ Tambah Pengeluaran</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Proyek</th>
        <th>Keterangan</th>
        <th>Jumlah</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($data)) : ?>
        <tr>
          <td><?= $row['tanggal'] ?></td>
          <td><?= $row['nama_proyek'] ?></td>
          <td><?= $row['keterangan'] ?></td>
          <td>Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
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
