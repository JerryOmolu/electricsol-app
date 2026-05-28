<?php include "includes/admin_header.php"; ?>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<?php include "includes/top_nav.php"; ?>   
<!-- partial -->
<div class="container-fluid page-body-wrapper">
      
<!-- partial -->
<!-- partial:partials/_sidebar.html -->
<?php include "includes/sidenav.php"; ?>      

<!-- partial -->
<div class="main-panel">
<div class="content-wrapper">

<!--Welcome-->
<?php include "includes/welcome.php"; ?> 
<hr>

<!--Order-->
<div class="row">
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<p class="card-title mb-0">Customer Orders</p><br>

<div class="table-responsive">
<table class="table table-hover table-bordered table-striped">

<thead class="table-info">
<tr>
<th>Customer Name</th>
<th>Product</th>
<th>Image</th>
<th>Price</th>
<th>QTY</th>
<th>Amount</th>
<th>Date</th>
<th>Order No</th>
<th>Status</th>
</tr>  
</thead>

<tbody>

<?php
/* =========================
   PAGINATION SETUP (PDO)
========================= */

$perpage = 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);
$page_1 = ($page - 1) * $perpage;

/* =========================
   TOTAL COUNT (OPTIMIZED)
========================= */
$stmtCount = $pdo->query("SELECT COUNT(order_id) AS total FROM cart");
$totalRows = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
$total = ceil($totalRows / $perpage);

$Previous = max($page - 1, 1);
$Next = min($page + 1, $total);

/* =========================
   FETCH PAGINATED DATA
========================= */
$stmt = $pdo->prepare("
    SELECT 
        order_id,
        customer_name,
        product_name,
        product_number,
        image_one,
        price,
        stock_level,
        quantity,
        amount,
        order_number,
        payment_status,
        date_ordered
    FROM cart
    ORDER BY order_id DESC
    LIMIT :offset, :perpage
");

$stmt->bindValue(':offset', $page_1, PDO::PARAM_INT);
$stmt->bindValue(':perpage', $perpage, PDO::PARAM_INT);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $customer_name  = escape($row['customer_name']);
    $product_name   = escape($row['product_name']);
    $image_one      = escape($row['image_one']);
    $price          = escape($row['price']);
    $quantity       = escape($row['quantity']);
    $amount         = escape($row['amount']);
    $order_number   = escape($row['order_number']);
    $payment_status = escape($row['payment_status']);
    $date_ordered   = escape($row['date_ordered']);
?>

<tr>
    <td><?php echo $customer_name ?></td>
    <td><?php echo $product_name ?></td>
    <td><img src="images/products/<?php echo $image_one ?>"></td>
    <td>&#8358;<?php echo number_format($price,2) ?></td>
    <td><?php echo $quantity ?></td>
    <td class='font-weight-bold'>&#8358;<?php echo number_format($amount,2) ?></td>
    <td><?php echo $date_ordered ?></td>
    <td><?php echo $order_number ?></td>
    <td>
        <?php 
        if($payment_status == 'Paid'){
            echo "<div class='badge badge-success'>Paid</div>";
        }else{
            echo "<div class='badge badge-warning'>Pending</div>";  
        }
        ?>
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

<!-- Pagination -->
<div class="row">
<div class="col-md-10">
<nav aria-label="Page navigation">

<ul class="pagination">

<li>
<a href="view_orders?page=<?= $Previous; ?>">
<span>
<button class="btn btn-md btn-primary">
<i class="fa fa-arrow-left"></i>&nbsp;Previous
</button>
</span>
</a>
</li>

<?php for($i=1; $i<=$total; $i++): ?>

<li>
<a href="view_orders?page=<?= $i; ?>">
<button type="button" class="btn btn-outline-primary btn-icon">
<?= $i; ?>
</button>
</a>
</li>

<?php endfor; ?>

<li>
<a href="view_orders?page=<?= $Next; ?>">
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

<!-- content-wrapper ends -->
<?php include "includes/admin_footer.php"; ?> 