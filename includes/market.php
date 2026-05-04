<div class="container my-4">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <!-- Section Heading -->
      <div class="element-heading text-center mb-3">
        <h5 class="fw-bold text-dark">🛒 Our Market Place</h5>
        <p class="text-muted small">Browse the latest products added to our marketplace</p>
      </div>
      <hr>

      <!-- Products Grid -->
      <div class="row g-3">
        <?php 
          $query = "SELECT * FROM product ORDER BY added_on DESC LIMIT 10";
          $select_product_query = mysqli_query($connection, $query);
          if(!$select_product_query){
            die('QUERY FAILED' . mysqli_error($connection));
          }

          while($row = mysqli_fetch_array($select_product_query)){
            $product_id = escape($row['product_id']);
            $product_name = escape($row['product_name']);
            $price = escape($row['price']);                
            $image_one = escape($row['image_one']);                                
        ?>
        <!-- Single Product Card -->
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card single-product-card border-0 shadow-sm h-100">
            <!-- Product Image -->
            <a href="shop-details?id=<?php echo $product_id ?>" class="product-thumbnail">
              <div class="ratio ratio-1x1">
                <img src="admin/images/products/<?php echo $image_one ?>" 
                     class="card-img-top rounded-top" 
                     alt="<?php echo $product_name ?>">
              </div>
            </a>
            <!-- Product Details -->
            <div class="card-body text-center p-3">
              <a class="product-title fw-semibold text-dark d-block text-truncate mb-1"
                 href="shop-details?id=<?php echo $product_id ?>">
                 <?php echo $product_name ?>
              </a>
              <p class="sale-price text-warning fw-bold mb-0">
                &#8358;<?php echo number_format($price,0) ?>
              </p>
              <a href="shop-details?id=<?php echo $product_id ?>" 
                 class="btn btn-sm btn-warning w-100 mt-2">
                 View Details <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<!-- Custom CSS for Marketplace -->
<style>
  .single-product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
  }

  .single-product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  }

  .product-thumbnail img {
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .single-product-card:hover .product-thumbnail img {
    transform: scale(1.05);
  }

  .btn-warning {
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
  }
</style>
