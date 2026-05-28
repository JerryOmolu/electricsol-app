<?php include "includes/admin_header.php"; ?>

<?php 
if(!is_admin($_SESSION['username'])){
    header('Location:home.php');
    exit;
}
?>

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

<p class="card-title">EDIT USER</p><hr>

<div class="row">
<div class="col-6 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<?php 

/* =========================
   DEFAULT VARIABLES
========================= */
$user_id = $fullname = $username = $email = $phone = $gender = "";
$password = $role = $added_on = $added_by = "";

/* =========================
   FETCH USER (PDO FAST MODE)
========================= */
if(isset($_GET['edit_user'])){

    $the_user_id = (int) $_GET['edit_user'];

    $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = :id LIMIT 1");
    $stmt->bindParam(':id', $the_user_id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row){
        $user_id   = htmlspecialchars($row['user_id']);
        $fullname  = htmlspecialchars($row['fullname']);
        $username  = htmlspecialchars($row['username']);
        $email     = htmlspecialchars($row['email']);
        $phone     = htmlspecialchars($row['phone']);
        $gender    = htmlspecialchars($row['gender']);
        $role      = htmlspecialchars($row['role']);
        $added_on  = htmlspecialchars($row['added_on']);
        $added_by  = htmlspecialchars($row['added_by']);
    }
}

/* =========================
   UPDATE USER (PDO OPTIMIZED)
========================= */
if(isset($_POST['edit_user'])){

    $email  = $_POST['email'];
    $phone  = $_POST['phone'];
    $role   = $_POST['role'];

    $password = $_POST['password'] ?? '';

    // Build query dynamically (only hash if password is provided)
    if(!empty($password)){

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

        $stmt = $pdo->prepare("
            UPDATE user 
            SET email = :email,
                phone = :phone,
                role = :role,
                password = :password
            WHERE user_id = :id
        ");

        $stmt->bindParam(':password', $hashedPassword);

    } else {

        $stmt = $pdo->prepare("
            UPDATE user 
            SET email = :email,
                phone = :phone,
                role = :role
            WHERE user_id = :id
        ");
    }

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':id', $the_user_id, PDO::PARAM_INT);

    if($stmt->execute()){
        echo "<div class='alert alert-success'>
                User Edited Successfully:&nbsp;&nbsp;&nbsp;
                <a href='view_users.php'>
                    <button class='btn btn-primary'>View Users</button>
                </a>
              </div>";
    } else {
        echo "<div class='alert alert-danger'>Update failed. Please try again.</div>";
    }
}

?>

<!-- =========================
     UI (UNCHANGED)
========================= -->

<form class="forms-sample" action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control"
               name="name"
               value="<?php echo $fullname; ?>" readonly>
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control"
               name="username"
               value="<?php echo $username; ?>" readonly>
    </div>

    <div class="form-group">
        <label>Email address</label>
        <input type="email" class="form-control"
               name="email"
               value="<?php echo $email; ?>">
    </div>

    <div class="form-group">
        <label>Phone Number</label>
        <input type="text" class="form-control"
               name="phone"
               maxlength="11"
               value="<?php echo $phone; ?>">
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control"
               name="password"
               placeholder="Leave empty to keep current password">
    </div>

    <div class="form-group">
        <label>User Role</label>
        <select class="form-control" name="role" required>
            <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
            <option value="Admin">Admin</option>
            <option value="Manager">Manager</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary col-6 mr-2" name="edit_user">
        <i class="fa fa-pencil-square-o"></i> Update User
    </button>

</form>

</div>
</div>
</div>
</div>

</div>
</div>
</div>

</div>

<?php include "includes/admin_footer.php"; ?>