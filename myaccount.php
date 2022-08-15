<?php session_start();
if (isset($_SESSION['User_Id'])) {
    include 'header.php'; ?>

    <?php
    $user = $_SESSION['User_Id'];
    $query = "select * from `user` where id='$user'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    ?>
    <hr>
    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-sm-10">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-2"><a class="pull-right">
                    <h2><?php echo $row['name'] ?></h2>
                </a></div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <!--left col-->
                </hr><br>

            </div>
            <!--/col-3-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active nav-item"><a class="nav-link" data-toggle="tab" href="#home">Profile</a></li>
                    <li class="active nav-item"><a class="nav-link" data-toggle="tab" href="#messages">Billing Address</a></li>
                    <li class="active nav-item"><a class="nav-link" data-toggle="tab" href="#settings">All Orders</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <hr>
                        <h6>Name: </h6><span><?php echo $row['name'] ?></span>
                        <h6>Username:</h6><span><?php echo $row['username'] ?></span>
                        <h6>Email: </h6><span><?php echo $row['email'] ?></span>
                        <h6>Contact Phone:</h6><span><?php echo $row['contact_phone'] ?></span>
                        <hr>

                    </div>
                    <!--/tab-pane-->
                    <div class="tab-pane" id="messages">

                        <h2>Billing Address</h2>
                        <hr>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="Address Type">
                                    <h6>Address Type</h6>
                                </label>
                                <select name="addresstype" id="addresstype" class="form-control">
                                    <option value="" selected>Select Address Type</option>
                                    <option value="Home Address">Home Address</option>
                                    <option value="Business Address">Business Address</option>
                                    <option value="Shipping Address">Shipping Address</option>
                                    <option value="Billing Address">Billing Address</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="last_name">
                                    <h6>Address Line 1</h6>
                                </label>
                                <input type="text" class="form-control" name="address1" id="address1" placeholder="Address Line 1" title="enter your last name if any.">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="phone">
                                    <h6>Address Line 2</h6>
                                </label>
                                <input type="text" class="form-control" name="address2" id="address2" placeholder="Address Line 2" title="enter your phone number if any.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-8">
                                <label for="mobile">
                                    <h6>Country</h6>
                                </label>
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
                                <!-- <input type="text" class="form-control" name="country" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any."> -->
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="email">
                                    <h6>City</h6>
                                </label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="City" title="enter your city.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="email">
                                    <h6>State</h6>
                                </label>
                                <input type="text" class="form-control" id="state" placeholder="State" title="enter a state">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="password">
                                    <h6>Zip Code</h6>
                                </label>
                                <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Zip Code 5 digit" title="enter your zip code.">
                                <input type="hidden" name="aid" id="aid">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <br>
                                <button class="btn btn-lg btn-info" id="btnadd" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Add</button>
                                <button class="btn btn-lg btn-info" id="btnedit" type="submit" style="display: none;"><i class="glyphicon glyphicon-ok-sign"></i> Edit</button>
                            </div>
                        </div>
                        <table class="table">


                            <tbody id="adisplay">

                            </tbody>

                        </table>
                    </div>
                    <!--/tab-pane-->
                    <div class="tab-pane" id="settings">
                        <h2>All Orders</h2>
                        <hr>

                        <table class="table">
                            <thead>
                                <th>Order Id</th>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Action</th>
                            </thead>

                            <tbody id="odisplay">

                            </tbody>

                        </table>


                    </div>

                </div>
                <!--/tab-pane-->
            </div>
            <!--/tab-content-->

        </div>
        <!--/col-9-->
    </div>
    <!--/row-->

    <script>
        $(document).ready(function() {

            alldata();

            function alldata() {
                $.ajax({
                    url: 'ajaxconfig.php',
                    type: 'GET',
                    data: {
                        Display: 1,
                    },
                    success: function(response) {
                        $('#adisplay').html(response);
                    },
                    error: function(err) {
                        alert("Api Call Failed");
                    },
                });
            }

            allorder();

            function allorder() {
                $.ajax({
                    url: 'ajaxconfig.php',
                    type: 'GET',
                    data: {
                        Allorder: 1,
                    },
                    success: function(response) {
                        $('#odisplay').html(response);
                    },
                    error: function(err) {
                        alert("Api Call Failed");
                    },
                });
            }

            $('#btnadd').click(function() {
                var addresst = $('#addresstype').val();
                var address1 = $('#address1').val();
                var address2 = $('#address2').val();
                var country = $('#country').val();
                var city = $('#city').val();
                var state = $('#state').val();
                var zipcode = $('#zipcode').val();

                $.ajax({

                    url: 'ajaxconfig.php',
                    type: 'POST',
                    data: {
                        AddressAdd: 1,
                        a_type: addresst,
                        a_1: address1,
                        a_2: address2,
                        a_country: country,
                        a_city: city,
                        a_state: state,
                        a_zipcode: zipcode,
                    },
                    success: function(response) {
                        if (response) {
                            alldata();
                            blankfield();
                            swal("Good job!", "Your Address Has Been Added!", "success");
                        } else {
                            alert("Failed");
                        }
                    },
                    error: function(err) {
                        alert("Api Call Failed");
                    },

                });
            });

            $(document).on('click', '.btndelete', function() {
                var id = $(this).val();
                $.ajax({
                    url: 'ajaxconfig.php',
                    type: 'POST',
                    data: {
                        Adelete: 1,
                        a_id: id,
                    },
                    success: function(response) {
                        if (response) {
                            alldata();
                        } else {
                            alert("Failed");
                        }
                    },
                    error: function(err) {
                        alert("Api Call Failed");
                    },
                });
            });

            $(document).on('click', '.btnocancel', function() {
                var id = $(this).val();
                $.ajax({
                    url: 'ajaxconfig.php',
                    type: 'POST',
                    data: {
                        Ordelete: 1,
                        od_id: id,
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


            $(document).on('click', '.btnedit', function() {
                var row = $(this).val();
                $('#aid').val(row);
                var row = $(this).closest('tr').find('td');
                $('#addresstype').val(row[0].innerText);
                $('#address1').val(row[1].innerText);
                $('#address2').val(row[2].innerText);
                $('#country').val(row[3].innerText);
                $('#city').val(row[4].innerText);
                $('#state').val(row[5].innerText);
                $('#zipcode').val(row[6].innerText);

                $('#btnedit').show();
                $('#btnadd').hide();
            });


            $('#btnedit').click(function() {
                var aid = $('#aid').val();
                var addresst = $('#addresstype').val();
                var address1 = $('#address1').val();
                var address2 = $('#address2').val();
                var country = $('#country').val();
                var city = $('#city').val();
                var state = $('#state').val();
                var zipcode = $('#zipcode').val();

                $.ajax({

                    url: 'ajaxconfig.php',
                    type: 'POST',
                    data: {
                        Aedit: 1,
                        a_idd: aid,
                        a_type: addresst,
                        a_1: address1,
                        a_2: address2,
                        a_country: country,
                        a_city: city,
                        a_state: state,
                        a_zipcode: zipcode,
                    },
                    success: function(response) {
                        if (response) {
                            alldata();
                            blankfield();
                            $('#btnadd').show();
                            $('#btnedit').hide();
                            swal("Good job!", "Your Address Has Been Updated!", "success");
                        } else {
                            alert("Failed");
                        }
                    },
                    error: function(err) {
                        alert("Api Call Failed");
                    },

                });
            });

            function blankfield() {
                $('#aid').val("");
                $('#addresstype').val("");
                $('#address1').val("");
                $('#address2').val("");
                $('#country').val("");
                $('#city').val("");
                $('#state').val("");
                $('#zipcode').val("");
            }

        });

        $(document).ready(function() {


            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.avatar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function() {
                readURL(this);
            });
        });
    </script>

<?php include 'footer.php';
} else {
    header('location:signin.php');
} ?>