<?php include "includes/admin_header.php"; ?>
<?php require_once "includes/db.php"; // MUST expose $pdo ?>

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

<p class="card-title">ALL REVIEWS</p><hr>

<div class="row">   
<div class="col-lg-12 stretch-card">
<div class="card">
<div class="card-body">

<?php
/* =========================
   BULK ACTION (PDO OPTIMIZED)
   ========================= */
if(isset($_POST['checkBoxArray'], $_POST['bulk_options'])){

    $action = $_POST['bulk_options'];
    $ids = $_POST['checkBoxArray'];

    if(!empty($ids)){

        // Convert IDs to integers for safety
        $ids = array_map('intval', $ids);
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        if($action === 'Approved' || $action === 'Unapproved'){

            $status = $action;

            $stmt = $pdo->prepare("
                UPDATE review 
                SET review_status = ? 
                WHERE review_id IN ($placeholders)
            ");

            $stmt->execute(array_merge([$status], $ids));

        } elseif($action === 'Delete'){

            $stmt = $pdo->prepare("
                DELETE FROM review 
                WHERE review_id IN ($placeholders)
            ");

            $stmt->execute($ids);
        }
    }
}
?>

<form action="" method="post">

<table class="table table-hover table-bordered table-striped table-responsive">

<div class="row">
<div id="bulkOptionContainer" class="col-md-6">
    <select class="form-control" name="bulk_options">
        <option value="">--Select An Action--</option>
        <option value="Approved">Approve Review(s)</option>
        <option value="Unapproved">Unapprove Review(s)</option>
        <option value="Delete">Delete Review(s)</option>
    </select>
</div>

<div class="col-md-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
</div>
</div>

<br>

<thead class="table-info">
<tr>
    <th><input id="selectAllBoxes" type="checkbox"></th>
    <th>Review Author</th>
    <th>Review Content</th>
    <th>Review Date</th>
    <th>Star Rating</th>
    <th>Review Status</th>
</tr>
</thead>

<tbody>

<?php
/* =========================
   PAGINATION OPTIMIZED
   ========================= */

$perpage = 10;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$page_1 = ($page - 1) * $perpage;

/* COUNT QUERY (fast) */
$countStmt = $pdo->query("SELECT COUNT(*) FROM review");
$totalRows = (int)$countStmt->fetchColumn();
$total = ceil($totalRows / $perpage);

/* DATA QUERY (indexed pagination) */
$stmt = $pdo->prepare("
    SELECT review_id, review_author, review_content, review_rating, review_date, review_status
    FROM review
    ORDER BY review_date DESC
    LIMIT :limit OFFSET :offset
");

$stmt->bindValue(':limit', $perpage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $page_1, PDO::PARAM_INT);
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $review_id = htmlspecialchars($row['review_id']);
    $review_author = htmlspecialchars($row['review_author']);
    $review_content = htmlspecialchars($row['review_content']);
    $review_rating = htmlspecialchars($row['review_rating']);
    $review_date = htmlspecialchars($row['review_date']);
    $review_status = htmlspecialchars($row['review_status']);

    echo "<tr>";
    echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='{$review_id}'></td>";
    echo "<td>{$review_author}</td>";
    echo "<td>{$review_content}</td>";
    echo "<td>{$review_date}</td>";
    echo "<td>{$review_rating}</td>";
    echo "<td>{$review_status}</td>";
    echo "</tr>";
}
?>

</tbody>
</table>

</form>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- =========================
     PAGINATION
========================= -->
<div class="row">
<div class="col-md-10">
<nav aria-label="Page navigation">
<ul class="pagination">

<li>
<a href="reviews?page=<?= max(1, $page - 1); ?>">
<button class="btn btn-md btn-primary">
<i class="fa fa-arrow-left"></i> Previous
</button>
</a>
</li>

<?php for($i=1; $i<=$total; $i++): ?>
<li>
<a href="reviews?page=<?= $i; ?>">
<button type="button"
class="btn <?= ($i == $page) ? 'btn-primary' : 'btn-outline-primary'; ?> btn-icon">
<?= $i; ?>
</button>
</a>
</li>
<?php endfor; ?>

<li>
<a href="reviews?page=<?= min($total, $page + 1); ?>">
<button class="btn btn-md btn-primary">
Next <i class="fa fa-arrow-right"></i>
</button>
</a>
</li>

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