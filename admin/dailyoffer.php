<?php
session_start();
if (isset($_SESSION['adminid'])) {
    include_once 'config.php';
    include 'header.php';
    include 'navbar.php';
?>



    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="index.php">Thriftfashion</a></li>
                                    <li class="breadcrumb-item active">Daily offer</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Daily Offer</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <h4 class="header-title">Offers Details</h4>
                            <br>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Product</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Stock</th>
                                        <th>Launched Date</th>
                                        <th>Image1</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM `product`";
                                    $result = mysqli_query($conn, $query);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['product']; ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td><?php echo $row['category']; ?></td>
                                            <td><?php echo $row['stock']; ?></td>
                                            <td><?php echo $row['launch_date']; ?></td>
                                            <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image1']); ?>" width="100px" height="100px" /></td>
                                            <td><a class="btn btn-success addoffer">Offer</a></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div id="ofdisplay" style="display: none;">
                                <label>Start Date : </label>
                                <input type="text" class="form-control" id="sdate" name="sdate" placeholder="2022-08-01" required />
                                <input type="hidden" class="form-control" id="pid" name="pid" />
                                <br>
                                <label>End Date: </label>
                                <input type="text" class="form-control" id="edate" name="edate" placeholder="2022-08-01" required />
                                <br>
                                <label>Discount Percentage: </label>
                                <input type="text" class="form-control" id="discount" name="discount" placeholder="10" required />
                                <br>
                                <input type="submit" class="btn btn-primary" value="Add DailyOffer" id="btnAdd" />

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {


                    $(document).on('click', '.addoffer', function() {
                        var row = $(this).closest('tr').find('td');
                        $('#pid').val(row[0].innerText);

                        $('#ofdisplay').show();
                    });

                    $('#btnAdd').click(function() {
                        var id = $('#pid').val();
                        var sdate = $('#sdate').val();
                        var edate = $('#edate').val();
                        var discount = $('#discount').val();
                        $.ajax({

                            url: 'ajaxconfig.php',
                            type: 'POST',
                            data: {
                                dailyof: 1,
                                p_id: id,
                                s_date: sdate,
                                e_date: edate,
                                o_discount: discount,
                            },
                            success: function(response) {
                                if (response) {
                                    $('#ofdisplay').hide();
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
        header('location:login.php');
    }
        ?>