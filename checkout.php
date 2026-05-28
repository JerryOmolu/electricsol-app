<?php session_start(); ?>
<?php include "includes/home_header.php"; ?>

<?php
$fullname = $_SESSION['fullname'] ?? '';
$email    = $_SESSION['email'] ?? '';
$phone    = $_SESSION['phone'] ?? '';
$address  = $_SESSION['address'] ?? '';
$total    = $_GET['total'] ?? 0;

$fullname = htmlspecialchars($fullname, ENT_QUOTES, 'UTF-8');
$email    = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$phone    = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
$address  = htmlspecialchars($address, ENT_QUOTES, 'UTF-8');
$total    = (float)$total;
?>


<div class="internet-connection-status" id="internetStatus"></div>

<!-- HEADER -->
<div class="header-area shadow-sm bg-white sticky-top" id="headerArea">
  <div class="container">
    <div class="header-content d-flex align-items-center justify-content-between py-3">

      <a href="cart" class="btn-back">
        <i class="bi bi-arrow-left-short"></i>
      </a>

      <div class="page-title d-flex align-items-center gap-2">
        <img src="img/electrisol-img/checkout.png" width="26">
        <span>Secure Checkout</span>
      </div>

      <div class="navbar--toggler" id="affanNavbarToggler"
        data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas">
        <span></span><span></span><span></span>
      </div>

    </div>
  </div>
</div>

<?php include "includes/home_side_nav_left.php"; ?>

<!-- CONTENT -->
<div class="page-content-wrapper py-4">
  <div class="container">

    <div class="checkout-card">

      <div class="checkout-top">
        <h5>Billing Details</h5>
        <p>Confirm your information before payment</p>
      </div>

      <form id="paymentForm">

        <div class="form-grid">

          <div class="field">
            <label>Full Name</label>
            <input type="text" id="fname" value="<?= $fullname ?>" readonly>
          </div>

          <div class="field">
            <label>Email Address</label>
            <input type="email" id="email-address" value="<?= $email ?>" readonly>
          </div>

          <div class="field full">
            <label>Billing Address</label>
            <input type="text" value="<?= $address ?>" readonly>
          </div>

          <div class="field highlight full">
            <label>Total Amount</label>
            <input type="tel" id="amount" value="<?= $total ?>" readonly>
            <small>₦<?= number_format($total, 2) ?></small>
          </div>

        </div>

        <div class="paystack-box">
          <img src="img/electrisol-img/paystack.png">
        </div>

        <button class="pay-btn" type="submit">
          Pay Securely ₦<?= number_format($total, 2) ?>
        </button>

      </form>

    </div>

  </div>
</div>

<style>

/* ===== PAGE BACKGROUND ===== */
body {
  background: linear-gradient(180deg, #f8f9fb 0%, #ffffff 100%);
}

/* ===== HEADER ===== */
.header-area {
  border-bottom: 1px solid #eee;
  backdrop-filter: blur(8px);
}

.page-title {
  font-weight: 600;
  font-size: 15px;
  color: #111;
}

/* BACK BUTTON */
.btn-back {
  width: 38px;
  height: 38px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f3f4f6;
  color: #111;
  transition: .25s;
  text-decoration: none;
}
.btn-back:hover {
  background: #EC8305;
  color: #fff;
}

/* ===== CARD ===== */
.checkout-card {
  background: #fff;
  border-radius: 18px;
  padding: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.06);
  border: 1px solid #f1f1f1;
}

/* TOP SECTION */
.checkout-top h5 {
  font-weight: 700;
  margin-bottom: 5px;
}
.checkout-top p {
  font-size: 13px;
  color: #777;
}

/* ===== FORM GRID ===== */
.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
  margin-top: 15px;
}

.field.full {
  grid-column: span 2;
}

.field label {
  font-size: 13px;
  font-weight: 600;
  margin-bottom: 6px;
  display: block;
  color: #444;
}

.field input {
  width: 100%;
  padding: 12px 14px;
  border-radius: 12px;
  border: 1px solid #e6e6e6;
  font-size: 14px;
  transition: .25s;
  background: #fafafa;
}

.field input:focus {
  outline: none;
  border-color: #EC8305;
  box-shadow: 0 0 0 3px rgba(236,131,5,0.15);
  background: #fff;
}

/* HIGHLIGHT AMOUNT */
.highlight input {
  font-weight: 700;
  color: #198754;
}

.highlight small {
  display: block;
  margin-top: 6px;
  font-size: 12px;
  color: #666;
}

/* PAYSTACK BOX */
.paystack-box {
  text-align: center;
  margin: 20px 0 10px;
}
.paystack-box img {
  width: 160px;
  opacity: 0.9;
}

/* PAY BUTTON */
.pay-btn {
  width: 100%;
  padding: 14px;
  border: none;
  border-radius: 14px;
  font-weight: 700;
  font-size: 15px;
  color: #fff;
  background: linear-gradient(135deg, #28a745, #1e7e34);
  box-shadow: 0 10px 20px rgba(40,167,69,0.25);
  transition: .25s;
}

.pay-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 14px 25px rgba(40,167,69,0.35);
}

/* HAMBURGER */
.navbar--toggler {
  width: 30px;
  height: 22px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  cursor: pointer;
}
.navbar--toggler span {
  height: 3px;
  border-radius: 3px;
  background: #333;
  transition: .25s;
}
.navbar--toggler:hover span {
  background: #EC8305;
}

/* RESPONSIVE */
@media(max-width: 768px){
  .form-grid {
    grid-template-columns: 1fr;
  }
  .field.full {
    grid-column: span 1;
  }
}

</style>

<script src="https://js.paystack.co/v1/inline.js"></script>

<script>
const paymentForm = document.getElementById('paymentForm');

paymentForm.addEventListener("submit", payWithPaystack);

function payWithPaystack(e){
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: 'pk_test_a57ecd12cac9e74aa191be0c9210919f92aae107',
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
    ref: 'EM' + Math.floor(Math.random() * 1000000000 + 1),

    onClose: function () {
      window.location = "https://electricsol.com.ng/cart?transaction-canceled";
    },

    callback: function (response) {
      window.location =
        "http://localhost/electricsol/verify_transaction?reference=" +
        response.reference;
    }
  });

  handler.openIframe();
}
</script>

<?php include "includes/home_footer_nav.php"; ?>