<?php

require_once("../config/Base.php");
require_once("../config/Auth.php");
require_once("../config/Alert.php");

$kategori = "SELECT * FROM kategori ORDER BY id_kategori DESC";
$view_kategori = mysqli_query($conn, $kategori);
if (isset($_POST["add_kategori"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (kategori($conn, $validated_post, $action = 'insert') > 0) {
    $message = "Kategori baru berhasil ditambahkan.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: kategori");
    exit();
  }
}
if (isset($_POST["edit_kategori"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (kategori($conn, $validated_post, $action = 'update') > 0) {
    $message = "Kategori " . $_POST['nama_kategoriOld'] . " berhasil diubah.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: kategori");
    exit();
  }
}
if (isset($_POST["delete_kategori"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (kategori($conn, $validated_post, $action = 'delete') > 0) {
    $message = "Kategori " . $_POST['nama_kategori'] . " berhasil dihapus.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: kategori");
    exit();
  }
}
