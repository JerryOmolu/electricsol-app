<?php ob_start(); ?>
<?php include "includes/db.php" ?>
<?php session_start(); ?>
<?php include "includes/functions.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Electricsol-Mobile App</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">

  <style>

    body {
      background: linear-gradient(180deg, #f6f8fb 0%, #ffffff 100%);
      font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    }

    /* PRELOADER */
    #preloader {
      position: fixed;
      inset: 0;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    }

    /* HEADER */
    .header-area {
      background: #fff;
      border-bottom: 1px solid #eee;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .header-content {
      padding: 14px 0;
    }

    .back-button a {
      width: 38px;
      height: 38px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 12px;
      background: #f2f4f7;
      color: #111;
      text-decoration: none;
      transition: .2s;
    }

    .back-button a:hover {
      background: #0134d4;
      color: #fff;
    }

    .page-heading {
      flex: 1;
      text-align: center;
      font-weight: 700;
      font-size: 15px;
      color: #111;
    }

    /* CARD */
    .card {
      border: 0;
      border-radius: 18px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.06);
      padding: 10px;
      background: #fff;
    }

    .card h6 {
      font-weight: 700;
      color: #0134d4;
    }

    /* FORM */
    .form-label {
      font-size: 13px;
      font-weight: 600;
      color: #444;
      margin-bottom: 6px;
    }

    .form-control,
    .form-select {
      border-radius: 12px;
      padding: 12px 14px;
      border: 1px solid #e5e5e5;
      font-size: 14px;
      transition: .2s;
      background: #fafafa;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #0134d4;
      box-shadow: 0 0 0 3px rgba(1,52,212,0.15);
      background: #fff;
    }

    textarea.form-control {
      resize: none;
    }

    /* BUTTON */
    .btn-dark {
      width: 100%;
      border-radius: 14px;
      padding: 13px;
      font-weight: 700;
      border: none;
      background: linear-gradient(135deg, #0134d4, #000);
      transition: .25s;
    }

    .btn-dark:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 20px rgba(1,52,212,0.25);
    }

    /* CARD BODY */
    .card-body {
      padding: 18px;
    }

    /* ICON TITLE */
    .section-title {
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: 700;
      margin-bottom: 12px;
    }

  </style>
</head>

<body>


  <!-- HEADER -->
  <div class="header-area" id="headerArea">
    <div class="container">
      <div class="header-content d-flex align-items-center">

        <div class="back-button">
          <a href="home">
            <i class="bi bi-arrow-left-short fs-3"></i>
          </a>
        </div>

        <div class="page-heading">
          <img src="img/electrisol-img/disco.png" width="26">
          Contact Your Disco
        </div>

        <div style="width:38px;"></div>

      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="page-content-wrapper py-4">
    <div class="container">

      <div class="card">
        <div class="card-body">

          <div class="section-title">
            <i class="bi bi-chat-left-text"></i>
            Send a Message / Complaint
          </div>

          <form action="" method="post">

            <div class="mb-3">
              <label class="form-label">Your Name</label>
              <input class="form-control" type="text" name="name" placeholder="Enter your name" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Your Location</label>
              <input class="form-control" type="text" name="location" placeholder="Enter your location" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Phone Number</label>
              <input class="form-control" type="text" name="phone" maxlength="11" placeholder="Enter phone number" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Select Disco</label>
              <select class="form-select" name="disco" required>
                <option value="">-- Select Disco --</option>
                <option>AEDC - Abuja Electricity Distribution Company</option>
                <option>Aba Power Electric Company</option>
                <option>EKEDC - Eko Electricity Distribution Company</option>
                <option>IKEDC - Ikeja Electricity Distribution Company</option>
                <option>BEDC - Benin Electricity Distribution Company</option>
                <option>IBEDC - Ibadan Electricity Distribution Company</option>
                <option>KEDCO - Kano Electricity Distribution Company</option>
                <option>EEDC - Enugu Electricity Distribution Company</option>
                <option>PHEDC - Port Harcourt Electricity Distribution Company</option>
                <option>JEDC - Jos Electricity Distribution Company</option>
                <option>YEDC - Yola Electricity Distribution Company</option>
                <option>KAEDC - Kaduna Electricity Distribution Company</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Your Message</label>
              <textarea class="form-control" name="message" rows="3" maxlength="150" placeholder="Type your message..." required></textarea>
            </div>

            <button class="btn btn-dark" type="submit" name="review">
              <i class="bi bi-send me-1"></i> Submit Message
            </button>

          </form>

<?php
if(isset($_POST['review'])){

    $name     = trim($_POST['name'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $disco    = trim($_POST['disco'] ?? '');
    $message  = trim($_POST['message'] ?? '');

    if(!empty($name) && !empty($location) && !empty($phone) && !empty($disco) && !empty($message)){

        try {

            $stmt = $pdo->prepare("
                INSERT INTO disco
                (name, location, phone, disco, message, date, status)
                VALUES
                (:name, :location, :phone, :disco, :message, NOW(), 'Unhandled')
            ");

            $result = $stmt->execute([
                ':name'     => $name,
                ':location' => $location,
                ':phone'    => $phone,
                ':disco'    => $disco,
                ':message'  => $message
            ]);

            if($result){
                $_SESSION['head'] = "Success";
                $_SESSION['status'] = "Message sent successfully";
                $_SESSION['status_code'] = "success";
            } else {
                $_SESSION['head'] = "Error";
                $_SESSION['status'] = "Something went wrong";
                $_SESSION['status_code'] = "error";
            }

        } catch(Exception $e){
            $_SESSION['head'] = "Error";
            $_SESSION['status'] = "Something went wrong";
            $_SESSION['status_code'] = "error";
        }

    } else {
        echo "<div class='alert alert-danger mt-3'>All fields are required</div>";
    }
}
?>

        </div>
      </div>

    </div>
  </div>

  <!-- SWEET ALERT -->
  <script src="js/sweetalert.js"></script>

  <?php if(isset($_SESSION['status']) && $_SESSION['status'] != '') { ?>
    <script>
      swal({
        title: "<?php echo $_SESSION['head']; ?>",
        text: "<?php echo $_SESSION['status']; ?>",
        icon: "<?php echo $_SESSION['status_code']; ?>",
        button: "OK",
      }).then(function(){
        window.location = "contact_disco";
      });
    </script>
  <?php unset($_SESSION['status']); } ?>

</body>
</html>