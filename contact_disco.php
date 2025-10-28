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

  <!-- Title -->
  <title>Electricsol-Mobile App</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">

  <!-- Custom CSS -->
  <style>
    /* Card beautification */
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.08);
      padding: 20px;
    }

    .card h6 {
      font-weight: 600;
      color: #0134d4;
    }

    /* Input fields */
    .form-control {
      border-radius: 10px;
      padding: 12px;
      border: 1px solid #ddd;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #0134d4;
      box-shadow: 0 0 6px rgba(1, 52, 212, 0.2);
    }

    /* Button */
    .btn-dark {
      width: 100%;
      border-radius: 12px;
      padding: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
      background: linear-gradient(135deg, #0134d4, #000);
      border: none;
    }

    .btn-dark:hover {
      background: linear-gradient(135deg, #000, #0134d4);
      transform: translateY(-2px);
      box-shadow: 0px 6px 15px rgba(1, 52, 212, 0.3);
    }
  </style>
</head>

<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
  </div>

  <!-- Header Area -->
  <div class="header-area" id="headerArea">
    <div class="container">
      <div class="header-content header-style-five d-flex align-items-center">
        <div class="back-button">
          <a href="index"><i class="bi bi-arrow-left-short fs-3"></i></a>
        </div>
        <div class="page-heading">
          <h6 class="mb-0"><center><img src="img/electrisol-img/disco.png" width="30px"> Contact Your Disco</center></h6>
        </div>
      </div>
    </div>
  </div>

  <!-- Page Content -->
  <div class="page-content-wrapper py-4">
    <div class="container">
      <div class="card">
        <div class="card-body">
          <h6 class="mb-3"><i class="bi bi-chat-left-text"></i> Send a Message/Complaint</h6>

          <!-- Contact Form -->
          <form action="" method="post">
            <div class="form-group mb-3">
              <label><b>Your Name:</b></label>
              <input class="form-control" type="text" name="name" placeholder="Enter your name" required>
            </div>

            <div class="form-group mb-3">
              <label><b>Your Location:</b></label>
              <input class="form-control" type="text" name="location" placeholder="Enter your location" required>
            </div>

            <div class="form-group mb-3">
              <label><b>Your Phone Number:</b></label>
              <input class="form-control" type="text" name="phone" maxlength="11" placeholder="Enter your phone number" required>
            </div>

            <div class="form-group mb-3">
              <label><b>Disco to Contact:</b></label>
              <select class="form-select" name="disco" required>
                <option value="">-- Select Disco --</option>
                <option value="AEDC - Abuja Electricity Distribution Company">AEDC - Abuja Electricity Distribution Company</option>
                <option value="Aba Power">Aba Power Electric Company</option>
                <option value="EKEDC - Eko Electricity Distribution Company">EKEDC - Eko Electricity Distribution Company</option>
                <option value="IKEDC - Ikeja Electricity Distribution Company">IKEDC - Ikeja Electricity Distribution Company</option>
                <option value="BEDC - Benin Electricity Distribution Company">BEDC - Benin Electricity Distribution Company</option>
                <option value="IBEDC - Ibadan Electricity Distribution Company">IBEDC - Ibadan Electricity Distribution Company</option>
                <option value="KEDCO - Kano Electricity Distribution Company">KEDCO - Kano Electricity Distribution Company</option>
                <option value="EEDC - Enugu Electricity Distribution Company">EEDC - Enugu Electricity Distribution Company</option>
                <option value="PHEDC - Port Harcourt Electricity Distribution Company">PHEDC - Port Harcourt Electricity Distribution Company</option>
                <option value="JEDC - Jos Electricity Distribution Company">JEDC - Jos Electricity Distribution Company</option>
                <option value="YEDC - Yola Electricity Distribution Company">YEDC - Yola Electricity Distribution Company</option>
                <option value="KAEDC - Kaduna Electricity Distribution Company">KAEDC - Kaduna Electricity Distribution Company</option>
              </select>
            </div>

            <div class="form-group mb-3">
              <label><b>Your Message:</b></label>
              <textarea class="form-control" name="message" rows="3" maxlength="150" placeholder="Type your message (max 150 chars)" required></textarea>
            </div>

            <button class="btn btn-dark" type="submit" name="review"><i class="bi bi-send"></i> Submit</button>
          </form>

          <!-- PHP Logic -->
          <?php		  
          if(isset($_POST['review'])){
              $name = mysqli_real_escape_string($connection,$_POST['name']);
              $location = mysqli_real_escape_string($connection,$_POST['location']);
              $phone = mysqli_real_escape_string($connection,$_POST['phone']);
              $disco = mysqli_real_escape_string($connection,$_POST['disco']);
              $message = mysqli_real_escape_string($connection,$_POST['message']);
              
              if(!empty ($name) && !empty ($location) && !empty ($phone) && !empty ($disco) && !empty ($message)){
                $query = "INSERT INTO disco(name,location,phone,disco,message,date,status)
                          VALUES('{$name}','{$location}','{$phone}','{$disco}','{$message}',now(),'Unhandled')";
                $disco_query = mysqli_query($connection, $query);
                
                if($disco_query){
                  $_SESSION['head'] = "Thank You!";
                  $_SESSION['status'] = "Your message has been sent successfully";
                  $_SESSION['status_code'] = "success";
                } else {
                  $_SESSION['head'] = "Error!";
                  $_SESSION['status'] = "Something went wrong";
                  $_SESSION['status_code'] = "error";
                }
              } else {
                echo "<div class='alert alert-danger mt-3'><strong>All fields are required!</strong></div>";
              }
          }               
          ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Sweet Alert -->
  <script src="js/sweetalert.js"></script>
  <?php 
  if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
  ?>
    <script>
      swal({
        title: "<?php echo $_SESSION['head']; ?>",
        icon: "<?php echo $_SESSION['status_code']; ?>",
        text: "<?php echo $_SESSION['status']; ?>",
        button: "OK",
      }).then(function() {
        window.location = "contact_disco";
      });
    </script>
  <?php unset($_SESSION['status']); } ?>

  <?php include "includes/home_footer_nav.php"; ?>
</body>
</html>
