<?php

require_once("../config/Base.php");
require_once("../config/Auth.php");
require_once("../config/Alert.php");

$import = "SELECT export_import.*, kategori.id_kategori, data_barang.nama_barang, data_izin.nama_pengirim, data_izin.no_plat, data_izin.nama_penerima 
  FROM export_import 
  JOIN kategori ON export_import.id_kategori=kategori.id_kategori 
  JOIN data_barang ON export_import.id_barang=data_barang.id_barang 
  JOIN data_izin ON export_import.id_export_import=data_izin.id_export_import 
  WHERE kategori.nama_kategori LIKE '%Import%' 
  ORDER BY export_import.id_export_import DESC";
$view_import = mysqli_query($conn, $import);
if (isset($_POST["export"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (import($conn, $validated_post, $action = 'export') > 0) {
    $message = "Data import berhasil di unduh.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: imports");
    exit();
  }
}