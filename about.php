<?php include 'header.php' ?>


<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Why Shop With Us</h1>
      <p class="lead text-muted">We firmly believe our team of employees is the reason for our success and treat them well. All employees are in-house with no outsourcing of customer support personnel, and no part-time help. When you contact us you get a vested and trained full-time team member ready with the desire to help. We work hard and truly care about what we're doing.</p>
      <p>
        <a href="contact.php" class="btn btn-primary my-2">Contact</a>
      </p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        <?php
        $query = "select * from `team`";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
        ?>

          <div class="col-md-4">
            <div class="card mb-4 box-shadow">
              <img class="card-img-top" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['profile']); ?>" alt="Card image cap" width="10px" height="250px">
              <div class="card-body">
                <h5 class="card-text"><?php echo $row['name']; ?></h5>
                <h6 class="card-text"><?php echo $row['designation']; ?></h6>
                <p class="card-text"><?php echo $row['bio']; ?></p>

              </div>
            </div>
          </div>

        <?php
        }
        ?>
      </div>
    </div>
  </div>
  </div>

</main>

<?php include 'footer.php' ?>