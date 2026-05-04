<?php include "includes/admin_header.php"; ?>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<?php include "includes/top_nav.php"; ?>   
<!-- partial -->
<div class="container-fluid page-body-wrapper">
  

<!-- partial:partials/_sidebar.html -->
<?php include "includes/sidenav.php"; ?>      

<!-- partial -->
<div class="main-panel">
<div class="content-wrapper">
 <?php include "includes/welcome.php"; ?>   

<!--    Main Content Wrapper-->
<div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">ARTISAN'S DETAIL</p><hr>
    
          <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                   <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
                          
                $query = "SELECT * FROM artisan WHERE artisan_id  = $id";
                $view_artisan = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($view_artisan)){
                    $id = escape($row['artisan_id']);
                    $name = escape($row['name']);
                    $gender = escape($row['gender']);
                    $date_of_birth = escape($row['date_of_birth']);
                    $email = escape($row['email']);
                    $phone = escape($row['phone']);
                    $state = escape($row['state']);
                    $lga = escape($row['lga']);
                    $address = escape($row['address']);
                    $skills = escape($row['skills']);
                    $certificate = escape($row['certificate']);
                    $years = escape($row['years']);
                    $added_on = escape($row['added_on']);
                    ?>
                
              <div class="card">
                <div class="card-body">
                  <div class="media">
                    <img src="img/electrisol-img/artisan.png" alt="profile"/ width="200px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="media-body">
                    <h4>Personal Details of <?php  echo $name ?></h4><hr> 
                    <ul>
                    <li><h5 class="card-text">Artisan Name: <?php echo $name ?></h5></li><br>
                    <li><h5 class="card-text">Artisan Email: <?php echo $email ?></h5></li><br>
                    <li><h5 class="card-text">Artisan Phone Number: <?php echo $phone ?></h5></li><br>
                    <li><h5 class="card-text">State of Origin: <?php echo $state ?></h5></li><br>
                    <li><h5 class="card-text">LGA: <?php echo $lga ?></h5></li><br>
                    <li><h5 class="card-text">Contact Address: <?php echo $address ?></h5></li><br>
                    <li><h5 class="card-text">Date of Birth: <?php echo $date_of_birth ?></h5></li><br>
                    </ul><hr>
                    <h4>Skills</h4><hr>
                    <table>
                    <tr>
                    <td>
                    <h6>
                    <?php if(isset($skills)){
                    $string = $skills;
                    $string = rtrim($string, ',');
                    echo "<table class='table table-hover table-bordered table-striped table-responsive'>";
                    foreach(explode(',', $string) as $td) {
                    echo "<tr>";
                    echo "<td><i class='fa fa-check-square-o' aria-hidden='true' style='color:green'></i></td>"; 
                    echo "<td><h6>$td</h6></td>";
                    echo "</tr>";
                    }
                    echo "</table>";

                    } 
                    ?>
                    </h6>  
                    </td>
                    </table><hr>
                    <h4>Certifications</h4><hr>
                    <table>
                    <tr>
                    <td>
                    <h6>
                    <?php if(isset($certificate)){
                    $string = $certificate;
                    $string = rtrim($string, ',');
                    echo "<table class='table table-hover table-bordered table-striped table-responsive'>";
                    foreach(explode(',', $string) as $td) {
                    echo "<tr>";
                    echo "<td><i class='fa fa-check-square-o' aria-hidden='true' style='color:green'></i></td>"; 
                    echo "<td><h6>$td</h6></td>";
                    echo "</tr>";
                    }
                    echo "</table>";

                    } 
                    ?>
                    </h6>  
                    </td>
                    </table><hr>
                    <h4>Years of Experience</h4><hr>
                    <ul>   
                    <li><h5 class="card-text"><?php echo $years  ?></h5></li>
                    </ul> 
                    </div>
                  </div>
                </div>
              </div>
        <?php } ?>
              </div>
            </div>
    
    </div>
    
    
        </div>     

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include "includes/admin_footer.php"; ?>      
