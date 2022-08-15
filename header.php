<?php
if (session_id() == null) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/styling.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Thrift Fashion</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Shop </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="allproducts.php">All Products</a></li>
              <?php
              include 'config.php';
              $query = "select * from `product_category`";
              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_assoc($result)) {
                $squery = "select * from `product_subcategory` where Category=" . $row['id'];
                $sresult = mysqli_query($conn, $squery);
                if ($row['status'] == "Active") {
              ?>

                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#"><?php echo $row['category']; ?></a>
                    <ul class="dropdown-menu">

                      <?php

                      while ($srow = mysqli_fetch_array($sresult)) {
                      ?>
                        <li><a class="dropdown-item" href="product.php?id=<?php echo $srow[0] ?>"><?php echo $srow['subcategory']; ?></a></li>
                      <?php

                      }
                      ?>
                    </ul>
                  </li>
              <?php
                }
              }
              ?>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="contact.php">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="dailyoffers.php">Daily Offers</a>
          </li>
        </ul>

        <ul class="navbar-nav mr-auto">
          <?php
          if (isset($_SESSION['User_Id'])) {
            $user = $_SESSION['User_Id'];
            $query = "select * from cart where user_id = '$user'";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);
          }
          ?>
          <li class="nav-item"><a class="nav-link" href="viewcart.php">Cart</a> </li><span class="cart-count"><?php if (isset($_SESSION['User_Id'])) {
                                                                                                                echo $count;
                                                                                                              } ?></span> &nbsp; &nbsp;
          <?php
          if (isset($_SESSION['User_Id'])) {
          ?>
            <a class="nav-link" href="myaccount.php">My Account</a>
            <span class="nav-link"><?php echo $_SESSION['Username']; ?></span>
            <a class="nav-link" href="logout.php">Log Out</a>

          <?php
          } else {
          ?>
            <a class="nav-link" href="signin.php">Sign In</a>
            <a class="nav-link" href="signup.php">Sign Up</a>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>