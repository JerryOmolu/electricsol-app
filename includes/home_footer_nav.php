<!-- Footer Nav -->
<div class="footer-nav-area shadow-lg border-top" id="footerNav">
  <div class="container px-0">
    <!-- Footer Content -->
    <div class="footer-nav position-relative">
      <ul class="h-100 d-flex align-items-center justify-content-around ps-0 mb-0">

        <!-- Home -->
        <li class="nav-item active text-center">
          <a href="home" class="nav-link d-flex flex-column align-items-center">
            <i class="bi bi-house fs-4"></i>
            <span class="small">Home</span>
          </a>
        </li>

        <!-- Energy Calculator -->
        <li class="nav-item text-center">
          <a href="energy" class="nav-link d-flex flex-column align-items-center">
            <i class="bi bi-battery-charging fs-4"></i>
            <span class="small">Energy</span>
          </a>
        </li>

        <!-- Shop -->
        <li class="nav-item text-center">
          <a href="shop" class="nav-link d-flex flex-column align-items-center">
            <i class="bi bi-shop fs-4"></i>
            <span class="small">Shop</span>
          </a>
        </li>

        <!-- Notifications -->
        <li class="nav-item text-center">
          <a href="notification" class="nav-link d-flex flex-column align-items-center position-relative">
            <i class="bi bi-bell fs-4"></i>
            <span class="small">Alerts</span>
            <!-- Notification badge -->
            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">
              3
            </span>
          </a>
        </li>

        <!-- Settings -->
        <li class="nav-item text-center">
          <a href="settings" class="nav-link d-flex flex-column align-items-center">
            <i class="bi bi-gear fs-4"></i>
            <span class="small">Settings</span>
          </a>
        </li>

      </ul>
    </div>
  </div>
</div>

<!-- Custom Styles -->
<style>
  .footer-nav-area {
    background: #ffffff;
    border-radius: 20px 20px 0 0;
    padding: 0.5rem 0;
  }

  .footer-nav-area .nav-link {
    color: #6c757d;
    transition: all 0.3s ease;
  }

  .footer-nav-area .nav-link:hover,
  .footer-nav-area .nav-item.active .nav-link {
    color: #ffc107; /* Bootstrap warning color */
  }

  .footer-nav-area i {
    transition: transform 0.3s ease;
  }

  .footer-nav-area .nav-link:hover i {
    transform: scale(1.2);
  }
</style>


<script>
                var url = 'https://wati-integration-prod-service.clare.ai/v2/watiWidget.js?42713';
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = url;
                var options = {
                "enabled":true,
                "chatButtonSetting":{
                    "backgroundColor":"#156fe5",
                    "ctaText":"Chat with us",
                    "borderRadius":"25",
                    "marginLeft": "0",
                    "marginRight": "20",
                    "marginBottom": "20",
                    "ctaIconWATI":false,
                    "position":"right"
                },
                "brandSetting":{
                    "brandName":"Electricsol",
                    "brandSubTitle":"undefined",
                    "brandImg":"https://www.wati.io/wp-content/uploads/2023/04/Wati-logo.svg",
                    "welcomeText":"Hi there!\nHow can I help you?",
                    "messageText":"Hello, %0A I have a question about Electricsol Mobile",
                    "backgroundColor":"#156fe5",
                    "ctaText":"Chat with us",
                    "borderRadius":"25",
                    "autoShow":false,
                    "phoneNumber":"2349021611689"
                }
                };
                s.onload = function() {
                    CreateWhatsappChatWidget(options);
                };
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            </script>

  <!-- All JavaScript Files -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/slideToggle.min.js"></script>
  <script src="js/internet-status.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/venobox.min.js"></script>
  <script src="js/countdown.js"></script>
  <script src="js/rangeslider.min.js"></script>
  <script src="js/vanilla-dataTables.min.js"></script>
  <script src="js/index.js"></script>
  <script src="js/imagesloaded.pkgd.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/dark-rtl.js"></script>
  <script src="js/active.js"></script>
  <script src="js/pwa.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="js/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
        crossorigin="anonymous"></script>

</body>

</html>