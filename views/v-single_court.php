
 <!-- main content -->

 <div class="container px-4 py-4">
        <div class="row g-5 py-2">
          <div class="col-7">
            <h1><?php echo htmlspecialchars($court['name']); ?></h1>
            <img style="height: 350px;" src="<?php echo htmlspecialchars($court['file_path']); ?>" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            <div class="row">
              <p class="col-12 bg-dark text-white py-1 rounded-1"><?php echo htmlspecialchars($court['description']); ?></p>
              <p class="col-6">by <?php echo htmlspecialchars($court['creator']); ?></p>
              <p class="col-6"><?php echo htmlspecialchars($court['created_at']); ?></p>
              <p class="col-6">Location: <?php echo htmlspecialchars($court['location']); ?></p>
              <p class="col-6">Rating: <span class="avgStars"></span></p>
            </div>
          </div>

          <?php if($is_set_session) { ?>
          <div class="col-5">
          <form action="single_court_controler.php?id=<?php echo htmlspecialchars($court_id); ?>" method="POST">
              
              <img class="mb-4 d-block mx-auto" src="public/theme/img/logo/boston-logo.png" alt="logo" width="72" height="57">
              <h1 class="h3 mb-3 fw-normal">Add comment. Express yourself</h1>

              <!-- COMMENT TEXTBOX-->
              <?php if($systemErrors['comment_err']) { ?>
                <small class="text-danger"><?php echo $systemErrors['comment_err']; ?></small>
              <?php } ?>
              <div class="mb-3">
                <label for="comment" class="form-label">Add comment</label>
                <textarea class="form-control" id="comment" rows="3" name="comment"><?php echo htmlspecialchars($comment); ?></textarea>
              </div>
              <?php if($systemErrors['rating_err']) { ?>
                <small class="text-danger"><?php echo $systemErrors['rating_err']; ?></small>
              <?php } ?>
              
              <!-- RATING INPUT -->
              <div class="mb-3">
                <label for="rating" class="form-label">Rate court</label>
                <input type="number" class="form-control" id="rating" aria-describedby="emailHelp" name="rating" min="1" max="5" step="1" value="<?php echo htmlspecialchars($rating); ?>">
              </div>
          
              <button class="w-100 btn btn-lg btn-success" type="submit" name="add_comment">Add comment</button>
            </form>
          </div>
          <?php } ?>

        </div>
        
        <div class="row d-flex justify-content-between gx-1">
          <?php foreach($user_comments as $comment) { ?>
              <div class="col-6 text-white mb-1">
                  <div class="bg-dark px-3 py-1">
                    <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                    <div class="d-flex justify-content-between">
                      <p>Rating: <span class="stars"><?php echo htmlspecialchars($comment['rating']); ?></span></p>
                      <p><small>by <?php echo htmlspecialchars($comment['creator']); ?></small></p>
                    </div>
                  </div>
              </div>
          <?php } ?>
        </div>

      </div>