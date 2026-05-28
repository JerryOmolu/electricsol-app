<?php include "includes/admin_header.php"; ?>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<?php include "includes/top_nav.php"; ?>   
<!-- partial -->
<div class="container-fluid page-body-wrapper">

<!-- partial:partials/_sidebar.html -->
<?php include "includes/sidenav.php"; ?>      

<div class="main-panel">
<div class="content-wrapper">

<?php include "includes/welcome.php"; ?>   

<div class="row">
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<p class="card-title">PUBLIC REQUESTS TO DISCOS</p><hr>

<div class="row">
<div class="col-lg-12 stretch-card">
<div class="card">
<div class="card-body">

<?php
/* =========================
   PDO BULK ACTION (OPTIMIZED)
========================= */
if (!empty($_POST['checkBoxArray']) && !empty($_POST['bulk_options'])) {

    $bulk_options = $_POST['bulk_options'];
    $ids = $_POST['checkBoxArray'];

    if (is_array($ids) && count($ids) > 0) {

        try {

            $pdo->beginTransaction();

            if ($bulk_options === 'Delete') {

                $stmt = $pdo->prepare("DELETE FROM disco WHERE disco_id = ?");

                foreach ($ids as $id) {
                    $stmt->execute([(int)$id]);
                }

            } elseif ($bulk_options === 'Handled' || $bulk_options === 'Unhandled') {

                $stmt = $pdo->prepare("UPDATE disco SET status = ? WHERE disco_id = ?");

                foreach ($ids as $id) {
                    $stmt->execute([$bulk_options, (int)$id]);
                }
            }

            $pdo->commit();

        } catch (Exception $e) {
            $pdo->rollBack();
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
        <option value="Handled">Change to Handled</option>
        <option value="Unhandled">Change to Unhandled</option>
        <option value="Delete">Delete Request</option>
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
<th>Name</th>
<th>Phone Number</th>
<th>Disco</th>
<th>Date</th>
<th>Status</th>
<th>Detail</th>
</tr>
</thead>

<tbody>

<?php
/* =========================
   PAGINATION (PDO OPTIMIZED)
========================= */

$perpage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);
$page_1 = ($page - 1) * $perpage;

/* COUNT TOTAL */
$total_stmt = $pdo->query("SELECT COUNT(*) FROM disco");
$total_rows = $total_stmt->fetchColumn();
$total = ceil($total_rows / $perpage);

$Previous = max($page - 1, 1);
$Next = min($page + 1, $total);

/* FETCH DATA (FAST LIMIT QUERY) */
$stmt = $pdo->prepare("SELECT disco_id, name, phone, disco, date, status 
                       FROM disco 
                       ORDER BY date DESC 
                       LIMIT :start, :perpage");

$stmt->bindValue(':start', $page_1, PDO::PARAM_INT);
$stmt->bindValue(':perpage', $perpage, PDO::PARAM_INT);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $disco_id = (int)$row['disco_id'];
    $name = htmlspecialchars($row['name']);
    $phone = htmlspecialchars($row['phone']);
    $disco = htmlspecialchars($row['disco']);
    $date = htmlspecialchars($row['date']);
    $status = htmlspecialchars($row['status']);

    echo "<tr>";
?>
    <td>
        <input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $disco_id; ?>">
    </td>

    <?php
    echo "<td>{$name}</td>";
    echo "<td>{$phone}</td>";
    echo "<td>{$disco}</td>";
    echo "<td>{$date}</td>";

    if ($status === 'Handled') {
        echo "<td style='color:green'><b>{$status}</b></td>";
    } else {
        echo "<td style='color:red'><b>{$status}</b></td>";
    }

    echo "<td>
            <a href='view_disco_detail?id={$disco_id}'>
                <button type='button' class='btn btn-warning btn-rounded btn-icon'>
                    <i class='ti-eye'></i>
                </button>
            </a>
          </td>";

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

<!-- PAGINATION -->
<div class="row">
<div class="col-md-10">
<nav aria-label="Page navigation">
<ul class="pagination">

<li>
<a href="discos?page=<?= $Previous; ?>">
<span>
<button class="btn btn-md btn-primary">
<i class="fa fa-arrow-left"></i> Previous
</button>
</span>
</a>
</li>

<?php
for ($i = 1; $i <= $total; $i++) {
    echo "<li>
            <a href='discos?page={$i}'>
                <button type='button' class='btn btn-outline-primary btn-icon'>{$i}</button>
            </a>
          </li>";
}
?>

<li>
<a href="discos?page=<?= $Next; ?>">
<span>
<button class="btn btn-md btn-primary">
Next <i class="fa fa-arrow-right"></i>
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
    background: #000 !important;
}
</style>

</div>
</div>

<?php include "includes/admin_footer.php"; ?>