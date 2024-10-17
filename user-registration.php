<?php
    use DataSource\user;

    if (!empty($_POST["signup-btn"])) {
        require_once './Model/user.php';
        $user = new user();
        $registrationResponse = $user->registeruser();
    }
?>

<html>
<head>
    <title>User Registration</title>
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h3 class="card-title text-center">Registration</h3>
                        <?php
                            if (!empty($registrationResponse["status"])) {
                                if ($registrationResponse["status"] == "error") {
                                    echo '<div class="alert alert-danger">' . $registrationResponse["message"] . '</div>';
                                } else if ($registrationResponse["status"] == "success") {
                                    echo '<div class="alert alert-success">' . $registrationResponse["message"] . '</div>';
                                }
                            }
                        ?>
                        <form name="sign-up" action="" method="post" onsubmit="return signupValidation()">
                            <div class="mb-3">
                                <label for="username" class="form-label">
                                    <span class="required error">
                                        <i class="fas fa-user"></i>
                                    </span> Username
                                </label>
                                <input class="form-control" type="text" name="username" id="username">
                                <span class="required error" id="username-info"></span>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <span class="required error">
                                        <i class="fas fa-envelope"></i>
                                    </span> Email
                                </label>
                                <input class="form-control" type="email" name="email" id="email">
                                <span class="required error" id="email-info"></span>
                            </div>
                            <div class="mb-3">
                                <label for="signup-password" class="form-label">
                                    <span class="required error">
                                        <i class="fas fa-lock"></i>
                                    </span> Password
                                </label>
                                <input class="form-control" type="password" name="signup-password" id="signup-password">
                                <span class="required error" id="signup-password-info"></span>
                            </div>
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">
                                    <span class="required error">
                                        <i class="fas fa-lock"></i>
                                    </span> Confirm Password
                                </label>
                                <input class="form-control" type="password" name="confirm-password" id="confirm-password">
                                <span class="required error" id="confirm-password-info"></span>
                            </div>
                            <div class="mb-3">
                                <div class="error-msg" id="error-msg"></div>
                            </div>
                            <div class="mb-3">
                                <input class="btn btn-primary" type="submit" name="signup-btn" id="signup-btn" value="Sign up">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        Already have an account? <a href="index.php">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/js/bootstrap.bundle.min.js"></script>y
	<script>
    $(document).ready(function() {
        clearErrorFields();

        function clearErrorFields() {
            $("#username").removeClass("error-field");
            $("#email").removeClass("error-field");
            $("#signup-password").removeClass("error-field");
            $("#confirm-password").removeClass("error-field");
            $("#username-info").html("").hide();
            $("#email-info").html("").hide();
            $("#signup-password-info").html("").hide();
            $("#confirm-password-info").html("").hide();
            $("#error-msg").html("").hide();
        }

        function signupValidation() {
            clearErrorFields();

            var valid = true;
            var UserName = $("#username").val();
            var email = $("#email").val();
            var Password = $('#signup-password').val();
            var ConfirmPassword = $('#confirm-password').val();
            var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

            if (UserName.trim() == "") {
                $("#username-info").html("required.").css("color", "#ee0000").show();
                $("#username").addClass("error-field");
                valid = false;
            }
            if (email == "") {
                $("#email-info").html("required").css("color", "#ee0000").show();
                $("#email").addClass("error-field");
                valid = false;
            } else if (email.trim() == "") {
                $("#email-info").html("Invalid email address.").css("color", "#ee0000").show();
                $("#email").addClass("error-field");
                valid = false;
            } else if (!emailRegex.test(email)) {
                $("#email-info").html("Invalid email address.").css("color", "#ee0000").show();
                $("#email").addClass("error-field");
                valid = false;
            }
            if (Password.trim() == "") {
                $("#signup-password-info").html("required.").css("color", "#ee0000").show();
                $("#signup-password").addClass("error-field");
                valid = false;
            }
            if (ConfirmPassword.trim() == "") {
                $("#confirm-password-info").html("required.").css("color", "#ee0000").show();
                $("#confirm-password").addClass("error-field");
                valid = false;
            }
            if (Password != ConfirmPassword) {
                $("#error-msg").html("Both passwords must be the same.").show();
                valid = false;
            }
            if (valid == false) {
                $('.error-field').first().focus();
            }
            return valid;
        }

        $("form[name='sign-up']").submit(function(event) {
            if (!signupValidation()) {
                event.preventDefault();
            }
        });
    });
</script>

</body>
</html>
