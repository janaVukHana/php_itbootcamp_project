<!-- main content -->
<div class="album py-5 bg-light">
        <div class="container">
    
        <!-- filters -->
        <div class="bg-dark text-white pt-3 px-2 rounded shadow">
          <form action="./courts_page_controler.php" method="GET">
            <div class="row d-flex justify-content-between mb-3">
                <div class="col-md-4 col-sm-12 mb-1">
                    <select class="form-select court-location" aria-label="Default select example" name="court_location" onchange="this.form.submit()">
                        <option <?php if($court_location == 'Hardest') echo htmlspecialchars('selected'); ?> value="Hardest">Hardest to play on</option>
                        <option <?php if($court_location == 'Easiest') echo htmlspecialchars('selected'); ?> value="Easiest">Easiest to play on</option>

                        <option <?php if($court_location == 'Newest' || $court_location == '') echo htmlspecialchars('selected'); ?> value="Newest">Newest added</option>
                        <option <?php if($court_location == 'Oldest') echo htmlspecialchars('selected'); ?> value="Oldest">Oldest added</option>
                        <option <?php if($court_location == 'Detelinara') echo htmlspecialchars('selected'); ?> value="Detelinara">Detelinara</option>
                        <option <?php if($court_location == 'Liman') echo htmlspecialchars('selected'); ?> value="Liman">Liman</option>
                        <option <?php if($court_location == 'Centar') echo htmlspecialchars('selected'); ?> value="Centar">Centar</option>
                        <option <?php if($court_location == 'Grbavica') echo htmlspecialchars('selected'); ?> value="Grbavica">Grbavica</option>
                        <option <?php if($court_location == 'Novo_naselje') echo htmlspecialchars('selected'); ?> value="Novo_naselje">Novo naselje</option>
                        <option <?php if($court_location == 'Kej') echo htmlspecialchars('selected'); ?> value="Kej">Kej</option>
                      </select>
                </div>
                <!-- <div class="col-md-4 col-sm-12 mb-1">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search term" aria-label="Search term" aria-describedby="button-addon2" name="search_term" value=<?php echo $term; ?>>
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button</button>
                    </div>
                </div> -->
            </div>
          </form>
        </div>
        <!-- end of filters -->
          

          <div class="courts-container row">
            <?php foreach($all_courts as $court) { ?>
              <div class="single-court col-4 mb-3 d-flex">
                <div class="card shadow-sm mx-auto">
                  <!-- NISAM SIGURAN DA JE OBJECT FIT VALIDNO RESENJE -->
                  <div style="height: 250px">
                    <img style="max-height: 250px;" class="d-block mx-auto w-100" src="<?php echo htmlspecialchars($court['file_path']); ?>" alt="<?php echo htmlspecialchars($court['name']); ?> basketball court">
                  </div>

                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                      <p class="card-text">
                        <small>by <?php echo htmlspecialchars($court['creator']); ?></small>
                      </p>
                      <p><small>
                      <?php echo htmlspecialchars($court['created_at']); ?>
                      </small></p>
                    </div>
                    <div>
                        <p style="margin-top: -13px;">Name: <?php echo htmlspecialchars($court['name']); ?></p>
                        <p style="margin-top: -13px;">Location: <span class="location-name"><?php echo htmlspecialchars($court['location']); ?><span></p>
                        <p style="margin-top: -13px;">Rating: <span class="avg-rating"><?php echo htmlspecialchars($court['avg_rating']); ?><span></p> 
                        <p class="mb-5" style="margin-top: -13px;">Comments number: <span class="comment-num"><?php echo htmlspecialchars($court['comments_num']); ?><span></p>
                    </div>
                      <div class="position-absolute bottom-0 start-0 ms-3 mb-2">
                        <a class="btn btn-outline-success" href="single_court_controler.php?id=<?php echo htmlspecialchars($court['id']); ?>">Show</a>
                      </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            
          </div>
        </div>
      </div>