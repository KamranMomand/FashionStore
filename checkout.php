<?php
session_start();
if (isset($_SESSION['User_Id'])) {
  include 'header.php';
?>
  <?php
  if (isset($_SESSION['User_Id'])) {
    $user = $_SESSION['User_Id'];
    $query = "select * from cart c join `product` p on c.product_id=p.id where user_id = '$user'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
  }

  ?>
  <div class="container">
    <h2>Check Out</h2>
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Your cart</span>
          <span class="badge badge-secondary badge-pill"><?php echo $count; ?></span>
        </h4>
        <ul class="list-group mb-3">
          <?php
          $total = 0;
          while ($row = mysqli_fetch_array($result)) { ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image1']); ?>" alt="Image" class="img-fluid" width="30px" height="30px">
                <h6 class="my-0"><?php echo $row['product']; ?></h6>
              </div>
              <div>
                <span class="text-muted">$ <?php echo $row['price']; ?></span>
                <h6 class="my-0" style="text-align: right;"><?php echo $row['quantity']; ?></h6>

                <hr>
                <h6><?php echo $row['quantity'] * $row['price']; ?></h6>
              </div>
            </li>
          <?php $total += $row['quantity'] * $row['price'];
          } ?>

          <li class="list-group-item d-flex justify-content-between">
            <strong>Total $ <?php
                            echo $total; ?></strong>
          </li>
        </ul>
        <label id="total"><?php echo $total; ?></label>
      </div>
      <div class="col-md-8 order-md-1">

        <h4 class="mb-3">Billing Address</h4>
        <hr class="mb-4">
        <table class="table">
          <tbody>


            <?php
            $user = $_SESSION['User_Id'];
            $querya = "select * from `address` where user_id='$user'";
            $resulta = mysqli_query($conn, $querya);

            while ($rowa = mysqli_fetch_assoc($resulta)) { ?><tr>
                <td><input type="radio" id="pay1" name="pay1" value="<?php echo $rowa['id'] ?>"></td>
                <td><span style="font-weight:bold"><?php echo $rowa['address_type'] ?></span></td>
                <td><span><?php echo $rowa['address_line1'] ?></span></td>
                <td><span><?php echo $rowa['address_line2'] ?></span></td>
                <td><span><?php echo $rowa['country'] ?></span></td>
              </tr>
              <tr>
                <td><span><?php echo $rowa['city'] ?></span></td>
                <td><span><?php echo $rowa['state'] ?></span></td>
                <td><span><?php echo $rowa['zip_code'] ?></span></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

        <!--         
          <form class="needs-validation" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Address Type</label>
                <select name="addresstype" id="addresstype" class="form-control">
                  <option value="" selected>Select Address Type</option>
                  <option value="Home Address">Home Address</option>
                  <option value="Business Address">Business Address</option>
                  <option value="Shipping Address">Shipping Address</option>
                  <option value="Billing Address">Billing Address</option>
                </select>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Address Line 1</label>
                <input type="text" class="form-control" name="address1" id="address1" placeholder="Address Line 1" title="enter your last name if any.">
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="username">Address Line 2</label>
              <div class="input-group">
              <input type="text" class="form-control" name="address2" id="address2" placeholder="Address Line 2" title="enter your phone number if any.">
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Country </label>
              <select name="country" id="country" class="form-control">
                <option value="" selected>Select Country</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Malaysia">Malaysia</option>
                <option value="United State">United State</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="Turkey">Turkey</option>
                <option value="Australia">Australia</option>
                <option value="Germany">Germany</option>
                <option value="China">China</option>
                <option value="Russia">Russia</option>
                <option value="Saudia Arabia">Saudia Arabia</option>
                <option value="Qatar">Qatar</option>
                <option value="Russia">Russia</option>
              </select>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="address">City</label>
              <input type="text" class="form-control" name="city" id="city" placeholder="City" title="enter your city.">
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="mb-3">
              <label for="address2">State </label>
              <input type="text" class="form-control" id="state" placeholder="State" title="enter a state">
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Zip Code</label>
                <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Zip Code 5 digit" title="enter your zip code.">
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
            </div>
          </form> -->


        <hr class="mb-4">

        <h4 class="mb-3">Payment</h4>

        <div class="d-block my-3">
          <div class="custom-control custom-radio">
            <input id="cod" name="paymentMethod" type="radio" value="cod" class="custom-control-input">
            <label class="custom-control-label" for="cod">Cash on Delivery</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="credit" name="paymentMethod" type="radio" value="Credit" class="custom-control-input">
            <label class="custom-control-label" for="credit">Credit card</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="debit" name="paymentMethod" type="radio" value="Debit" class="custom-control-input">
            <label class="custom-control-label" for="debit">Debit card</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="paypal" name="paymentMethod" type="radio" value="Paypal" class="custom-control-input">
            <label class="custom-control-label" for="paypal">Paypal</label>
          </div>
        </div>
        <div class="row" id="displ" style="display: none ;">

          <div class="col-md-6 mb-3">
            <label for="cc-number">Credit Card number</label>
            <input type="text" class="form-control" id="cc_number" placeholder="" required>
            <div class="invalid-feedback">
              Credit card number is required
            </div>
          </div>
        </div>

        <div class="row" id="displ2" style="display: none ;">

          <div class="col-md-6 mb-3">
            <label for="cc-number">Debit Card number</label>
            <input type="text" class="form-control" id="dc_number" placeholder="" required>
            <div class="invalid-feedback">
              Debit card number is required
            </div>
          </div>
        </div>

        <div class="row" id="displ3" style="display: none ;">

          <div class="col-md-6 mb-3">
            <label for="cc-number">Paypal Account Number</label>
            <input type="text" class="form-control" id="pp_number" placeholder="" required>
            <div class="invalid-feedback">
              Paypal Account number is required
            </div>
          </div>
        </div>


        <hr class="mb-4">
        <button class="btn btn-info btn-lg btn-block" id="btncheckout" type="submit">Continue to Checkout</button>
      </div>

      </form>
    </div>
  </div>
  </div><br /><br /><br /><br />

  <script>
    $(document).ready(function() {


      $('input:radio[name="paymentMethod"]').change(function() {
        if ($(this).val() == 'Credit') {
          $('#displ').show();
        } else {
          $('#displ').hide();
        }
        if ($(this).val() == 'Debit') {
          $('#displ2').show();
        } else {
          $('#displ2').hide();
        }
        if ($(this).val() == 'Paypal') {
          $('#displ3').show();
        } else {
          $('#displ3').hide();
        }
      });


      $('#btncheckout').click(function() {
        var add_id = $("input[name='pay1']:checked").val();
        var total = $('#total').html();
        var type = $("input[name='paymentMethod']:checked").val();
        var card = "";
        if (type == "Credit") {
          card = $('#cc_number').val();
        }
        if (type == "Debit") {
          card = $('#dc_number').val();
        }
        if (type == "Paypal") {
          card = $('#pp_number').val();
        }
        //alert(type);
        // alert(total);
        $.ajax({

          url: 'ajaxconfig.php',
          type: 'POST',
          data: {
            Order: 1,
            a_id: add_id,
            o_total: total,
            b_card: card,
          },
          success: function(response) {
            if (response) {
              location.reload();
            } else {
              alert("Failed");
            }
          },
          error: function(err) {
            alert("Api Call Failed");
          },

        });
      });


    });
  </script>

<?php
  include 'footer.php';
} else {
  header('location:signin.php');
}
?>