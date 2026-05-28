<div class="pb-3"></div>
    <div class="container my-5">
  <div class="promo-card card text-white shadow-lg overflow-hidden">
    <div class="bg-img" style="background-image: url('img/electrisol-img/power.jpg');"></div>
    <div class="overlay"></div>
    <div class="card-body p-5 position-relative text-center">
      <h2 class="fw-bold mb-3">Over 2000 Energy Saving Electrical Products</h2>
      <p class="mb-4 text-white">Shop high-quality electrical products with our user-friendly mobile app.</p>
      <a class="btn btn-warning btn-lg fw-bold shadow" href="shop">
        Shop Now <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</div>

<style>
.promo-card {
  border-radius: 16px;
  position: relative;
  height: 320px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.promo-card .bg-img {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center;
  transition: transform 0.5s ease;
}

.promo-card .overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom right, rgba(0,0,0,0.5), rgba(0,0,0,0.3));
}

.promo-card:hover .bg-img {
  transform: scale(1.1);
}

.promo-card .card-body {
  position: relative;
  z-index: 2;
}

.promo-card h2 {
  font-size: 1.8rem;
}

.promo-card p {
  font-size: 1.1rem;
}

.promo-card .btn {
  transition: all 0.3s ease;
  border-radius: 50px;
  padding: 12px 24px;
}

.promo-card .btn:hover {
  background-color: #ffc107;
  color: #000;
  transform: scale(1.05);
  box-shadow: 0 6px 18px rgba(0,0,0,0.3);
}
</style>