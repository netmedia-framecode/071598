<?php

require_once("config/Base.php");
require_once("config/Alert.php");

$data_izin = "SELECT data_izin.*, kategori.nama_kategori, data_barang.nama_barang, export_import.kapasitas, export_import.tgl_pengiriman, export_import.daerah_asal, export_import.daerah_tujuan
    FROM data_izin 
    JOIN export_import ON data_izin.id_export_import = export_import.id_export_import 
    JOIN kategori ON export_import.id_kategori = kategori.id_kategori 
    JOIN data_barang ON export_import.id_barang = data_barang.id_barang 
    ORDER BY data_izin.id_izin DESC";
$view_data_izin = mysqli_query($conn, $data_izin);
$data_izin_export = "SELECT data_izin.*, kategori.nama_kategori, data_barang.nama_barang, export_import.kapasitas, export_import.tgl_pengiriman, export_import.daerah_asal, export_import.daerah_tujuan
    FROM data_izin 
    JOIN export_import ON data_izin.id_export_import = export_import.id_export_import 
    JOIN kategori ON export_import.id_kategori = kategori.id_kategori 
    JOIN data_barang ON export_import.id_barang = data_barang.id_barang 
    WHERE kategori.nama_kategori LIKE '%Export%' 
    ORDER BY data_izin.id_izin DESC";
$view_data_izin_export = mysqli_query($conn, $data_izin_export);
$data_izin_import = "SELECT data_izin.*, kategori.nama_kategori, data_barang.nama_barang, export_import.kapasitas, export_import.tgl_pengiriman, export_import.daerah_asal, export_import.daerah_tujuan
    FROM data_izin 
    JOIN export_import ON data_izin.id_export_import = export_import.id_export_import 
    JOIN kategori ON export_import.id_kategori = kategori.id_kategori 
    JOIN data_barang ON export_import.id_barang = data_barang.id_barang 
    WHERE kategori.nama_kategori LIKE '%Import%' 
    ORDER BY data_izin.id_izin DESC";
$view_data_izin_import = mysqli_query($conn, $data_izin_import);

if (isset($_POST["check_account"])) {
  $password_encryption = valid($conn, $_POST['password_encryption']);
  $email = valid($conn, $_POST['email']);
  if (password_verify($email, $password_encryption)) {
    $_SESSION["project_plbn_motamasin"]["izin"] = [
      'email' => $email
    ];
    header("Location: surat-izin");
    exit();
  } else {
    $message = "Maaf, seperti ada kesalahan saat memverifikasi link anda, silakan cek kembali link yang kami kirimkan melalui email.";
    $message_type = "danger";
    alert($message, $message_type);
    return false;
  }
}
