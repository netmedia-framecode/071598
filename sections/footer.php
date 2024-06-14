<div class="footerContentWrap">
  <!-- Footer Contacts -->
  <footer class="footerWrap footerStyleLight contactFooterWrap">
    <div class="main contactFooter">
      <section>
        <div class="logo">
          <a href="index-2.html">
            <img src="<?= $baseURL ?>assets/img/logo.png" style="width: 100px; height: 100px;" alt="">
          </a>
        </div>
        <div class="contactAddress">
          <address class="addressRight">
            No Telepon: 021-31323277<br>
            Fax: (021) 31924491<br>
            Email: bag.hukum@bnpp.go.id
          </address>
          <address class="addressLeft">
            Jl. Kebon Sirih No.31A, RT.1/RW.5,<br>
            Kb. Sirih, Kec. Menteng,<br>
            Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10340.
          </address>
        </div>
        <div>
          <ul style="display: flex; justify-content:center;">
            <li style="list-style: none; padding: 20px;">
              <a class="social_icons fShare facebook_custom_bg" href="https://www.facebook.com/p/Badan-Nasional-Pengelola-Perbatasan-Republik-Indonesia-100064393703887/" target="_blank" title="Facebook">
                <i class="bi bi-facebook" style="color: #0f6fa9; font-size: 50px;"></i>
              </a>
            </li>
            <li style="list-style: none; padding: 20px;">
              <a class="" href="https://www.instagram.com/bnpp_ri" target="_blank">
                <i class="bi bi-instagram" style="color: #0f6fa9; font-size: 50px"></i>
              </a>
            </li>
            <li style="list-style: none; padding: 20px;">
              <a class="" href="https://x.com/BNPB_Indonesia" target="_blank">
                <i class="bi bi-twitter" style="color: #0f6fa9; font-size: 50px"></i>
              </a>
            </li>
          </ul>
        </div>
      </section>
    </div>
  </footer>
  <!-- /Footer Contacts -->
  <!-- Google Map -->
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3935.642542144471!2d125.08059377418516!3d-9.452709249038659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2cff04e11ede0b23%3A0xda8c92f862ed23e1!2sPLBN%20Motamasin%20Malaka!5e0!3m2!1sid!2sid!4v1718322719026!5m2!1sid!2sid" height="600" style="width: 100%; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  <!-- /Google Map -->
  <!-- Footer Widgets -->
  <footer class="footerWrap footerStyleLight">
    <div class="main footerWidget widget_area">
      <div class="columnsWrap">
        <aside class="columns1_4 widgetWrap widget">
          <div class="widget_advert_inner">
            <figure class="sc_image sc_image_shape_square width_150" style="text-align: center;">
              <img src="<?= $baseURL ?>assets/img/logo.png" alt="" />
            </figure>
            <p style="font-size: 20px; color: #000; font-weight: bold; margin-top: 10px; margin-bottom: -20px;">PLBN MOTAMASIN</p>
            <br /> <span class="sc_icon icon-home theme_accent"></span> Kab. Malaka, Nusa Tenggara Timur
            <br /> <span class="sc_icon icon-email theme_accent"></span> bag.hukum@bnpp.go.id
            <br /> <span class="sc_icon icon-phone theme_accent"></span> (021) 31924491
          </div>
        </aside>
        <aside class="columns1_4 widgetWrap widget-number-2 widget widget_calendar">
          <div id="calendar_wrap">
            <table class="wp-calendar">
              <thead>
                <tr>
                  <th class="prevMonth">
                    <div class="left roundButton">
                      <a href="#" id="prevMonthBtn" title="View previous month">&#9664;</a>
                    </div>
                  </th>
                  <th class="curMonth" colspan="5" id="currentMonthYear"></th>
                  <th class="nextMonth">
                    <div class="right roundButton">
                      <a href="#" id="nextMonthBtn" title="View next month">&#9654;</a>
                    </div>
                  </th>
                </tr>
                <tr>
                  <th scope="col" title="Monday">M</th>
                  <th scope="col" title="Tuesday">T</th>
                  <th scope="col" title="Wednesday">W</th>
                  <th scope="col" title="Thursday">T</th>
                  <th scope="col" title="Friday">F</th>
                  <th scope="col" title="Saturday">S</th>
                  <th scope="col" title="Sunday">S</th>
                </tr>
              </thead>
              <tbody id="calendarBody">
              </tbody>
            </table>
          </div>
        </aside>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            const calendarBody = document.getElementById('calendarBody');
            const currentMonthYear = document.getElementById('currentMonthYear');
            const prevMonthBtn = document.getElementById('prevMonthBtn');
            const nextMonthBtn = document.getElementById('nextMonthBtn');

            const holidays = {
              "1-1": "New Year's Day",
              "12-25": "Christmas Day",
              // Tambahkan lebih banyak hari libur di sini dengan format "MM-DD": "Nama Hari Libur"
            };

            let today = new Date();
            let currentMonth = today.getMonth();
            let currentYear = today.getFullYear();

            function renderCalendar(month, year) {
              calendarBody.innerHTML = '';
              const firstDay = new Date(year, month).getDay();
              const daysInMonth = new Date(year, month + 1, 0).getDate();

              currentMonthYear.textContent = new Date(year, month).toLocaleString('default', {
                month: 'long',
                year: 'numeric'
              });

              let date = 1;
              for (let i = 0; i < 6; i++) {
                const row = document.createElement('tr');

                for (let j = 0; j < 7; j++) {
                  const cell = document.createElement('td');
                  if (i === 0 && j < firstDay) {
                    cell.classList.add('pad');
                    row.appendChild(cell);
                  } else if (date > daysInMonth) {
                    cell.classList.add('pad');
                    row.appendChild(cell);
                  } else {
                    cell.textContent = date;
                    const dateKey = (month + 1) + '-' + date;
                    if (holidays[dateKey]) {
                      cell.classList.add('holiday');
                      cell.dataset.holiday = holidays[dateKey];
                    }
                    if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                      cell.classList.add('today');
                    }
                    cell.addEventListener('click', function() {
                      if (cell.dataset.holiday) {
                        alert('Hari libur: ' + cell.dataset.holiday);
                      } else {
                        alert('Tidak ada hari libur pada tanggal ini.');
                      }
                    });
                    row.appendChild(cell);
                    date++;
                  }
                }

                calendarBody.appendChild(row);
              }
            }

            prevMonthBtn.addEventListener('click', function(e) {
              e.preventDefault();
              currentMonth--;
              if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
              }
              renderCalendar(currentMonth, currentYear);
            });

            nextMonthBtn.addEventListener('click', function(e) {
              e.preventDefault();
              currentMonth++;
              if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
              }
              renderCalendar(currentMonth, currentYear);
            });

            renderCalendar(currentMonth, currentYear);
          });
        </script>
        <aside class="columns1_4 widgetWrap widget widget_flickr">
          <h3 class="title">Flickr photos</h3>
          <div class="flickr_images">
            <a data-flickr-embed="true" href="https://www.flickr.com/photos/adheb/33728594872/in/photostream/" title="PLBN Motamasin"><img src="https://live.staticflickr.com/2865/33728594872_1c3cc4ebd4_k.jpg" width="100" height="75" alt="PLBN Motamasin" /></a>
            <a data-flickr-embed="true" href="https://www.flickr.com/photos/adheb/33041531834/in/photostream/" title="PLBN Motamasin"><img src="https://live.staticflickr.com/2822/33041531834_1497ec98dc_k.jpg" width="100" height="75" alt="PLBN Motamasin" /></a>
            <a data-flickr-embed="true" href="https://www.flickr.com/photos/adheb/33071888623/in/photostream/" title="PLBN Motamasin"><img src="https://live.staticflickr.com/2814/33071888623_e215325ba8_k.jpg" width="100" height="75" alt="PLBN Motamasin" /></a>
          </div>
        </aside>
      </div>
    </div>
  </footer>
  <!-- /Footer Widgets -->
  <!-- Copyright area -->
  <div class="copyWrap">
    <div class="copy main">
      <div class="copyright">
        <a href="https://netmedia-framecode.com">Netmedia Framecode</a> &copy; <?= date('Y'); ?> All Rights Reserved
        <a href="https://netmedia-framecode.com/ketentuan-layanan">Terms of Use</a> and <a href="https://netmedia-framecode.com/kebijakan-privasi">Privacy Policy</a>
      </div>
      <div class="copy_socials socPage">
        <p>Develop by Gradiana Rafu Liko</p>
      </div>
    </div>
  </div>
  <!-- /Copyright area -->
