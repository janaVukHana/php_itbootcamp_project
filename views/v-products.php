   <!-- main content -->
  <div class="overlay album py-5 bg-light">
    <div class="container">

      <div class="courts-container row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <!-- ovde ide php foreach -->
        <?php foreach($products as $product) { ?>
        <div class="single-court col-lg-4 d-flex align-items-stretch">
            <div class="card shadow-sm">
              <!-- NISAM SIGURAN DA JE OBJECT FIT VALIDNO RESENJE -->
              <img class="mx-auto d-block" style="width: 80%;" src=<?php echo htmlspecialchars($product['image']); ?> alt=<?php echo htmlspecialchars($product['name']); ?>>

              <div class="card-body mb-5">

                    <p style="margin-top: -13px;"><span><?php echo htmlspecialchars($product['name']); ?></span>: <?php echo htmlspecialchars($product['description']);  ?></p>
                    <p style="margin-top: -13px;"><small>Price: <span><?php echo htmlspecialchars($product['price']); ?></span> $</small></p>
                    <p class="d-none" style="margin-top: -13px;">Stock: <span><?php echo htmlspecialchars($product['stock']); ?></span></p>
                    <p class="d-none" style="margin-top: -13px;">Barcode: <?php echo htmlspecialchars($product['barcode']); ?></p>
                
                    <div>
                        <button id=<?php echo htmlspecialchars($product['id']); ?> type="button" class="add-to-cart-btn cart-button position-absolute bottom-0 start-0 ms-3 mb-2">
                          <span class="add-to-cart">Add To Cart</span>
                          <span class="added">Added</span>
                          <i class="fas fa-shopping-cart cart-icon"></i>
                          <i class="fas fa-box cart-item"></i>
                        </button>
                    </div>
              </div>
            </div>
        </div>  
        <!-- ovde ide endof php foreach -->
        <?php } ?>

    </div>

  </div>
</div>