
    <!-- <title>Login Page</title> -->
    <!-- font awesome icons -->
    <script defer="" src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <!-- bootstrap css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- custom css for sign-in page -->
    <link rel="stylesheet" href="theme/css/sing-in-custrom.css">


      <!-- main content -->
      <main class="form-signin w-100 m-auto my-5">
        <!-- <form action="login_page_controler.php" method="POST"> -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
          
          <img class="mb-4 d-block mx-auto" src="public/theme/img/logo/boston-logo.png" alt="logo" width="72" height="57">
          <h1 class="h3 mb-3 fw-normal text-center">Please Log In</h1>
          <?php if(!$username_password_match) { ?>
          <p>
            <small class="text-danger">
              Username or password does not match. Maybe you need to 
              <a class="text-primary" href="./sign_up_page_controler.php">SIGN UP</a> first, or try again.
            </small>
          </p>
          <?php } ?>
      
          <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" name="username" value="<?php echo htmlspecialchars($username);?>"placeholder="username">
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" value="<?php echo htmlspecialchars($password);?>"placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
      
          <button class="w-100 btn btn-lg btn-success" type="submit" name="log_in">Log in</button>
        </form>
      </main>
