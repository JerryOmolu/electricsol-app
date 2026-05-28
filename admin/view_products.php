<?php include "includes/admin_header.php"; ?>

<?php 
if(!is_admin($_SESSION['username'])){
    header('Location:home');
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

<!-- Main Wrapper -->
<div class="row">
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<p class="card-title">View All Products</p>

<div class="row">   
<div class="col-lg-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<div class="table-responsive pt-3">

<table class="table table-hover table-bordered table-striped table-responsive">

<thead class="table-info">
<tr>
<th>Product Name</th>
<th>Product Number</th>
<th>Price</th>
<th>Picture</th>
<th>Stock Level</th>
<th>Added On</th>
<th>Added By</th>
<th>Restock</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php
/* =========================
   PAGINATION SETUP
========================= */

$perpage = 50;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);

$page_1 = ($page - 1) * $perpage;

/* =========================
   TOTAL ROW COUNT (FAST)
========================= */

$stmtCount = $pdo->query("SELECT COUNT(product_id) AS total FROM product");
$totalRows = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
$total = ceil($totalRows / $perpage);

$Previous = max($page - 1, 1);
$Next = min($page + 1, $total);

/* =========================
   FETCH PRODUCTS (OPTIMIZED)
========================= */

$stmt = $pdo->prepare("
    SELECT 
        product_id,
        product_name,
        product_number,
        price,
        image_one,
        stock_level,
        added_on,
        added_by
    FROM product
    ORDER BY product_id DESC
    LIMIT :offset, :perpage
");

$stmt->bindValue(':offset', $page_1, PDO::PARAM_INT);
$stmt->bindValue(':perpage', $perpage, PDO::PARAM_INT);
$stmt->execute();

/* =========================
   OUTPUT LOOP
========================= */

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $product_id    = escape($row['product_id']);
    $product_name  = escape($row['product_name']);
    $product_number= escape($row['product_number']);
    $price         = escape($row['price']);
    $image_one     = escape($row['image_one']);
    $stock_level   = escape($row['stock_level']);
    $added_on      = escape($row['added_on']);
    $added_by      = escape($row['added_by']);
?>

<tr>
    <td><?php echo $product_name; ?></td>
    <td><?php echo $product_number; ?></td>
    <td><?php echo $price; ?></td>

    <td>
        <img width="100" src="images/products/<?php echo $image_one; ?>" alt="image">
    </td>

    <td>
        <?php if($stock_level <= 5): ?>
            <button class="btn btn-danger"><?php echo $stock_level; ?></button>
        <?php else: ?>
            <button class="btn btn-success"><?php echo $stock_level; ?></button>
        <?php endif; ?>
    </td>

    <td><?php echo $added_on; ?></td>
    <td><?php echo $added_by; ?></td>

    <td>
        <a href="restock_product?id=<?php echo $product_id; ?>&number=<?php echo $product_number; ?>&stock=<?php echo $stock_level; ?>&name=<?php echo $product_name; ?>">
            <button type="button" class="btn btn-info btn-rounded btn-icon">
                <i class="ti-plus"></i>
            </button>
        </a>
    </td>

    <td>
        <a href="edit_product?source=edit_product&edit_product=<?php echo $product_id; ?>">
            <button type="button" class="btn btn-warning btn-rounded btn-icon">
                <i class="ti-pencil-alt"></i>
            </button>
        </a>

        &nbsp;

        <a href="delete_product?id=<?php echo $product_id; ?>">
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
<a href="view_products?page=<?= $Previous; ?>">
<span>
<button class="btn btn-md btn-primary">
<i class="fa fa-arrow-left"></i>&nbsp;Previous
</button>
</span>
</a>
</li>

<?php for($i=1; $i<=$total; $i++): ?>

<li>
<a href="view_products?page=<?= $i; ?>">
<button type="button" class="btn btn-outline-primary btn-icon">
<?= $i; ?>
</button>
</a>
</li>

<?php endfor; ?>

<li>
<a href="view_products?page=<?= $Next; ?>">
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