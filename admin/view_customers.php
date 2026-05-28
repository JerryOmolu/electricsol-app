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
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<p class="card-title">ALL CUSTOMERS</p><hr>

<div class="row">   
<div class="col-lg-12 stretch-card">
<div class="card">
<div class="card-body">

<div class="table-responsive pt-3">
<table class="table table-hover table-bordered table-striped">

<thead>
<tr class="table-info">
    <th>Full Name</th>
    <th>Email Address</th>
    <th>Phone Number</th>
    <th>Added On</th>
    <th>Verification Status</th>
    <th>View Detail</th>
</tr>
</thead>

<tbody>

<?php
// =========================
// PAGINATION LOGIC (FAST)
// =========================
$perpage = 20;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max($page, 1);

$page_1 = ($page - 1) * $perpage;

try {

    // COUNT QUERY (optimized)
    $stmtCount = $pdo->prepare("SELECT COUNT(id) FROM register");
    $stmtCount->execute();
    $totalRows = $stmtCount->fetchColumn();

    $total = ceil($totalRows / $perpage);

    $Previous = max($page - 1, 1);
    $Next = min($page + 1, $total);

    // MAIN DATA QUERY (FAST + LIMIT)
    $stmt = $pdo->prepare("
        SELECT id, fullname, email, phone, verify_status, date
        FROM register
        ORDER BY date DESC
        LIMIT :limit OFFSET :offset
    ");

    $stmt->bindValue(':limit', (int)$perpage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$page_1, PDO::PARAM_INT);

    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $id      = (int) $row['id'];
        $name    = htmlspecialchars($row['fullname']);
        $email   = htmlspecialchars($row['email']);
        $phone   = htmlspecialchars($row['phone']);
        $date    = htmlspecialchars($row['date']);
        $status  = $row['verify_status'];
        ?>

        <tr>
            <td><?= $name ?></td>
            <td><?= $email ?></td>
            <td><?= $phone ?></td>
            <td><?= $date ?></td>

            <?php if ($status == '0'): ?>
                <td><button class="btn btn-danger">Unverified</button></td>
            <?php else: ?>
                <td><button class="btn btn-success">Verified</button></td>
            <?php endif; ?>

            <td>
                <a href="view_customer_detail?id=<?= $id ?>">
                    <button type="button" class="btn btn-outline-primary btn-rounded btn-icon">
                        <i class="ti-eye"></i>
                    </button>
                </a>

                &nbsp;

                <a href="delete_customer?id=<?= $id ?>">
                    <button type="button" class="btn btn-danger btn-rounded btn-icon">
                        <i class="ti-trash"></i>
                    </button>
                </a>
            </td>
        </tr>

<?php
    }

} catch (PDOException $e) {
    echo "<tr><td colspan='6'>Error loading data</td></tr>";
}
?>

</tbody>
</table>
</div>

</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

<!-- PAGINATION -->
<div class="row">
<div class="col-md-10">
<nav aria-label="Page navigation">
<ul class="pagination">

<li>
<a href="view_customers?page=<?= $Previous; ?>">
<span aria-hidden="true">
<button class="btn btn-md btn-primary">
<i class="fa fa-arrow-left"></i>&nbsp;Previous
</button>
</span>
</a>
</li>

<?php for ($i = 1; $i <= $total; $i++): ?>
<li>
<a href="view_customers?page=<?= $i; ?>">
<button type="button"
class="btn <?= ($i == $page) ? 'btn-primary' : 'btn-outline-primary'; ?> btn-icon">
<?= $i; ?>
</button>
</a>
</li>
<?php endfor; ?>

<li>
<a href="view_customers?page=<?= $Next; ?>">
<span aria-hidden="true">
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
    background: #000 !important;
}
</style>

</div>

<?php include "includes/admin_footer.php"; ?>