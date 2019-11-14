<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>Animarl</title>
<!-- Favicon-->
<link rel="icon" href="../../favicon.ico" type="image/x-icon">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<!-- Bootstrap Core Css -->
<link href="../../assets/cms/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<!-- Waves Effect Css -->
<link href="../../assets/cms/plugins/node-waves/waves.css" rel="stylesheet" />
<!-- Animation Css -->
<link href="../../assets/cms/plugins/animate-css/animate.css" rel="stylesheet" />
<!-- Custom Css -->
<link href="../../assets/cms/css/style.css" rel="stylesheet">
</head>
<body class="signup-page">
<div class="signup-box">
	<div class="logo">
		<a href="javascript:void(0);"><b>Animarl</b></a>
		<small>新規会員登録</small>
		<!-- <small>Admin BootStrap Based - Material Design</small> -->
	</div>
	<div class="card">
		<div class="body">
			<form action="../cl_login/check_email" method="POST">
				<div class="msg">まず初めにEmailを登録してください</div>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">email</i>
					</span>
					<div class="form-line">
						<input type="email" class="form-control" name="email" placeholder="メールアドレス" required>
					</div>
				</div>
				<!-- <div class="form-group">
							<input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
							<label for="terms">I read and agree to the <a href="javascript:void(0);">terms of
										usage</a>.</label>
						</div> -->
				<button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>

				<div class="m-t-25 m-b--5 align-center">
					<a href="login">アカウントを持っていますか?</a>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Jquery Core Js -->
<script src="../../assets/cms/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../../assets/cms/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../../assets/cms/plugins/node-waves/waves.js"></script>

<!-- Validation Plugin Js -->
<script src="../../assets/cms/plugins/jquery-validation/jquery.validate.js"></script>

<!-- Custom Js -->
<script src="../../assets/cms/js/admin.js"></script>
<script src="../../assets/cms/js/pages/examples/sign-up.js"></script>
</body>

</html>