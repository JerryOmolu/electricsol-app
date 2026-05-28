<?php ob_start(); ?>
<?php include "includes/db.php"; // MUST expose $pdo ?>
<?php session_start(); ?>
<?php include "includes/functions.php"; ?>

<?php
if (!isset($_SESSION['verify_status']) || $_SESSION['verify_status'] !== 1) {
    header("Location:login.php");
    exit();
}

if (isset($_POST['update_quantity'])) {

    $order_id = $_POST['order_id'] ?? '';
    $new_quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    if ($order_id !== '') {

        $stmt = $pdo->prepare("SELECT price FROM cart WHERE order_id = :order_id LIMIT 1");
        $stmt->execute([':order_id' => $order_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $price = (float)$row['price'];
            $new_amount = $price * $new_quantity;

            $update = $pdo->prepare("
                UPDATE cart 
                SET quantity = :qty, amount = :amt 
                WHERE order_id = :order_id
            ");

            $update->execute([
                ':qty' => $new_quantity,
                ':amt' => $new_amount,
                ':order_id' => $order_id
            ]);
        }
    }
}

if (isset($_GET["action"]) && $_GET["action"] === "delete") {

    $product_name = $_GET["name"] ?? '';

    if ($product_name !== '') {
        $del = $pdo->prepare("DELETE FROM cart WHERE product_name = :name");
        $del->execute([':name' => $product_name]);
    }
}

$fullname = $_SESSION['fullname'] ?? '';
$total = 0;

$stmt = $pdo->prepare("
    SELECT order_id, product_name, image_one, price, quantity, amount
    FROM cart
    WHERE customer_name = :name
    AND payment_status = 'Pending'
");

$stmt->execute([':name' => $fullname]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="theme-color" content="#0134d4">

<title>Electricsol-Mobile App</title>

<link rel="icon" href="favicon/favicon.ico">
<link rel="stylesheet" href="font-awesome/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">

<style>

/* =========================
   MODERN UI REFRESH ONLY
   (NO STRUCTURE CHANGES)
========================= */

body{
  background: #f6f8fb;
  font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
}

/* Header */
.header-area{
  border-bottom: 1px solid #eef0f3;
  backdrop-filter: blur(8px);
  background: rgba(255,255,255,0.95) !important;
}

.header-area .page-heading h6{
  font-size: 15px;
  font-weight: 600;
  color: #222;
}

.header-area .back-button a{
  border: none;
  background: #f1f3f7;
  transition: 0.2s;
}

.header-area .back-button a:hover{
  transform: scale(1.05);
  background: #e9ecf3;
}

/* Card */
.cart-wrapper-area .card{
  border-radius: 16px;
  border: none;
  box-shadow: 0 10px 25px rgba(0,0,0,0.05);
  overflow: hidden;
}

/* Table header */
.table-dark{
  background: #0d6efd !important;
}

/* Table */
.table{
  margin-bottom: 0;
}

.table td, .table th{
  vertical-align: middle !important;
  border-color: #f0f2f5 !important;
}

/* Product image */
.table img{
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

/* Product name */
.table h6{
  font-size: 14px;
  margin-bottom: 3px;
  color: #1f2937;
}

.table small{
  font-size: 12px;
  color: #6b7280;
}

/* Quantity buttons */
.btn-outline-secondary{
  border-radius: 8px;
  padding: 2px 8px;
  font-weight: bold;
}

.form-control-sm{
  border-radius: 8px;
  border: 1px solid #e5e7eb;
}

/* Amount */
.text-success{
  font-weight: 600;
  color: #16a34a !important;
}

/* Delete button */
.btn-outline-danger{
  border-radius: 8px;
}

/* Total row */
.table-warning{
  background: #fff7cc !important;
  font-weight: 700;
}

/* Checkout button */
.btn-warning{
  background: linear-gradient(135deg, #ffb703, #fb8500);
  border: none;
  border-radius: 12px;
  padding: 12px;
  font-weight: 700;
  box-shadow: 0 6px 15px rgba(255,183,3,0.25);
  transition: 0.2s;
}

.btn-warning:hover{
  transform: translateY(-2px);
}

/* Mobile polish only */
@media (max-width: 768px){
  .table{
    font-size: 13px;
  }

  .table img{
    width: 50px !important;
    height: 50px !important;
  }
}

</style>
</head>

<body>

<div class="internet-connection-status" id="internetStatus"></div>

<div class="header-area shadow-sm sticky-top bg-white" id="headerArea">
  <div class="container">
    <div class="header-content d-flex align-items-center justify-content-between py-2">

      <div class="back-button">
        <a href="shop" class="btn btn-sm btn-outline-dark rounded-circle shadow-sm">
          <i class="bi bi-arrow-left-short fs-4"></i>
        </a>
      </div>

      <div class="page-heading text-center">
        <h6 class="mb-0 fw-bold d-flex align-items-center gap-2">
          <img src="img/electrisol-img/cart-2.png" width="28" alt="">
          My Cart
        </h6>
      </div>

      <div class="navbar--toggler" id="affanNavbarToggler">
        <span></span><span></span><span></span>
      </div>

    </div>
  </div>
</div>

<?php include "includes/home_side_nav_left.php"; ?>

<div class="page-content-wrapper py-3">
  <div class="container">

    <div class="cart-wrapper-area">
      <div class="card shadow-lg border-0 mb-3">

        <div class="card-header bg-dark text-white">
          <h5 class="mb-0">Your Shopping Cart</h5>
        </div>

        <div class="table-responsive card-body">

          <table class="table table-bordered table-striped text-center">

            <thead class="table-dark">
              <tr>
                <th>Image</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Remove</th>
              </tr>
            </thead>

            <tbody>

              <?php foreach ($cartItems as $row):
                  $order_id = htmlspecialchars($row['order_id']);
                  $product_name = htmlspecialchars($row['product_name']);
                  $image_one = htmlspecialchars($row['image_one']);
                  $price = (float)$row['price'];
                  $quantity = (int)$row['quantity'];
                  $amount = (float)$row['amount'];

                  $total += $amount;
              ?>

              <tr>
                <td>
                  <img src="admin/images/products/<?php echo $image_one; ?>" 
                       class="img-fluid" 
                       style="width:60px;height:60px;object-fit:cover;">
                </td>

                <td>
                  <h6><?php echo $product_name; ?></h6>
                  <small>
                    ₦<?php echo number_format($price,2); ?> × <?php echo $quantity; ?>
                  </small>
                </td>

                <td>
                  <form method="post" class="d-flex justify-content-center align-items-center">
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

                    <button type="submit" name="update_quantity"
                      class="btn btn-sm btn-outline-secondary me-1"
                      onclick="this.form.quantity.value=Math.max(1, parseInt(this.form.quantity.value)-1)">
                      -
                    </button>

                    <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1"
                      class="form-control form-control-sm text-center" style="width:50px;">

                    <button type="submit" name="update_quantity"
                      class="btn btn-sm btn-outline-secondary ms-1"
                      onclick="this.form.quantity.value=parseInt(this.form.quantity.value)+1">
                      +
                    </button>
                  </form>
                </td>

                <td class="text-success">
                  ₦<?php echo number_format($amount,2); ?>
                </td>

                <td>
                  <a class="btn btn-sm btn-outline-danger"
                     href="cart.php?action=delete&name=<?php echo urlencode($product_name); ?>">
                    <i class="bi bi-x-lg"></i>
                  </a>
                </td>
              </tr>

              <?php endforeach; ?>

              <tr class="table-warning">
                <td colspan="2"></td>
                <td>Total</td>
                <td>₦<?php echo number_format($total,2); ?></td>
                <td></td>
              </tr>

            </tbody>
          </table>

          <div class="mt-4">
            <a href="checkout?total=<?php echo $total; ?>&user=<?php echo urlencode($fullname); ?>"
               class="btn btn-warning w-100">
              Proceed to Checkout
            </a>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<?php include "includes/home_footer_nav.php"; ?>

</body>
</html>