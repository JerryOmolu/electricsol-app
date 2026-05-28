<div class="container mt-4">

  <div class="card testimonial-card shadow-sm border-0 rounded-4 mb-3">
    <div class="card-body">

      <h5 class="text-center fw-bold mb-2">Here's What People are Saying</h5>
      <hr class="mt-2 mb-4">

      <div class="testimonial-slide-three-wrapper">
        <div class="testimonial-slide3 testimonial-style3">

          <?php
          try {

              static $stmt = null;

              if ($stmt === null) {

                  $sql = "
                      SELECT review_author, review_content, review_date, review_rating
                      FROM review
                      WHERE review_status = ?
                      ORDER BY review_date DESC
                      LIMIT 5
                  ";

                  $stmt = $pdo->prepare($sql);
              }

              $stmt->execute(['Approved']);

              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                  $review_author  = htmlspecialchars($row['review_author'], ENT_QUOTES, 'UTF-8');
                  $review_content = htmlspecialchars($row['review_content'], ENT_QUOTES, 'UTF-8');
                  $review_date    = $row['review_date'];
                  $rating         = (int)$row['review_rating'];
          ?>

          <div class="single-testimonial-slide modern-testimonial p-3 mb-3">

            <!-- Accent bar -->
            <div class="accent-line mb-2"></div>

            <!-- Rating -->
            <div class="stars mb-2">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <span class="star <?php echo ($i <= $rating) ? 'filled' : ''; ?>">★</span>
              <?php endfor; ?>
            </div>

            <!-- Quote -->
            <div class="quote-box">
              <i class="fa fa-quote-left quote-icon"></i>

              <p class="review-text mb-2">
                <?php echo $review_content; ?>
              </p>

              <i class="fa fa-quote-right quote-icon float-end"></i>
            </div>

            <!-- Author -->
            <div class="review-meta mt-2">
              <div class="fw-semibold text-dark"><?php echo $review_author; ?></div>
              <small class="text-muted">
                <?php echo date('F j, Y', strtotime($review_date)); ?>
              </small>
            </div>

          </div>

          <?php } } catch (PDOException $e) { ?>
            <div class="alert alert-danger">Unable to load reviews.</div>
          <?php } ?>

        </div>
      </div>

    </div>
  </div>
</div>
<style>

/* Card surface upgrade */
.testimonial-card {
  background: linear-gradient(145deg, #ffffff, #f7f9fc);
  border-radius: 18px;
}

/* Individual testimonial card */
.modern-testimonial {
  background: #fff;
  border-radius: 14px;
  transition: all 0.25s ease;
  box-shadow: 0 6px 18px rgba(0,0,0,0.05);
  position: relative;
  overflow: hidden;
}

/* hover effect */
.modern-testimonial:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.10);
}

/* accent line */
.accent-line {
  width: 50px;
  height: 4px;
  border-radius: 50px;
  background: linear-gradient(90deg, #ffc107, #ffe08a);
}

/* star rating modern */
.stars .star {
  font-size: 18px;
  color: #ddd;
  transition: 0.3s;
}

.stars .filled {
  color: #f4a100;
  text-shadow: 0 2px 10px rgba(244,161,0,0.3);
}

/* quote styling */
.quote-box {
  position: relative;
  padding: 5px 0;
}

.review-text {
  font-style: italic;
  color: #4b5563;
  line-height: 1.6;
  font-size: 14px;
}

/* quote icons */
.quote-icon {
  color: #ffc107;
  opacity: 0.8;
  font-size: 14px;
}

/* author styling */
.review-meta {
  border-top: 1px solid rgba(0,0,0,0.05);
  padding-top: 8px;
}

/* subtle animation */
.modern-testimonial {
  animation: fadeUp 0.5s ease;
}

@keyframes fadeUp {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* mobile tuning */
@media (max-width: 576px) {
  .review-text {
    font-size: 13px;
  }

  .stars .star {
    font-size: 16px;
  }
}

</style>