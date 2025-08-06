<?php
require '../../inc/koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM proyek WHERE id=$id");
header("Location: index.php");
exit;
