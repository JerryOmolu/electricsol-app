<?php include "includes/admin_header.php"; ?>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<?php include "includes/top_nav.php"; ?>   
<!-- partial -->
<div class="container-fluid page-body-wrapper">
      
<!-- partial -->
<!-- partial:partials/_sidebar.html -->
<?php include "includes/sidenav.php"; ?>      

<!-- partial -->
<div class="main-panel">
<div class="content-wrapper">
<!--Welcome-->
<?php include "includes/welcome.php"; ?> 
<hr>
          
<!--    Sales-->
    <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">SALES REPORT (PENDING TRANSACTIONS)</p><hr>
        <div class="row">
        <div class="card">
        <div class="card-body">
        <form class="form-inline" method="get" action="">
        <label for="From">From:&nbsp;&nbsp;</label>
        <input type="date" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="from" required>
        <label for="From">To:&nbsp;&nbsp;</label>
        <input type="date" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="to" required>
        <button type="submit" class="btn btn-dark mb-2" name="submit">Display Report</button>
        </form>
        </div>
        </div>
        </div>             
    <?php 
                  
    if(isset($_GET['submit'])){
		$from = escape($_GET['from']);
		$to = escape($_GET['to']);
		
    if(!empty ($from) && !empty ($to)){
		
			$perpage = 20;
			if(isset($_GET['page'])){
				$page = escape($_GET['page']);
			}else{
				$page = "";
			}
			if($page == "" || $page == 1){
				$page_1 = 0;
			}else{
				$page_1 = ($page * $perpage)-$perpage;
			}

      $qry= "SELECT amount FROM cart";
        $amount_query = mysqli_query($connection, $qry);
        $number_of_amount = mysqli_num_rows($amount_query);

			$query1 = "SELECT * FROM cart WHERE payment_status = 'Pending' && date_ordered  BETWEEN '$from' AND '$to'";
			$view_invoice1 = mysqli_query($connection, $query1);
			$total_invoice = mysqli_num_rows($view_invoice1);
			$total = ceil($total_invoice/$perpage);
			$Previous = (int)$page - 1;
			$Next = (int)$page + 1; 
      
        $result = mysqli_query($connection, "SELECT SUM(amount) AS value_sum FROM cart WHERE payment_status = 'Pending' && date_ordered  BETWEEN '$from' AND '$to'"); 
        $row = mysqli_fetch_assoc($result); 
        $sum = $row['value_sum'];
        echo '<b>Total Amount: </b>&#8358;'.number_format($sum,2);
        echo "<br>";
        echo "<br>";
        
        $query = "SELECT * FROM cart WHERE payment_status = 'Pending' && date_ordered BETWEEN '$from' AND '$to' LIMIT $page_1, $perpage";
        $sales_query = mysqli_query($connection, $query);
		$number_of_rows = mysqli_num_rows($sales_query);
        
echo "<b>Number of Pending Sales: {$number_of_rows} Results</b>";
echo "<br>";
echo "<br>";
echo "<b>Report of Pending Sales Made from {$from} to {$to}</b>";
echo "<br>";
echo "<br>";
echo "<table class='css-serial table table-hover table-bordered table-striped table-responsive'>"; 
		
echo "<tr><th>Customer Name</th><th>Product Name</th><th>Product Number</th><th>Price</th><th>Quantity</th><th>Amount</th><th>Order Number</th><th>payment_status</th><th>Date</th></tr>";
		
while($row = mysqli_fetch_array($sales_query)){ 
echo "<tr><td>" . $row['customer_name'] . "</td><td>" . $row['product_name'] . "</td><td>" . $row['product_number'] . "</td><td>" .'&#8358;'. $row['price'] . "</td><td>" . $row['quantity'] . "</td><td>" .'&#8358;'. $row['amount'] . "</td><td>" . $row['order_number'] . "</td><td>" . $row['payment_status'] . "</td><td>" . $row['date_ordered'] . "</td></tr>";  
}

echo "</table>";
	}	
	}
    ?>              
    <tr style='color:grey;'></tr>                
                  
                </div>
              </div>
            </div>
          </div>
<!--    Pagination-->
    <div class="row">
        <div class="col-md-10">
            <nav aria-label="Page navigation">
                <h6>Page Number(s):</h6>
               <ul class="pagination">
<!--
                  <li>
                <a href="sales_report_success.php?page=<?= $Previous; ?>" aria-label="Previous">
                       <span aria-hidden="true"><button class="btn btn-md btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Previous</button></span>   
                      </a>
                  </li>
-->
                <?php
                error_reporting(E_ALL ^ E_WARNING); 
                for($i=1; $i<=$total; $i++){
                if($i == $page){
                echo "<li><a href='sales_report_pending?page={$i}&from={$from}&to={$to}&submit='>&nbsp;&nbsp;<button type='button' class='btn btn-outline-dark btn-icon'>{$i}</button>&nbsp;&nbsp;</a></li>";
                }else{
                echo "<li><a href='sales_report_pending?page={$i}&from={$from}&to={$to}&submit='>&nbsp;&nbsp;<button type='button' class='btn btn-outline-dark btn-icon'>{$i}</button>&nbsp;&nbsp;</a></li>"; 
                }
                }
                ?>
<!--
                   <li>
                <a href="sales_report_success.php?page=<?= $Next; ?>" aria-label="Next">
                        <span aria-hidden="true"><button class="btn btn-md btn-dark">Next&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i></button> </span>
                       </a>
                   </li>
-->
               </ul>
                
            </nav>
        </div>
    </div>                
    <style>
.pagination li .active-link{
    background: #000 !important
}

</style>      
    
        </div>     

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include "includes/admin_footer.php"; ?>      
