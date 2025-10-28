<?php
$cart_stock = "SELECT product_number, quantity FROM cart WHERE customer_name = '$fullname' AND payment_status = 'Pending'";
$cart_stock_query = mysqli_query($connection, $cart_stock);

while ($row = mysqli_fetch_array($cart_stock_query)) {
    $cart_product_number = $row['product_number'];
    $cart_quantity = $row['quantity'];
    
    // Fetch the stock level for the current product
    $product_stock = "SELECT * FROM product WHERE product_number = $cart_product_number";
    $product_stock_query = mysqli_query($connection, $product_stock);
    
    if (mysqli_num_rows($product_stock_query) > 0) {
        $product_row = mysqli_fetch_array($product_stock_query);
        $product_stock_level = $product_row['stock_level'];
        
        // Calculate the new stock level
        $new_stock_level = $product_stock_level - $cart_quantity;
        
        // Update the stock level for the current product
        $update_quantity = "UPDATE product SET stock_level = $new_stock_level WHERE product_number = $cart_product_number";
        mysqli_query($connection, $update_quantity);
    }
}

// After updating all product stock levels, update the cart payment status
$update_cart = "UPDATE cart SET payment_status = 'Paid' WHERE customer_name = '$fullname' AND payment_status = 'Pending'";
mysqli_query($connection, $update_cart);

if($payment_query){
    header("Location: payment-confirm?status=success&ref='$reference'");
    exit;
}else{
    header("Location: error.html");
    exit;
}

?>
