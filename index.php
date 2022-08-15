<?php include 'header.php' ?>


<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/3.jpg" alt="Los Angeles" width="100%" height="500px">
    </div>
    <div class="carousel-item">
      <img src="images/4.jpg" alt="Chicago" width="100%" height="500px">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>

<br />


<br />

<div class="container py-5">
  <h2>Featured Product</h2>
  <div class="row">

    <?php

    $query = "select * from `product` p join `product_subcategory` sc on p.Category=sc.Id join `product_category` c on sc.Category=c.Id where p.featured = 'Yes'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result)) {
    ?>
      <div class="col-md-12 col-lg-3 mb-3 mb-lg-0">

        <div class="card">
          <?php if ($row['discount'] > 0) { ?>
            <span class="badge bg-primary ms-3"><?php echo $row['discount']; ?>% OFF</span>
          <?php
          } ?>
          <a href="productdetails.php?id=<?php echo $row[0]; ?>">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image1']); ?>" class="card-img-top" alt="<?php echo $row['product']; ?>" width="200px" height="180px" />
          </a>
          <div class="card-body">
            <div class="d-flex justify-content-between">

              <p class="small"><a class="text-muted"><?php echo $row['category']; ?> / <?php echo $row['subcategory']; ?></a></p>

            </div>

            <div class="d-flex justify-content-between mb-3">
              <h5 class="mb-0"><?php echo $row['product']; ?></h5>

            </div>

            <div class="d-flex justify-content-between mb-2">
              <h5 class="text-dark mb-0">$ &nbsp;<?php echo $row['price']; ?></h5>
              <p class="text-muted mb-0">Available: <span class="fw-bold"><?php echo $row['stock']; ?></span></p>

            </div>
            <button class='btn btn-info btncart' value='<?php echo $row[0]; ?>'> Add to Cart</button>

          </div>
        </div>
      </div>
    <?php
    }
    ?>
    <script>
      $(document).on('click', '.btncart', function() {
        var id = $(this).val();
        $.ajax({
          url: 'ajaxconfig.php',
          type: 'POST',
          data: {
            cart: 1,
            p_id: id,
          },
          success: function(response) {
            if (response) {
              if (response == "noadd") {
                window.location = "signin.php";
              } else {
                location.reload();
              }

            } else {
              alert("Failed Please Try Again");
            }
          },
          error: function(err) {
            alert("Api Call Failed");
          },
        });
      });
    </script>
  </div>
</div>
</div>
<br /><br />

<?php include 'footer.php' ?>