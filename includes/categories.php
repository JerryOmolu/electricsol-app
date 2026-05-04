<div class="container my-5">
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-body p-4">
      
      <!-- Title -->
      <h4 class="fw-bold text-center mb-4 text-dark">
        <i class="bi bi-grid-fill text-warning me-2"></i> Product Categories
      </h4>
      <hr class="mb-5 w-25 mx-auto text-warning opacity-75">

      <!-- Categories Grid -->
      <div class="row g-4">
        
        <!-- Single Category -->
        <div class="col-6 col-sm-4 col-lg-3">
          <a href="#" class="text-decoration-none">
            <div class="category-card text-center p-3 h-100">
              <img src="img/electrisol-img/lighting.jpg" class="img-fluid rounded mb-3" alt="Lighting">
              <p class="fw-semibold text-dark small">Lighting</p>
            </div>
          </a>
        </div>

        <!-- Repeat for each category -->
        <div class="col-6 col-sm-4 col-lg-3">
          <a href="#" class="text-decoration-none">
            <div class="category-card text-center p-3 h-100">
              <img src="img/electrisol-img/wiring.jpg" class="img-fluid rounded mb-3" alt="Wiring">
              <p class="fw-semibold text-dark small">Power & Wiring Accessories</p>
            </div>
          </a>
        </div>

        <div class="col-6 col-sm-4 col-lg-3">
          <a href="#" class="text-decoration-none">
            <div class="category-card text-center p-3 h-100">
              <img src="img/electrisol-img/appliance.jpg" class="img-fluid rounded mb-3" alt="Home Appliances">
              <p class="fw-semibold text-dark small">Home Appliances</p>
            </div>
          </a>
        </div>

        <div class="col-6 col-sm-4 col-lg-3">
          <a href="#" class="text-decoration-none">
            <div class="category-card text-center p-3 h-100">
              <img src="img/electrisol-img/consumer.jpg" class="img-fluid rounded mb-3" alt="Consumer Electronics">
              <p class="fw-semibold text-dark small">Consumer Electronics</p>
            </div>
          </a>
        </div>

        <!-- Continue same structure for remaining categories... -->
        
      </div>
    </div>
  </div>
</div>

<!-- Custom CSS -->
<style>
  .category-card {
    background: #fff;
    border-radius: 12px;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
  }
  .category-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
    border-color: #ffc107;
  }
  .category-card img {
    max-height: 120px;
    object-fit: cover;
  }
</style>
