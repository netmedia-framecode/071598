<?php

require_once("../config/Base.php");
require_once("../config/Auth.php");
require_once("../config/Alert.php");
        
$keuangan = "SELECT data_izin.*, kategori.nama_kategori, data_barang.nama_barang, export_import.id_kategori, export_import.id_barang, export_import.kapasitas, export_import.tgl_pengiriman, export_import.daerah_asal, export_import.daerah_tujuan
  FROM data_izin 
  JOIN export_import ON data_izin.id_export_import = export_import.id_export_import 
  JOIN kategori ON export_import.id_kategori = kategori.id_kategori 
  JOIN data_barang ON export_import.id_barang = data_barang.id_barang 
  ORDER BY data_izin.id_izin DESC";
$view_keuangan = mysqli_query($conn, $keuangan);
if (isset($_POST["export"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (keuangan($conn, $validated_post, $action = 'export') > 0) {
    $message = "Data keuangan berhasil di unduh.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: keuangan");
    exit();
  }
}