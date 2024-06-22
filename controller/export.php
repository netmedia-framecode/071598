<?php

require_once("../config/Base.php");
require_once("../config/Auth.php");
require_once("../config/Alert.php");

$kategori = "SELECT * FROM kategori WHERE nama_kategori LIKE '%Export%' ORDER BY id_kategori DESC LIMIT 1";
$view_kategori = mysqli_query($conn, $kategori);
$data_barang = "SELECT * FROM data_barang ORDER BY id_barang DESC";
$view_data_barang = mysqli_query($conn, $data_barang);
$export = "SELECT export_import.*, kategori.id_kategori, data_barang.nama_barang 
  FROM export_import 
  JOIN kategori ON export_import.id_kategori=kategori.id_kategori 
  JOIN data_barang ON export_import.id_barang=data_barang.id_barang 
  WHERE kategori.nama_kategori LIKE '%Export%' 
  ORDER BY export_import.id_export_import DESC";
$view_export = mysqli_query($conn, $export);
if (isset($_POST["edit_export"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (export_import($conn, $validated_post, $action = 'update') > 0) {
    $message = "Data export " . $_POST['nama_barangOld'] . " berhasil diubah.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: export");
    exit();
  }
}
if (isset($_POST["delete_export"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (export_import($conn, $validated_post, $action = 'delete') > 0) {
    $message = "Data export " . $_POST['nama_barang'] . " berhasil dihapus.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: export");
    exit();
  }
}
