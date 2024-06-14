<?php require_once("../controller/import.php");
$_SESSION["project_plbn_motamasin"]["name_page"] = "Import";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_plbn_motamasin"]["name_page"] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Barang</th>
              <th class="text-center">Kapasitas</th>
              <th class="text-center">Tgl Pengiriman</th>
              <th class="text-center">Daerah Asal</th>
              <th class="text-center">Daerah Tujuan</th>
              <th class="text-center">Tgl masuk</th>
              <th class="text-center">Tgl ubah</th>
              <th class="text-center" style="width: 200px;">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Barang</th>
              <th class="text-center">Kapasitas</th>
              <th class="text-center">Tgl Pengiriman</th>
              <th class="text-center">Daerah Asal</th>
              <th class="text-center">Daerah Tujuan</th>
              <th class="text-center">Tgl masuk</th>
              <th class="text-center">Tgl ubah</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($view_import as $data) { ?>
              <tr>
                <td><?= $data['nama_barang'] ?></td>
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
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_export_import'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $data['id_export_import'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['nama_barang'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_export_import" value="<?= $data['id_export_import'] ?>">
                          <input type="hidden" name="nama_barangOld" value="<?= $data['nama_barang'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="id_barang">Barang</label>
                              <select name="id_barang" class="form-control" id="id_barang" required>
                                <option value="" selected>Pilih Barang</option>
                                <?php $id_barang = $data['id_barang'];
                                foreach ($view_data_barang as $data_data_barang) {
                                  $selected = ($data_data_barang['id_barang'] == $id_barang) ? 'selected' : ''; ?>
                                  <option value="<?= $data_data_barang['id_barang'] ?>" <?= $selected ?>><?= $data_data_barang['nama_barang'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="kapasitas">Kapasitas</label>
                              <input type="text" name="kapasitas" value="<?= $data['kapasitas'] ?>" class="form-control" id="kapasitas" required>
                            </div>
                            <div class="form-group">
                              <label for="tgl_pengiriman">Tgl Pengiriman</label>
                              <input type="date" name="tgl_pengiriman" value="<?= $data['tgl_pengiriman'] ?>" class="form-control" id="tgl_pengiriman" required>
                            </div>
                            <div class="form-group">
                              <label for="daerah_asal">Daerah asal</label>
                              <input type="text" name="daerah_asal" value="<?= $data['daerah_asal'] ?>" class="form-control" id="daerah_asal" required>
                            </div>
                            <div class="form-group">
                              <label for="daerah_tujuan">Daerah tujuan</label>
                              <input type="text" name="daerah_tujuan" value="<?= $data['daerah_tujuan'] ?>" class="form-control" id="daerah_tujuan" required>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_import" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_export_import'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $data['id_export_import'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['nama_barang'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_export_import" value="<?= $data['id_export_import'] ?>">
                          <input type="hidden" name="nama_barang" value="<?= $data['nama_barang'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus data ini, klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_import" class="btn btn-danger btn-sm">hapus</button>
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
          <h5 class="modal-title" id="tambahLabel">Tambah Data Export</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <?php if (mysqli_num_rows($view_kategori)) {
            $data_kategori = mysqli_fetch_assoc($view_kategori); ?>
            <input type="hidden" name="id_kategori" value="<?= $data_kategori['id_kategori'] ?>" class="form-control" id="id_kategori" required>
          <?php } ?>
          <div class="modal-body">
            <div class="form-group">
              <label for="id_barang">Barang</label>
              <select name="id_barang" class="form-control" id="id_barang" required>
                <option value="" selected>Pilih Barang</option>
                <?php foreach ($view_data_barang as $data_data_barang) { ?>
                  <option value="<?= $data_data_barang['id_barang'] ?>"><?= $data_data_barang['nama_barang'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="kapasitas">Kapasitas</label>
              <input type="text" name="kapasitas" class="form-control" id="kapasitas" required>
            </div>
            <div class="form-group">
              <label for="tgl_pengiriman">Tgl Pengiriman</label>
              <input type="date" name="tgl_pengiriman" class="form-control" id="tgl_pengiriman" required>
            </div>
            <div class="form-group">
              <label for="daerah_asal">Daerah asal</label>
              <input type="text" name="daerah_asal" class="form-control" id="daerah_asal" required>
            </div>
            <div class="form-group">
              <label for="daerah_tujuan">Daerah tujuan</label>
              <input type="text" name="daerah_tujuan" class="form-control" id="daerah_tujuan" required>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_import" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>