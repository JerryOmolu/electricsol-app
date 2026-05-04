<div class="container mt-4">
  <div class="card shadow-sm border-0 rounded-4 mb-3">
    <div class="card-body">
      <h5 class="text-dark text-center fw-bold">Here's What People are Saying</h5>
      <hr class="mt-2 mb-4">

      <div class="testimonial-slide-three-wrapper">
        <div class="testimonial-slide3 testimonial-style3">

          <!-- PHP Loop -->
          <?php 
          $query = "SELECT * FROM review WHERE review_status = 'Approved' ORDER BY review_date DESC LIMIT 5";
          $select_review_query = mysqli_query($connection, $query);
          if(!$select_review_query){
              die('QUERY FAILED' . mysqli_error($connection));
          }

          while($row = mysqli_fetch_array($select_review_query)){
              $review_author = escape($row['review_author']);
              $review_content = escape($row['review_content']);
              $review_date = escape($row['review_date']);                
              $rating = escape($row['review_rating']);                
          ?>
          
          <div class="single-testimonial-slide p-3 mb-3">
            <!-- Star Rating -->
            <div class="stars mb-2">
              <?php             
              for ($i = 1; $i <= 5; $i++) {
                  if ($i <= $rating) {
                      echo "<span class='star filled'>★</span>";
                  } else {
                      echo "<span class='star empty'>★</span>";
                  }
              }
              ?>
            </div>

            <!-- Review Content -->
            <div class="text-content">
              <p class="mb-2 text-secondary fst-italic">
                <i class="fa fa-quote-left text-warning"></i>
                &nbsp;<?php echo $review_content ?>&nbsp;
                <i class="fa fa-quote-right text-warning"></i>
              </p>
              <h6 class="fw-semibold mb-0 text-dark"><?php echo $review_author ?></h6>
              <small class="text-muted"><?php echo date("F j, Y", strtotime($review_date)); ?></small>
            </div>
          </div>
          
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Extra CSS -->
<style>
  .single-testimonial-slide {
    background: #f9fafc;
    border-radius: 12px;
    transition: all 0.3s ease;
  }
  .single-testimonial-slide:hover {
    background: #fff;
    transform: translateY(-4px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
  }
  .stars .star {
    font-size: 18px;
    margin-right: 2px;
  }
  .stars .filled {
    color: #EC8305;
  }
  .stars .empty {
    color: #d3d3d3;
  }
</style>
