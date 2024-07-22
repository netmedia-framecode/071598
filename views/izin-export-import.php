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
              <th class="text-center">Kode Izin</th>
              <th class="text-center">Nama PT</th>
              <th class="text-center">Nama Penanggung Jawab</th>
              <th class="text-center">Nama Pengirim</th>
              <th class="text-center">No. Plat Kendaraan</th>
              <th class="text-center">Nama Penerima</th>
              <th class="text-center">Email</th>
              <th class="text-center">No. Telp</th>
              <th class="text-center">Alamat</th>
              <th class="text-center">Jenis Barang</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">Kapasitas</th>
              <th class="text-center">Tgl Pengiriman</th>
              <th class="text-center">Daerah Asal</th>
              <th class="text-center">Daerah Tujuan</th>
              <th class="text-center">BEA Masuk</th>
              <th class="text-center">Total Harga</th>
              <th class="text-center">Tgl izin</th>
              <th class="text-center">Tgl ubah</th>
              <th class="text-center" style="width: 200px;">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Kode Izin</th>
              <th class="text-center">Nama PT</th>
              <th class="text-center">Nama Penanggung Jawab</th>
              <th class="text-center">Nama Pengirim</th>
              <th class="text-center">No. Plat Kendaraan</th>
              <th class="text-center">Nama Penerima</th>
              <th class="text-center">Email</th>
              <th class="text-center">No. Telp</th>
              <th class="text-center">Alamat</th>
              <th class="text-center">Jenis Barang</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">Kapasitas</th>
              <th class="text-center">Tgl Pengiriman</th>
              <th class="text-center">Daerah Asal</th>
              <th class="text-center">Daerah Tujuan</th>
              <th class="text-center">BEA Masuk</th>
              <th class="text-center">Total Harga</th>
              <th class="text-center">Tgl izin</th>
              <th class="text-center">Tgl ubah</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($view_data_izin as $data) { ?>
              <tr>
                <td><span class="badge bg-primary text-white"><?= $data['kode_izin'] ?></span></td>
                <td><?= $data['nama_pt'] ?></td>
                <td><?= $data['nama_pj'] ?></td>
                <td><?= $data['nama_pengirim'] ?></td>
                <td><?= $data['no_plat'] ?></td>
                <td><?= $data['nama_penerima'] ?></td>
                <td><?= $data['email'] ?></td>
                <td><?= $data['no_hp'] ?></td>
                <td><?= $data['alamat'] ?></td>
                <td><?= $data['nama_barang'] ?></td>
                <td><?= $data['nama_kategori'] ?></td>
                <td><?= $data['kapasitas'] ?></td>
                <td><?php $tgl_pengiriman = date_create($data["tgl_pengiriman"]);
                    echo date_format($tgl_pengiriman, "d M Y"); ?></td>
                <td><?= $data['daerah_asal'] ?></td>
                <td><?= $data['daerah_tujuan'] ?></td>
                <td>Rp.<?= number_format($data['bea_masuk']) ?></td>
                <td>Rp.<?= number_format($data['total_harga']) ?></td>
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
                              <label for="kode_izin">Kode Izin</label>
                              <input type="text" name="kode_izin" value="<?= $data['kode_izin'] ?>" class="form-control" id="kode_izin" required>
                            </div>
                            <div class="form-group">
                              <label for="nama_pt">Nama PT</label>
                              <input type="text" name="nama_pt" value="<?= $data['nama_pt'] ?>" class="form-control" id="nama_pt" required>
                            </div>
                            <div class="form-group">
                              <label for="nama_pj">Nama Penanggung Jawab</label>
                              <input type="text" name="nama_pj" value="<?= $data['nama_pj'] ?>" class="form-control" id="nama_pj" required>
                            </div>
                            <div class="form-group">
                              <label for="nama_pengirim">Nama Pengirim</label>
                              <input type="text" name="nama_pengirim" value="<?= $data['nama_pengirim'] ?>" class="form-control" id="nama_pengirim" required>
                            </div>
                            <div class="form-group">
                              <label for="no_plat">No. Plat Kendaraan</label>
                              <input type="text" name="no_plat" value="<?= $data['no_plat'] ?>" class="form-control" id="no_plat" required>
                            </div>
                            <div class="form-group">
                              <label for="nama_penerima">Nama Penerima</label>
                              <input type="text" name="nama_penerima" value="<?= $data['nama_penerima'] ?>" class="form-control" id="nama_penerima" required>
                            </div>
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" name="email" value="<?= $data['email'] ?>" class="form-control" id="email" required>
                            </div>
                            <div class="form-group">
                              <label for="no_hp">No. Telp</label>
                              <input type="number" name="no_hp" value="<?= $data['no_hp'] ?>" class="form-control" id="no_hp" required>
                            </div>
                            <div class="form-group">
                              <label for="alamat">Alamat</label>
                              <input type="text" name="alamat" value="<?= $data['alamat'] ?>" class="form-control" id="alamat" required>
                            </div>
                            <div class="form-group">
                              <label for="id_kategori">Kategori</label>
                              <select name="id_kategori" class="form-control" id="id_kategori" required>
                                <option value="" selected>Pilih Kategori</option>
                                <?php $id_kategori = $data['id_kategori'];
                                foreach ($view_kategori as $data_kategori) {
                                  $selected = ($data_kategori['id_kategori'] == $id_kategori) ? 'selected' : ''; ?>
                                  <option value="<?= $data_kategori['id_kategori'] ?>" <?= $selected ?>><?= $data_kategori['nama_kategori'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
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
                              <input type="number" name="kapasitas" value="<?= $data['kapasitas'] ?>" class="form-control" id="kapasitas" required>
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
                            <div class="form-group">
                              <label for="bea_masuk">BEA Masuk</label>
                              <input type="number" name="bea_masuk" value="<?= $data['bea_masuk'] ?>" class="form-control" id="bea_masuk" required>
                            </div>
                            <div class="form-group">
                              <label for="total_harga">Total Harga ($)</label>
                              <input type="number" name="total_harga" value="<?= $data['total_harga'] ?>" class="form-control" id="total_harga" required>
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
              <label for="kode_izin">Kode Izin</label>
              <input type="text" name="kode_izin" class="form-control" id="kode_izin" required>
            </div>
            <div class="form-group">
              <label for="nama_pt">Nama PT</label>
              <input type="text" name="nama_pt" value="<?php if (isset($_POST['nama_pt'])) {
                                                          echo $_POST['nama_pt'];
                                                        } ?>" class="form-control" id="nama_pt" required>
            </div>
            <div class="form-group">
              <label for="nama_pj">Nama Penanggung Jawab</label>
              <input type="text" name="nama_pj" value="<?php if (isset($_POST['nama_pj'])) {
                                                          echo $_POST['nama_pj'];
                                                        } ?>" class="form-control" id="nama_pj" required>
            </div>
            <div class="form-group">
              <label for="nama_pengirim">Nama Pengirim</label>
              <input type="text" name="nama_pengirim" value="<?php if (isset($_POST['nama_pengirim'])) {
                                                                echo $_POST['nama_pengirim'];
                                                              } ?>" class="form-control" id="nama_pengirim" required>
            </div>
            <div class="form-group">
              <label for="no_plat">No. Plat Kendaraan</label>
              <input type="text" name="no_plat" value="<?php if (isset($_POST['no_plat'])) {
                                                          echo $_POST['no_plat'];
                                                        } ?>" class="form-control" id="no_plat" required>
            </div>
            <div class="form-group">
              <label for="nama_penerima">Nama Penerima</label>
              <input type="text" name="nama_penerima" value="<?php if (isset($_POST['nama_penerima'])) {
                                                                echo $_POST['nama_penerima'];
                                                              } ?>" class="form-control" id="nama_penerima" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" value="<?php if (isset($_POST['email'])) {
                                                        echo $_POST['email'];
                                                      } ?>" class="form-control" id="email" required>
            </div>
            <div class="form-group">
              <label for="no_hp">No. Telp</label>
              <input type="number" name="no_hp" value="<?php if (isset($_POST['no_hp'])) {
                                                          echo $_POST['no_hp'];
                                                        } ?>" class="form-control" id="no_hp" required>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" name="alamat" value="<?php if (isset($_POST['alamat'])) {
                                                        echo $_POST['alamat'];
                                                      } ?>" class="form-control" id="alamat" required>
            </div>
            <div class="form-group">
              <label for="id_kategori">Kategori</label>
              <select name="id_kategori" class="form-control" id="id_kategori" required>
                <option value="" selected>Pilih Kategori</option>
                <?php foreach ($view_kategori as $data_kategori) { ?>
                  <option value="<?= $data_kategori['id_kategori'] ?>"><?= $data_kategori['nama_kategori'] ?></option>
                <?php } ?>
              </select>
            </div>
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
              <input type="number" name="kapasitas" value="<?php if (isset($_POST['kapasitas'])) {
                                                            echo $_POST['kapasitas'];
                                                          } ?>" class="form-control" id="kapasitas" required>
            </div>
            <div class="form-group">
              <label for="tgl_pengiriman">Tgl Pengiriman</label>
              <input type="date" name="tgl_pengiriman" value="<?php if (isset($_POST['tgl_pengiriman'])) {
                                                                echo $_POST['tgl_pengiriman'];
                                                              } ?>" class="form-control" id="tgl_pengiriman" required>
            </div>
            <div class="form-group">
              <label for="daerah_asal">Daerah asal</label>
              <input type="text" name="daerah_asal" value="<?php if (isset($_POST['daerah_asal'])) {
                                                              echo $_POST['daerah_asal'];
                                                            } ?>" class="form-control" id="daerah_asal" required>
            </div>
            <div class="form-group">
              <label for="daerah_tujuan">Daerah tujuan</label>
              <input type="text" name="daerah_tujuan" value="<?php if (isset($_POST['daerah_tujuan'])) {
                                                                echo $_POST['daerah_tujuan'];
                                                              } ?>" class="form-control" id="daerah_tujuan" required>
            </div>
            <div class="form-group">
              <label for="bea_masuk">BEA Masuk</label>
              <input type="number" name="bea_masuk" value="<?php if (isset($_POST['bea_masuk'])) {
                                                                echo $_POST['bea_masuk'];
                                                              } ?>" class="form-control" id="bea_masuk" required>
            </div>
            <div class="form-group">
              <label for="total_harga">Total Harga</label>
              <input type="number" name="total_harga" value="<?php if (isset($_POST['total_harga'])) {
                                                                echo $_POST['total_harga'];
                                                              } ?>" class="form-control" id="total_harga" required>
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