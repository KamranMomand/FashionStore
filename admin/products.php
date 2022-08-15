<?php
session_start();
if (isset($_SESSION['adminid'])) {
    include_once 'config.php';
    include 'header.php';
    include 'navbar.php';

    $pro_query = "select * from `product` p join `product_subcategory` sc on p.Category=sc.id join `product_category` c on sc.category=c.id";
    $pro_result = mysqli_query($conn, $pro_query);

    if (isset($_POST['btnAddd'])) {
        $product = $_POST['pro'];
        $descrition = $_POST['desc'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $launch_Date=date("Y-m-d");
        $image1 = addslashes(file_get_contents($_FILES['image1']['tmp_name']));
        $image2 = addslashes(file_get_contents($_FILES['image2']['tmp_name']));
        $image3 = addslashes(file_get_contents($_FILES['image3']['tmp_name']));
        $discount = $_POST['discr'];
        $stock = $_POST['stock'];
        
        if($_POST['feat'] == "Yes"){
            $featured = "Yes";
        }else{
            $featured = "No";
        }
        $status = "Active";
        
        $p_query = "INSERT INTO `product`(`product`, `description`, `price`, `category`, `stock`, `launch_date`, `image1`, `image2`, `image3`, `discount`, `featured`, `status`) VALUES ('$product','$descrition','$price','$category','$stock','$launch_Date','$image1','$image2','$image3','$discount','$featured','$status')";
        $p_result = mysqli_query($conn, $p_query);

        if ($p_result) {
            header('location: products.php');
        } else {
            echo "Record Not Inserted " . mysqli_error($conn);
        }
    }
?>

    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'thrift_fashion');
    $cquery = "select * from product_category";
    $cresult = mysqli_query($conn, $cquery);
    ?>
    <script>
        $(document).ready(function() {

            $('#category').on('change', function() {
                var subcategory = this.value;
                $.ajax({
                    url: "subcategory-by-category.php",
                    type: "POST",
                    data: {
                        'subcategory': subcategory
                    },
                    cache: false,
                    success: function(result) {
                        $("#sub_category").html(result);

                    }
                });
            });

        });

        displayData();

        function displayData() {
            $.ajax({
                url: 'config.php',
                type: 'GET',
                data: {
                    Display: 1
                },
                success: function(response) {
                    $('#result').html(response);
                },
                error: function(err) {
                    alert('Api Call Failed');
                }
            });
        }


        $(document).on('click', '.btnEdit', function() {
            var row = $(this).closest('tr').find('td');
            $('#cat_id').val(row[0].innerText);
            $('#category').val(row[1].innerText);
            $('#sub_category').val(row[2].innerText);


            $('#btnAdd').hide();
            $('#btnUpdate').show();
        });

        $(document).on('click', '.btnDelete', function() {
            var id = $(this).val();
            $.ajax({
                url: 'config.php',
                type: 'POST',
                data: {
                    Delete: 1,
                    stu_Id: id
                },
                success: function(response) {
                    if (response) {
                        alert("Record Deleted");
                        displayData();
                    } else {
                        alert("Failed");
                    }
                },
                error: function(err) {
                    alert('Api Call Failed');
                }
            });
        });

        $('#btnAdd').click(function() {
            var cyname = $('#category').val();
            var statename = $('#sub_category').val();

            $.ajax({
                url: 'config.php',
                type: 'POST',
                data: {
                    Add: 1,
                    coun_Name: cyname,
                    stat_name: statename,
                    //cty_name:cityname
                },
                success: function(response) {
                    if (response) {
                        // alert("Record Added Successfully");
                        displayData();
                    } else {
                        alert("Failed");
                    }
                },
                error: function(err) {
                    alert('Api Call Failed');
                }
            });
        });

        $('#btnUpdate').click(function() {
            var stId = $('#cat_id').val();
            var cyname = $('#category').val();
            var statename = $('#sub_category').val();
            //var cityname=$('#city_name').val();

            $.ajax({
                url: 'config.php',
                type: 'POST',
                data: {
                    Update: 1,
                    stu_Id: stId,
                    coun_Name: cyname,
                    stat_name: statename,
                    // cty_name:cityname
                },
                success: function(response) {

                    if (response) {
                        alert("Record Updated Successfully");
                        displayData();
                    } else {
                        alert("Failed");
                    }
                },
                error: function(err) {
                    alert('Api Call Failed');
                }
            });
        });
    </script>
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
                                    <li class="breadcrumb-item active">Product</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Products</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <h4 class="header-title">Product Details</h4>
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
                                        <th>Image2</th>
                                        <th>Image3</th>
                                        <th>CheckBox</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $query = "select * from product";
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
                                            <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image2']); ?>" width="100px" height="100px" /></td>
                                            <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image3']); ?>" width="100px" height="100px" /></td>
                                            <td><?php echo $row['featured']; ?></td>
                                            <td><a href="products_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <form method="post" enctype="multipart/form-data">
                                <label>Enter Product : </label>
                                <input type="text" class="form-control" id="pro" name="pro" />
                                <br>
                                <label>Enter Description: </label>
                                <input type="text" class="form-control" id="desc" name="desc" />
                                <br>
                                <label>Enter Price: </label>
                                <input type="text" class="form-control" id="price" name="price" />
                                <br>
                                <!-- Country Code start  -->
                                <input type="hidden" name="stId" id="cat_id">
                                <label>Enter Category</label>
                                <select class="form-control" name="category" id="category">
                                    <option>Select Category</option>
                                    <?php
                                    while ($crow = mysqli_fetch_assoc($cresult)) {
                                    ?>
                                        <option value="<?php echo $crow['id']; ?>"><?php echo $crow['category']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <br>
                                <label>Enter SubCategory</label>
                                <select class="form-control" name="sub_category" id="sub_category">

                                </select>
                                <br>

                                <table class="table table-bordered table-hovered">

                                    <tbody id="result">
                                    </tbody>

                                </table>
                                <!-- Country Code End -->
                                <label>Enter Stock: </label>
                                <input type="text" class="form-control" id="stock" name="stock" />
                                <br>
                                <!-- <label>Enter Launch Date: </label>
                            <input type="text" class="form-control" name="ldate"/>
                            <br> -->
                                <label>Select Image : </label>
                                <input type="file" class="form-control" id="image1" name="image1" required />
                                <br>
                                <label>Select Image : </label>
                                <input type="file" class="form-control" id="image2" name="image2" required />
                                <br>
                                <label>Select Image : </label>
                                <input type="file" class="form-control" id="image3" name="image3" required />
                                <br>
                                <label>Enter Discount: </label>
                                <input type="text" class="form-control" id="discr" name="discr" />
                                <br/>
                                <label>Featured:</label>
                                <input type="checkbox" id="feat" name="feat" value="Yes">
                                <br>
                                <input type="submit" class="btn btn-primary" value="Add Product" id="btnAddd" name="btnAddd" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        <?php
        include 'footer.php';
    } else {
        header('location:login.php');
    }
        ?>