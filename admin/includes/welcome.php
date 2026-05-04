<div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome! <?php echo $_SESSION['fullname'] ?></h3>
                  <h6 class="font-weight-normal mb-0">Portfolio: <?php echo $_SESSION['role'] ?> | Phone Number: <?php echo $_SESSION['phone'] ?></h6>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-md btn-light bg-white" type="button"  aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> <?php echo date("l, F j, Y"); ?>
                    </button>
                  </div>
                 </div>
                </div>
              </div>
            </div>
          </div>