<?php include "includes/admin_header.php"; ?>
<?php require_once "includes/db.php"; // MUST expose $pdo ?>

<div class="container-scroller">

<?php include "includes/top_nav.php"; ?>   

<div class="container-fluid page-body-wrapper">

<?php include "includes/sidenav.php"; ?>      

<div class="main-panel">
<div class="content-wrapper">

<?php include "includes/welcome.php"; ?>   

<div class="row">
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<p class="card-title">ARTISAN'S DETAIL</p><hr>

<div class="row">
<div class="col-md-8 grid-margin stretch-card">

<?php

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = (int) $_GET['id'];

    /* =========================
       FAST SINGLE QUERY FETCH
    ========================= */
    $stmt = $pdo->prepare("
        SELECT *
        FROM artisan
        WHERE artisan_id = :id
        LIMIT 1
    ");

    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row){

        $name = htmlspecialchars($row['name']);
        $gender = htmlspecialchars($row['gender']);
        $date_of_birth = htmlspecialchars($row['date_of_birth']);
        $email = htmlspecialchars($row['email']);
        $phone = htmlspecialchars($row['phone']);
        $state = htmlspecialchars($row['state']);
        $lga = htmlspecialchars($row['lga']);
        $address = htmlspecialchars($row['address']);
        $skills = $row['skills'];
        $certificate = $row['certificate'];
        $years = htmlspecialchars($row['years']);

?>

<div class="card">
<div class="card-body">

<div class="media">
<img src="img/electrisol-img/artisan.png" alt="profile" width="200px"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<div class="media-body">

<h4>Personal Details of <?= $name ?></h4><hr>

<ul>
<li><h5 class="card-text">Artisan Name: <?= $name ?></h5></li><br>
<li><h5 class="card-text">Artisan Email: <?= $email ?></h5></li><br>
<li><h5 class="card-text">Artisan Phone Number: <?= $phone ?></h5></li><br>
<li><h5 class="card-text">State of Origin: <?= $state ?></h5></li><br>
<li><h5 class="card-text">LGA: <?= $lga ?></h5></li><br>
<li><h5 class="card-text">Contact Address: <?= $address ?></h5></li><br>
<li><h5 class="card-text">Date of Birth: <?= $date_of_birth ?></h5></li><br>
</ul>

<hr>
<h4>Skills</h4><hr>

<?php if(!empty($skills)): ?>
<table class="table table-hover table-bordered table-striped table-responsive">
<?php
foreach(explode(',', rtrim($skills, ',')) as $skill){
    echo "<tr>
        <td><i class='fa fa-check-square-o' style='color:green'></i></td>
        <td><h6>".htmlspecialchars($skill)."</h6></td>
    </tr>";
}
?>
</table>
<?php endif; ?>

<hr>
<h4>Certifications</h4><hr>

<?php if(!empty($certificate)): ?>
<table class="table table-hover table-bordered table-striped table-responsive">
<?php
foreach(explode(',', rtrim($certificate, ',')) as $cert){
    echo "<tr>
        <td><i class='fa fa-check-square-o' style='color:green'></i></td>
        <td><h6>".htmlspecialchars($cert)."</h6></td>
    </tr>";
}
?>
</table>
<?php endif; ?>

<hr>
<h4>Years of Experience</h4><hr>

<ul>
<li><h5 class="card-text"><?= $years ?></h5></li>
</ul>

</div>
</div>

</div>
</div>

<?php
    } else {
        echo "<div class='alert alert-danger'>Artisan not found.</div>";
    }
}
?>

</div>
</div>

</div>
</div>

</div>

</div>
</div>

<?php include "includes/admin_footer.php"; ?>