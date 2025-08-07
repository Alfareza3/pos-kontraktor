<?php
require __DIR__ . '/../header.php';
require __DIR__ . '/../topbar.php';
require __DIR__ . '/../sidebar.php';
require __DIR__ . '/../../inc/koneksi.php';

$cari = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : '';

$query = "SELECT absensi.*, pekerja.nama AS nama_pekerja, proyek.nama_proyek 
          FROM absensi 
          LEFT JOIN pekerja ON absensi.pekerja_id = pekerja.id 
          LEFT JOIN proyek ON absensi.proyek_id = proyek.id";

if ($cari) {
  $query .= " WHERE pekerja.nama LIKE '%$cari%' 
              OR proyek.nama_proyek LIKE '%$cari%' 
              OR absensi.tanggal LIKE '%$cari%'";
}

$query .= " ORDER BY absensi.tanggal DESC";
$data = mysqli_query($conn, $query);
?>

<div class="p-4 flex-grow-1">
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">📅 Data Absensi</h4>
        <a href="tambah.php" class="btn btn-success">➕ Tambah Absensi</a>
      </div>

      <!-- Form Pencarian -->
      <form method="GET" class="mb-3">
        <div class="input-group">
          <input type="text" name="cari" class="form-control" placeholder="Cari pekerja / proyek / tanggal..." value="<?= htmlspecialchars($cari) ?>">
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
              <th>Tanggal</th>
              <th>Pekerja</th>
              <th>Proyek</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($data) > 0) : ?>
              <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                  <td><?= htmlspecialchars($row['tanggal']) ?></td>
                  <td><?= htmlspecialchars($row['nama_pekerja']) ?></td>
                  <td><?= htmlspecialchars($row['nama_proyek'] ?? '-') ?></td>
                  <td>
                    <?= $row['hadir'] ? '<span class="text-success fw-semibold">✅ Hadir</span>' : '<span class="text-danger fw-semibold">❌ Tidak Hadir</span>' ?>
                  </td>
                  <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-warning">✏️ Edit</a>
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?')">🗑️ Hapus</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else : ?>
              <tr>
                <td colspan="5" class="text-center text-muted">Tidak ada data ditemukan.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<?php include '../footer.php'; ?>
