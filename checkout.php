<?php include "includes/home_header.php"; ?>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>

  <!-- HEADER AREA -->
<!-- Checkout Header -->
<div class="header-area shadow-sm bg-white sticky-top" id="headerArea">
  <div class="container">
    <!-- Header Content -->
    <div class="header-content header-style-five d-flex align-items-center justify-content-between py-3">
      
      <!-- Back Button -->
      <div class="back-button">
        <a href="cart" class="btn-back">
          <i class="bi bi-arrow-left-short"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 fw-bold text-dark d-flex align-items-center justify-content-center">
          <img src="img/electrisol-img/checkout.png" width="26px" class="me-2"> Checkout
        </h6>
      </div>

      <!-- Navbar Toggler -->
      <div class="navbar--toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas"
        data-bs-target="#affanOffcanvas" aria-controls="affanOffcanvas">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
</div>


<?php include "includes/home_side_nav_left.php"; ?>

<!-- PAGE CONTENT -->
<div class="page-content-wrapper py-4">
  <div class="container">
    <!-- Checkout Wrapper -->
    <div class="checkout-wrapper-area">
      <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body checkout-form">
          <h6 class="mb-3 fw-bold text-dark border-bottom pb-2">Billing Details</h6>

          <?php 
            if(isset($_SESSION['fullname'])) $fullname = escape($_SESSION['fullname']);
            if(isset($_SESSION['email'])) $email = escape($_SESSION['email']);
            if(isset($_SESSION['phone'])) $phone = escape($_SESSION['phone']);
            if(isset($_SESSION['address'])) $address = escape($_SESSION['address']);

            if(isset($_GET['total'])) $total = escape($_GET['total']);
          ?>

          <form id="paymentForm">
            <div class="form-group mb-3">
              <label class="fw-semibold">Full Name</label>
              <input class="form-control rounded-3" type="text" id="fname" value="<?php echo $fullname ?>" readonly />
            </div>

            <div class="form-group mb-3">
              <label class="fw-semibold">Email Address</label>
              <input class="form-control rounded-3" type="email" id="email-address" 
                     value="<?php echo $email ?>" readonly />
            </div>

            <div class="form-group mb-3">
              <label class="fw-semibold">Billing Address</label>
              <input class="form-control rounded-3" type="text" value="<?php echo $address ?>" readonly />
            </div>

            <div class="form-group mb-3">
              <label class="fw-semibold">Total Amount to Pay</label>
              <input class="form-control rounded-3 fw-bold text-success" type="tel" id="amount" 
                     value="<?php $total = escape($_GET['total']); echo $total ?>" readonly />
            </div>

            <div class="text-center my-3">
              <img src="img/electrisol-img/paystack.png" width="200px" class="img-fluid">
            </div>

            <div class="form-submit">
              <button class="btn btn-success w-100 py-2 rounded-3 fw-bold" type="submit" onclick="payWithPaystack()">
                Pay Now (&#8358;<?php $total = escape($_GET['total']); echo number_format($total, 2); ?>)
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Checkout Page Styles */
.checkout-form label {
  font-size: 14px;
  color: #333;
}
.checkout-form input {
  font-size: 15px;
  padding: 10px 12px;
  border: 1px solid #ddd;
}
.checkout-form input:focus {
  border-color: #EC8305;
  box-shadow: 0 0 4px rgba(236,131,5,.3);
}
.checkout-form .btn-success {
  background-color: #28a745;
  border: none;
  transition: background .3s ease;
}
.checkout-form .btn-success:hover {
  background-color: #218838;
}

	/* Header Area */
.header-area {
  border-bottom: 1px solid #f0f0f0;
}

.header-area .header-content {
  position: relative;
}

/* Back Button */
.btn-back {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: #f8f9fa;
  color: #333;
  font-size: 1.4rem;
  transition: all 0.3s ease;
}
.btn-back:hover {
  background: #EC8305;
  color: #fff;
  text-decoration: none;
}

/* Page Title */
.page-heading h6 {
  font-size: 16px;
  letter-spacing: 0.3px;
}

/* Navbar Toggler */
.navbar--toggler {
  width: 30px;
  height: 22px;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.navbar--toggler span {
  display: block;
  height: 3px;
  background-color: #333;
  border-radius: 2px;
  transition: all 0.3s ease;
}
.navbar--toggler:hover span {
  background-color: #EC8305;
}

</style>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
  const paymentForm = document.getElementById('paymentForm');
  paymentForm.addEventListener("submit", payWithPaystack, false);

  function payWithPaystack(e) {
    e.preventDefault();
    let handler = PaystackPop.setup({
      key: 'pk_test_a57ecd12cac9e74aa191be0c9210919f92aae107',
      fname: document.getElementById("fname").value,
      email: document.getElementById("email-address").value,
      amount: document.getElementById("amount").value * 100,
      ref: 'EM'+Math.floor((Math.random() * 1000000000) + 1),
      onClose: function(){
        window.location = "https://electricsol.com.ng/cart?transaction-canceled";
        alert('Transaction Cancelled.');
      },
      callback: function(response){
        let message = 'Payment complete! Reference: ' + response.reference;
        alert(message);
        window.location = "https://electricsol.com.ng/verify_transaction?reference=" + response.reference;
      }
    });
    handler.openIframe();
  }
</script>

<?php include "includes/home_footer_nav.php"; ?>
