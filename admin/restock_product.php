<?php 
include "includes/admin_header.php";
require_once "includes/db.php"; // must expose $pdo

if(!is_admin($_SESSION['username'])){
    header('Location:home');
    exit;
}
?>

<script>
function increment() {
    let value = parseInt(document.getElementById('quantity').value);
    document.getElementById('quantity').value = value + 1;
}

function decrement() {
    let value = parseInt(document.getElementById('quantity').value);
    if (value > 1) {
        document.getElementById('quantity').value = value - 1;
    }
}
</script>

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

<p class="card-title">Restock Product</p>

<div class="row">
<div class="col-md-8 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<form class="forms-sample" action="" method="get">

<div class="form-group">
<label>Product Number</label>
<input type="text" class="form-control" name="number"
value="<?php echo isset($_GET['number']) ? htmlspecialchars($_GET['number']) : ''; ?>" readonly>
</div>

<div class="form-group">
<label>Product Name</label>
<input type="text" class="form-control" name="name"
value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>" readonly>
</div>

<div class="form-group">
<label>Current Stock Level</label>
<input type="number" class="form-control" name="stock"
value="<?php echo isset($_GET['stock']) ? htmlspecialchars($_GET['stock']) : ''; ?>" readonly>
</div>

<div class="form-group">
<label>Quantity to Add</label>
</div>

<div class="input-group form-group">
<button class="btn btn-outline-dark form-control" type="button" onclick="decrement()">-</button>

<input class="input-group-text form-control"
type="number" id="quantity" min="1" value="1" name="quantity" readonly>

<button class="btn btn-outline-dark form-control" type="button" onclick="increment()">+</button>
</div>

<button type="submit" class="btn btn-primary mr-2" name="submit">
Restock Product
</button>

</form>

<br><br>

<?php
if(isset($_GET['submit'])){

    $number = trim($_GET['number'] ?? '');
    $quantity = (int) ($_GET['quantity'] ?? 0);

    if($number !== '' && $quantity > 0){

        try {
            $pdo->beginTransaction();

            // 1. Fetch product (single lightweight query)
            $stmt = $pdo->prepare("
                SELECT product_name, product_number, stock_level 
                FROM product 
                WHERE product_number = :num 
                LIMIT 1
            ");
            $stmt->execute([':num' => $number]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$product){
                $pdo->rollBack();
                echo "<div class='alert alert-danger'><b>Product not found.</b></div>";
            } else {

                $product_name = $product['product_name'];

                // 2. Fast atomic update (no second SELECT needed)
                $update = $pdo->prepare("
                    UPDATE product 
                    SET stock_level = stock_level + :qty 
                    WHERE product_number = :num 
                    LIMIT 1
                ");

                $update->execute([
                    ':qty' => $quantity,
                    ':num' => $number
                ]);

                $pdo->commit();

                $new_stock_balance = $product['stock_level'] + $quantity;

                echo "<div class='alert alert-success'>
                <b>Stock Level for {$product_name} ({$number}) has been restocked with {$quantity} units successfully. 
                New stock balance is {$new_stock_balance} units.</b></div>";
            }

        } catch(Exception $e){
            $pdo->rollBack();
            echo "<div class='alert alert-danger'><b>Error processing request.</b></div>";
        }
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

</div>
</div>

<?php include "includes/admin_footer.php"; ?>