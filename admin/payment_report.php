<?php include "includes/admin_header.php"; ?>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<?php include "includes/top_nav.php"; ?>   
<!-- partial -->

<div class="container-fluid page-body-wrapper">

<?php include "includes/sidenav.php"; ?>      

<div class="main-panel">
<div class="content-wrapper">

<?php include "includes/welcome.php"; ?> 
<hr>

<!-- ================= REPORT FILTER ================= -->
<div class="row">
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<p class="card-title mb-0">PAYMENT REPORT</p>
<hr>

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

if (isset($_GET['submit'])) {

    $from = $_GET['from'] ?? '';
    $to   = $_GET['to'] ?? '';

    if (!empty($from) && !empty($to)) {

        // ===============================
        // PAGINATION SETTINGS
        // ===============================
        $perpage = 20;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max($page, 1);
        $offset = ($page - 1) * $perpage;

        // ===============================
        // TOTAL COUNT (FAST)
        // ===============================
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM payment 
            WHERE payment_date BETWEEN :from AND :to
        ");
        $stmt->execute([
            'from' => $from,
            'to' => $to
        ]);
        $total_invoice = $stmt->fetchColumn();
        $total = ceil($total_invoice / $perpage);

        // ===============================
        // TOTAL SUM (FAST)
        // ===============================
        $stmt = $pdo->prepare("
            SELECT COALESCE(SUM(amount),0) 
            FROM payment 
            WHERE payment_date BETWEEN :from AND :to
        ");
        $stmt->execute([
            'from' => $from,
            'to' => $to
        ]);
        $sum = $stmt->fetchColumn();

        echo "<b>Total Amount:</b> &#8358;" . number_format($sum, 2) . "<br><br>";

        // ===============================
        // FETCH PAGINATED DATA (FAST)
        // ===============================
        $stmt = $pdo->prepare("
            SELECT customer_name, customer_email, phone_number,
                   amount, reference, status, payment_date
            FROM payment
            WHERE payment_date BETWEEN :from AND :to
            ORDER BY payment_date DESC
            LIMIT :offset, :perpage
        ");

        $stmt->bindValue(':from', $from);
        $stmt->bindValue(':to', $to);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':perpage', $perpage, PDO::PARAM_INT);

        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $number_of_rows = count($rows);

        echo "<b>Number of Payment(s): {$number_of_rows} Results</b><br><br>";
        echo "<b>Report of Payments from {$from} to {$to}</b><br><br>";

        echo "<table class='css-serial table table-hover table-bordered table-striped table-responsive'>";

        echo "<tr>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Phone Number</th>
                <th>Amount</th>
                <th>Reference No</th>
                <th>Status</th>
                <th>Payment Date</th>
              </tr>";

        foreach ($rows as $row) {

            echo "<tr>
                    <td>{$row['customer_name']}</td>
                    <td>{$row['customer_email']}</td>
                    <td>{$row['phone_number']}</td>
                    <td>&#8358;" . number_format($row['amount'], 2) . "</td>
                    <td>{$row['reference']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['payment_date']}</td>
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

<!-- ================= PAGINATION ================= -->
<div class="row">
<div class="col-md-10">
<nav aria-label="Page navigation">
<h6>Page Number(s):</h6>

<ul class="pagination">

<?php if (!empty($total)) { ?>

<?php for ($i = 1; $i <= $total; $i++) { ?>

<li>
<a href="payment_report?page=<?= $i ?>&from=<?= $from ?>&to=<?= $to ?>&submit=1">
<button type="button" class="btn btn-outline-dark btn-icon">
<?= $i ?>
</button>
</a>
</li>

<?php } ?>

<?php } ?>

</ul>

</nav>
</div>
</div>

<style>
.pagination li .active-link {
    background: #000 !important;
}
</style>

</div>
</div>
</div>

<?php include "includes/admin_footer.php"; ?>