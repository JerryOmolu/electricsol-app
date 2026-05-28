<div class="tiny-slider-one-wrapper">
  <div class="tiny-slider-one">

    <!-- Slide -->
    <div>
      <div class="single-hero-slide hero-bg"
        style="background-image:url('img/electrisol-img/calculator.jpg');">
        <div class="hero-overlay">
          <div class="container text-center">
            <div class="hero-content glass-card">
              <h2 class="fw-bold text-white mb-3">Energy Consumption Calculator</h2>
              <p class="text-white-50 mb-4">
                Get a comprehensive energy consumption calculation for Devices/Appliances at your fingertips.
              </p>
              <a class="btn btn-warning btn-lg rounded-pill hero-btn" href="energy">
                Get Started <i class="bi bi-arrow-right-circle ms-2"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide -->
    <div>
      <div class="single-hero-slide hero-bg"
        style="background-image:url('img/electrisol-img/solar.jpg');">
        <div class="hero-overlay">
          <div class="container text-center">
            <div class="hero-content glass-card">
              <h2 class="fw-bold text-white mb-3">Renewable Energy Solutions</h2>
              <p class="text-white-50 mb-4">
                We are committed to promoting green energy and reducing carbon emissions.
              </p>
              <a class="btn btn-warning btn-lg rounded-pill hero-btn" href="contact">
                Contact Us <i class="bi bi-arrow-right-circle ms-2"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide -->
    <div>
      <div class="single-hero-slide hero-bg"
        style="background-image:url('img/electrisol-img/power.jpg');">
        <div class="hero-overlay">
          <div class="container text-center">
            <div class="hero-content glass-card">
              <h2 class="fw-bold text-white mb-3">Power Infrastructure Development</h2>
              <p class="text-white-50 mb-4">
                Electricsol undertakes design, engineering, and implementation of power infrastructure projects.
              </p>
              <a class="btn btn-warning btn-lg rounded-pill hero-btn" href="contact">
                Contact Us <i class="bi bi-arrow-right-circle ms-2"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide -->
    <div>
      <div class="single-hero-slide hero-bg"
        style="background-image:url('img/electrisol-img/grid.jpg');">
        <div class="hero-overlay">
          <div class="container text-center">
            <div class="hero-content glass-card">
              <h2 class="fw-bold text-white mb-3">Smart Grid Solutions</h2>
              <p class="text-white-50 mb-4">
                Optimize energy distribution with intelligent monitoring and control systems.
              </p>
              <a class="btn btn-warning btn-lg rounded-pill hero-btn" href="contact">
                Contact Us <i class="bi bi-arrow-right-circle ms-2"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide -->
    <div>
      <div class="single-hero-slide hero-bg"
        style="background-image:url('img/electrisol-img/worker.jpg');">
        <div class="hero-overlay">
          <div class="container text-center">
            <div class="hero-content glass-card">
              <h2 class="fw-bold text-white mb-3">Construction & Operations Management</h2>
              <p class="text-white-50 mb-4">
                We manage construction and operations for sustainable energy distribution.
              </p>
              <a class="btn btn-warning btn-lg rounded-pill hero-btn" href="contact">
                Contact Us <i class="bi bi-arrow-right-circle ms-2"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<style>
/* Slide base */
.single-hero-slide.hero-bg {
  min-height: 92vh;
  background-size: cover;
  background-position: center;
  position: relative;
  display: flex;
  align-items: center;
}

/* Dark modern overlay (gradient depth) */
.hero-overlay {
  position: absolute;
  inset: 0;
  background: radial-gradient(
      circle at center,
      rgba(0,0,0,0.35),
      rgba(0,0,0,0.75)
  );
  display: flex;
  align-items: center;
}

/* Glass content box */
.glass-card {
  max-width: 720px;
  margin: auto;
  padding: 30px 25px;
  border-radius: 18px;
  backdrop-filter: blur(8px);
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(255, 255, 255, 0.12);
  box-shadow: 0 10px 40px rgba(0,0,0,0.25);
  animation: floatIn 0.8s ease;
}

/* Button modern feel */
.hero-btn {
  transition: all 0.3s ease;
  font-weight: 600;
  padding: 12px 26px;
}

.hero-btn:hover {
  transform: translateY(-3px) scale(1.05);
  box-shadow: 0 10px 30px rgba(255, 193, 7, 0.45);
}

/* Smooth entrance animation */
@keyframes floatIn {
  from {
    opacity: 0;
    transform: translateY(25px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Mobile optimization */
@media (max-width: 768px) {
  .glass-card {
    padding: 22px 18px;
    border-radius: 14px;
  }

  .glass-card h2 {
    font-size: 20px;
  }

  .glass-card p {
    font-size: 13px;
  }
}
</style>