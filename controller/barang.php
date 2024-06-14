<?php

require_once("../config/Base.php");
require_once("../config/Auth.php");
require_once("../config/Alert.php");

$data_barang = "SELECT * FROM data_barang ORDER BY id_barang DESC";
$view_data_barang = mysqli_query($conn, $data_barang);
if (isset($_POST["add_data_barang"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (data_barang($conn, $validated_post, $action = 'insert') > 0) {
    $message = "Data barang baru berhasil ditambahkan.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: barang");
    exit();
  }
}
if (isset($_POST["edit_data_barang"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (data_barang($conn, $validated_post, $action = 'update') > 0) {
    $message = "Data barang " . $_POST['nama_barangOld'] . " berhasil diubah.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: barang");
    exit();
  }
}
if (isset($_POST["delete_data_barang"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (data_barang($conn, $validated_post, $action = 'delete') > 0) {
    $message = "Data barang " . $_POST['nama_barang'] . " berhasil dihapus.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: barang");
    exit();
  }
}
