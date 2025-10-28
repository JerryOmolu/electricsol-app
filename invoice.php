<?php include "includes/home_header.php"; ?>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <!-- Internet Connection Status -->
  <div class="internet-connection-status" id="internetStatus"></div>

  <!-- Dark mode switching -->
  <div class="dark-mode-switching">
    <div class="d-flex w-100 h-100 align-items-center justify-content-center">
      <div class="dark-mode-text text-center">
        <i class="bi bi-moon"></i>
        <p class="mb-0">Switching to dark mode</p>
      </div>
      <div class="light-mode-text text-center">
        <i class="bi bi-brightness-high"></i>
        <p class="mb-0">Switching to light mode</p>
      </div>
    </div>
  </div>

  <!-- RTL mode switching -->
  <div class="rtl-mode-switching">
    <div class="d-flex w-100 h-100 align-items-center justify-content-center">
      <div class="rtl-mode-text text-center">
        <i class="bi bi-text-right"></i>
        <p class="mb-0">Switching to RTL mode</p>
      </div>
      <div class="ltr-mode-text text-center">
        <i class="bi bi-text-left"></i>
        <p class="mb-0">Switching to default mode</p>
      </div>
    </div>
  </div>

 

  <!-- Header Area -->
  <div class="header-area" id="headerArea">
    <div class="container">
      <!-- Header Content -->
      <div class="header-content position-relative d-flex align-items-center justify-content-between">
        <!-- Back Button -->
        <div class="back-button">
          <a href="shop.php">
            <i class="bi bi-arrow-left-short"></i>
          </a>
        </div>

        <!-- Page Title -->
        <div class="page-heading">
          <h6 class="mb-0">Invoice</h6>
        </div>

        <!-- Settings -->
        <div class="setting-wrapper">
          <div class="setting-trigger-btn" id="settingTriggerBtn">
            <i class="bi bi-gear"></i>
            <span></span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="page-content-wrapper py-3">
    <div class="container">
      <div class="card invoice-card shadow">
        <div class="card-body">
<!--
           Download Invoice 
          <div class="download-invoice text-end mb-3">
            <a class="btn btn-sm btn-primary me-2" href="sample.php">
              <i class="bi bi-file-earmark-pdf"></i> PDF
            </a>
            <a class="btn btn-sm btn-light" href="#">
              <i class="bi bi-printer"></i> Print
            </a>
          </div>
-->

          <!-- Invoice Info -->
          <div class="invoice-info text-end mb-4">
            <h5 class="mb-1 fz-14"><img src="img/electrisol-img/Logo%206.png" width="100px"></h5><p><em>Innovating Energy for Africa...</em></p><hr><br>
            <h5 class="mb-1 fz-14">Customer Name: 
               <?php if(isset($_SESSION['fullname'])){
                $fullname = escape($_SESSION['fullname']);
                } 
                echo $fullname;
                ?>
              </h5>  
            <h6 class="fz-12">Invoice No. 
                <?php 
                $receipt_number = rand(1000000, 9999999); echo '#'.$receipt_number;
                ?>
                </h6>
            <p class="mb-0 fz-12"><b>Date:</b> <?php echo date("l, F j, Y"); ?></p>
          </div>

          <!-- Invoice Table -->
          <div class="invoice-table">
            <div class="table-responsive">    
              <table class="table table-bordered caption-top">
                <caption>Product List</caption>
                <thead class="table-light">
                  <tr>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Q.</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
    <?php 
        if(isset($_SESSION['fullname'])){
                $fullname = escape($_SESSION['fullname']);
                } 
        
        $total = 0;
        $query = "SELECT * FROM cart WHERE customer_name = '$fullname' && payment_status = 'Pending'";
        $select_product_query = mysqli_query($connection, $query);
        if(!$select_product_query){
        die('QUERY FAILED' . mysqli_error($connection));
        }

        while($row = mysqli_fetch_array($select_product_query)){
        $order_id = escape($row['order_id']);
        $customer_name = escape($row['customer_name']);
        $product_name = escape($row['product_name']);
        $product_number = escape($row['product_number']);
        $image_one = escape($row['image_one']);
        $price = escape($row['price']);                
        $quantity = escape($row['quantity']);                 
        $amount = escape($row['amount']);                 
        $order_number = escape($row['order_number']);                 
        $payment_status = escape($row['payment_status']);                 
        $date_ordered = escape($row['date_ordered']);                 
                
?>                            
     
                  <tr>
                    <td><?php echo $product_name ?></td>
                    <td>&#8358;<?php echo $price ?></td>
                    <td><?php echo $quantity ?></td>
                    <td>&#8358;<?php echo number_format($amount,2) ?></td>
                  </tr>
<?php 
        $total = $total + $amount;
        } ?>
                </tbody>
                <tfoot class="table-light">

                  <tr>
                    <td class="text-end" colspan="3">Total:</td>
                    <td class="text-end">&#8358;<?php echo number_format($total, 2);  ?></td>
                  </tr>
                  <tr>
                    <td class="text-end" colspan="3">VAT (7.5%):</td>
                    <td class="text-end">Included in the Total</td>
                  </tr>
                  <tr>
                    <td class="text-end" colspan="3">Grand Total:</td>
                    <td class="text-end">&#8358;<?php echo number_format($total, 2);  ?></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <p class="mb-0">Notice: This is auto generated invoice.</p>
        </div>
      </div>
    </div>
  </div>

  <?php include "includes/home_footer_nav.php"; ?>