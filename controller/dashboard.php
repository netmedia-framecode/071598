<?php

require_once("../config/Base.php");
require_once("../config/Auth.php");
require_once("../config/Alert.php");

$data_barang = "SELECT * FROM data_barang ORDER BY id_barang DESC";
$view_data_barang = mysqli_query($conn, $data_barang);
$export = "SELECT export_import.*, kategori.id_kategori, data_barang.nama_barang 
  FROM export_import 
  JOIN kategori ON export_import.id_kategori=kategori.id_kategori 
  JOIN data_barang ON export_import.id_barang=data_barang.id_barang 
  WHERE kategori.nama_kategori LIKE '%Export%' 
  ORDER BY export_import.id_export_import DESC";
$view_export = mysqli_query($conn, $export);
$import = "SELECT export_import.*, kategori.id_kategori, data_barang.nama_barang 
  FROM export_import 
  JOIN kategori ON export_import.id_kategori=kategori.id_kategori 
  JOIN data_barang ON export_import.id_barang=data_barang.id_barang 
  WHERE kategori.nama_kategori LIKE '%Import%' 
  ORDER BY export_import.id_export_import DESC";
$view_import = mysqli_query($conn, $import);
if (isset($_POST["export_data_izin"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (data_izin($conn, $validated_post, $action = 'export') > 0) {
    $message = "Data izin berhasil di export.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: izin-export-import");
    exit();
  }
}
