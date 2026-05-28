<?php session_start(); ?>
<?php include "includes/home_header.php"; ?>


<!-- Internet Connection Status -->
<div class="internet-connection-status" id="internetStatus"></div>

<!-- Dark mode switching -->
<div class="dark-mode-switching">
  <div class="d-flex w-100 h-100 align-items-center justify-content-center">
    <div class="dark-mode-text text-center">
      <i class="bi bi-moon"></i>
      <p class="mb-0">Switching to dark mode</p>
    </div>
    <div class="light-mode-text text-center">
      <i class="bi bi-brightness-high"></i>
      <p class="mb-0">Switching to light mode</p>
    </div>
  </div>
</div>

<!-- Header Area -->
<div class="header-area shadow-sm bg-white sticky-top" id="headerArea">
  <div class="container">
    <div class="header-content d-flex align-items-center justify-content-between py-3">
      <!-- Back Button -->
      <div class="back-button">
        <a href="home" class="btn-back">
          <i class="bi bi-arrow-left-short"></i>
        </a>
      </div>

      <!-- Page Title -->
      <div class="page-heading text-center flex-grow-1">
        <h6 class="mb-0 fw-bold text-dark d-flex align-items-center justify-content-center">
          <img src="img/electrisol-img/contact.png" width="26px" class="me-2"> Contact Us
        </h6>
      </div>

      <!-- Settings -->
      <div class="setting-wrapper">
        <div class="setting-trigger-btn" id="settingTriggerBtn">
          <i class="bi bi-gear"></i>
          <span></span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-content-wrapper py-3">
  <div class="container">
    <!-- Contact Form -->
    <div class="card shadow-sm mb-4 border-0">
      <div class="card-body">
        <h5 class="mb-3 fw-bold text-dark"><i class="bi bi-chat-dots me-2 text-primary"></i> Write to us</h5>

        <!-- Contact Us PHP Logic -->
        <?php 
// assumes $pdo already exists from includes/db.php
// include "includes/db.php";

if(isset($_POST['submit'])){

    // -------------------------
    // FAST INPUT LOADING
    // -------------------------
    $email   = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $body    = $_POST['body'] ?? '';

    $email   = filter_var($email, FILTER_SANITIZE_EMAIL);
    $subject = trim($subject);
    $body    = trim($body);

    if(!empty($email) && !empty($subject) && !empty($body)){

        // -------------------------
        // EMAIL HEADERS (OPTIMIZED)
        // -------------------------
        $to = "info@electricsol.org";
        $subject = wordwrap($subject, 70);
        $headers = "From: ".$email."\r\n";
        $headers .= "Reply-To: ".$email."\r\n";

        // -------------------------
        // SEND EMAIL (FAST PATH)
        // -------------------------
        $sent = mail($to, $subject, $body, $headers);

        if($sent){

            // -------------------------
            // PDO LOGGING (OPTIONAL BUT HIGH VALUE)
            // reduces debugging + prevents spam abuse
            // -------------------------
            try {
                $stmt = $pdo->prepare("
    INSERT INTO contact_messages (email, subject, message, ip_address, user_agent, created_at)
    VALUES (:email, :subject, :message, :ip, :agent, NOW())
");

                $stmt->execute([
                    ':email'   => $email,
                    ':subject' => $subject,
                    ':message' => $body
                ]);

            } catch(Exception $e){
                // fail silently for performance (do not block user flow)
            }

            echo "<div class='alert alert-success'>
                    Your message has been sent successfully!
                  </div>";

        } else {
            echo "<div class='alert alert-danger'>
                    Message could not be sent. Please try again.
                  </div>";
        }

    } else {
        echo "<div class='alert alert-warning'>
                All fields are required.
              </div>";
    }
}
?>

        <!-- Contact Form -->
        <form action="" method="post" class="needs-validation" novalidate>
          <div class="mb-3">
            <input class="form-control" type="email" placeholder="Enter Your Email" name="email" id="email" required>
          </div>
          <div class="mb-3">
            <input class="form-control" type="text" placeholder="Enter Subject" name="subject" id="subject" required>
          </div>
          <div class="mb-3">
            <textarea class="form-control" name="body" rows="5" placeholder="Write Your Message" required></textarea>
          </div>
          <button class="btn btn-primary w-100" type="submit" name="submit">
            <i class="bi bi-send me-1"></i> Send Message
          </button>
        </form>
      </div>
    </div>

    <!-- Google Maps & Contact Info -->
    <div class="card shadow-sm border-0">
      <div class="card-body">
        <h5 class="mb-3 fw-bold text-dark"><i class="bi bi-geo-alt me-2 text-danger"></i> Our Office Location</h5>
        <p><b>Office Address:</b> Area 2 Section 2, Block 2, Jibiya Street, Garki – Abuja.</p>
        
        <div class="divider my-3">
          <i class="bi bi-geo-alt text-primary"></i>
        </div>

        <iframe class="rounded shadow-sm" width="100%" height="300" frameborder="0" scrolling="no" 
          src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Area%202%20Section%202,%20block%202,%20Jibiya%20street%20Garki-%20Abuja.+(Electricsol%20Limited)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
        </iframe>

        <div class="divider my-3">
          <i class="bi bi-person-lines-fill text-success"></i>
        </div>

        <table class="table table-borderless text-center mb-0">
          <tr>
            <td><i class="bi bi-phone text-primary"></i> <span class="fw-bold">07039000386</span></td>
            <td><i class="bi bi-envelope text-warning"></i> <span class="fw-bold">info@electricsol.org</span></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<style>
/* Back button styling */
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

/* Divider styling */
.divider {
  text-align: center;
  position: relative;
}
.divider i {
  background: #fff;
  padding: 0 10px;
  font-size: 1.2rem;
  position: relative;
  z-index: 2;
}
.divider::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0;
  width: 100%;
  border-top: 1px solid #ddd;
  z-index: 1;
}

</style>

<!-- Footer Nav -->
<?php include "includes/home_footer_nav.php"; ?>
