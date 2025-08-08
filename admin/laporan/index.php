<?php
require __DIR__ . '/../header.php';
require __DIR__ . '/../topbar.php';
require __DIR__ . '/../sidebar.php';
require __DIR__ . '/../../inc/koneksi.php';

$cari = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : '';

$query = "SELECT * FROM proyek";
if ($cari) {
  $query .= " WHERE nama_proyek LIKE '%$cari%'";
}
$query .= " ORDER BY id DESC";
$proyek = mysqli_query($conn, $query);
?>

<div class="p-4 flex-grow-1">
  <div class="card shadow-sm">
    <div class="card-body">
      <h4 class="mb-3">📊 Laporan Proyek</h4>

      <form method="GET" class="mb-3">
        <div class="input-group">
          <input type="text" name="cari" class="form-control" placeholder="Cari nama proyek..." value="<?= htmlspecialchars($cari) ?>">
          <button class="btn btn-outline-success" type="submit">🔍 Cari</button>
          <?php if ($cari) : ?>
            <a href="index.php" class="btn btn-outline-secondary">🔁 Reset</a>
          <?php endif; ?>
        </div>
      </form>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-light">
            <tr class="text-center">
              <th>Nama Proyek</th>
              <th>Total Bahan</th>
              <th>Total Upah</th>
              <th>Pengeluaran Lain</th>
              <th>Total Keseluruhan</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($proyek) > 0) : ?>
              <?php while ($p = mysqli_fetch_assoc($proyek)) :
                $proyek_id = $p['id'];
                $q_bahan = mysqli_query($conn, "SELECT SUM(harga_total) as total FROM bahan WHERE proyek_id = $proyek_id");
                $total_bahan = (int)(mysqli_fetch_assoc($q_bahan)['total'] ?? 0);
                $q_upah = mysqli_query($conn, "
                  SELECT SUM(upah_borongan) as total
                  FROM pekerja
                  WHERE proyek_id = $proyek_id
                ");
                $total_upah = (int)(mysqli_fetch_assoc($q_upah)['total'] ?? 0);

                $q_lain = mysqli_query($conn, "SELECT SUM(jumlah) as total FROM pengeluaran_lain WHERE proyek_id = $proyek_id");
                $total_lain = (int)(mysqli_fetch_assoc($q_lain)['total'] ?? 0);

                $total_semua = $total_bahan + $total_upah + $total_lain;
              ?>
                <tr>
                  <td><?= htmlspecialchars($p['nama_proyek']) ?></td>
                  <td class="text-end text-primary">Rp <?= number_format($total_bahan, 0, ',', '.') ?></td>
                  <td class="text-end text-warning">Rp <?= number_format($total_upah, 0, ',', '.') ?></td>
                  <td class="text-end text-danger">Rp <?= number_format($total_lain, 0, ',', '.') ?></td>
                  <td class="text-end fw-bold text-success">Rp <?= number_format($total_semua, 0, ',', '.') ?></td>
                </tr>
              <?php endwhile; ?>
            <?php else : ?>
              <tr>
                <td colspan="5" class="text-center text-muted">Data proyek tidak ditemukan.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<?php require __DIR__ . '/../footer.php'; ?>
