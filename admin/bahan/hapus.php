<?php
require '../../inc/koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM bahan WHERE id=$id");
header("Location: index.php");
exit;
