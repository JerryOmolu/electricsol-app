<div class="container my-5">
  <div class="card text-white shadow-lg border-0 rounded-4 overflow-hidden" 
       style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('img/electrisol-img/art1.jpg') center/cover no-repeat;">
    
    <div class="card-body p-5 text-center">
      <!-- Title -->
      <h3 class="fw-bold mb-3">Our Artisans' Planet</h3>
      <hr class="bg-light w-25 mx-auto mb-5">

      <!-- Options -->
      <div class="row g-4 justify-content-center">
        
        <!-- Register as Artisan -->
        <div class="col-6 col-md-4">
          <a href="artisan_register" class="text-decoration-none">
            <div class="card h-100 bg-dark bg-gradient shadow-sm border-0 rounded-4 artisan-card">
              <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                <img src="img/electrisol-img/worker2.png" width="70" alt="Register Artisan" class="mb-3">
                <p class="text-white fw-light mb-0">Register as an Artisan</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Hire an Artisan -->
        <div class="col-6 col-md-4">
          <a href="view_artisan" class="text-decoration-none">
            <div class="card h-100 bg-dark bg-gradient shadow-sm border-0 rounded-4 artisan-card">
              <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                <img src="img/electrisol-img/worker2.png" width="70" alt="Hire Artisan" class="mb-3">
                <p class="text-white fw-light mb-0">Hire an Artisan</p>
              </div>
            </div>
          </a>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Custom CSS -->
<style>
  .artisan-card {
    transition: all 0.3s ease-in-out;
    cursor: pointer;
  }
  .artisan-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(255, 193, 7, 0.4);
  }
</style>
