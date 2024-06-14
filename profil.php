<?php require_once("controller/visitor.php");
require_once("templates/top.php"); ?>

<!-- Page title -->
<div id="topOfPage" class="topTabsWrap">
  <div class="main">
    <div class="speedBar">
      <a class="home" href="./">Beranda</a>
      <span class="breadcrumbs_delimiter"> / </span>
      <span class="current">Profil</span>
    </div>
    <h3 class="pageTitle h3">Profil</h3>
  </div>
</div>
<!-- /Page title -->
<!-- Content -->
<div class="mainWrap without_sidebar">
  <div class="main">
    <div class="content">
      <div>
        <section class="post no_margin">
          <article class="post_content">
            <div class="post_text_area">
              <div class="columnsWrap sc_columns sc_columns_count_2 sc_columns_custom_style">
                <div class="columns1_2 sc_column_item sc_column_item_1 odd first">
                  <figure class="sc_image  sc_image_shape_square">
                    <img src="<?= $baseURL?>assets/img/profil.png" alt="" />
                  </figure>
                </div>
                <div class="columns1_2 sc_column_item sc_column_item_2 even">
                  <h1 class="sc_title sc_title_regular text-left">PLBN Motamasin</h1>
                  <p style="margin-top: -30px;">Terletak di Kabupaten Malaka, Nusa Tenggara Timur, PLBN Motamasin merupakan pintu gerbang perbatasan Indonesia dengan Timor Leste yang difungsikan untuk kebutuhan CIQSN (Custom, Immigration, Quarantine and Security)
                  </p>
                  <h6>Alamat</h6>
                  <p style="margin-top: -30px;">Malaka, Nusa Tenggara Timur</p>
                  <h6>Tahun Dibangun</h6>
                  <p style="margin-top: -30px;">2017</p>
                  <h6>Perbatasan Negara</h6>
                  <p style="margin-top: -30px;">Indonesia-Timor Leste</p>
                </div>
              </div>
            </div>
          </article>
        </section>
      </div>
    </div>
  </div>
</div>
<!-- /Content -->

<?php require_once("templates/bottom.php"); ?>