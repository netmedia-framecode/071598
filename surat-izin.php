<?php require_once("controller/visitor.php");
require_once("templates/top.php");

if (!isset($_GET['auth'])) {
  header("Location: ./");
  exit();
} else {
  $password_encryption = valid($conn, $_GET['auth']);
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

        </div>
      </div>
    </div>
  </div>
  <!-- /Content -->

<?php }
require_once("templates/bottom.php"); ?>