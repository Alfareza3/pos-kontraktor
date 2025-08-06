<?php
require __DIR__ . '/../header.php';
require __DIR__ . '/../topbar.php';
require __DIR__ . '/../sidebar.php';
require __DIR__ . '/../../inc/koneksi.php';


$data = mysqli_query($conn, "SELECT bahan.*, proyek.nama_proyek 
                             FROM bahan 
                             LEFT JOIN proyek ON bahan.proyek_id = proyek.id 
                             ORDER BY bahan.id DESC");
?>

<div class="p-4 flex-grow-1">
  <h4>🧱 Data Bahan Bangunan</h4>
  <a href="tambah.php" class="btn btn-success mb-3">➕ Tambah Bahan</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nama Bahan</th>
        <th>Supplier</th>
        <th>Jumlah</th>
        <th>Satuan</th>
        <th>Harga Total</th>
        <th>Tanggal</th>
        <th>Proyek</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($data)) : ?>
        <tr>
          <td><?= $row['nama_bahan'] ?></td>
          <td><?= $row['supplier'] ?></td>
          <td><?= $row['jumlah'] ?></td>
          <td><?= $row['satuan'] ?></td>
          <td>Rp <?= number_format($row['harga_total'], 0, ',', '.') ?></td>
          <td><?= $row['tanggal'] ?></td>
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
