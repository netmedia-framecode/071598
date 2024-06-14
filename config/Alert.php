<?php

$messageTypes = ["success", "info", "warning", "danger", "dark"];

if (!isset($_SESSION["project_plbn_motamasin"]["users"])) {
  if (isset($_SESSION["project_plbn_motamasin"]["time_message"]) && (time() - $_SESSION["project_plbn_motamasin"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_plbn_motamasin"]["message_$type"])) {
        unset($_SESSION["project_plbn_motamasin"]["message_$type"]);
      }
    }
    unset($_SESSION["project_plbn_motamasin"]["time_message"]);
  }
} else if (isset($_SESSION["project_plbn_motamasin"]["users"])) {
  if (isset($_SESSION["project_plbn_motamasin"]["users"]["time_message"]) && (time() - $_SESSION["project_plbn_motamasin"]["users"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_plbn_motamasin"]["users"]["message_$type"])) {
        unset($_SESSION["project_plbn_motamasin"]["users"]["message_$type"]);
      }
    }
    unset($_SESSION["project_plbn_motamasin"]["users"]["time_message"]);
  }
}
