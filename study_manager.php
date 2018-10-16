<?php
require_once( 'php/Check_Identity.php' );

$account = $_SESSION[ 'account' ];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="facility" content="Kris">
	<meta name="keyword" content="Booking">

	<title>FISHTALK 課程管理</title>

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
		show_sidebar( 'study_manager' );
		?>
		<!--main content start-->
		<section id="main-content">
			<section class="wrapper">
				<?php
				require_once( 'php/Message.php' );
				require_once( 'php/Connect_DB.php' );
				/* 查詢課程 */
				$query = "	SELECT	tool.*
							FROM 	study R, tool
							WHERE	R.number != tool.number AND
									R.account = '$account';";
				$result = mysqli_query( $conn, $query );
				$count = mysqli_num_rows( $result );
				if ( $count > 0 ) {
					echo "<div class='row mt'>";
					echo "<div class='col-md-12'>";
					echo "<div class='content-panel table-responsive'>";
					echo "<table class='table table-striped table-advance table-hover'>";
					echo "<h4><i class='fa fa-angle-right'></i> 課程管理 (未學習)</h4>";
					echo "<hr>";
					echo "<thead>";
					echo "<tr>";
					echo "<th  width='150px'><i class='fa fa-user-circle'></i> 課程名稱</th>";
					echo "<th  width='200px'><i class='fa fa-id-card-o'></i> 課程說明</th>";
					echo "<th  width='200px'><i class='fa fa-user'></i> 課程連結</th>";
					echo "<th  width='80px'></th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ( $row = mysqli_fetch_assoc( $result ) ) {
						/* 印出列 */
						echo "<tr>";
						echo "<td>{$row['name']}</td>";
						echo "<td>{$row['note']}</td>";
						echo "<td>{$row['url']}</td>";
						echo "<td>";
						echo "<a class='btn btn-success btn-xs' href='php/Update_Study.php?number={$row['number']}'><i class='fa fa-check'></i></a>";
						echo "</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
					echo "</div>";
					echo "</div>";
					echo "</div>";
				}
				?>

				<!--------------------------------------------------------------------------->
				<?php
				require_once( 'php/Message.php' );
				require_once( 'php/Connect_DB.php' );
				/* 查詢課程 */
				$query = "	SELECT	tool.*
							FROM 	study R, tool
							WHERE	R.number = tool.number AND
									R.account = '$account';";
				$result = mysqli_query( $conn, $query );
				$count = mysqli_num_rows( $result );
				if ( $count > 0 ) {
					echo "<div class='row mt'>";
					echo "<div class='col-md-12'>";
					echo "<div class='content-panel table-responsive'>";
					echo "<table class='table table-striped table-advance table-hover'>";
					echo "<h4><i class='fa fa-angle-right'></i> 課程管理 (已學習)</h4>";
					echo "<hr>";
					echo "<thead>";
					echo "<tr>";
					echo "<th  width='150px'><i class='fa fa-user-circle'></i> 課程名稱</th>";
					echo "<th  width='200px'><i class='fa fa-id-card-o'></i> 課程說明</th>";
					echo "<th  width='200px'><i class='fa fa-user'></i> 課程連結</th>";
					echo "<th  width='80px'></th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ( $row = mysqli_fetch_assoc( $result ) ) {
						/* 印出列 */
						echo "<tr>";
						echo "<td>{$row['name']}</td>";
						echo "<td>{$row['note']}</td>";
						echo "<td>{$row['url']}</td>";
						echo "<td>";
						echo "</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
					echo "</div>";
					echo "</div>";
					echo "</div>";
				}
				?>
				
				</table>
				</div>
				<!-- /content-panel -->
				</div>
				<!-- /col-md-12 -->
				</div>
				<!-- /row -->
				<!-- 新增 Modal -->
				<div aria-hidden="true" aria-labelledby="addModalLabel" role="dialog" tabindex="-1" id="addModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form enctype="multipart/form-data" id="addForm" class="form-horizontal style-form" action="php/Insert_Admin.php" method="post">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">新增系統帳號</h4>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label class="col-sm-2 control-label">帳號</label>
										<div class="col-sm-10">
											<input type="text" name="aid" id="aid" class="form-control" autofocus required maxlength="16">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">密碼</label>
										<div class="col-sm-10">
											<input type="password" name="apassword" id="apassword" class="form-control" required rangelength="6,20">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">確認密碼</label>
										<div class="col-sm-10">
											<input type="password" name="confirm_apassword" id="confirm_apassword" class="form-control" required equalTo="#apassword">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">姓名</label>
										<div class="col-sm-10">
											<input type="text" name="aname" id="aname" class="form-control" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">E-mail</label>
										<div class="col-sm-10">
											<input type="email" name="email" id="email" class="form-control required email">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">身份</label>
										<div class="col-sm-10">
											<input type="hidden" name="rid" id="rid" value="1">
											<label class="control-label">系統管理員</label>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
									<button class="btn btn-theme" type="submit">新增</button>
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
	<script>
		$( "form" ).validate();
		$( "#addForm" ).validate();
	</script>

</body>

</html>