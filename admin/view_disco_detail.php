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
                  <p class="card-title">DETAIL OF PUBLIC REQUEST/COMPLAINT TO DISCOS</p><hr>
    
          <div class="row">
                   <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
                          
                $query = "SELECT * FROM disco WHERE disco_id   = $id";
                $view_disco = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($view_disco)){
                    $disco_id = escape($row['disco_id']);
                    $name = escape($row['name']);
                    $location = escape($row['location']);
                    $phone = escape($row['phone']);
                    $disco = escape($row['disco']);
                    $message = escape($row['message']);
                    $date = escape($row['date']);
                    $status = escape($row['status']);
                    ?>
                  <div class="media">
                    <img src="img/electrisol-img/power.jpg" alt="profile"/ width="200px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="media-body">
                    <h4>The Details</h4><hr>
                    <table class='table table-hover table-bordered table-striped table-responsive'>
                    <tbody>   
                   <tr>
                    <td><b>Name</b></td>
                    <td><?php echo $name ?></td>
                    </tr>
                    <tr>
                    <td><b>Phone Number</b></td>
                    <td><?php echo $phone ?></td>
                    </tr>
                    <tr>
                    <td><b>Disco to Contact</b></td>
                    <td><?php echo $disco ?></td>
                    </tr>
                    <tr>
                    <td><b>Message</b></td>
                    <td><?php echo $message ?></td>
                    </tr>
                    <tr>
                    <td><b>Date</b></td>
                    <td><?php echo $date ?></td>
                    </tr>
                    <tr>
                    <td><b>Status</b></td>
                    <td><?php 
                        if ($status == 'Handled'){
                         echo "<button class='btn btn-success'>$status</button>";   
                        }else{
                        echo "<button class='btn btn-warning'>$status</button>";    
                        }
                        ?></td>
                    </tr>
                    </tbody> 
                    </table>
                    </div>
                      
        <?php } ?>
              </div>
            </div>
    
    </div>
    
    
        </div>     

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include "includes/admin_footer.php"; ?>      
