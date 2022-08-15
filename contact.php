<?php include 'header.php' ?>
<?php
$error2 = NULL;

if (isset($_POST['btnsend'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $subject = mysqli_real_escape_string($conn, $_POST['subject']);
  $comment = mysqli_real_escape_string($conn, $_POST['comment']);

  $query = "INSERT INTO `contact`(`name`, `phone`, `email`, `subject`, `comment`) VALUES ('$name','$phone','$email','$subject','$comment')";
  $result = mysqli_query($conn, $query);
  if ($result) {
    $error2 = "Message Send Successfully.";
  }
}   ?>
<div class="row" id="contatti">
  <div class="container mt-5">
    <div class="row" style="height:550px;">
      <div class="col-md-6 maps">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11880.492291371422!2d12.4922309!3d41.8902102!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x28f1c82e908503c4!2sColosseo!5e0!3m2!1sit!2sit!4v1524815927977" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
      <div class="col-md-6">
        <h2 class="text-uppercase mt-3 font-weight-bold">CONTACT</h2>
        <form method="POST">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <input type="text" class="form-control mt-2" placeholder="Name" name="name" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="text" class="form-control mt-2" placeholder="Phone" name="phone" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="email" class="form-control mt-2" placeholder="Email" name="email" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="text" class="form-control mt-2" placeholder="Subject" name="subject" required>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <textarea class="form-control" id="txtcomment" placeholder="Message" name="comment" rows="3" required></textarea>
              </div>
            </div>
            <div class="col-12">
              <button class="btn btn-light" name="btnsend" type="submit">Send</button>
              &nbsp;<?php echo $error2 ?>
            </div>
            <div style="font-weight:bold">

            </div>
          </div>
        </form>
        <div class="">
          <h2 class="text-uppercase mt-4 font-weight-bold">WHERE WE ARE</h2>

          <i class="fas fa-phone mt-3"></i> <a href="tel:+">(+39) 123456</a><br>
          <i class="fas fa-phone mt-3"></i> <a href="tel:+">(+39) 123456</a><br>
          <i class="fa fa-envelope mt-3"></i> <a href="">info@test.it</a><br>
          <i class="fas fa-globe mt-3"></i> Piazza del Colosseo, 1, 00184 Roma<br>
          <i class="fas fa-globe mt-3"></i> Piazza del Colosseo, 1, 00184 Roma<br>
          <div class="my-4">
            <a href=""><i class="fab fa-facebook fa-3x pr-4"></i></a>
            <a href=""><i class="fab fa-linkedin fa-3x"></i></a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php include 'footer.php'; ?>