<!-- Footer Nav -->
<div class="footer-nav-area shadow-lg border-top" id="footerNav">
  <div class="container px-0">
    <div class="footer-nav position-relative">

      <ul class="h-100 d-flex align-items-center justify-content-around ps-0 mb-0">

        <!-- Home -->
        <li class="nav-item active text-center">
          <a href="home" class="nav-link d-flex flex-column align-items-center">

            <span class="icon-box">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 10.5L12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z"/>
              </svg>
            </span>

            <span class="small">Home</span>
          </a>
        </li>

        <!-- Energy -->
        <li class="nav-item text-center">
          <a href="energy" class="nav-link d-flex flex-column align-items-center">

            <span class="icon-box">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M13 2L3 14h7l-1 8 12-14h-7l-1-6z"/>
              </svg>
            </span>

            <span class="small">Energy</span>
          </a>
        </li>

        <!-- Shop -->
        <li class="nav-item text-center">
          <a href="shop" class="nav-link d-flex flex-column align-items-center">

            <span class="icon-box">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M6 2h12l2 7H4l2-7z"/>
                <path d="M4 9h16v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9z"/>
              </svg>
            </span>

            <span class="small">Shop</span>
          </a>
        </li>

        <!-- Notifications -->
        <li class="nav-item text-center">
          <a href="notification" class="nav-link d-flex flex-column align-items-center position-relative">

            <span class="icon-box">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 8a6 6 0 10-12 0c0 7-3 7-3 7h18s-3 0-3-7"/>
                <path d="M13.73 21a2 2 0 01-3.46 0"/>
              </svg>
            </span>

            <span class="small">Alerts</span>

            <span class="notif-badge">3</span>
          </a>
        </li>

        <!-- Settings -->
        <li class="nav-item text-center">
          <a href="settings" class="nav-link d-flex flex-column align-items-center">

            <span class="icon-box">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.4 15a1.7 1.7 0 0 0 .33 1.87l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.7 1.7 0 0 0-1.87-.33 1.7 1.7 0 0 0-1 1.54V22a2 2 0 1 1-4 0v-.09a1.7 1.7 0 0 0-1-1.54 1.7 1.7 0 0 0-1.87.33l-.06.06A2 2 0 1 1 3.3 17l.06-.06A1.7 1.7 0 0 0 3.7 15a1.7 1.7 0 0 0-1.54-1H2a2 2 0 1 1 0-4h.16a1.7 1.7 0 0 0 1.54-1 1.7 1.7 0 0 0-.33-1.87l-.06-.06A2 2 0 1 1 6.14 3.3l.06.06A1.7 1.7 0 0 0 8 3.7c.66 0 1.26-.38 1.54-1V2a2 2 0 1 1 4 0v.16c.28.62.88 1 1.54 1 .7 0 1.36-.27 1.87-.74l.06-.06A2 2 0 1 1 20.7 6.14l-.06.06c-.47.51-.74 1.17-.74 1.87 0 .66.38 1.26 1 1.54H22a2 2 0 1 1 0 4h-.16c-.62.28-1 1-1 1.54z"/>
              </svg>
            </span>

            <span class="small">Settings</span>
          </a>
        </li>

      </ul>
    </div>
  </div>
</div>

<style>

/* Footer base - modern floating bar */
.footer-nav-area {
  background: rgba(255,255,255,0.95);
  backdrop-filter: blur(12px);
  border-radius: 20px 20px 0 0;
  padding: 8px 0;
}

/* icon container */
.icon-box {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 6px;
  border-radius: 12px;
  transition: all 0.25s ease;
  color: #6c757d;
}

/* label */
.footer-nav-area .small {
  font-size: 11px;
  margin-top: 2px;
  color: #6c757d;
}

/* hover */
.footer-nav-area .nav-link {
  color: #6c757d;
  transition: all 0.25s ease;
  position: relative;
}

.footer-nav-area .nav-link:hover {
  color: #ffc107;
  transform: translateY(-2px);
}

.footer-nav-area .nav-link:hover .icon-box {
  color: #ffc107;
  transform: scale(1.15);
}

/* active tab (modern pill indicator) */
.footer-nav-area .nav-item.active .nav-link {
  color: #ffc107;
}

.footer-nav-area .nav-item.active .icon-box {
  background: rgba(255,193,7,0.12);
  color: #ffc107;
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(255,193,7,0.15);
}

/* notification badge (modern dot style) */
.notif-badge {
  position: absolute;
  top: -2px;
  right: 20px;
  background: #ff3b30;
  color: #fff;
  font-size: 10px;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
}

/* smooth tap feel */
.footer-nav-area .nav-link:active {
  transform: scale(0.95);
}

/* mobile tuning */
@media (max-width: 576px) {
  .footer-nav-area .small {
    font-size: 10px;
  }
}

</style>




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