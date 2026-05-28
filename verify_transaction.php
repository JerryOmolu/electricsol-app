<?php ob_start(); ?>
<?php session_start(); ?>

<?php include "includes/db.php"; // MUST now expose $pdo ?>
<?php include "includes/functions.php"; ?>

<?php

$ref = $_GET['reference'] ?? '';

if (empty($ref)) {
    header("Location:javascript://history.go(-1)");
    exit;
}

/* =========================
   PAYSTACK VERIFICATION
========================= */

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer sk_test_82fa2974b322b8a10e552bdccaf5dab2bb1de05b",
        "Cache-Control: no-cache",
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    error_log("cURL Error: " . $err);
    header("Location: error.html");
    exit;
}

$result = json_decode($response, true);

if (!isset($result['data']['status']) || $result['data']['status'] !== 'success') {
    header("Location: error.html");
    exit;
}

/* =========================
   DATA EXTRACTION
========================= */

$status    = $result['data']['status'];
$reference = $result['data']['reference'];
$amount    = $result['data']['amount'];
$cus_email = $result['data']['customer']['email'];

date_default_timezone_set('Africa/Lagos');

$fullname = $_SESSION['fullname'] ?? null;
$email    = $_SESSION['email'] ?? null;
$phone    = $_SESSION['phone'] ?? null;

if (!$fullname || !$email || !$phone) {
    header("Location: error.html");
    exit;
}

try {

    $pdo->beginTransaction();

    /* =========================
       1. INSERT PAYMENT (FAST PDO)
    ========================= */

    $stmt = $pdo->prepare("
        INSERT INTO payment 
        (customer_name, customer_email, phone_number, amount, reference, status)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $payment_query = $stmt->execute([
        $fullname,
        $email,
        $phone,
        $amount,
        $reference,
        $status
    ]);

    /* =========================
       2. FETCH CART ITEMS (1 QUERY ONLY)
    ========================= */

    $stmt = $pdo->prepare("
        SELECT product_number, quantity 
        FROM cart 
        WHERE customer_name = ? 
        AND payment_status = 'Pending'
    ");
    $stmt->execute([$fullname]);
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /* =========================
       3. PREPARED STATEMENTS (REUSED)
    ========================= */

    $productStmt = $pdo->prepare("
        SELECT stock_level 
        FROM product 
        WHERE product_number = ?
        LIMIT 1
    ");

    $updateProductStmt = $pdo->prepare("
        UPDATE product 
        SET stock_level = ? 
        WHERE product_number = ?
    ");

    /* =========================
       4. STOCK UPDATE LOOP (OPTIMIZED)
    ========================= */

    foreach ($cart_items as $item) {

        $product_number = (int)$item['product_number'];
        $quantity       = (int)$item['quantity'];

        $productStmt->execute([$product_number]);
        $product = $productStmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $new_stock = (int)$product['stock_level'] - $quantity;

            if ($new_stock < 0) {
                $new_stock = 0; // prevent negative stock
            }

            $updateProductStmt->execute([$new_stock, $product_number]);
        }
    }

    /* =========================
       5. MARK CART AS PAID (1 QUERY)
    ========================= */

    $stmt = $pdo->prepare("
        UPDATE cart 
        SET payment_status = 'Paid' 
        WHERE customer_name = ? 
        AND payment_status = 'Pending'
    ");
    $stmt->execute([$fullname]);

    /* =========================
       6. COMMIT TRANSACTION
    ========================= */

    $pdo->commit();

    if ($payment_query) {
        header("Location: payment-confirm?status=success&ref=" . urlencode($reference));
        exit;
    } else {
        header("Location: error.html");
        exit;
    }

} catch (Exception $e) {
    $pdo->rollBack();
    error_log("Payment Processing Error: " . $e->getMessage());
    header("Location: error.html");
    exit;
}
?>