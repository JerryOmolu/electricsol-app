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

<p class="card-title">Edit Product</p>

<div class="row">
<div class="col-6 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<?php 

$product_id = $product_name = $product_details = $product_number = "";
$category = $price = $keywords = "";
$image_one = $image_two = $image_three = "";
$stock_level = $added_on = $added_by = "";

/* =========================
   FETCH PRODUCT (PDO OPTIMIZED)
========================= */
if(isset($_GET['edit_product'])){

    $the_product_id = (int) $_GET['edit_product'];

    $stmt = $pdo->prepare("SELECT * FROM product WHERE product_id = :id LIMIT 1");
    $stmt->bindParam(':id', $the_product_id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row){

        $product_id      = htmlspecialchars($row['product_id']);
        $product_name    = htmlspecialchars($row['product_name']);
        $product_details = htmlspecialchars($row['product_details']);
        $product_number  = htmlspecialchars($row['product_number']);
        $category        = htmlspecialchars($row['category']);
        $price           = htmlspecialchars($row['price']);
        $keywords        = htmlspecialchars($row['keywords']);
        $image_one       = htmlspecialchars($row['image_one']);
        $image_two       = htmlspecialchars($row['image_two']);
        $image_three     = htmlspecialchars($row['image_three']);
        $stock_level     = htmlspecialchars($row['stock_level']);
        $added_on        = htmlspecialchars($row['added_on']);
        $added_by        = htmlspecialchars($row['added_by']);
    }
}

/* =========================
   UPDATE PRODUCT (PDO OPTIMIZED)
========================= */
if(isset($_POST['edit_product'])){

    $name     = $_POST['name'];
    $detail   = $_POST['detail'];
    $number   = $_POST['number'];
    $price    = $_POST['price'];
    $keywords = $_POST['keywords'];
    $category = $_POST['category'];

    $update = $pdo->prepare("
        UPDATE product 
        SET product_name = :name,
            product_details = :detail,
            product_number = :number,
            category = :category,
            price = :price,
            keywords = :keywords
        WHERE product_id = :id
    ");

    $update->bindParam(':name', $name);
    $update->bindParam(':detail', $detail);
    $update->bindParam(':number', $number);
    $update->bindParam(':category', $category);
    $update->bindParam(':price', $price);
    $update->bindParam(':keywords', $keywords);
    $update->bindParam(':id', $the_product_id, PDO::PARAM_INT);

    if($update->execute()){
        echo "<div class='alert alert-success'>
                Product Edited Successfully: &nbsp;&nbsp;&nbsp;
                <a href='view_products.php'>
                    <button class='btn btn-primary'>View Products</button>
                </a>
              </div>";
    } else {
        echo "<div class='alert alert-danger'>Update failed. Please try again.</div>";
    }
}

?>

<!-- FORM (UNCHANGED UI) -->

<form class="forms-sample" action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>Product Name</label>
        <input type="text" class="form-control" name="name" autocomplete="off"
               value="<?php echo $product_name; ?>">
    </div>

    <div class="form-group">
        <label>Product Detail</label>
        <textarea class="form-control" name="detail" id="summernote" cols="30" rows="10" required><?php echo $product_details; ?></textarea>
    </div>

    <div class="form-group">
        <label>Product Number</label>
        <input type="text" class="form-control" name="number" maxlength="50"
               value="<?php echo $product_number; ?>" readonly>
    </div>

    <div class="form-group">
        <label>Price</label>
        <input type="text" class="form-control" name="price"
               value="<?php echo $price; ?>">
    </div>

    <div class="form-group">
        <label>Keywords</label>
        <input type="text" class="form-control" name="keywords"
               value="<?php echo $keywords; ?>">
    </div>

    <div class="form-group">
        <label>Category</label>
        <select class="form-control" name="category" required>
            <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
            <option value="Lighting">Lighting</option>
            <option value="Power and Wiring Accessories">Power and Wiring Accessories</option>
            <option value="Home Appliances">Home Appliances</option>
            <option value="Consumer Electronics">Consumer Electronics</option>
            <option value="Electrical Tools & Instruments">Electrical Tools and Instruments</option>
            <option value="Renewable Energy Products">Renewable Energy Products</option>
            <option value="Batteries & Power Storage">Batteries and Power Storage</option>
            <option value="Heating & Cooling Products">Heating and Cooling Products</option>
            <option value="Kitchen Appliances">Kitchen Appliances</option>
            <option value="Safety & Security">Safety and Security</option>
            <option value="Audio-Visual Equipment">Audio-Visual Equipment</option>
            <option value="Industrial & Commercial Electrical Products">Industrial and Commercial Electrical Products</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary col-6 mr-2" name="edit_product">
        <i class="fa fa-pencil-square-o"></i> Update Product Info
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