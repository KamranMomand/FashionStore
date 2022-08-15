<?php
include 'header.php'
?>

<br />

<div class="container col-md-3">
    <div id="message"></div>

    <h2>Sign In</h2><br />
    <label for="fname"> Email:</label><br>
    <input class="form-control" type="text" id="email" name="email">
    <span style="color: red;" class="error" id="email_err"> </span><br>
    <label for="lname">Password:</label><br>
    <input class="form-control" type="password" id="pass" name="pass">
    <span style="color: red;" class="error" id="pass_err"> </span><br><br>
    <input class="btn" type="button" value="Sign In" id="btnsignin" />&nbsp; <a href="signup.php"><input class="btn" type="button" value="Sign Up" /></a><br />
    <span id="msgdisplayl"></span>

</div>
<br />

<script>
    $(document).ready(function() {

        $('#email').on('input', function() {
            checkemail();
        });
        $('#pass').on('input', function() {
            checkpass();
        });

        $('#btnsignin').click(function() {


            if (!checkemail() && !checkpass()) {
                console.log("er1");
                $("#message").html(`<div class="alert alert-warning">Please fill all required field</div>`);
            } else if (!checkemail() || !checkpass()) {
                $("#message").html(`<div class="alert alert-warning">Please fill all required field</div>`);
                console.log("er");
            } else {

                var emaill = $('#email').val();
                var passl = $('#pass').val();
                $.ajax({

                    url: 'loginconfig.php',
                    type: 'POST',
                    data: {
                        Signin: 1,
                        l_email: emaill,
                        l_pass: passl,
                    },
                    success: function(response) {
                        if (response) {
                            var msg = "";
                            if (response == 1) {
                                swal("Good job!", "Login Successfully!", "success").then(function() {
                                    window.location = "allproducts.php";
                                });
                            } else {
                                $("#message").html(`<div class="alert alert-warning">Invalid Account</div>`);
                            }

                        }
                    },
                    error: function(err) {
                        alert("Api Call Failed");
                    },

                });

            }
        });
    });

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
        var pass = $('#pass').val();
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
</script>
<?php include 'footer.php' ?>