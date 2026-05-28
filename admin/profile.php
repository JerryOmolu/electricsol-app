<?php include "includes/admin_header.php"; ?>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<?php include "includes/top_nav.php"; ?>   
<!-- partial -->

<div class="container-fluid page-body-wrapper">

<?php include "includes/sidenav.php"; ?>      

<div class="main-panel">
<div class="content-wrapper">

<?php include "includes/welcome.php"; ?>   

<!-- Main Content -->
<div class="row">
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<p class="card-title">MY PROFILE</p>
<hr>

<div class="row">

<?php
// ===============================
// SESSION DATA (FAST)
// ===============================
$fullname = $_SESSION['fullname'] ?? '';

// ===============================
// SINGLE FAST QUERY (PDO)
// ===============================
$stmt = $pdo->prepare("
    SELECT user_id, fullname, username, email, phone,
           gender, role, added_on, added_by,
           verify_token, verify_status
    FROM user
    WHERE fullname = :fullname
    LIMIT 1
");

$stmt->execute([
    'fullname' => $fullname
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
?>

<div class="media">
<table class="table table-hover table-bordered table-striped table-responsive">
<tbody>

<tr>
<td><b>Name:</b></td>
<td><?php echo $user['fullname']; ?></td>
</tr>

<tr>
<td><b>Username:</b></td>
<td><?php echo $user['username']; ?></td>
</tr>

<tr>
<td><b>Email Address:</b></td>
<td><?php echo $user['email']; ?></td>
</tr>

<tr>
<td><b>Phone Number:</b></td>
<td><?php echo $user['phone']; ?></td>
</tr>

<tr>
<td><b>Gender:</b></td>
<td><?php echo $user['gender']; ?></td>
</tr>

<tr>
<td><b>Role:</b></td>
<td><?php echo $user['role']; ?></td>
</tr>

<tr>
<td><b>Added On:</b></td>
<td><?php echo $user['added_on']; ?></td>
</tr>

</tbody>
</table>
</div>

<?php } ?>

</div>

</div>
</div>
</div>

</div>
</div>

<?php include "includes/admin_footer.php"; ?>