<?php require_once("controller/visitor.php");
require_once("templates/top.php");

if (!isset($_GET['auth'])) {
  $password_encryption = "";
} else {
  $password_encryption = valid($conn, $_GET['auth']);
}
?>

<!-- Page title -->
<div id="topOfPage" class="topTabsWrap">
  <div class="main">
    <div class="speedBar">
      <a class="home" href="./">Beranda</a>
      <span class="breadcrumbs_delimiter"> / </span>
      <span class="current">Surat Izin</span>
    </div>
    <h3 class="pageTitle h3">Surat Izin</h3>
  </div>
</div>
<!-- /Page title -->
<!-- Content -->
<div class="mainWrap without_sidebar">
  <div class="main">
    <div class="content">
      <div>
        <?php if (!isset($_SESSION["project_plbn_motamasin"]["izin"])) { ?>
          <form action="" method="post">
            <input type="hidden" name="password_encryption" value="<?= $password_encryption ?>">
            <p>Masukan email untuk memverifikasi!</p>
            <div class="columnsWrap">
              <div class="columns1_6">
                <label class="required" for="sc_contact_form_email">E-mail</label>
                <input id="sc_contact_form_email" type="text" name="email">
              </div>
            </div>
            <div class="sc_contact_form_button" style="margin-top: 20px;">
              <style>
                .sc_contact_form_submit {
                  padding: 10px;
                  border: none;
                  background-color: #1288cf;
                  /* Warna latar belakang tombol */
                  color: white;
                  /* Warna teks tombol */
                  cursor: pointer;
                  /* Mengubah kursor menjadi pointer saat dihover */
                  border-radius: 4px;
                  /* Membuat sudut tombol sedikit melengkung */
                  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1),
                    0 1px 3px rgba(0, 0, 0, 0.08);
                  /* Efek bayangan */
                  transition: all 0.3s ease;
                  /* Animasi transisi */
                }

                .sc_contact_form_submit:hover {
                  background-color: #0f6fa9;
                  /* Warna latar belakang tombol saat dihover */
                  box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2),
                    0 2px 4px rgba(0, 0, 0, 0.1);
                  /* Efek bayangan saat dihover */
                }

                .sc_contact_form_submit:active {
                  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1),
                    0 1px 2px rgba(0, 0, 0, 0.08);
                  /* Efek bayangan saat tombol ditekan */
                  transform: translateY(2px);
                  /* Menurunkan tombol sedikit saat ditekan */
                }
              </style>
              <button type="submit" name="check_account" class="sc_contact_form_submit">Submit</button>
            </div>
          </form>
          <?php } else if (isset($_SESSION["project_plbn_motamasin"]["izin"])) {
          $email = valid($conn, $_SESSION["project_plbn_motamasin"]["izin"]['email']);
          $data_izin_user = "SELECT di.*, k.nama_kategori
              FROM data_izin di
              LEFT JOIN export_import ei ON di.id_export_import = ei.id_export_import
              JOIN kategori k ON ei.id_kategori = k.id_kategori
              WHERE di.email='$email'
              AND di.id_izin IN (
                  SELECT MIN(id_izin)
                  FROM data_izin
                  WHERE email='$email'
                  GROUP BY kode_izin
              )
          ";
          $view_data_izin_user = mysqli_query($conn, $data_izin_user);
          if (mysqli_num_rows($view_data_izin_user) > 0) { ?>
            <style>
              .sc_contact_form_submit {
                padding: 5px;
                border: none;
                background-color: #1288cf;
                /* Warna latar belakang tombol */
                color: white;
                /* Warna teks tombol */
                cursor: pointer;
                /* Mengubah kursor menjadi pointer saat dihover */
                border-radius: 4px;
                /* Membuat sudut tombol sedikit melengkung */
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1),
                  0 1px 3px rgba(0, 0, 0, 0.08);
                /* Efek bayangan */
                transition: all 0.3s ease;
                /* Animasi transisi */
              }

              .sc_contact_form_submit:hover {
                background-color: #0f6fa9;
                /* Warna latar belakang tombol saat dihover */
                box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2),
                  0 2px 4px rgba(0, 0, 0, 0.1);
                /* Efek bayangan saat dihover */
              }

              .sc_contact_form_submit:active {
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1),
                  0 1px 2px rgba(0, 0, 0, 0.08);
                /* Efek bayangan saat tombol ditekan */
                transform: translateY(2px);
                /* Menurunkan tombol sedikit saat ditekan */
              }
            </style>
            <div class="table-responsive" style="overflow-x: auto;">
              <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th class="text-center">File</th>
                    <th class="text-center">Tgl izin</th>
                    <th class="text-center">Nama PT</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">No. Telp</th>
                    <th class="text-center">Kategori</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($view_data_izin_user as $data) { ?>
                    <tr>
                      <td>
                        <a href="export-pdf-izin?post=<?= $data['kode_izin'] ?>" class="sc_contact_form_submit">Cetak</a>
                      </td>
                      <td><span class="badge bg-success text-white"><?php $created_at = date_create($data["created_at"]);
                                                                    echo date_format($created_at, "d M Y - h:i a"); ?></span></td>
                      <td><?= $data['nama_pt'] ?></td>
                      <td><?= $data['email'] ?></td>
                      <td><?= $data['no_hp'] ?></td>
                      <td><?= $data['nama_kategori'] ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
        <?php }
        } ?>
      </div>
    </div>
  </div>
</div>
<!-- /Content -->

<?php require_once("templates/bottom.php"); ?>