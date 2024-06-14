<?php require_once("controller/visitor.php");

require_once __DIR__ . '/assets/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

if (!isset($_GET["post"])) {
  header("Location: surat-izin");
  exit();
} else {
  $id_izin = valid($conn, $_GET["post"]);
  $data_izin_print = "SELECT data_izin.*, kategori.nama_kategori, data_barang.nama_barang, export_import.kapasitas, export_import.tgl_pengiriman, export_import.daerah_asal, export_import.daerah_tujuan
    FROM data_izin 
    JOIN export_import ON data_izin.id_export_import = export_import.id_export_import 
    JOIN kategori ON export_import.id_kategori = kategori.id_kategori 
    JOIN data_barang ON export_import.id_barang = data_barang.id_barang 
    WHERE data_izin.id_izin='$id_izin'";
  $view_data_izin_print = mysqli_query($conn, $data_izin_print);
  $data = mysqli_fetch_assoc($view_data_izin_print);

  $mpdf->WriteHTML('<div style="border-bottom: 3px solid black;width: 100%;">
  <table border="0" style="width: 100%;">
    <tbody>
      <tr>
        <td style="text-align: center;">
          <h3>' . $data['nama_pt'] . '</h3>
          <p style="font-size: 14px;">' . $data['alamat'] . '</p>
        </td>
      </tr>
    </tbody>
  </table>
</div>');

  $mpdf->WriteHTML('
  <h4 style="text-align: center; text-decoration: underline;">SURAT IZIN ' . $data['nama_kategori'] . '</h4>
');

  $mpdf->WriteHTML('<p style="font-weight: bold;">Kepada :</p>
  <p style="font-weight: bold;">Yth. Kepala PLBN Motamasin</p>
  <p style="margin-left: 10px; padding-top: -10px; font-weight: bold;">di-</p>
  <p style="margin-left: 30px; text-decoration: underline; padding-top: -10px; font-weight: bold;">MOTAMASIN</p>
  
  <p>Dengan Hormat,</p>
  <p style="padding-top: -10px;">Yang bertanda tangan dibawah ini:</p>
  <table style="border-collapse: collapse; width: 100%; margin: auto;">
  <tbody>
    <tr>
      <td style="width: 250px; ">Nama Perusahaan Exportir</td>
      <td style="width: 10px; ">:</td>
      <td>' . $data['nama_pt'] . '</td>
    </tr>
    <tr>
      <td>Nama Penanggung Jawab</td>
      <td>:</td>
      <td>' . $data['nama_pj'] . '</td>
    </tr>
    <tr>
      <td>No.Telepon / HP</td>
      <td>:</td>
      <td>' . $data['no_hp'] . '</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>' . $data['alamat'] . '</td>
    </tr>
  </tbody>
  </table>
  <p style="padding-top: -10px;">Dengan ini mengajukan permohonan untuk ' . $data['nama_kategori'] . ' barang ke ' . $data['daerah_tujuan'] . ' melalui PLBN Motamasin, Kiranya kami dapat difasilitasi tempat / ruang kargo untuk proses ' . $data['nama_kategori'] . ' tersebut.</p>
  
  <p>Adapun Komoditas yang akan di ' . $data['nama_kategori'] . ' adalah sebagai berikut :</p>

  <table style="border-collapse: collapse; width: 100%; margin: auto;">
  <thead>
    <tr style="border: 1px solid #000;">
      <th style="border: 1px solid #000;">Barang</th>
      <th style="border: 1px solid #000;">Kapasitas</th>
      <th style="border: 1px solid #000;">Daerah Asal</th>
      <th style="border: 1px solid #000;">Daerah Tujuan</th>
    </tr>
  </thead>
  <tbody id="search-page">
      <tr style="border: 1px solid #000;">
        <td style="border: 1px solid #000;">' . $data['nama_barang'] . '</td>
        <td style="border: 1px solid #000;">' . $data['kapasitas'] . '</td>
        <td style="border: 1px solid #000;">' . $data['daerah_asal'] . '</td>
        <td style="border: 1px solid #000;">' . $data['daerah_tujuan'] . '</td>
      </tr>
    </tbody>
  </table>
  
  <p>Demikian surat permohonan ini dibuat, atas perhatian Bapak / Ibu kami ucapkan terima kasih.</p>
  ');

  $mpdf->WriteHTML('
  <div style="width: 300px; margin-top: 20px; float: right; text-align: right;">
    <p style="text-align: center;">Motamasi, ' . date("d M Y") . '</p>
    <p style="text-align: center; padding-top: -15px;">Pemohon</p>
    <h4 style="padding-top: 50px; text-decoration: underline; text-align: center;">' . $data['nama_pj'] . '</h4>
  </div>
');

  $mpdf->Output();
  // $mpdf->OutputHttpDownload('Data_Izin.pdf');
  // header("Location: surat-izin");
  // exit;
}
