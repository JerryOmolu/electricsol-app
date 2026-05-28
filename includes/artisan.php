<div class="container my-5">

  <div class="card artisan-hero text-white shadow-lg border-0 rounded-4 overflow-hidden"
    style="background: url('img/electrisol-img/art1.jpg') center/cover no-repeat;">

    <div class="artisan-overlay">

      <div class="card-body p-4 p-md-5 text-center">

        <!-- Title -->
        <h3 class="fw-bold mb-2">Our Artisans' Planet</h3>

        <div class="title-accent mx-auto mb-4"></div>

        <p class="text-white-50 mb-4 small">
          Connect with skilled professionals or register to offer your services.
        </p>

        <!-- Options -->
        <div class="row g-4 justify-content-center">

          <!-- Register -->
          <div class="col-6 col-md-4">
            <a href="artisan_register" class="text-decoration-none">
              <div class="artisan-card h-100">

                <div class="artisan-icon">
                  <img src="img/electrisol-img/worker2.png" width="62" alt="Register Artisan">
                </div>

                <p class="text-white fw-semibold mb-0 mt-2">
                  Register as an Artisan
                </p>

                <small class="text-white-50 d-block mt-1">
                  Join the network
                </small>

              </div>
            </a>
          </div>

          <!-- Hire -->
          <div class="col-6 col-md-4">
            <a href="view_artisan" class="text-decoration-none">
              <div class="artisan-card h-100">

                <div class="artisan-icon">
                  <img src="img/electrisol-img/worker2.png" width="62" alt="Hire Artisan">
                </div>

                <p class="text-white fw-semibold mb-0 mt-2">
                  Hire an Artisan
                </p>

                <small class="text-white-50 d-block mt-1">
                  Find trusted experts
                </small>

              </div>
            </a>
          </div>

        </div>

      </div>

    </div>
  </div>

</div>

<style>

/* Hero container upgrade */
.artisan-hero {
  position: relative;
}

/* Modern overlay (depth + softness) */
.artisan-overlay {
  background: radial-gradient(circle at top,
    rgba(0,0,0,0.35),
    rgba(0,0,0,0.75)
  );
}

/* Accent line under title */
.title-accent {
  width: 70px;
  height: 4px;
  border-radius: 50px;
  background: linear-gradient(90deg, #ffc107, #ffdd7a);
}

/* Option card modern UI */
.artisan-card {
  background: rgba(0, 0, 0, 0.45);
  backdrop-filter: blur(8px);
  border-radius: 16px;
  padding: 18px 12px;
  border: 1px solid rgba(255,255,255,0.08);
  transition: all 0.25s ease;
  height: 100%;
}

/* Hover effect (soft lift + glow) */
.artisan-card:hover {
  transform: translateY(-6px);
  border-color: rgba(255, 193, 7, 0.4);
  box-shadow: 0 12px 30px rgba(255, 193, 7, 0.25);
}

/* Icon container */
.artisan-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 6px;
  transition: 0.3s ease;
}

/* Icon hover animation */
.artisan-card:hover .artisan-icon {
  transform: scale(1.08);
  filter: brightness(1.1);
}

/* Mobile refinement */
@media (max-width: 576px) {
  .artisan-card {
    padding: 14px 10px;
    border-radius: 14px;
  }

  .artisan-card p {
    font-size: 13px;
  }
}

</style>