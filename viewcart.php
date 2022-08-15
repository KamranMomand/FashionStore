<?php include 'header.php';
?>

<!-- inner page section -->
<section class="inner_page_head">
  <div class="container_fuild">
    <div class="row">
      <div class="col-md-12">
        <div class="full">

        </div>
      </div>
    </div>
  </div>
</section>
<!-- end inner page section -->
<!-- product section -->
<section class="product_section layout_padding">


  <div class="container">
    <h2>Cart Details</h2>
    <div class="row">

      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="display: none;">Id</th>
            <th class="product-thumbnail">Product</th>
            <th class="product-name">Name</th>
            <th class="product-price">Price</th>
            <th class="product-quantity">Quantity</th>
            <th class="product-total">Total</th>
            <th class="product-remove">Remove</th>
          </tr>
        </thead>
        <tbody>

          <?php
          if (isset($_SESSION['User_Id'])) {
            $user = $_SESSION['User_Id'];

            $query = "select * from cart join `product` p on cart.product_id=p.id join `product_subcategory` sc on p.category=sc.Id join `product_category` c on sc.category=c.Id where cart.user_id = '$user' ";

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result)) {
          ?>
              <tr>
                <td style="display: none;"><?php echo $row[0]; ?></td>
                <td class="product-thumbnail">
                  <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image1']); ?>" alt="Image" class="img-fluid" width="100px" height="100px">
                </td>
                <td class="product-name">
                  <h3 class="h5 text-black"><?php echo $row['product']; ?></h3>
                </td>
                <td><?php echo $row['price']; ?></td>
                <td>
                  <div class="input-group mb-3" style="max-width: 120px;">
                    <input type="hidden" name="<?php $row['quantity']; ?>" value="<?php echo $row['quantity']; ?>">
                    <input type="number" class="form-control qty" value="<?php echo $row['quantity'] ?>" min="1" name="qty<?php echo $row['quantity']; ?>">
                    <!-- <div class="input-group-append">
                        <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                      </div> -->
                  </div>
                </td>
                <td>$ &nbsp;<?php echo $row['price'] * $row['quantity'];
                            ?></td>
                <td>
                  <button class="btn btn-primary height-auto btn-sm btntdelete" value="<?php echo $row[0]; ?>"> X</button>
                </td>
              </tr>
            <?php
            }
            ?>
        </tbody>
      </table>

      <?php
            $check = mysqli_num_rows($result) > 0;
            if ($check <= 0) { ?>
        <h3> No Data in cart</h3>
      <?php
            } else {
      ?>
        <a href="checkout.php" class="btn btn-info">Place Order</a>
    <?php }
          } ?>

    </div>

  </div>
  </div>
  <br /><br />
</section>
<script>
  $(document).ready(function() {

    $(document).on('change', '.qty', function() {
      var row = $(this).closest('tr').find('td');
      var qty = $(this).val();
      // alert("quantity : "+qty);
      // alert("price : "+row['3'].innerText);
      // alert("Total :"+qty*row['3'].innerText);
      row['5'].innerText = qty * row['3'].innerText;

      var c_id = row['0'].innerText;
      $.ajax({
        url: 'ajaxconfig.php',
        type: 'POST',
        data: {
          Update: 1,
          qty: qty,
          c_id: c_id,
        },
        success: function(response) {
          if (response) {

          } else {
            alert("Failed");
          }
        },
        error: function(err) {
          alert("Api Call Failed");
        },
      });

    });

    $(document).on('click', '.btntdelete', function() {
      var id = $(this).val();
      $.ajax({
        url: 'ajaxconfig.php',
        type: 'POST',
        data: {
          Delete: 1,
          p_id: id,
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
<!-- end product section -->


<?php include 'footer.php' ?>