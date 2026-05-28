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

<!-- Main Content Wrapper -->
<div class="row">
    <div class="col-md-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">CUSTOMER DETAIL</p>
                <hr>

                <div class="row">
                    <div class="col-md-8 grid-margin stretch-card">

<?php
// Ensure ID is safe
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

try {
    // PDO query (optimized + secure)
    $stmt = $pdo->prepare("SELECT id, fullname, email, phone, date, address 
                           FROM register 
                           WHERE id = :id 
                           LIMIT 1");
    
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row):
        $fullname = htmlspecialchars($row['fullname']);
        $email    = htmlspecialchars($row['email']);
        $phone    = htmlspecialchars($row['phone']);
        $address  = htmlspecialchars($row['address']);
        $date     = htmlspecialchars($row['date']);
?>

                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <img src="img/electrisol-img/customer.png" alt="profile" width="100px">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <div class="media-body">
                                        <h4 class="card-title">Customer Name: <?= $fullname ?></h4>
                                        <h4 class="card-title">Customer Email: <?= $email ?></h4>
                                        <h4 class="card-title">Customer Phone Number: <?= $phone ?></h4>
                                        <h4 class="card-title">Customer Address: <?= $address ?></h4>
                                        <p class="card-title">Date Registered: <?= $date ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

<?php
    else:
        echo "<div class='alert alert-warning'>Customer not found.</div>";
    endif;

} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Database error occurred.</div>";
}
?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</div>     
<!-- content-wrapper ends -->

<?php include "includes/admin_footer.php"; ?>      