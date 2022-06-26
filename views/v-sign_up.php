<!-- main content -->
<?php if($registration_failed_message) { ?>
    <div class="alert alert-warning alert-dismissible fade show mx-auto mt-3" role="alert" style="max-width: 360px;">
      <?php echo $registration_failed_message; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>


<main class="form-signin w-100 m-auto my-5">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
        
        <img class="mb-4 d-block mx-auto" src="public/theme/img/logo/boston-logo.png" alt="logo" width="72" height="57">
          <h1 class="h3 mb-3 fw-normal text-center">Please Sign Up</h1>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" name="username" value="<?php echo htmlspecialchars($username);?>" placeholder="username">
            <label for="floatingInput">Username</label>
            <small class="text-danger"><?php echo $systemErrors['username_err']; ?></small>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" name="email" value="<?php echo htmlspecialchars($email);?>" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
            <small class="text-danger"><?php echo $systemErrors['email_err']; ?></small>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" value="<?php echo htmlspecialchars($password);?>" placeholder="Password">
            <label for="floatingPassword">Password</label>
            <small class="text-danger"><?php echo $systemErrors['password_err']; ?></small>
        </div>

        <!-- upload profile img -->
        <div class="form-floating">
            <input type="file" class="form-control" id="upload" aria-describedby="emailHelp" name="upload">
            <small class="text-danger"><?php echo htmlspecialchars($systemErrors['file_err']); ?></small>
          </div>
        

        <button class="w-100 btn btn-lg btn-success" type="submit" name="sign_up">Sign in</button>
    </form>
</main>
