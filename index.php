<?php require_once("controller/visitor.php");
require_once("templates/top.php"); ?>

<!-- Revolution Slider -->
<div class="sliderHomeBullets slider_engine_revo slider_alias_revo-fullscreen">
  <div id="rev_slider_2_1_wrapper" class="rev_slider_wrapper fullscreen-container rs_custom_bg1 padding_0">
    <div id="rev_slider_2_1" class="rev_slider fullscreenbanner display_none">
      <ul>
        <!-- Slide 1 -->
        <li data-transition="random" data-slotamount="7" data-masterspeed="300" data-saveperformance="off" class="overlay_bg_7 _slide1">
          <img src="<?= $baseURL ?>assets/img/banner.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
          <div class="tp-caption _slide1_img randomrotate rs-parallaxlevel-1" data-x="227" data-y="center" data-voffset="-57" data-speed="500" data-start="1500" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300">
            <img src="<?= $baseURL ?>assets/img/logo.png" alt="" data-ww="105" data-hh="96">
          </div>
          <div class="tp-caption _title lfr skewtorightshort tp-resizeme rs-parallaxlevel-1" data-x="10" data-y="490" data-voffset="45" data-speed="500" data-start="2000" data-easing="Power3.easeInOut" data-splitin="chars" data-splitout="words" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300">
            Badan Nasional Pengelola Perbatasan
          </div>
          <div class="tp-caption _slide1_text tp-fade tp-resizeme rs-parallaxlevel-1" data-x="153" data-y="center" data-voffset="107" data-speed="500" data-start="2500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300">
            PLBN Motamasin
          </div>
        </li>
      </ul>
      <div class="tp-bannertimer"></div>
    </div>
  </div>
</div>
<!-- Content -->
<div class="mainWrap without_sidebar">
  <div class="content">
    <div>
      <section class="post no_margin page">
        <article class="post_content">
          <div class="post_text_area">
            <div class="sc_content main margin_top_5em_imp margin_bottom_2em_imp">
              <div class="columnsWrap sc_columns sc_columns_count_3">
                <div class="columns1_3 sc_column_item sc_column_item_1 odd first">
                  <h1>Data Pelintas</h1>
                  <div id="sc_blogger_2" class="sc_blogger sc_blogger_vertical style_date sc_scroll_controls sc_scroll_controls_vertical no_description margin_bottom_3em height_330">
                    <div id="sc_blogger_2_scroll" class="sc_scroll sc_scroll_vertical sc_slider_noresize swiper-slider-container scroll-container height_330">
                      <div class="sc_scroll_wrapper swiper-wrapper">
                        <div class="sc_scroll_slide swiper-slide">
                          <?php foreach ($view_data_izin as $data) : ?>
                            <article class="sc_blogger_item">
                              <div class="sc_blogger_date">
                                <span class="day_month"><?php $date = date_create($data["updated_at"]);
                                                        echo date_format($date, "d.m"); ?></span>
                                <span class="year"><?php $date = date_create($data["updated_at"]);
                                                    echo date_format($date, "Y"); ?></span>
                              </div>
                              <h4 class="sc_blogger_title sc_title">
                                <p style="font-size: 20px;"><?= $data['nama_pt'] ?></p>
                              </h4>
                              <div class="sc_blogger_info">
                                <p style="margin-top: -30px;">Dari <?= $data['daerah_asal'] ?></p>
                                <p style="margin-top: -30px;">Tujuan <?= $data['daerah_tujuan'] ?></p>
                              </div>
                            </article>
                          <?php endforeach; ?>
                        </div>
                      </div>
                      <div id="sc_blogger_2_scroll_bar" class="sc_scroll_bar sc_scroll_bar_vertical sc_blogger_2_scroll_bar"></div>
                    </div>
                    <ul class="flex-direction-nav">
                      <li>
                        <a class="flex-prev" href="#"></a>
                      </li>
                      <li>
                        <a class="flex-next" href="#"></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="columns2_3 sc_column_item sc_column_item_2 even span_2 text-none">
                  <h1 class="sc_title sc_title_regular text-left">Data Ekspor Import</h1>
                  <div class="sc_tabs sc_tabs_style_1" style="margin-bottom:3em;" data-active="0">
                    <ul class="sc_tabs_titles">
                      <li class="tab_names first">
                        <a href="#export" class="theme_button" id="export_tab">Export</a>
                      </li>
                      <li class="tab_names">
                        <a href="#import" class="theme_button" id="import_tab">Import</a>
                      </li>
                    </ul>
                    <div id="export" class="sc_tabs_content odd first">
                      <div id="export_scroll" class="height_230">
                        <div class="table-responsive" style="overflow-x: auto;">
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
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($view_data_izin_export as $data) { ?>
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
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div id="import" class="sc_tabs_content even">
                      <div id="import_scroll" class="height_230">
                        <div class="table-responsive" style="overflow-x: auto;">
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
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($view_data_izin_import as $data) { ?>
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
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </article>
      </section>
    </div>
  </div>
</div>
<!-- Footer -->

<?php require_once("templates/bottom.php"); ?>