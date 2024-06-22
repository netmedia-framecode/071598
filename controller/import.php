<?php

require_once("../config/Base.php");
require_once("../config/Auth.php");
require_once("../config/Alert.php");

$kategori = "SELECT * FROM kategori WHERE nama_kategori LIKE '%Import%' ORDER BY id_kategori DESC LIMIT 1";
$view_kategori = mysqli_query($conn, $kategori);
$data_barang = "SELECT * FROM data_barang ORDER BY id_barang DESC";
$view_data_barang = mysqli_query($conn, $data_barang);
$import = "SELECT export_import.*, kategori.id_kategori, data_barang.nama_barang, data_izin.nama_pengirim, data_izin.no_plat, data_izin.nama_penerima 
  FROM export_import 
  JOIN kategori ON export_import.id_kategori=kategori.id_kategori 
  JOIN data_barang ON export_import.id_barang=data_barang.id_barang 
  JOIN data_izin ON export_import.id_export_import=data_izin.id_export_import 
  WHERE kategori.nama_kategori LIKE '%Import%' 
  ORDER BY export_import.id_export_import DESC";
$view_import = mysqli_query($conn, $import);
if (isset($_POST["edit_import"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (export_import($conn, $validated_post, $action = 'update') > 0) {
    $message = "Data import " . $_POST['nama_barangOld'] . " berhasil diubah.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: import");
    exit();
  }
}
if (isset($_POST["delete_import"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (export_import($conn, $validated_post, $action = 'delete') > 0) {
    $message = "Data import " . $_POST['nama_barang'] . " berhasil dihapus.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: import");
    exit();
  }
}
