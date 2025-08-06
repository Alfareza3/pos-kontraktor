<?php
require __DIR__ . '/../header.php';
require __DIR__ . '/../topbar.php';
require __DIR__ . '/../sidebar.php';
require __DIR__ . '/../../inc/koneksi.php';


$proyek = mysqli_query($conn, "SELECT * FROM proyek");
?>

<div class="p-4 flex-grow-1">
  <h4>📊 Laporan Proyek</h4>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Proyek</th>
        <th>Bahan (Rp)</th>
        <th>Upah Pekerja (Rp)</th>
        <th>Pengeluaran Lain (Rp)</th>
        <th>Total (Rp)</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($p = mysqli_fetch_assoc($proyek)) :
        $proyek_id = $p['id'];

        // Total bahan
        $q_bahan = mysqli_query($conn, "SELECT SUM(harga_total) as total FROM bahan WHERE proyek_id = $proyek_id");
        $total_bahan = mysqli_fetch_assoc($q_bahan)['total'] ?? 0;

        // Total upah pekerja dari absensi
        $q_upah = mysqli_query($conn, "
          SELECT SUM(pekerja.upah_harian) as total
          FROM absensi 
          JOIN pekerja ON absensi.pekerja_id = pekerja.id
          WHERE absensi.hadir = 1 AND absensi.proyek_id = $proyek_id
        ");
        $total_upah = mysqli_fetch_assoc($q_upah)['total'] ?? 0;

        // Total pengeluaran lain
        $q_lain = mysqli_query($conn, "SELECT SUM(jumlah) as total FROM pengeluaran_lain WHERE proyek_id = $proyek_id");
        $total_lain = mysqli_fetch_assoc($q_lain)['total'] ?? 0;

        $total_semua = $total_bahan + $total_upah + $total_lain;
      ?>
        <tr>
          <td><?= $p['nama_proyek'] ?></td>
          <td><?= number_format($total_bahan, 0, ',', '.') ?></td>
          <td><?= number_format($total_upah, 0, ',', '.') ?></td>
          <td><?= number_format($total_lain, 0, ',', '.') ?></td>
          <td><strong><?= number_format($total_semua, 0, ',', '.') ?></strong></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php include '../footer.php'; ?>
