<?php
if (!isset($_SESSION["project_plbn_motamasin"]["users"])) {
  header("Location: ../auth/");
  exit;
}