</div>
</div>
</div>

<div class="upToScroll">
  <a href="#" class="scrollToTop icon-up-open-big" title="Back to top"></a>
</div>

<script type="text/javascript" src="<?= $baseURL ?>assets/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/_packed.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/global.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/_utils.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/_front.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/shortcodes/shortcodes_init.js"></script>

<script type="text/javascript" src="<?= $baseURL ?>assets/js/superfish.min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/magnific-popup/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/swiper/idangerous.swiper-2.7.min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/swiper/idangerous.swiper.scrollbar-2.4.min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/flexslider/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/royalslider/jquery.royalslider.min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/slider_init.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/rs-plugin/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/rs-plugin/jquery.themepunch.revolution.min.js"></script>

<script type="text/javascript" src="<?= $baseURL ?>assets/js/SmoothScroll.min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/hover/jquery.hoverdir.min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/hover/hoverIntent.min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/messages/_messages.min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/diagram/chart.min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/diagram/diagram.raphael.min.js"></script>

<script type="text/javascript" src="<?= $baseURL ?>assets/js/isotope/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="<?= $baseURL ?>assets/js/prettyphoto/jquery.prettyPhoto.min.js"></script>
<script async src="//embedr.flickr.com/assets/client-code.js" charset="utf-8"></script>
<!-- <script type="text/javascript" src="<?= $baseURL ?>assets/js/_customizer.js"></script> -->

<script>
  const showMessage = (type, title, message) => {
    if (message) {
      Swal.fire({
        icon: type,
        title: title,
        text: message,
      });
    }
  };

  showMessage("success", "Berhasil Terkirim", $(".message-success").data("message-success"));
  showMessage("info", "For your information", $(".message-info").data("message-info"));
  showMessage("warning", "Peringatan!!", $(".message-warning").data("message-warning"));
  showMessage("error", "Kesalahan", $(".message-danger").data("message-danger"));
</script>

<script>
  $('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });
</script>