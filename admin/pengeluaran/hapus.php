<?php
require '../../inc/koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM pengeluaran_lain WHERE id=$id");
header("Location: index.php");
exit;
