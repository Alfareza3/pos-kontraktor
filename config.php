<?php

$base_url = '/pos-kontraktor/admin/';

$nama_perusahaan = "PT Green Sukses Lestari";

$app_version = "1.0.0";

date_default_timezone_set('Asia/Makassar');

$theme_color = "#a8ff00";

function rupiah($angka)
{
  return "Rp " . number_format($angka, 0, ',', '.');
}

function formatTanggal($tanggal)
{
  if (!$tanggal) return '-';
  $bulan = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  ];
  $pecah = explode('-', $tanggal);
  return $pecah[2] . ' ' . $bulan[(int)$pecah[1] - 1] . ' ' . $pecah[0];
}
