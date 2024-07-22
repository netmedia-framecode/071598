<?php require_once("../controller/exports.php");
$_SESSION["project_plbn_motamasin"]["name_page"] = "Laporan Export";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_plbn_motamasin"]["name_page"] ?></h1>
    <div>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#export"><i class="bi bi-download"></i> Export</a>
    </div>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Nama Pengirim</th>
              <th class="text-center">No. Plat Kendaraan</th>
              <th class="text-center">Nama Penerima</th>
              <th class="text-center">Barang</th>
              <th class="text-center">Kapasitas</th>
              <th class="text-center">Tgl Pengiriman</th>
              <th class="text-center">Daerah Asal</th>
              <th class="text-center">Daerah Tujuan</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Nama Pengirim</th>
              <th class="text-center">No. Plat Kendaraan</th>
              <th class="text-center">Nama Penerima</th>
              <th class="text-center">Barang</th>
              <th class="text-center">Kapasitas</th>
              <th class="text-center">Tgl Pengiriman</th>
              <th class="text-center">Daerah Asal</th>
              <th class="text-center">Daerah Tujuan</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($view_export as $data) { ?>
              <tr>
                <td><?= $data['nama_pengirim'] ?></td>
                <td><?= $data['no_plat'] ?></td>
                <td><?= $data['nama_penerima'] ?></td>
                <td><?= $data['nama_barang'] ?></td>
                <td><?= $data['kapasitas'] ?></td>
                <td><?php $tgl_pengiriman = date_create($data["tgl_pengiriman"]);
                    echo date_format($tgl_pengiriman, "d M Y"); ?></td>
                <td><?= $data['daerah_asal'] ?></td>
                <td><?= $data['daerah_tujuan'] ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="export" tabindex="-1" aria-labelledby="exportLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-bottom-0 shadow">
          <h5 class="modal-title" id="exportLabel">Export</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="format_file">Format</label>
              <select name="format_file" id="format_file" class="form-select form-control" required>
                <option selected value="">Pilih Format</option>
                <option value="pdf">PDF</option>
                <option value="excel">Excel</option>
              </select>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="export" class="btn btn-primary btn-sm">Export</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>
        