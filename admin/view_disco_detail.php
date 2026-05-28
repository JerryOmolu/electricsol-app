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
// Ensure ID is safe
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

try {

    // PDO prepared statement (FAST + SAFE)
    $stmt = $pdo->prepare("SELECT * FROM disco WHERE disco_id = :id LIMIT 1");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {

        $disco_id = escape($row['disco_id']);
        $name     = escape($row['name']);
        $location = escape($row['location']);
        $phone    = escape($row['phone']);
        $disco    = escape($row['disco']);
        $message  = escape($row['message']);
        $date     = escape($row['date']);
        $status   = escape($row['status']);
?>

                    <div class="media">
                        <img src="img/electrisol-img/power.jpg" alt="profile" width="200px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                                        <td>
                                            <?php 
                                            if ($status == 'Handled') {
                                                echo "<button class='btn btn-success'>$status</button>";   
                                            } else {
                                                echo "<button class='btn btn-warning'>$status</button>";    
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody> 
                            </table>

                        </div>
                    </div>

<?php
    } else {
        echo "<div class='alert alert-danger'>No record found.</div>";
    }

} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Database error occurred.</div>";
}
?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include "includes/admin_footer.php"; ?>   