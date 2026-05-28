<?php include "includes/admin_header.php"; ?>
<?php require_once "includes/db.php"; // MUST expose $pdo ?>

<div class="container-scroller">

<?php include "includes/top_nav.php"; ?>   

<div class="container-fluid page-body-wrapper">

<?php include "includes/sidenav.php"; ?>      

<div class="main-panel">
<div class="content-wrapper">

<?php include "includes/welcome.php"; ?> 
<hr>

<div class="row">
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<p class="card-title mb-0">SALES REPORT (SUCCESSFUL TRANSACTIONS)</p><hr>

<div class="row">
<div class="card">
<div class="card-body">

<form class="form-inline" method="get" action="">
<label>From:&nbsp;&nbsp;</label>
<input type="date" class="form-control mb-2 mr-sm-2" name="from" required>

<label>To:&nbsp;&nbsp;</label>
<input type="date" class="form-control mb-2 mr-sm-2" name="to" required>

<button type="submit" class="btn btn-dark mb-2" name="submit">
Display Report
</button>
</form>

</div>
</div>
</div>

<?php

if(isset($_GET['submit'])){

    $from = $_GET['from'] ?? '';
    $to = $_GET['to'] ?? '';

    if(!empty($from) && !empty($to)){

        /* =========================
           PAGINATION SETUP
        ========================= */
        $perpage = 20;
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $page_1 = ($page - 1) * $perpage;

        /* =========================
           COUNT QUERY (FAST INDEXED)
        ========================= */
        $countStmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM cart 
            WHERE payment_status = 'Paid'
            AND date_ordered BETWEEN :from AND :to
        ");

        $countStmt->execute([
            ':from' => $from,
            ':to' => $to
        ]);

        $total_invoice = (int)$countStmt->fetchColumn();
        $total = ceil($total_invoice / $perpage);

        /* =========================
           SUM QUERY (FAST AGGREGATION)
        ========================= */
        $sumStmt = $pdo->prepare("
            SELECT SUM(amount) 
            FROM cart 
            WHERE payment_status = 'Paid'
            AND date_ordered BETWEEN :from AND :to
        ");

        $sumStmt->execute([
            ':from' => $from,
            ':to' => $to
        ]);

        $sum = $sumStmt->fetchColumn() ?? 0;

        echo "<b>Total Amount: </b>&#8358;" . number_format($sum, 2);
        echo "<br><br>";

        /* =========================
           INFO OUTPUT
        ========================= */
        echo "<b>Number of Sales: {$total_invoice} Results</b><br><br>";
        echo "<b>Report of Successful Sales Made from {$from} to {$to}</b><br><br>";

        /* =========================
           DATA QUERY (OPTIMIZED)
        ========================= */
        $stmt = $pdo->prepare("
            SELECT customer_name, product_name, product_number, price, quantity, amount, order_number, payment_status, date_ordered
            FROM cart
            WHERE payment_status = 'Paid'
            AND date_ordered BETWEEN :from AND :to
            ORDER BY date_ordered DESC
            LIMIT :limit OFFSET :offset
        ");

        $stmt->bindValue(':from', $from);
        $stmt->bindValue(':to', $to);
        $stmt->bindValue(':limit', $perpage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $page_1, PDO::PARAM_INT);
        $stmt->execute();

        echo "<table class='css-serial table table-hover table-bordered table-striped table-responsive'>";

        echo "<tr>
            <th>Customer Name</th>
            <th>Product Name</th>
            <th>Product Number</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Order Number</th>
            <th>Status</th>
            <th>Date</th>
        </tr>";

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            echo "<tr>
                <td>{$row['customer_name']}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['product_number']}</td>
                <td>&#8358;" . number_format($row['price'], 2) . "</td>
                <td>{$row['quantity']}</td>
                <td>&#8358;" . number_format($row['amount'], 2) . "</td>
                <td>{$row['order_number']}</td>
                <td>{$row['payment_status']}</td>
                <td>{$row['date_ordered']}</td>
            </tr>";
        }

        echo "</table>";
    }
}
?>

</div>
</div>
</div>
</div>

<!-- PAGINATION -->
<div class="row">
<div class="col-md-10">
<nav>
<h6>Page Number(s):</h6>
<ul class="pagination">

<?php
if(isset($total, $from, $to)){

    for($i = 1; $i <= $total; $i++){

        $active = ($i == $page) ? "btn-primary" : "btn-outline-dark";

        echo "<li>
            <a href='sales_report_success?page={$i}&from={$from}&to={$to}&submit=1'>
                <button type='button' class='btn {$active} btn-icon'>{$i}</button>
            </a>
        </li>";
    }
}
?>

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