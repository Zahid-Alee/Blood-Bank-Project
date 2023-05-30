<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires ");

use DataSource\user;

if (!empty($_POST["login-btn"])) {
	require_once __DIR__ . '/Model/user.php';
	$user = new user();
	$loginResult = $user->loginuser();
}
?>

<html>

<head>
	<title>Login</title>
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
						<h3 class="card-title text-center">Login</h3>
						<?php if (!empty($loginResult)) { ?>
							<div class="alert alert-danger">
								<?php echo $loginResult; ?>
							</div>
						<?php } ?>
						<form name="login" action="" method="post" onsubmit="return loginValidation()">
							<div class="mb-3">
								<label for="username" class="form-label">
									<span class="required error">
										<i class="fas fa-user"></i>
									</span> Username
								</label>
								<input class="form-control" type="text" name="username" id="username">
							</div>
							<div class="mb-3">
								<label for="login-password" class="form-label">
									<span class="required error">
										<i class="fas fa-lock"></i>
									</span> Password
								</label>
								<input class="form-control" type="password" name="login-password" id="login-password">
							</div>
							<div class="row d-flex">
								<div class="mb-3">
									<input class="btn btn-primary" type="submit" name="login-btn" id="login-btn"
										value="Login">
								</div>
								<div class="mb-3">
									<button class="btn btn-primary" name="signup-btn">
										Register </button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		function loginValidation() {
			var valid = true;
			$("#username").removeClass("error-field");
			$("#password").removeClass("error-field");

			var UserName = $("#username").val();
			var Password = $('#login-password').val();

			$("#username-info").html("").hide();

			if (UserName.trim() == "") {
				$("#username-info").html("required.").css("color", "#ee0000").show();
				$("#username").addClass("error-field");
				valid = false;
			}
			if (Password.trim() == "") {
				$("#login-password-info").html("required.").css("color", "#ee0000").show();
				$("#login-password").addClass("error-field");
				valid = false;
			}
			if (valid == false) {
				$('.error-field').first().focus();
				valid = false;
			}
			return valid;
		}
	</script>
</body>

</html>