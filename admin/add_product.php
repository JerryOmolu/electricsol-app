<?php include "includes/admin_header.php"; ?>
<script>
        function increment() {
            let value = parseInt(document.getElementById('quantity').value);
            document.getElementById('quantity').value = value + 1;
        }

        function decrement() {
            let value = parseInt(document.getElementById('quantity').value);
            if (value > 0) {
                document.getElementById('quantity').value = value - 1;
            }
        }
</script>
<?php 
if(!is_admin($_SESSION['username'])){
    header('Location:home');
}

?>

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

<!--    Main Content Wrapper-->
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Add New Product</p><hr>
                  <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
<!--Add Product Code-->
<?php 
if (isset($_POST['add_product'])) {
    $name = escape($_POST['name']);
    $detail = escape($_POST['detail']);
    $number = escape($_POST['number']);
    $category = escape($_POST['category']);
    $price = escape($_POST['price']);
    $keywords = escape($_POST['keywords']);
    $stock = escape($_POST['stock']);
    
    // Define maximum and minimum dimensions
    $minWidth = 800; // Minimum width in pixels
    $minHeight = 800; // Minimum height in pixels
    $maxWidth = 800; // Maximum width in pixels
    $maxHeight = 800; // Maximum height in pixels
    
    // Allowed file types
    $allowedFileTypes = ['image/jpeg', 'image/png'];
    
    // Function to check image dimensions
    function checkImageDimensions($tempFile) {
        list($width, $height) = getimagesize($tempFile);
        return [$width, $height];
    }
    
    $errors = array();
    $images = [];

    // Check dimensions and file type for each image
    foreach (['image_one', 'image_two', 'image_three'] as $imageKey) {
        $imageTemp = $_FILES[$imageKey]['tmp_name'];
        $imageType = $_FILES[$imageKey]['type'];
        $imageName = $_FILES[$imageKey]['name'];

        // Check if file exists and is of an allowed type
        if (file_exists($imageTemp)) {
            // Validate file type
            if (!in_array($imageType, $allowedFileTypes)) {
                $errors[$imageKey] = ucfirst($imageKey) . " must be a JPEG or PNG file.";
                continue; // Skip further checks for this image
            }

            // Check dimensions
            list($width, $height) = checkImageDimensions($imageTemp);
            if ($width < $minWidth || $height < $minHeight) {
                $errors[$imageKey] = ucfirst($imageKey) . " must be at least {$minWidth}px wide and {$minHeight}px tall.";
            } elseif ($width > $maxWidth || $height > $maxHeight) {
                $errors[$imageKey] = ucfirst($imageKey) . " must not exceed {$maxWidth}px wide and {$maxHeight}px tall.";
            } else {
                // Store image names if the dimensions and type are valid
                $images[$imageKey] = escape($imageName);
            }
        }
    }

    // Check for product number uniqueness
    $n = "SELECT product_number FROM product WHERE product_number = '$number' LIMIT 1";
    $nn = mysqli_query($connection, $n);
    if (empty($number)) {
        $errors['n'] = "Product Number Cannot be Empty, Please Enter Product Number";
    } elseif (mysqli_num_rows($nn) > 0) {
        $errors['n'] = "Product Number already exists for another Product";
    }
    
    if (isset($_SESSION['fullname'])) {
        $fullname = escape($_SESSION['fullname']);
    }

    // Only proceed if there are no errors
    if (count($errors) == 0 && !empty($name) && !empty($detail) && !empty($number) && !empty($category) && !empty($price) && !empty($keywords) && !empty($stock)) {
        // Move images if there are no errors
        foreach ($images as $imageKey => $imageName) {
            $imageTemp = $_FILES[$imageKey]['tmp_name'];
            move_uploaded_file($imageTemp, "images/products/$imageName");
        }

        $query = "INSERT INTO product(product_name, product_details, product_number, category, price, keywords, image_one, image_two, image_three, stock_level, added_by) VALUES ('{$name}', '{$detail}', '{$number}', '{$category}', '{$price}', '{$keywords}', '{$images['image_one']}', '{$images['image_two']}', '{$images['image_three']}', '{$stock}', '{$fullname}')";
        
        $create_post_query = mysqli_query($connection, $query);
        
        if (!$create_post_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        }
        echo "<div class='alert alert-success'><b>Product Added Successfully &nbsp;&nbsp;&nbsp;<a href='view_products'><button class='btn btn-primary'>View Products</button></a></b></div>";
    } else {
        // Display the errors
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}
?>

<!--End of Add Product Code-->
                    

                  <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1" class="font-weight-bold">Product Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Product Name" name="name" maxlength="50" autocomplete="off" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUserName1" class="font-weight-bold">Product Detail</label>
                      <textarea class="form-control" name="detail" id="summernote" cols="30" rows="10" placeholder="Enter Product Detail" value="<?php echo isset($_POST['detail']) ? $_POST['detail'] : '' ?>" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" class="font-weight-bold">Product Number</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Product Number" name="number" value="<?php echo isset($_POST['number']) ? $_POST['number'] : '' ?>" required>
                    <b><p class="text-danger"><?php if(isset($errors['n']))echo $errors['n']; ?></p></b>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPhone" class="font-weight-bold">Category</label>
                      <select class="form-control" name="category" required>
                        <option value="">-Select Category-</option>
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
                    <div class="form-group">
                      <label for="exampleSelectGender" class="font-weight-bold">Product Price</label>
                        <input type="text" class="form-control" id="exampleInputPassword4" placeholder="Product Price" name="price" value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ?>" required>
                      </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4" class="font-weight-bold">Keywords</label>
                      <input type="text" class="form-control" id="exampleInputPassword4" placeholder="Keywords" name="keywords" value="<?php echo isset($_POST['keywords']) ? $_POST['keywords'] : '' ?>" required>
                    </div>
                    <hr>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                    <h4>See picture preview here</h4>
                    <img id="output" width="300"/>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label for="exampleInputPassword4" class="font-weight-bold">Picture One</label>
                      <input type="file" class="form-control" name="image_one" onchange="loadFile(event)" accept="image/*" required>
                    <p class="text-secondary">** Picture dimension must be 800 X 800 pixels **</p>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4" class="font-weight-bold">Picture Two</label>
                      <input type="file" class="form-control" name="image_two" onchange="loadFile(event)" accept="image/*" required>
                    <p class="text-secondary">** Picture dimension must be 800 X 800 pixels **</p>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4" class="font-weight-bold">Picture Three</label>
                      <input type="file" class="form-control" name="image_three" onchange="loadFile(event)" accept="image/*" required>
                    <p class="text-secondary">** Picture dimension must be 800 X 800 pixels **</p>
                    </div>
                    
                    <label for="exampleInputCity1" class="font-weight-bold"><p>Stock Level</p></label>
                    <div class='input-group form-group'>
                    <button class="btn btn-outline-primary form-control" type="button" onclick="decrement()">-</button>
                    <input class='input-group-text form-control' type='number' id="quantity" min="1" value="1" name="stock" readonly>
                    <button class="btn btn-outline-primary form-control" type="button" onclick="increment()">+</button>
                    </div> 
                      
                    <button type="submit" class="btn btn-primary col-6 mr-2" name="add_product"><i class="fa fa-floppy-o" aria-hidden="true"></i> Add Product</button>
                  </form>
                </div>
              </div>
            </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
        </div>     
    

<!--Summernote-->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
    
<script>
      $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>
    
    
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include "includes/admin_footer.php"; ?>      
