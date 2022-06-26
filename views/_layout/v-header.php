<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page); ?></title>
    <!-- font awesome icons -->
    <script defer="" src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <!-- bootstrap css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- custom css for sign-in page -->
    <link rel="stylesheet" href="./public/theme/css/custom-styles.css">
</head>
<body>
    <!-- navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
        <div class="container-fluid">
          <a class="navbar-brand" href="home_page_controler.php"><img src="public/theme/img/logo/boston-logo.png" alt="logo" class="logo"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link <?php if($page == 'Home page') echo htmlspecialchars('active'); ?>" aria-current="page" href="home_page_controler.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if($page == 'Courts page') echo htmlspecialchars('active'); ?>" href="courts_page_controler.php">Courts</a>
              </li>
              <?php if($is_set_session) { ?>
              <li class="nav-item">
                <a class="nav-link <?php if($page == 'Add court page') echo htmlspecialchars('active'); ?>" href="add_court_page_controler.php">Add Court</a>
              </li>
              <?php } ?>
              <li class="nav-item">
                <a class="nav-link <?php if($page == 'Products page') echo htmlspecialchars('active'); ?>" href="products_page_controler.php">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About Us</a>
              </li>
            </ul>
          </div>
          <?php if($page == 'Products page') { ?>
            <a href="shopping_cart_page_controler.php" class="btn btn-warning position-relative">
              ShoppingCart
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                0
                <!-- <span class="visually-hidden">unread messages</span> -->
              </span>
            </a>
          <?php } ?>

          <?php if($_SESSION['username']) { ?>
            <div class="dropdown">
              
              <button class="btn btn-secondary dropdown-toggle mx-4" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <small>Hi <?php echo htmlspecialchars($_SESSION['username']); ?></small> <img style="width: 20px; height: 20px; border-radius: 50%;" src=<?php echo $_SESSION['img'] ?> />
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="logout_page_controler.php">Logout</a></li>
                <!-- Button trigger modal -->
                <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Change Img</button></li>
                
              </ul>
            </div>
          <?php } ?>
        </div>
      </nav>


      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content bg-secondary text-white">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Change your avatar image</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- form for changing img -->
              <div class="form-signin w-100 m-auto my-5">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">

                  <div class="form-floating">
                    <input type="file" class="form-control" id="change-img" name="upload">
                  </div>
              
                  <button class="w-100 btn btn-lg btn-dark text-white" type="submit" name="change_img">Change</button>

                </form>

              </div>
              <!-- end of my form -->
            </div>
            <div class="modal-footer"></div>
          </div>
        </div>
      </div>
      <!-- end of Modal -->

      <?php if($header_form_err) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>You have error! </strong> <?php echo htmlspecialchars($modal_systemErrors['file_err']); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php } ?>
        
