<?php
require_once( 'php/Check_Identity.php' );
require_once( 'php/Connect_DB.php' );

$account = $_SESSION[ 'account' ];

/* 取得帳號資料 */
$stmt = $conn->prepare( "	SELECT	*
							FROM 	member, researcher
							WHERE 	member.account = ? ;" );
$stmt->bind_param( "s", $account );
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->free_result();
$stmt->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Kris">
	<meta name="keyword" content="Booking">

	<title>FISHTALK</title>

	<!-- Bootstrap core CSS -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<!--external css-->
	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
	<link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css"/>
	<link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">

	<!-- Custom styles for this template -->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/style-responsive.css" rel="stylesheet">

	<script src="assets/js/chart-master/Chart.js"></script>

	<?php 
		require_once('php/Show_Function.php');
	?>
</head>

<body>

	<section id="container">
		<?php
		show_header();
		show_sidebar( 'personal' );
		?>
		<!--main content start-->
		<section id="main-content">
			<section class="wrapper">
				<?php
				require_once( 'php/Message.php' );
				?>
				<h3><i class="fa fa-angle-right"></i> 個人資料</h3>
				<!-- BASIC FORM ELELEMNTS -->
				<div class="row mt">
					<div class="col-lg-6">
						<div class="form-panel">
							<form class="form-horizontal style-form" action="php/Update_Personal.php" method="post">
								<div class="form-group">
									<label class="col-sm-3 control-label">帳號</label>
									<div class="col-sm-8">
										<p class="form-control-static" name="account">
											<?php echo $account ?>
										</p>
										<input type="hidden" name="account" id="account" value="<?php echo $user['account'] ?>">
										<a data-toggle="modal" href="personal.php#pwdModal"> 修改密碼</a>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">姓名</label>
									<div class="col-sm-8">
										<p class="form-control-static" name="username">
											<?php echo $user['username'] ?>
										</p>
										<input type="hidden" name="username" id="username" value="<?php echo $user['username'] ?>">
									</div>
								</div>							
								<div class="form-group">
									<label class="col-sm-3 control-label">身份</label>
									<div class="col-sm-8">
										<p class="form-control-static" name="identity">
											<?php
											if($user['identity'] == '1') {
												echo '<option>單位</option>';	
											} else if($user['identity'] == '2') {
												echo '<option>研究人員</option>';
											} else if($user['identity'] == '3') {
												echo '<option>漁產業者</option>';
											}
											?>
										</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">E-mail</label>
									<div class="col-sm-8">
										<input type="email" name="email" id="email" class="form-control required email" value="<?php echo $user['email'] ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">自我介紹</label>
									<div class="col-sm-8">
										<input type="text" name="introduction" id="introduction" class="form-control required" value="<?php echo $user['introduction'] ?>" maxlength="28">
									</div>
								</div>
								<?php
								//researcher
								if($user['identity'] == '2') {
									echo'<div class="form-group">';
										echo'<label class="col-sm-3 control-label">研究單位</label>';
										echo'<div class="col-sm-8">';
											echo'<p class="form-control-static" name="department">';
												echo $user['department'];
											echo'</p>';
											echo'<input type="hidden" name="department" id="department" value="';
											echo $user['department'];
											echo'">';
										echo'</div>';
									echo'</div>';
									echo'<div class="form-group">';
										echo'<label class="col-sm-3 control-label">研究專長</label>';
										echo'<div class="col-sm-8">';
											echo'<input type="text" name="skill" id="skill" class="form-control required" value="'; 
											echo $user['skill'] ; 
											echo'" maxlength="28">';
										echo'</div>';
									echo'</div>';
									echo'<div class="form-group">';
										echo'<label class="col-sm-3 control-label">研究經驗</label>';
										echo'<div class="col-sm-8">';
											echo'<input type="text" name="study" id="study" class="form-control required" value="'; 
											echo $user['study'] ; 
											echo'" maxlength="28">';
										echo'</div>';
									echo'</div>';
									echo'<div class="form-group">';
										echo'<label class="col-sm-3 control-label">實務經驗</label>';
										echo'<div class="col-sm-8">';
											echo'<input type="text" name="practice" id="practice" class="form-control required" value="'; 
											echo $user['practice'] ; 
											echo'" maxlength="28">';
										echo'</div>';
									echo'</div>';
									echo'<div class="form-group">';
										echo'<label class="col-sm-3 control-label">方便聯絡時間</label>';
										echo'<div class="col-sm-8">';
											echo'<input type="text" name="contact" id="contact" class="form-control required" value="'; 
											echo $user['contact'] ; 
											echo'" maxlength="28">';
										echo'</div>';
									echo'</div>';
								}?>				
								<div align="center">
									<button class="btn btn-theme" type="submit">更新</button>
								</div>
							</form>
						</div>
					</div>
					<!-- col-lg-12-->
				</div>
				<!-- /row -->
				<!-- Modal -->
				<div aria-hidden="true" aria-labelledby="pwdModalLabel" role="dialog" tabindex="-1" id="pwdModal" class="modal fade">
					<div class="modal-dialog" id="pwddialog">
						<div class="modal-content">
							<form id="pwdForm" class="form-horizontal style-form" action="php/Update_Personal_Password.php" method="post">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">修改密碼</h4>
								</div>
								<div class="modal-body">
									<input type="hidden" name="account" id="account" value="<?php echo $user['account'] ?>">
									<input type="password" name="password" id="password" class="form-control" placeholder="新密碼" required rangelength="6,20">
									<br>
									<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="確認密碼" required equalTo="#password">

								</div>
								<div class="modal-footer">
									<button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
									<button class="btn btn-theme" type="submit">修改</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- modal -->
			</section>
		</section>

		<!--main content end-->
		<?php
		show_footer();
		?>
	</section>

	<!-- js placed at the end of the document so the pages load faster -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/jquery-1.8.3.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
	<script src="assets/js/jquery.scrollTo.min.js"></script>
	<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
	<script src="assets/js/jquery.sparkline.js"></script>
	<script src="js/jquery-validate/jquery.validate.js"></script>
	<script src="js/jquery-validate/localization/messages_zh_TW.js"></script>


	<!--common script for all pages-->
	<script src="assets/js/common-scripts.js"></script>

	<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
	<script type="text/javascript" src="assets/js/gritter-conf.js"></script>

	<!--script for this page-->
	<script src="assets/js/sparkline-chart.js"></script>
	<script src="assets/js/zabuto_calendar.js"></script>
	<script type="application/javascript">
		$().ready( function () {
			$( "form" ).validate();
			$( "#pwdForm" ).validate();
		} );
	</script>

</body>

</html>