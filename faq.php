<?php include "includes/home_header.php"; ?>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
  </div>

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>

  <!-- Dark mode switching -->
  <div class="dark-mode-switching">
    <div class="d-flex w-100 h-100 align-items-center justify-content-center">
      <div class="dark-mode-text text-center">
        <i class="bi bi-moon"></i>
        <p class="mb-0">Switching to dark mode</p>
      </div>
      <div class="light-mode-text text-center">
        <i class="bi bi-brightness-high"></i>
        <p class="mb-0">Switching to light mode</p>
      </div>
    </div>
  </div>

  <!-- # Sidenav Left -->
  <?php include "includes/home_side_nav_left.php"; ?>

  <!-- Header Area -->
  <div class="header-area shadow-sm bg-white sticky-top" id="headerArea">
    <div class="container">
      <!-- Header Content -->
      <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between py-2">
        <!-- Back Button -->
        <div class="back-button">
          <a href="home" class="text-dark fs-4 d-flex align-items-center justify-content-center rounded-circle shadow-sm back-btn">
            <i class="bi bi-arrow-left-short"></i>
          </a>
        </div>

        <!-- Page Title -->
        <div class="page-heading text-center">
          <h6 class="mb-0 fw-bold text-dark d-flex align-items-center">
            <img src="img/electrisol-img/faq-2.png" width="26px" class="me-2"> FAQ
          </h6>
        </div>

        <!-- Navbar Toggler -->
        <div class="navbar--toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas"
          data-bs-target="#affanOffcanvas" aria-controls="affanOffcanvas">
          <span class="d-block"></span>
          <span class="d-block"></span>
          <span class="d-block"></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Page Content -->
  <div class="page-content-wrapper py-3">
    <div class="container">

      <!-- Section Title -->
      <div class="card bg-primary border-0 rounded-3 shadow-sm mb-3">
        <div class="card-body text-center py-3">
          <h6 class="mb-0 text-white fw-bold">Frequently Asked Questions (FAQs)</h6>
        </div>
      </div>

      <!-- FAQ Accordion -->
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="accordion" id="accordionStyle5">
            
            <!-- Item 1 -->
            <div class="accordion-item mb-2 shadow-sm rounded">
              <h6 class="accordion-header">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                  data-bs-target="#accordionStyleFive1" aria-expanded="false" aria-controls="accordionStyleFive1">
                  <i class="bi bi-question-circle me-2 text-primary"></i> What is Electricsol, and how does it work?
                </button>
              </h6>
              <div id="accordionStyleFive1" class="accordion-collapse collapse" data-bs-parent="#accordionStyle5">
                <div class="accordion-body small text-muted">
                  Electricsol is an innovative energy company dedicated to establishing and enhancing power infrastructure in Nigeria and Africa.  
                  The company's expertise is on projects such as solar power, and mini-grid systems design and installation.
                </div>
              </div>
            </div>

            <!-- Item 2 -->
            <div class="accordion-item mb-2 shadow-sm rounded">
              <h6 class="accordion-header">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                  data-bs-target="#accordionStyleFive2" aria-expanded="false" aria-controls="accordionStyleFive2">
                  <i class="bi bi-lightning-charge me-2 text-warning"></i> How can I use the Electricsol app to monitor my power consumption?
                </button>
              </h6>
              <div id="accordionStyleFive2" class="accordion-collapse collapse" data-bs-parent="#accordionStyle5">
                <div class="accordion-body small text-muted">
                  The app features a power consumption tracker where you can input your daily usage, and it will provide insights on how much energy you’re consuming and how solar energy could reduce your costs.
                </div>
              </div>
            </div>

            <!-- Item 3 -->
            <div class="accordion-item mb-2 shadow-sm rounded">
              <h6 class="accordion-header">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                  data-bs-target="#accordionStyleFive3" aria-expanded="false" aria-controls="accordionStyleFive3">
                  <i class="bi bi-person-check me-2 text-success"></i> Can Electricsol help me find a certified solar installer in my area?
                </button>
              </h6>
              <div id="accordionStyleFive3" class="accordion-collapse collapse" data-bs-parent="#accordionStyle5">
                <div class="accordion-body small text-muted">
                  Yes, Electricsol includes a directory of certified solar installers all over Nigeria. You can search for installers near you, view their ratings, and contact them directly through the app.
                </div>
              </div>
            </div>

            <!-- Item 4 -->
            <div class="accordion-item mb-2 shadow-sm rounded">
              <h6 class="accordion-header">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                  data-bs-target="#accordionStyleFive4" aria-expanded="false" aria-controls="accordionStyleFive4">
                  <i class="bi bi-cash-coin me-2 text-info"></i> Does the Electricsol app provide financing options for solar installation?
                </button>
              </h6>
              <div id="accordionStyleFive4" class="accordion-collapse collapse" data-bs-parent="#accordionStyle5">
                <div class="accordion-body small text-muted">
                  Electricsol partners with financial institutions to offer financing options. You can explore available financing plans within the app, compare rates, and apply directly.
                </div>
              </div>
            </div>

            <!-- Item 5 -->
            <div class="accordion-item mb-2 shadow-sm rounded">
              <h6 class="accordion-header">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                  data-bs-target="#accordionStyleFive5" aria-expanded="false" aria-controls="accordionStyleFive5">
                  <i class="bi bi-graph-up-arrow me-2 text-danger"></i> How accurate are the Electricsol app's calculations for energy savings?
                </button>
              </h6>
              <div id="accordionStyleFive5" class="accordion-collapse collapse" data-bs-parent="#accordionStyle5">
                <div class="accordion-body small text-muted">
                  The energy savings calculator uses your input data on energy usage, local energy rates, and solar system specifications to provide an estimate. While it gives a close approximation, actual savings may vary based on installation and usage conditions.
                </div>
              </div>
            </div>

            <!-- Item 6 -->
            <div class="accordion-item mb-2 shadow-sm rounded">
              <h6 class="accordion-header">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                  data-bs-target="#accordionStyleFive6" aria-expanded="false" aria-controls="accordionStyleFive6">
                  <i class="bi bi-tools me-2 text-primary"></i> What should I do if I encounter technical issues with the Electricsol app?
                </button>
              </h6>
              <div id="accordionStyleFive6" class="accordion-collapse collapse" data-bs-parent="#accordionStyle5">
                <div class="accordion-body small text-muted">
                  If you experience any technical issues, you can contact our support team directly through the app or via email.  
                  There is also a troubleshooting guide available in the app’s help section.
                </div>
              </div>
            </div>

            <!-- Item 7 -->
            <div class="accordion-item mb-2 shadow-sm rounded">
              <h6 class="accordion-header">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                  data-bs-target="#accordionStyleFive7" aria-expanded="false" aria-controls="accordionStyleFive7">
                  <i class="bi bi-pencil-square me-2 text-warning"></i> How can I update my personal information in the Electricsol app?
                </button>
              </h6>
              <div id="accordionStyleFive7" class="accordion-collapse collapse" data-bs-parent="#accordionStyle5">
                <div class="accordion-body small text-muted">
                  You can update your profile and energy usage data by navigating to the 'Settings' section within the app.  
                  From there, you can edit your information and save the changes.
                </div>
              </div>
            </div>

            <!-- Item 8 -->
            <div class="accordion-item mb-2 shadow-sm rounded">
              <h6 class="accordion-header">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                  data-bs-target="#accordionStyleFive8" aria-expanded="false" aria-controls="accordionStyleFive8">
                  <i class="bi bi-shield-lock me-2 text-success"></i> Is my data secure when using the Electricsol app?
                </button>
              </h6>
              <div id="accordionStyleFive8" class="accordion-collapse collapse" data-bs-parent="#accordionStyle5">
                <div class="accordion-body small text-muted">
                  Yes, Electricsol prioritizes your data security. The app uses encryption to protect your personal and energy usage information, ensuring it is safe from unauthorized access.
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>        

    </div>
  </div>


<!-- Custom CSS -->
  <style>
    /* Back button */
    .back-btn {
      width: 38px;
      height: 38px;
      background: #f8f9fa;
      transition: 0.3s;
    }
    .back-btn:hover {
      background: #0d6efd;
      color: #fff !important;
    }

    /* Navbar toggler bars */
    .navbar--toggler span {
      width: 20px;
      height: 2px;
      background: #333;
      margin: 4px 0;
      border-radius: 2px;
      transition: 0.3s;
    }
    .navbar--toggler:hover span {
      background: #0d6efd;
    }

    /* Accordion Styling */
    .accordion-button {
      border-radius: 8px;
      box-shadow: none;
    }
    .accordion-button:focus {
      box-shadow: none;
    }
    .accordion-button:not(.collapsed) {
      background-color: #f1f5ff;
      color: #0d6efd;
    }
    .accordion-body {
      border-top: 1px solid #e9ecef;
      padding-top: 10px;
    }
  </style>

  <?php include "includes/home_footer_nav.php"; ?>  

  