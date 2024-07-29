<?php require_once("../controller/keuangan.php");
$_SESSION["project_plbn_motamasin"]["name_page"] = "Keuangan";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_plbn_motamasin"]["name_page"] ?></h1>
    <div>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
        data-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal"
        data-target="#export"><i class="bi bi-download"></i> Export</a>
    </div>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center" rowspan="2">No</th>
              <th class="text-center" rowspan="2">Tanggal</th>
              <th class="text-center" colspan="6">Ekspor (BC 3.0)</th>
              <th class="text-center" colspan="5">Impor (BC 2.0)</th>
              <th class="text-center" rowspan="2">Aksi</th>
            </tr>
            <tr>
              <th class="text-center">Jumlah PEB</th>
              <th class="text-center">Netto (KG)</th>
              <th class="text-center">Devisa (USD)</th>
              <th class="text-center">Devisa (RP)</th>
              <th class="text-center">Komoditi</th>
              <th class="text-center">Sarana Angkut</th>
              <th class="text-center">Jumlah PIB</th>
              <th class="text-center">Bruto (KG)</th>
              <th class="text-center">Penerimaan Bea Masuk (RP)</th>
              <th class="text-center">Komoditi</th>
              <th class="text-center">Sarana Angkut</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach ($view_keuangan as $data) { ?>
            <tr>
              <td><span class="badge bg-primary text-white"><?= $no++ ?></span></td>
              <td><span class="badge bg-success text-white"><?php $created_at = date_create($data["created_at"]);
                                                              echo date_format($created_at, "d M Y - h:i a"); ?></span>
              </td>
              <td><?= $data['jumlah_peb'] ?></td>
              <td><?= $data['netto'] ?> kg</td>
              <td>$.<?= number_format($data['devisa_usd']) ?></td>
              <td>Rp.<?= number_format($data['devisa_rp']) ?></td>
              <td><?= $data['komoditi_ekspor'] ?></td>
              <td><?= $data['sarana_angkut_ekspor'] ?></td>
              <td><?= $data['jumlah_pib'] ?></td>
              <td><?= $data['bruto'] ?> kg</td>
              <td>Rp.<?= number_format($data['bea_masuk']) ?></td>
              <td><?= $data['komoditi_impor'] ?></td>
              <td><?= $data['sarana_angkut_impor'] ?></td>
              <td class="text-center">
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                  data-target="#ubah<?= $data['id_keuangan'] ?>">
                  <i class="bi bi-pencil-square"></i> Ubah
                </button>
                <div class="modal fade" id="ubah<?= $data['id_keuangan'] ?>" tabindex="-1"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header border-bottom-0 shadow">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="" method="post">
                        <input type="hidden" name="id_keuangan" value="<?= $data['id_keuangan'] ?>">
                        <div class="modal-body">
                          <h3 class="text-center">Ekspor (BC 3.0)</h3>
                          <div class="form-group">
                            <label for="jumlah_peb">Jumlah PEB</label>
                            <input type="number" name="jumlah_peb" value="<?= $data['jumlah_peb']?>"
                              class="form-control" id="jumlah_peb" required>
                          </div>
                          <div class="form-group">
                            <label for="netto">Netto (KG)</label>
                            <input type="number" name="netto" value="<?= $data['netto']?>" class="form-control"
                              id="netto" required>
                          </div>
                          <div class="form-group">
                            <label for="devisa_usd">Devisi (USD)</label>
                            <input type="number" name="devisa_usd" value="<?= $data['devisa_usd']?>"
                              class="form-control" id="devisa_usd" required>
                          </div>
                          <div class="form-group">
                            <label for="devisa_rp">Devisi (RP)</label>
                            <input type="number" name="devisa_rp" value="<?= $data['devisa_rp']?>" class="form-control"
                              id="devisa_rp" required>
                          </div>
                          <div class="form-group">
                            <label for="komoditi_ekspor">Komoditi</label>
                            <input type="text" name="komoditi_ekspor" value="<?= $data['komoditi_ekspor']?>"
                              class="form-control" id="komoditi_ekspor" required>
                          </div>
                          <div class="form-group">
                            <label for="sarana_angkut_ekspor">Sarana Angkut</label>
                            <input type="number" name="sarana_angkut_ekspor" value="<?= $data['sarana_angkut_ekspor']?>"
                              class="form-control" id="sarana_angkut_ekspor" required>
                          </div>
                          <hr>
                          <h3 class="text-center">Impor (BC 2.0)</h3>
                          <div class="form-group">
                            <label for="jumlah_pib">Jumlah PIB</label>
                            <input type="number" name="jumlah_pib" value="<?= $data['jumlah_pib']?>"
                              class="form-control" id="jumlah_pib" required>
                          </div>
                          <div class="form-group">
                            <label for="bruto">Bruto (KG)</label>
                            <input type="number" name="bruto" value="<?= $data['bruto']?>" class="form-control"
                              id="bruto" required>
                          </div>
                          <div class="form-group">
                            <label for="bea_masuk">Penerimaan Bea Masuk (RP)</label>
                            <input type="number" name="bea_masuk" value="<?= $data['bea_masuk']?>" class="form-control"
                              id="bea_masuk" required>
                          </div>
                          <div class="form-group">
                            <label for="komoditi_impor">Komoditi</label>
                            <input type="text0" name="komoditi_impor" value="<?= $data['komoditi_impor']?>"
                              class="form-control" id="komoditi_impor" required>
                          </div>
                          <div class="form-group">
                            <label for="sarana_angkut_impor">Sarana Angkut</label>
                            <input type="number" name="sarana_angkut_impor" value="<?= $data['sarana_angkut_impor']?>"
                              class="form-control" id="sarana_angkut_impor" required>
                          </div>
                        </div>
                        <div class="modal-footer justify-content-center border-top-0">
                          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                          <button type="submit" name="edit" class="btn btn-warning btn-sm">Ubah</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                  data-target="#hapus<?= $data['id_keuangan'] ?>">
                  <i class="bi bi-trash3"></i> Hapus
                </button>
                <div class="modal fade" id="hapus<?= $data['id_keuangan'] ?>" tabindex="-1"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header border-bottom-0 shadow">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="" method="post">
                        <input type="hidden" name="id_keuangan" value="<?= $data['id_keuangan'] ?>">
                        <div class="modal-body">
                          <p>Jika anda yakin ingin menghapus data ini, klik Hapus!</p>
                        </div>
                        <div class="modal-footer justify-content-center border-top-0">
                          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                          <button type="submit" name="delete" class="btn btn-danger btn-sm">hapus</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-bottom-0 shadow">
          <h5 class="modal-title" id="tambahLabel">Tambah Laporan keuangan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <h5 class="text-center">Ekspor (BC 3.0)</h4>
            <div class="form-group">
              <label for="jumlah_peb">Jumlah PEB</label>
              <input type="number" name="jumlah_peb" class="form-control" id="jumlah_peb" required>
            </div>
            <div class="form-group">
              <label for="netto">Netto (KG)</label>
              <input type="number" name="netto" value="<?php if (isset($_POST['netto'])) {
                                                        echo $_POST['netto'];
                                                      } ?>" class="form-control" id="netto" required>
            </div>
            <div class="form-group">
              <label for="devisa_usd">Devisi (USD)</label>
              <input type="number" name="devisa_usd" value="<?php if (isset($_POST['devisa_usd'])) {
                                                        echo $_POST['devisa_usd'];
                                                      } ?>" class="form-control" id="devisa_usd" required>
            </div>
            <div class="form-group">
              <label for="devisa_rp">Devisi (RP)</label>
              <input type="number" name="devisa_rp" value="<?php if (isset($_POST['devisa_rp'])) {
                                                        echo $_POST['devisa_rp'];
                                                      } ?>" class="form-control" id="devisa_rp" required>
            </div>
            <div class="form-group">
              <label for="komoditi_ekspor">Komoditi</label>
              <input type="text" name="komoditi_ekspor" value="<?php if (isset($_POST['komoditi_ekspor'])) {
                                                        echo $_POST['komoditi_ekspor'];
                                                      } ?>" class="form-control" id="komoditi_ekspor" required>
            </div>
            <div class="form-group">
              <label for="sarana_angkut_ekspor">Sarana Angkut</label>
              <input type="number" name="sarana_angkut_ekspor" value="<?php if (isset($_POST['sarana_angkut_ekspor'])) {
                                                        echo $_POST['sarana_angkut_ekspor'];
                                                      } ?>" class="form-control" id="sarana_angkut_ekspor" required>
            </div>
            <hr>
            <h5 class="text-center">Impor (BC 2.0)</h5>
            <div class="form-group">
              <label for="jumlah_pib">Jumlah PIB</label>
              <input type="number" name="jumlah_pib" value="<?php if (isset($_POST['jumlah_pib'])) {
                                                        echo $_POST['jumlah_pib'];
                                                      } ?>" class="form-control" id="jumlah_pib" required>
            </div>
            <div class="form-group">
              <label for="bruto">Bruto (KG)</label>
              <input type="number" name="bruto" value="<?php if (isset($_POST['bruto'])) {
                                                        echo $_POST['bruto'];
                                                      } ?>" class="form-control" id="bruto" required>
            </div>
            <div class="form-group">
              <label for="bea_masuk">Penerimaan Bea Masuk (RP)</label>
              <input type="number" name="bea_masuk" value="<?php if (isset($_POST['bea_masuk'])) {
                                                        echo $_POST['bea_masuk'];
                                                      } ?>" class="form-control" id="bea_masuk" required>
            </div>
            <div class="form-group">
              <label for="komoditi_impor">Komoditi</label>
              <input type="text" name="komoditi_impor" value="<?php if (isset($_POST['komoditi_impor'])) {
                                                        echo $_POST['komoditi_impor'];
                                                      } ?>" class="form-control" id="komoditi_impor" required>
            </div>
            <div class="form-group">
              <label for="sarana_angkut_impor">Sarana Angkut</label>
              <input type="number" name="sarana_angkut_impor" value="<?php if (isset($_POST['sarana_angkut_impor'])) {
                                                        echo $_POST['sarana_angkut_impor'];
                                                      } ?>" class="form-control" id="sarana_angkut_impor" required>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
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