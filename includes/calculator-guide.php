<div class="container my-4">

  <!-- Energy Calculator Card -->
  <div class="card energy-card border-0 rounded-4 shadow-lg">
    <div class="card-body p-4">

      <div class="d-flex align-items-center justify-content-between flex-wrap">

        <!-- Text Section -->
        <div class="flex-grow-1 pe-3">

          <div class="accent-line mb-3"></div>

          <h5 class="fw-bold mb-2 text-dark">
            Calculate the Energy Consumed by Appliances or Devices
          </h5>

          <p class="text-muted mb-3">
            Use our Energy Consumption Calculator to quickly estimate how much energy your home or office appliances use over time.
          </p>

          <!-- CTA Button -->
          <a class="btn btn-warning btn-lg fw-semibold px-4 shadow-sm energy-btn" href="energy">
            Start Calculating
            <i class="bi bi-arrow-right-circle ms-2"></i>
          </a>

        </div>

      </div>

    </div>
  </div>

  <!-- Step-by-Step Guide -->
  <div class="row text-center mt-4 g-3">

    <div class="col-4">
      <div class="step-card">
        <div class="step-icon bg-primary">
          <i class="bi bi-laptop"></i>
        </div>
        <p class="fw-semibold mb-1 mt-2">Step 1</p>
        <small class="text-muted">Choose Device</small>
      </div>
    </div>

    <div class="col-4">
      <div class="step-card">
        <div class="step-icon bg-success">
          <i class="bi bi-clock"></i>
        </div>
        <p class="fw-semibold mb-1 mt-2">Step 2</p>
        <small class="text-muted">Input Usage Hours</small>
      </div>
    </div>

    <div class="col-4">
      <div class="step-card">
        <div class="step-icon bg-warning">
          <i class="bi bi-lightning-charge"></i>
        </div>
        <p class="fw-semibold mb-1 mt-2">Step 3</p>
        <small class="text-muted">Get Consumption</small>
      </div>
    </div>

  </div>

</div>
<style>

/* Main card upgrade */
.energy-card {
  border-radius: 18px;
  background: linear-gradient(145deg, #ffffff, #f8f9fb);
  box-shadow: 0 10px 25px rgba(0,0,0,0.06);
  position: relative;
  overflow: hidden;
}

/* subtle accent line (modern UI detail) */
.accent-line {
  width: 60px;
  height: 4px;
  border-radius: 50px;
  background: linear-gradient(90deg, #ffc107, #ffdb6d);
}

/* CTA button modern feel */
.energy-btn {
  border-radius: 50px;
  transition: all 0.3s ease;
}

.energy-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(255, 193, 7, 0.35);
}

/* Step card redesign */
.step-card {
  padding: 14px 10px;
  border-radius: 14px;
  background: #fff;
  box-shadow: 0 6px 15px rgba(0,0,0,0.05);
  transition: all 0.25s ease;
}

.step-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

/* Icon circle modern */
.step-icon {
  width: 52px;
  height: 52px;
  margin: auto;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 22px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.15);
  transition: 0.3s ease;
}

.step-card:hover .step-icon {
  transform: scale(1.1);
  filter: brightness(1.1);
}

/* Mobile optimization */
@media (max-width: 576px) {
  .step-card {
    padding: 12px 8px;
  }

  .step-icon {
    width: 45px;
    height: 45px;
    font-size: 18px;
  }

  .energy-card h5 {
    font-size: 16px;
  }
}

</style>