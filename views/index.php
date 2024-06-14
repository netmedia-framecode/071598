<?php require_once("../controller/dashboard.php");
$_SESSION["project_plbn_motamasin"]["name_page"] = "";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <div class="row">

    <div class="col-xl-4 col-lg-5 mb-4">

      <div class="card border-left-info shadow py-2 mb-3">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                Barang</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= mysqli_num_rows($view_data_barang); ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-boxes fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="card border-left-primary shadow py-2 mb-3">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Export</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= mysqli_num_rows($view_export); ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-pallet fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="card border-left-success shadow py-2 mb-3">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Import</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= mysqli_num_rows($view_import); ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-truck-loading fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="col-xl-8 col-lg-7 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Data Grafik Export Import</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Action:</div>
              <a class="dropdown-item" href="export">Export</a>
              <a class="dropdown-item" href="import">Import</a>
              <a class="dropdown-item" href="export-file" data-toggle="modal" data-target="#export">Download file</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="izin-export-import">Izin Export Import</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <?php
            $currentYear = date('Y');
            $sql = "SELECT 'Export' as category, MONTH(data_izin.created_at) as month, COUNT(data_izin.*) as total 
                FROM data_izin 
                JOIN export_import ON data_izin.id_export_import = export_import.id_export_import 
                JOIN kategori ON export_import.id_kategori = kategori.id_kategori 
                WHERE kategori.nama_kategori LIKE '%Export%' 
                AND YEAR(data_izin.created_at) = $currentYear 
                AND MONTH(data_izin.created_at) BETWEEN 1 AND 12 
                GROUP BY month

                UNION ALL

                SELECT 'Import' as category, MONTH(data_izin.created_at) as month, COUNT(data_izin.*) as total 
                FROM data_izin 
                JOIN export_import ON data_izin.id_export_import = export_import.id_export_import 
                JOIN kategori ON export_import.id_kategori = kategori.id_kategori 
                WHERE kategori.nama_kategori LIKE '%Import%' 
                AND YEAR(data_izin.created_at) = $currentYear 
                AND MONTH(data_izin.created_at) BETWEEN 1 AND 12 
                GROUP BY month
            ";
            $result = $conn->query($sql);
            $dataGrafik = [];
            if ($result === false) {
              // echo "Error: " . $conn->error;
            } else {
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $namaBulan = DateTime::createFromFormat('!m', $row['month'])->format('F');
                  $dataGrafik[] = [
                    'category' => $row['category'],
                    'total' => $row['total'],
                    'month' => $namaBulan,
                  ];
                }
              }
            }
            ?>
            <canvas id="myAreaChart"></canvas>
            <script>
              var dataGrafik = <?php echo json_encode($dataGrafik); ?>;
            </script>
          </div>
        </div>
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