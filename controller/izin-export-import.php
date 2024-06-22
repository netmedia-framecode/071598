<?php

require_once("../config/Base.php");
require_once("../config/Auth.php");
require_once("../config/Alert.php");

$kategori = "SELECT * FROM kategori ORDER BY id_kategori DESC";
$view_kategori = mysqli_query($conn, $kategori);
$data_barang = "SELECT * FROM data_barang ORDER BY id_barang DESC";
$view_data_barang = mysqli_query($conn, $data_barang);
$export_import = "SELECT export_import.*, data_barang.nama_barang 
    FROM export_import 
    JOIN data_barang ON export_import.id_barang = data_barang.id_barang 
    ORDER BY export_import.id_export_import DESC";
$view_export_import = mysqli_query($conn, $export_import);
$data_izin = "SELECT data_izin.*, kategori.nama_kategori, data_barang.nama_barang, export_import.id_kategori, export_import.id_barang, export_import.kapasitas, export_import.tgl_pengiriman, export_import.daerah_asal, export_import.daerah_tujuan
    FROM data_izin 
    JOIN export_import ON data_izin.id_export_import = export_import.id_export_import 
    JOIN kategori ON export_import.id_kategori = kategori.id_kategori 
    JOIN data_barang ON export_import.id_barang = data_barang.id_barang 
    ORDER BY data_izin.id_izin DESC";
$view_data_izin = mysqli_query($conn, $data_izin);
if (isset($_POST["add_data_izin"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (data_izin($conn, $validated_post, $action = 'insert') > 0) {
    $message = "Data izin berhasil ditambahkan.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: izin-export-import");
    exit();
  }
}
if (isset($_POST["edit_data_izin"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (data_izin($conn, $validated_post, $action = 'update') > 0) {
    $message = "Data izin " . $_POST['nama_ptOld'] . " berhasil diubah.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: izin-export-import");
    exit();
  }
}
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
if (isset($_POST["sending_email_data_izin"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (data_izin($conn, $validated_post, $action = 'sending') > 0) {
    $message = "Data izin berhasil di kirim ke " . $_POST['nama_pt'] . ".";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: izin-export-import");
    exit();
  }
}
if (isset($_POST["delete_data_izin"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (data_izin($conn, $validated_post, $action = 'delete') > 0) {
    $message = "Data izin " . $_POST['nama_pt'] . " berhasil dihapus.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: izin-export-import");
    exit();
  }
}
