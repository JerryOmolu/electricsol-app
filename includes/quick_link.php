<style>
  .quick-links-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
  }

  .quick-link-item {
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 10px 5px;
    transition: all 0.25s ease;
  }

  .quick-link-item:hover {
    transform: translateY(-4px);
  }

  .icon-box {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: #f3f5f7;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 6px;
    transition: 0.25s;
  }

  .quick-link-item:hover .icon-box {
    background: #e9f0ff;
  }

  .quick-text {
    font-size: 12px;
    text-align: center;
    line-height: 1.2;
  }

  /* Mobile: single straight line scroll */
  @media (max-width: 576px) {
    .quick-scroll {
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto;
      gap: 12px;
      -webkit-overflow-scrolling: touch;
      padding-bottom: 5px;
    }

    .quick-scroll .col-3 {
      flex: 0 0 auto;
      width: auto;
    }
  }
</style>

<div class="container direction-rtl">
  <div class="card mb-3 quick-links-card">
    <div class="card-body">
      <h6 class="mb-2">Quick Links</h6>
      <hr class="mt-0">

      <div class="row g-3 quick-scroll">

        <div class="col-3">
          <a href="energy" class="quick-link-item">
            <div class="icon-box">
              <!-- Energy SVG -->
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M13 2L3 14h7l-1 8 12-14h-7l-1-6z"/>
              </svg>
            </div>
            <div class="quick-text">Calculate Energy</div>
          </a>
        </div>

        <div class="col-3">
          <a href="cart" class="quick-link-item">
            <div class="icon-box">
              <!-- Cart SVG -->
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.7 13.4a2 2 0 002 1.6h9.6a2 2 0 002-1.6L23 6H6"></path>
              </svg>
            </div>
            <div class="quick-text">Check My Cart</div>
          </a>
        </div>

        <div class="col-3">
          <a href="contact_disco" class="quick-link-item">
            <div class="icon-box">
              <!-- Contact SVG -->
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10a8 8 0 10-16 0c0 7 8 13 8 13s8-6 8-13z"></path>
                <circle cx="13" cy="10" r="3"></circle>
              </svg>
            </div>
            <div class="quick-text">Contact Disco(s)</div>
          </a>
        </div>

        <div class="col-3">
          <a href="view_artisan" class="quick-link-item">
            <div class="icon-box">
              <!-- Artisan SVG -->
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7l3-7z"/>
              </svg>
            </div>
            <div class="quick-text">Hire an Artisan</div>
          </a>
        </div>

      </div>
    </div>
  </div>
</div>