<?php include "includes/admin_header.php"; ?>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<?php include "includes/top_nav.php"; ?>   
<!-- partial -->
<div class="container-fluid page-body-wrapper">
  

<!-- partial:partials/_sidebar.html -->
<?php include "includes/sidenav.php"; ?>      

<!-- partial -->
<div class="main-panel">
<div class="content-wrapper">
 <?php include "includes/welcome.php"; ?>   

<!-- Main Content Wrapper-->
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title">ALL ARTISANS</p><hr>

        <div class="row">   
          <div class="col-lg-12 stretch-card">
            <div class="card">
              <div class="card-body">

                <div class="table-responsive pt-3">
                  <table class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr class="table-info">
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Added On</th>
                        <th>View Details</th>
                      </tr>
                    </thead>

                    <tbody>
<?php

// -------------------- PAGINATION SETUP --------------------
$perpage = 20;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$page_1 = ($page - 1) * $perpage;

// -------------------- TOTAL ROWS (OPTIMIZED) --------------------
$stmtCount = $pdo->query("SELECT COUNT(*) FROM artisan");
$total_rows = (int)$stmtCount->fetchColumn();

$total = ceil($total_rows / $perpage);

$Previous = max($page - 1, 1);
$Next = min($page + 1, $total);

// -------------------- MAIN DATA QUERY (FAST + SAFE) --------------------
$sql = "SELECT artisan_id, name, gender, phone, email, added_on 
        FROM artisan 
        ORDER BY added_on DESC 
        LIMIT :offset, :perpage";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':offset', $page_1, PDO::PARAM_INT);
$stmt->bindValue(':perpage', $perpage, PDO::PARAM_INT);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $artisan_id = htmlspecialchars($row['artisan_id']);
    $name = htmlspecialchars($row['name']);
    $gender = htmlspecialchars($row['gender']);
    $phone = htmlspecialchars($row['phone']);
    $email = htmlspecialchars($row['email']);
    $added_on = htmlspecialchars($row['added_on']);

    echo "
    <tr>
        <td>{$name}</td>
        <td>{$gender}</td>
        <td>{$phone}</td>
        <td>{$email}</td>
        <td>{$added_on}</td>
        <td>
            <a href='view_artisan_detail?id=$artisan_id'>
                <button type='button' class='btn btn-outline-primary btn-rounded btn-icon'>
                    <i class='ti-eye'></i>
                </button>
            </a>

            &nbsp;

            <a href='delete_artisan?id=$artisan_id'>
                <button type='button' class='btn btn-danger btn-rounded btn-icon'>
                    <i class='ti-trash'></i>
                </button>
            </a>
        </td>
    </tr>
    ";
}
?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Pagination -->
<div class="row">
  <div class="col-md-10">
    <nav aria-label="Page navigation">
      <ul class="pagination">

        <li>
          <a href="view_artisans?page=<?= $Previous; ?>">
            <span>
              <button class="btn btn-md btn-primary">
                <i class="fa fa-arrow-left"></i>&nbsp;Previous
              </button>
            </span>
          </a>
        </li>

        <?php for ($i = 1; $i <= $total; $i++): ?>
          <li>
            <a href="view_artisans?page=<?= $i; ?>">
              <button type="button"
                class="btn btn-outline-primary btn-icon <?= ($i == $page) ? 'active-link' : '' ?>">
                <?= $i; ?>
              </button>
            </a>
          </li>
        <?php endfor; ?>

        <li>
          <a href="view_artisans?page=<?= $Next; ?>">
            <span>
              <button class="btn btn-md btn-primary">
                Next&nbsp;<i class="fa fa-arrow-right"></i>
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
    color: #fff !important;
}
</style>

</div>

<?php include "includes/admin_footer.php"; ?>