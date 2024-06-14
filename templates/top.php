<!DOCTYPE html>
<html lang="en-US">

<head>

  <?php require_once("sections/head.php"); ?>

</head>

<body class="home page fullscreen top_panel_above">
  <?php foreach ($messageTypes as $type) {
    if (isset($_SESSION["project_plbn_motamasin"]["message_$type"])) {
      echo "<div class='message-$type' data-message-$type='{$_SESSION["project_plbn_motamasin"]["message_$type"]}'></div>";
    }
  } ?>
  <a id="toc_home" class="sc_anchor" title="Home" data-description="&lt;i&gt;Return to Home&lt;/i&gt; - &lt;br&gt;navigate to home page of the site" data-icon="icon-home" data-url="index.html" data-separator="yes"></a>
  <a id="toc_top" class="sc_anchor" title="To Top" data-description="&lt;i&gt;Back to top&lt;/i&gt; - &lt;br&gt;scroll to top of the page" data-icon="icon-up" data-url="" data-separator="yes"></a>

  <div class="main_content">
    <div class="boxedWrap">
        <?php require_once("sections/nav.php"); ?>