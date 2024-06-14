<?php if (!isset($_SESSION)) {
  session_start();
}
require_once("../controller/auth.php");
if (isset($_SESSION["project_plbn_motamasin"])) {
  unset($_SESSION["project_plbn_motamasin"]);
  header("Location: ./");
  exit();
}
