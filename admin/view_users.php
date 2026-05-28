<?php include "includes/admin_header.php"; ?>

<?php 
if(!is_admin($_SESSION['username'])){
    header('Location:home.php');
    exit;
}
?>

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

<!-- Main Content -->
<div class="row">
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<p class="card-title">ALL USERS</p><hr>

<a href="add_user">
<button class="btn btn-outline-success">
<i class="fa fa-plus"></i> Add New User
</button>
</a>

<div class="row">   
<div class="col-lg-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<div class="table-responsive pt-3">

<table class="table table-hover table-bordered table-striped">

<thead class="table-info">
<tr>
<th>Full Name</th>
<th>Username</th>
<th>Email</th>
<th>Phone Number</th>
<th>Gender</th>
<th>Role</th>
<th>Added On</th>
<th>Added By</th>
<th>Verification Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php
/* =========================
   PAGINATION SETUP
========================= */

$perpage = 20;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);

$page_1 = ($page - 1) * $perpage;

/* =========================
   TOTAL USERS COUNT (FAST)
========================= */

$stmtCount = $pdo->query("SELECT COUNT(user_id) AS total FROM user");
$totalRows = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
$total = ceil($totalRows / $perpage);

$Previous = max($page - 1, 1);
$Next = min($page + 1, $total);

/* =========================
   FETCH USERS (OPTIMIZED)
========================= */

$stmt = $pdo->prepare("
    SELECT 
        user_id,
        fullname,
        username,
        email,
        phone,
        gender,
        role,
        added_on,
        added_by,
        verify_status
    FROM user
    ORDER BY added_on DESC
    LIMIT :offset, :perpage
");

$stmt->bindValue(':offset', $page_1, PDO::PARAM_INT);
$stmt->bindValue(':perpage', $perpage, PDO::PARAM_INT);
$stmt->execute();

/* =========================
   OUTPUT LOOP
========================= */

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $user_id       = escape($row['user_id']);
    $fullname      = escape($row['fullname']);
    $username      = escape($row['username']);
    $email         = escape($row['email']);
    $phone         = escape($row['phone']);
    $gender        = escape($row['gender']);
    $role          = escape($row['role']);
    $added_on      = escape($row['added_on']);
    $added_by      = escape($row['added_by']);
    $verify_status = $row['verify_status'];
?>

<tr>
    <td><?php echo $fullname; ?></td>
    <td><?php echo $username; ?></td>
    <td><?php echo $email; ?></td>
    <td><?php echo $phone; ?></td>
    <td><?php echo $gender; ?></td>
    <td><?php echo $role; ?></td>
    <td><?php echo $added_on; ?></td>
    <td><?php echo $added_by; ?></td>

    <td>
        <?php if($verify_status == '0'): ?>
            <button class="btn btn-danger">Unverified</button>
        <?php else: ?>
            <button class="btn btn-success">Verified</button>
        <?php endif; ?>
    </td>

    <td>
        <a href="edit_user?source=edit_user&edit_user=<?php echo $user_id; ?>">
            <button type="button" class="btn btn-warning btn-rounded btn-icon">
                <i class="ti-pencil-alt"></i>
            </button>
        </a>

        &nbsp;

        <a href="delete_user?id=<?php echo $user_id; ?>">
            <button type="button" class="btn btn-danger btn-rounded btn-icon">
                <i class="ti-trash"></i>
            </button>
        </a>
    </td>
</tr>

<?php } ?>

</tbody>
</table>

</div>
</div>
</div>
</div>
</div>

</div>

<!-- Pagination -->
<div class="row">
<div class="col-md-10">
<nav aria-label="Page navigation">

<ul class="pagination">

<li>
<a href="view_users?page=<?= $Previous; ?>">
<span>
<button class="btn btn-md btn-primary">
<i class="fa fa-arrow-left"></i>&nbsp;Previous
</button>
</span>
</a>
</li>

<?php for($i=1; $i<=$total; $i++): ?>

<li>
<a href="view_users?page=<?= $i; ?>">
<button type="button" class="btn btn-outline-primary btn-icon">
<?= $i; ?>
</button>
</a>
</li>

<?php endfor; ?>

<li>
<a href="view_users?page=<?= $Next; ?>">
<span>
<button class="btn btn-md btn-primary">
Next&nbsp;<i class="fa fa-arrow-right"></i>
</button>
</span>
</a>
</li>

</ul>

</nav>
</div>
</div>

<style>
.pagination li .active-link{
    background: #000 !important
}
</style>

</div>

</div>
</div>
</div>

<?php include "includes/admin_footer.php"; ?>