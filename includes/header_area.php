<!-- Header Area -->
<div class="header-area shadow-sm sticky-top bg-white" id="headerArea">
  <div class="container">
    <!-- Header Content -->
    <div class="header-content header-style-five d-flex align-items-center justify-content-between py-2">
      
      <!-- Logo Wrapper -->
      <div class="logo-wrapper d-flex align-items-center">
        <a href="home" class="d-flex align-items-center">
          <img src="img/electrisol-img/Logo%206.png" alt="Electricsol Logo" class="me-2" style="height:40px;">
        </a>
      </div>

      <!-- Navbar Toggler -->
      <div class="navbar--toggler" id="affanNavbarToggler" 
           data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas"
           aria-controls="affanOffcanvas">
        <span class="toggler-bar"></span>
        <span class="toggler-bar"></span>
        <span class="toggler-bar"></span>
      </div>
    </div>
  </div>
</div>

<!-- Extra CSS -->
<style>
  /* Header */
  .header-area {
    border-bottom: 1px solid #f1f1f1;
    z-index: 1030;
  }
  .header-content img {
    transition: transform 0.3s ease;
  }
  .header-content img:hover {
    transform: scale(1.05);
  }

  /* Toggler */
  .navbar--toggler {
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
  }
  .navbar--toggler .toggler-bar {
    width: 25px;
    height: 3px;
    background-color: #333;
    border-radius: 2px;
    transition: all 0.3s ease;
  }
  .navbar--toggler:hover .toggler-bar {
    background-color: #EC8305; /* Accent color */
    transform: scaleX(1.1);
  }
</style>
