<?php include "includes/admin_header.php"; ?>

<?php
// ==============================
// PDO DASHBOARD QUERIES (FAST)
// ==============================

// ADMIN COUNT
$stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE role = 'Admin'");
$stmt->execute();
$number_of_admin = $stmt->fetchColumn();

// OPERATOR COUNT
$stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE role = 'Operator'");
$stmt->execute();
$number_of_manager = $stmt->fetchColumn();

// CUSTOMER COUNT
$stmt = $pdo->prepare("SELECT COUNT(*) FROM register WHERE verify_status = '1'");
$stmt->execute();
$number_of_customer = $stmt->fetchColumn();

// ARTISAN COUNT
$stmt = $pdo->prepare("SELECT COUNT(*) FROM artisan");
$stmt->execute();
$number_of_artisan = $stmt->fetchColumn();

// PRODUCT COUNT
$stmt = $pdo->prepare("SELECT COUNT(*) FROM product");
$stmt->execute();
$number_of_product = $stmt->fetchColumn();

// SUCCESSFUL TRANSACTIONS
$stmt = $pdo->prepare("SELECT COUNT(*) FROM cart WHERE payment_status = 'Paid'");
$stmt->execute();
$number_of_success = $stmt->fetchColumn();

// PENDING TRANSACTIONS
$stmt = $pdo->prepare("SELECT COUNT(*) FROM cart WHERE payment_status = 'Pending'");
$stmt->execute();
$number_of_pending = $stmt->fetchColumn();

// SUCCESSFUL PAYMENTS
$stmt = $pdo->prepare("SELECT COUNT(*) FROM payment WHERE status = 'success'");
$stmt->execute();
$number_of_success_payment = $stmt->fetchColumn();

?>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<?php include "includes/top_nav.php"; ?>   
<!-- partial -->

<div class="container-fluid page-body-wrapper">

<!-- partial -->
<?php include "includes/sidenav.php"; ?>      

<!-- main panel -->
<div class="main-panel">
<div class="content-wrapper">

<?php include "includes/welcome.php"; ?> 
<hr>

<!-- ================= USER METRICS ================= -->
<h4>User Statistics</h4>

<div class="row">

<div class="col-md-3 mb-4 stretch-card transparent">
  <div class="card card-tale">
    <div class="card-body">
      <h5 class="mb-4">Admins</h5>
      <p class="fs-30 mb-2"><?php echo $number_of_admin; ?></p>
      <h2><i class="fa fa-male"></i></h2>
    </div>
  </div>
</div>

<div class="col-md-3 mb-4 stretch-card transparent">
  <div class="card card-dark-blue">
    <div class="card-body">
      <h5 class="mb-4">Operators</h5>
      <p class="fs-30 mb-2"><?php echo $number_of_manager; ?></p>
      <h2><i class="fa fa-user-o"></i></h2>
    </div>
  </div>
</div>

<div class="col-md-3 mb-4 stretch-card transparent">
  <div class="card card-light-blue">
    <div class="card-body">
      <h5 class="mb-4">Customers</h5>
      <p class="fs-30 mb-2"><?php echo $number_of_customer; ?></p>
      <h2><i class="fa fa-users"></i></h2>
    </div>
  </div>
</div>

<div class="col-md-3 mb-4 stretch-card transparent">
  <div class="card card-light-danger">
    <div class="card-body">
      <h5 class="mb-4">Artisans</h5>
      <p class="fs-30 mb-2"><?php echo $number_of_artisan; ?></p>
      <h2><i class="fa fa-user-circle-o"></i></h2>
    </div>
  </div>
</div>

</div>

<!-- ================= PRODUCT METRICS ================= -->
<h4>Product Statistics</h4>

<div class="row">

<div class="col-md-3 mb-4 stretch-card transparent">
  <div class="card card-tale">
    <div class="card-body">
      <h5 class="mb-4">Products</h5>
      <p class="fs-30 mb-2"><?php echo $number_of_product; ?></p>
      <h2><i class="fa fa-shopping-cart"></i></h2>
    </div>
  </div>
</div>

<div class="col-md-3 mb-4 stretch-card transparent">
  <div class="card card-dark-blue">
    <div class="card-body">
      <h5 class="mb-4">Successful Transactions</h5>
      <p class="fs-30 mb-2"><?php echo $number_of_success; ?></p>
      <h2><i class="fa fa-credit-card"></i></h2>
    </div>
  </div>
</div>

<div class="col-md-3 mb-4 stretch-card transparent">
  <div class="card card-light-blue">
    <div class="card-body">
      <h5 class="mb-4">Pending Transactions</h5>
      <p class="fs-30 mb-2"><?php echo $number_of_pending; ?></p>
      <h2><i class="fa fa-credit-card"></i></h2>
    </div>
  </div>
</div>

<div class="col-md-3 mb-4 stretch-card transparent">
  <div class="card card-light-danger">
    <div class="card-body">
      <h5 class="mb-4">Successful Payments</h5>
      <p class="fs-30 mb-2"><?php echo $number_of_success_payment; ?></p>
      <h2><i class="fa fa-cc-mastercard"></i></h2>
    </div>
  </div>
</div>

</div>

<hr>

<!-- ================= SALES TABLE ================= -->
<h4>Sales Metrics</h4>

<div class="row">
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<p class="card-title mb-0">Sales Overview</p><br>

<div class="table-responsive">
<table class="table table-hover table-bordered table-striped">

<thead>
<tr>
  <th>Customer Name</th>
  <th>Product</th>
  <th>Price</th>
  <th>QTY</th>
  <th>Amount</th>
  <th>Date</th>
  <th>Status</th>
</tr>
</thead>

<tbody>

<?php
$stmt = $pdo->prepare("
    SELECT order_id, customer_name, product_name, product_number,
           image_one, price, stock_level, quantity,
           amount, order_number, payment_status, date_ordered
    FROM cart
    ORDER BY order_id DESC
    LIMIT 10
");
$stmt->execute();
$view_cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($view_cart as $row) {

    $order_id = escape($row['order_id']);
    $customer_name = escape($row['customer_name']);
    $product_name = escape($row['product_name']);
    $price = escape($row['price']);
    $quantity = escape($row['quantity']);
    $amount = escape($row['amount']);
    $date_ordered = escape($row['date_ordered']);
    $payment_status = escape($row['payment_status']);
?>

<tr>
  <td><?php echo $customer_name; ?></td>
  <td><?php echo $product_name; ?></td>
  <td>&#8358;<?php echo number_format($price, 2); ?></td>
  <td><?php echo $quantity; ?></td>
  <td class="font-weight-bold">&#8358;<?php echo number_format($amount, 2); ?></td>
  <td><?php echo $date_ordered; ?></td>
  <td>
    <?php if($payment_status == 'Paid'){ ?>
        <div class="badge badge-success">Paid</div>
    <?php } else { ?>
        <div class="badge badge-warning">Pending</div>
    <?php } ?>
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
</div>

<?php include "includes/admin_footer.php"; ?>