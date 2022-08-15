<?php include 'header.php' ?>

<br />
<div class="container col-md-3">

    <h2>Sign Up</h2><br />
    <div id="message"></div>
    <div id="myform">
        <label for="fullname"> Full Name:</label><br>
        <input class="form-control" type="text" id="fullname" name="fullname">
        <span style="color: red;" class="error" id="name_err"> </span><br>

        <label for="email"> Email Address:</label><br>
        <input class="form-control" type="email" id="email" name="email">
        <span style="color: red;" class="error" id="email_err"> </span><br>

        <label for="phone"> Phone #:</label><br>
        <input class="form-control" type="text" id="phone" name="phone">
        <span style="color: red;" class="error" id="phone_err"> </span><br>

        <label for="username"> Username:</label><br>
        <input class="form-control" type="text" id="username" name="username">
        <span style="color: red;" class="error" id="username_err"> </span><br>

        <label for="pass"> Password:</label><br>
        <input class="form-control" type="password" id="password" name="password">
        <span style="color: red;" class="error" id="pass_err"> </span><br>

        <input class="btn" type="button" value="Sign Up" id="btnsignup" />&nbsp; <a href="signin.php"><input class="btn" type="button" value="Sign In" /></a>
        <br />
    </div>
</div>
<br /><br /><br /><br /><br />


<script>
    $(document).ready(function() {
        $('#fullname').on('input', function() {
            checkname();
        });
        $('#email').on('input', function() {
            checkemail();
        });
        $('#password').on('input', function() {
            checkpass();
        });
        $('#username').on('input', function() {
            checkusername();
        });
        $('#phone').on('input', function() {
            checkphone();
        });

        $('#btnsignup').click(function() {


            if (!checkname() && !checkemail() && !checkpass() && !checkusername() && !checkphone()) {
                console.log("er1");
                $("#message").html(`<div class="alert alert-warning">Please fill all required field</div>`);
            } else if (!checkname() || !checkemail() || !checkpass() || !checkusername() || !checkphone()) {
                $("#message").html(`<div class="alert alert-warning">Please fill all required field</div>`);
                console.log("er");
            } else {

                var fname = $('#fullname').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var username = $('#username').val();
                var pass = $('#password').val();

                $.ajax({

                    url: 'loginconfig.php',
                    type: 'POST',
                    data: {
                        Signup: 1,
                        f_name: fname,
                        s_email: email,
                        s_phone: phone,
                        s_username: username,
                        s_pass: pass,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response) {
                            blankfield();
                            swal("Good job!", "Your Account Has Been Registered!", "success").then(function() {
                                window.location = "signin.php";
                            });
                        } else {
                            var errr = "You Account Has Not Been Registered. Try Again!";
                        }
                    },
                    error: function(err) {
                        alert("Api Call Failed");
                    },

                });

                function blankfield() {
                    $('#fullname').val("");
                    $('#email').val("");
                    $('#phone').val("");
                    $('#password').val("");
                    $('#username').val("");
                }

            }
        });
    });


    function checkname() {
        var pattern = /^[a-zA-Z]{4,}(?: [a-zA-Z]+)?(?: [a-zA-Z]+)?$/;
        var user = $('#fullname').val();
        var validuser = pattern.test(user);
        if ($('#fullname').val().length < 4) {
            $('#name_err').html('username length is too short');
            return false;
        } else if (!validuser) {
            $('#name_err').html('username should be a-z ,A-Z only');
            return false;
        } else {
            $('#name_err').html('');
            return true;
        }
    }

    function checkemail() {
        var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var email = $('#email').val();
        var validemail = pattern1.test(email);
        if (email == "") {
            $('#email_err').html('required field');
            return false;
        } else if (!validemail) {
            $('#email_err').html('invalid email');
            return false;
        } else {
            $('#email_err').html('');
            return true;
        }
    }

    function checkpass() {
        console.log("sass");
        var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        var pass = $('#password').val();
        var validpass = pattern2.test(pass);

        if (pass == "") {
            $('#pass_err').html('password can not be empty');
            return false;
        } else if (!validpass) {
            $('#pass_err').html('Minimum 5 and upto 15 characters, at least one uppercase letter, one lowercase letter, one number and one special character:');
            return false;

        } else {
            $('#pass_err').html("");
            return true;
        }
    }

    function checkusername() {
        var pass = $('#username').val();
        var cpass = $('#username').val();
        if (cpass == "") {
            $('#username_err').html('confirm password cannot be empty');
            return false;
        } else if (pass !== cpass) {
            $('#username_err').html('confirm password did not match');
            return false;
        } else {
            $('#username_err').html('');
            return true;
        }
    }

    function checkphone() {
        if (!$.isNumeric($("#phone").val())) {
            $("#phone_err").html("only number is allowed");
            return false;
        } else if ($("#phone").val().length != 11) {
            $("#phone_err").html("11 digit required");
            return false;
        } else {
            $("#phone_err").html("");
            return true;
        }
    }
</script>


<?php include 'footer.php' ?>