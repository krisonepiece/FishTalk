<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Pacific Alliances">
	<meta name="keyword" content="FishTalk">

	<title>FishTalk</title>

	<!-- Bootstrap core CSS -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<!--external css-->
	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>

	<!-- Custom styles for this template -->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/style-responsive.css" rel="stylesheet">
	<style type="text/css">
		#pwddialog {
			width: 400px;
		}
	</style>

</head>

<body>

	<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	<div id="login-page">
		<div class="container">
			<form class="form-login" action="php/Check_Login.php" method="post">
				<h2 class="form-login-heading"><b>FishTalk</b></h2>
				<div class="login-wrap">
					<input type="text" name="account" class="form-control" placeholder="帳號" autofocus required maxlength="16">
					<br>
					<input type="password" name="password" class="form-control" placeholder="密碼" required maxlength="20">

					<label class="checkbox">
                		<span class="pull-left">
		                    <?php
								if(isset($_GET['msg']) && $_GET['msg'] == 0)
									echo "<p style='color:red'>帳號或密碼輸入錯誤！</p>";
								else if(isset($_GET['msg']) && $_GET['msg'] == 1)
									echo "<p style='color:red'>此帳號尚未通過審核！</p>";
							?>		
		                </span>	                
		                <span class="pull-right">
		                    <a data-toggle="modal" href="../login.php#pwdModal"> 忘記密碼</a>		
		                </span>
		            </label>
				

					<button class="btn btn-theme btn-block" href="php/Check_Login.php" type="submit"><i class="fa fa-lock"></i> 登入</button>	
					<hr>
					<div class="registration">
						第一次使用FishTalk嗎？<br/>
						<a class="" href="sign_up.php">
		                	建立帳號
		                </a>					
					</div>					
				</div>				
			</form>			
			<!-- Modal -->
			<!-- password_forget -->
			<div aria-hidden="true" aria-labelledby="pwdModalLabel" role="dialog" tabindex="-1" id="pwdModal" class="modal fade">
				<div class="modal-dialog" id="pwddialog">
					<div class="modal-content">
						<form id="pwdForm" class="form-horizontal style-form" action="password_forget.php" method="post">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">忘記密碼</h4>
							</div>
							<div class="modal-body">
								<p>請輸入帳號及電子郵件，系統將會發送新的密碼至您的信箱。</p>
								<input type="text" name="account" id="account" class="form-control" placeholder="帳號" autofocus required maxlength="16">
								<br>
								<input type="email" name="email" id="email" class="form-control required email" placeholder="E-mail">

							</div>
							<div class="modal-footer">
								<button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
								<button class="btn btn-theme" type="submit">發送</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- modal -->
		</div>		
	</div>
	</br><p class="centered" style="color: white;">Pacific Alliance </p>
	<p class="centered"></p>
	<!-- js placed at the end of the document so the pages load faster -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!--BACKSTRETCH-->
	<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
	<script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
	<script>
		$.backstretch( "images/bg-masthead.jpg", {
			speed: 500
		} );
	</script>


</body>

</html>