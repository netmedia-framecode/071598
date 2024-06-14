<?php require_once("../controller/izin-export-import.php");
$_SESSION["project_plbn_motamasin"]["name_page"] = "Izin Export Import";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_plbn_motamasin"]["name_page"] ?></h1>
    <div>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#export"><i class="bi bi-download"></i> Export</a>
    </div>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Nama PT</th>
              <th class="text-center">Email</th>
              <th class="text-center">No. Telp</th>
              <th class="text-center">Barang</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">Kapasitas</th>
              <th class="text-center">Tgl Pengiriman</th>
              <th class="text-center">Daerah Asal</th>
              <th class="text-center">Daerah Tujuan</th>
              <th class="text-center">Tgl izin</th>
              <th class="text-center">Tgl ubah</th>
              <th class="text-center" style="width: 200px;">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Nama PT</th>
              <th class="text-center">Email</th>
              <th class="text-center">No. Telp</th>
              <th class="text-center">Barang</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">Kapasitas</th>
              <th class="text-center">Tgl Pengiriman</th>
              <th class="text-center">Daerah Asal</th>
              <th class="text-center">Daerah Tujuan</th>
              <th class="text-center">Tgl izin</th>
              <th class="text-center">Tgl ubah</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($view_data_izin as $data) { ?>
              <tr>
                <td><?= $data['nama_pt'] ?></td>
                <td><?= $data['email'] ?></td>
                <td><?= $data['no_hp'] ?></td>
                <td><?= $data['nama_barang'] ?></td>
                <td><?= $data['nama_kategori'] ?></td>
                <td><?= $data['kapasitas'] ?></td>
                <td><?php $tgl_pengiriman = date_create($data["tgl_pengiriman"]);
                    echo date_format($tgl_pengiriman, "d M Y"); ?></td>
                <td><?= $data['daerah_asal'] ?></td>
                <td><?= $data['daerah_tujuan'] ?></td>
                <td><span class="badge bg-success text-white"><?php $created_at = date_create($data["created_at"]);
                                                              echo date_format($created_at, "d M Y - h:i a"); ?></span></td>
                <td><span class="badge bg-warning"><?php $updated_at = date_create($data["updated_at"]);
                                                    echo date_format($updated_at, "d M Y - h:i a"); ?></span></td>
                <td class="text-center">
                  <form action="" method="post">
                    <input type="hidden" name="id_izin" value="<?= $data['id_izin'] ?>">
                    <button type="submit" name="sending_email_data_izin" class="btn btn-success btn-sm">
                      <i class="bi bi-envelope-at"></i> Kirim ke Email
                    </button>
                  </form>
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_izin'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $data['id_izin'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['nama_pt'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_izin" value="<?= $data['id_izin'] ?>">
                          <input type="hidden" name="nama_ptOld" value="<?= $data['nama_pt'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="id_export_import">Barang Export/Import</label>
                              <select name="id_export_import" class="form-control" id="id_export_import" required>
                                <option value="" selected>Pilih Barang Export/Import</option>
                                <?php $id_export_import = $data['id_export_import'];
                                foreach ($view_export_import as $data_export_import) {
                                  $selected = ($data_export_import['id_export_import'] == $id_export_import) ? 'selected' : ''; ?>
                                  <option value="<?= $data_export_import['id_export_import'] ?>" <?= $selected ?>><?= $data_export_import['nama_barang'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="nama_pt">Nama PT</label>
                              <input type="text" name="nama_pt" value="<?= $data['nama_pt'] ?>" class="form-control" id="nama_pt" required>
                            </div>
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" name="email" value="<?= $data['email'] ?>" class="form-control" id="email" required>
                            </div>
                            <div class="form-group">
                              <label for="no_hp">No. Telp</label>
                              <input type="number" name="no_hp" value="<?= $data['no_hp'] ?>" class="form-control" id="no_hp" required>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_data_izin" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_izin'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $data['id_izin'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['nama_pt'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_izin" value="<?= $data['id_izin'] ?>">
                          <input type="hidden" name="nama_pt" value="<?= $data['nama_pt'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus data ini, klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_data_izin" class="btn btn-danger btn-sm">hapus</button>
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
          <h5 class="modal-title" id="tambahLabel">Tambah Izin Export/Import</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="id_export_import">Barang Export/Import</label>
              <select name="id_export_import" class="form-control" id="id_export_import" required>
                <option value="" selected>Pilih Barang Export/Import</option>
                <?php foreach ($view_export_import as $data_export_import) { ?>
                  <option value="<?= $data_export_import['id_export_import'] ?>"><?= $data_export_import['nama_barang'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="nama_pt">Nama PT</label>
              <input type="text" name="nama_pt" class="form-control" id="nama_pt" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
              <label for="no_hp">No. Telp</label>
              <input type="number" name="no_hp" class="form-control" id="no_hp" required>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_data_izin" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="export" tabindex="-1" aria-labelledby="exportLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-bottom-0 shadow">
          <h5 class="modal-title" id="exportLabel">Export Izin</h5>
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
            <button type="submit" name="export_data_izin" class="btn btn-primary btn-sm">Export</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>