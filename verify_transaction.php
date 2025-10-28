<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "includes/db.php" ?>
<?php include "includes/functions.php" ?>
<?php

$ref = $_GET['reference'];
if($ref == ""){
    header("Location:javascript://history.go(-1)");
}
?>

<?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer sk_test_82fa2974b322b8a10e552bdccaf5dab2bb1de05b",
        "Cache-Control: no-cache",
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    error_log("cURL Error: " . $err);
} else {
    $result = json_decode($response);
}

if ($result->data->status == 'success') {
    $status = $result->data->status;
    $reference = $result->data->reference;
    $amount = $result->data->amount;
    $cus_email = $result->data->customer->email;
    date_default_timezone_set('Africa/Lagos');

    $fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : null;
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
    $phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : null;

    if (!$fullname || !$email || !$phone) {
        header("Location: error.html");
        exit;
    }

    $stmt = $connection->prepare("INSERT INTO payment(customer_name, customer_email, phone_number, amount, reference, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fullname, $email, $phone, $amount, $reference, $status);
    $payment_query = $stmt->execute();

    $cart_stock = "SELECT product_number, quantity FROM cart WHERE customer_name = '$fullname' AND payment_status = 'Pending'";
    $cart_stock_query = mysqli_query($connection, $cart_stock);

    while ($row = mysqli_fetch_array($cart_stock_query)) {
        $cart_product_number = $row['product_number'];
        $cart_quantity = $row['quantity'];

        $product_stock = "SELECT * FROM product WHERE product_number = $cart_product_number";
        $product_stock_query = mysqli_query($connection, $product_stock);

        if (mysqli_num_rows($product_stock_query) > 0) {
            $product_row = mysqli_fetch_array($product_stock_query);
            $product_stock_level = $product_row['stock_level'];
            $new_stock_level = $product_stock_level - $cart_quantity;

            $stmt = $connection->prepare("UPDATE product SET stock_level = ? WHERE product_number = ?");
            $stmt->bind_param("ii", $new_stock_level, $cart_product_number);
            $stmt->execute();
        }
    }

    $update_cart = "UPDATE cart SET payment_status = 'Paid' WHERE customer_name = '$fullname' AND payment_status = 'Pending'";
    mysqli_query($connection, $update_cart);

    if ($payment_query) {
        header("Location: payment-confirm?status=success&ref='$reference'");
        exit;
    } else {
        error_log("Payment query error: " . mysqli_error($connection));
        header("Location: error.html");
        exit;
    }
}
?>
