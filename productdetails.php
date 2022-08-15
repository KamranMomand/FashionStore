<?php
if (isset($_GET['id'])) {
    include 'header.php';
    $id = $_GET['id'];
    $query = "select * from `product` p join `product_subcategory` sc on p.Category=sc.id join `product_category` c on sc.Category=c.id WHERE p.id='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

?>
    <div class="container">
        <div class="col-lg-12 p-3">
            <div class="row hedding m-0 pl-3 pt-0 pb-3">
                <h2> Product Details</h2>
            </div>
            <div class="row m-0">
                <div class="col-lg-4 left-side-product-box pb-3">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image1']); ?>" class="border p-3">
                    <span class="sub-img">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image1']); ?>" class="border p-2">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image2']); ?>" class="border p-2">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image3']); ?>" class="border p-2">
                    </span>
                </div>
                <div class="col-lg-8">
                    <div class="right-side-pro-detail border p-3 m-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <span><?php echo $row['category']; ?> / <?php echo $row['subcategory']; ?></span>
                                <p class="m-0 p-0"><?php echo $row['product']; ?></p>
                            </div>
                            <div class="col-lg-12">
                                <p class="m-0 p-0 price-pro">$<?php echo $row['price']; ?></p>
                                <hr class="p-0 m-0">
                            </div>
                            <div class="col-lg-12 pt-2">
                                <h5>Product Detail</h5>
                                <span><?php echo $row['description']; ?></span>
                                <hr class="m-0 pt-2 mt-2">
                            </div>
                            <div class="col-lg-12">
                                <p class="tag-section"><strong>Stock Available : </strong><a><?php echo $row['stock']; ?></a></p>
                            </div>
                            <div class="col-lg-6">
                                <h6>Quantity :</h6>
                                <input type="number" class="form-control text-center w-100" id="qty" value="1" />
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="row">
                                    <div class="col-lg-6 pb-2">
                                        <button class="btn btn-danger w-100 btncart" value='<?php echo $row[0]; ?>'> Add to Cart</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br /><br />
            <h2>Feedback</h2>
            <?php

            $queryf = "select * from `feedback` f join `product` p on f.product_id=p.id join `user`u on f.user_id=u.id WHERE f.product_id='$id'";
            $resultf = mysqli_query($conn, $queryf);
            $count = mysqli_num_rows($resultf);
            $nofeedback = NULL;
            if ($count > 0) {
                while ($rowf = mysqli_fetch_array($resultf)) {
            ?>

                    <div class="container mt-12">
                        <div class="d-flex justify-content-center row">
                            <div class="col-md-12">
                                <div class="bg-white p-4">
                                    <div class="d-flex flex-row user-info">
                                        <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name"><?php echo $rowf['name']; ?></span><span class="date text-black-50">Shared publicity - <?php echo $rowf['date']; ?></span></div>

                                    </div>
                                    <div class="mt-4">
                                        <p class="comment-text"><?php echo $rowf['feedback']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


            <?php

                }
            } else {
                $nofeedback = "No Any Feedback!";
            }
            ?>

            <h5><?php echo $nofeedback ?></h5> <br /><br />
            <?php if (isset($_SESSION['User_Id'])) {

            ?>
                <div class="container mt-12">
                    <div class="d-flex justify-content-center row">
                        <div class="col-md-12">
                            <div class="d-flex flex-column comment-section">

                                <div class="bg-light p-4">
                                    <div class="d-flex flex-row align-items-start"><textarea id="comment" class="form-control ml-1 shadow-none textarea" placeholder="Feedback"></textarea></div>
                                    <div class="mt-4 text-right"><button class="btn btn-info btn-sm shadow-none" id="btnfeedback" type="button">Post Feedback</button></div>
                                    <input type="hidden" id="pid" value="<?php echo $_GET['id']; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
    <script>
        $(document).ready(function() {
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
                                swal({
                                    title: "Good job",
                                    text: "Product Added in Cart!",
                                    type: "success"
                                }).then(function() {
                                    location.reload();
                                });
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


            $('#btnfeedback').click(function() {
                var fcomment = $('#comment').val();
                var pid = $('#pid').val();

                $.ajax({
                    url: 'ajaxconfig.php',
                    type: 'POST',
                    data: {
                        feedback: 1,
                        f_comment: fcomment,
                        p_id: pid,
                    },
                    success: function(response) {
                        if (response) {
                            swal("Good job!", "Feedback Posted!", "success");
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
    header('location:allproducts.php');
} ?>