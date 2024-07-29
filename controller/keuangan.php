<?php

require_once("../config/Base.php");
require_once("../config/Auth.php");
require_once("../config/Alert.php");
        
$keuangan = "SELECT * FROM keuangan ORDER BY id_keuangan DESC";
$view_keuangan = mysqli_query($conn, $keuangan);
if (isset($_POST["add"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (keuangan($conn, $validated_post, $action = 'insert') > 0) {
    $message = "Data keuangan berhasil di tambahkan.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: keuangan");
    exit();
  }
}
if (isset($_POST["edit"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (keuangan($conn, $validated_post, $action = 'update') > 0) {
    $message = "Data keuangan berhasil di ubah.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: keuangan");
    exit();
  }
}
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