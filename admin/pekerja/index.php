<?php
require __DIR__ . '/../header.php';
require __DIR__ . '/../topbar.php';
require __DIR__ . '/../sidebar.php';
require __DIR__ . '/../../inc/koneksi.php';

// Pencarian
$cari = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : '';

if ($cari) {
  $data = mysqli_query($conn, "SELECT pekerja.*, proyek.nama_proyek 
                               FROM pekerja 
                               LEFT JOIN proyek ON pekerja.proyek_id = proyek.id 
                               WHERE pekerja.nama LIKE '%$cari%' 
                                  OR pekerja.jabatan LIKE '%$cari%' 
                                  OR proyek.nama_proyek LIKE '%$cari%'
                               ORDER BY pekerja.id DESC");
} else {
  $data = mysqli_query($conn, "SELECT pekerja.*, proyek.nama_proyek 
                               FROM pekerja 
                               LEFT JOIN proyek ON pekerja.proyek_id = proyek.id 
                               ORDER BY pekerja.id DESC");
}
?>

<div class="p-4 flex-grow-1">
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">👷 Data Pekerja</h4>
        <a href="tambah.php" class="btn btn-success">➕ Tambah Pekerja</a>
      </div>

      <!-- Form Pencarian -->
      <form method="GET" class="mb-3">
        <div class="input-group">
          <input type="text" name="cari" class="form-control" placeholder="Cari berdasarkan nama, jabatan, atau proyek..." value="<?= htmlspecialchars($cari) ?>">
          <button class="btn btn-outline-success" type="submit">🔍 Cari</button>
          <?php if ($cari) : ?>
            <a href="index.php" class="btn btn-outline-secondary">🔁 Reset</a>
          <?php endif; ?>
        </div>
      </form>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Upah Harian</th>
              <th>Proyek</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($data) > 0) : ?>
              <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                  <td><?= htmlspecialchars($row['nama']) ?></td>
                  <td>
                    <span class="badge bg-primary"><?= htmlspecialchars($row['jabatan']) ?></span>
                  </td>
                  <td>
                    <span class="text-success fw-semibold">Rp <?= number_format($row['upah_harian'], 0, ',', '.') ?></span>
                  </td>
                  <td><?= htmlspecialchars($row['nama_proyek'] ?? '-') ?></td>
                  <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-warning">✏️ Edit</a>
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?')">🗑️ Hapus</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else : ?>
              <tr>
                <td colspan="5" class="text-center text-muted">Data tidak ditemukan.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include '../footer.php'; ?>
