<div class="container my-5">

  <div class="card disco-card shadow-lg border-0 rounded-4 overflow-hidden">

    <div class="card-body p-4 p-md-5">

      <div class="row align-items-center g-4">

        <!-- Text Section -->
        <div class="col-md-8">

          <div class="accent-bar mb-3"></div>

          <h4 class="fw-bold mb-2 text-dark d-flex align-items-center gap-2">
            Contact Your Disco
          </h4>

          <p class="text-muted mb-4">
            Do you want to reach out to your Disco about any issues? Take advantage of our direct connection to all Discos nationwide and get your issues resolved quickly and seamlessly.
          </p>

          <a class="btn btn-warning btn-lg px-4 rounded-pill disco-btn" href="contact_disco">
            Contact Your Disco
            <i class="bi bi-arrow-right-circle ms-2"></i>
          </a>

        </div>

        <!-- Image Section -->
        <div class="col-md-4 text-center">
          <div class="disco-image-wrapper">
            <img src="img/electrisol-img/disco.png"
              class="img-fluid disco-image"
              alt="Contact Disco">
          </div>
        </div>

      </div>

    </div>
  </div>

</div>

<style>

/* Card modern surface */
.disco-card {
  background: linear-gradient(145deg, #ffffff, #f8f9fb);
  position: relative;
  overflow: hidden;
}

/* soft accent bar (modern UI cue) */
.accent-bar {
  width: 60px;
  height: 4px;
  border-radius: 50px;
  background: linear-gradient(90deg, #ffc107, #ffdb70);
}

/* Button modern feel */
.disco-btn {
  transition: all 0.3s ease;
  font-weight: 600;
}

.disco-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(255, 193, 7, 0.35);
}

/* Image styling upgrade */
.disco-image-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
}

.disco-image {
  max-width: 160px;
  transition: all 0.3s ease;
  filter: drop-shadow(0 8px 18px rgba(0,0,0,0.15));
}

.disco-card:hover .disco-image {
  transform: scale(1.05);
}

/* subtle hover lift */
.disco-card {
  transition: all 0.3s ease;
}

.disco-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 18px 40px rgba(0,0,0,0.08);
}

/* Mobile tuning */
@media (max-width: 576px) {
  .disco-image {
    max-width: 120px;
  }

  .disco-btn {
    width: 100%;
  }
}

</style>