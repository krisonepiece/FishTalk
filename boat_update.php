<?php 
require_once( 'php/Check_Indentity.php' );
require_once( 'php/Connect_DB.php' );

if ( $_GET ) {
	$number = $_GET[ 'number' ];
	$account = $_SESSION[ 'account' ];

	/* 取得身份資料 */
	$stmt = $conn->prepare( "	SELECT	boat.*
								FROM 	boat
								WHERE 	number = ?;" );
	$stmt->bind_param( "i", $number );
	$stmt->execute();
	$boat = $stmt->get_result()->fetch_assoc();
	$stmt->free_result();
	$stmt->close();
	}
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
		show_sidebar('boat_manager');
		?>
		<!--main content start-->
		<section id="main-content">
			<section class="wrapper">
				<h3><i class="fa fa-angle-right"></i> 更新漁船</h3>

				<!-- BASIC FORM ELELEMNTS -->
				<div class="row mt">
					<div class="col-lg-12">
						<div class="form-panel">
							<form class="form-horizontal style-form" action="php/Update_Boat.php?number=<?php  echo $number ?>" method="post">
								<div class="form-group">
									<label class="col-sm-2 control-label">船型</label>
									<div class="col-sm-10">
										<input type="text" name="type" id="type" class="form-control" required maxlength="28" value="<?php echo $boat['type'] ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">捕撈魚種</label>
									<div class="col-sm-10">
										<input type="text" name="spicies" id="spicies" class="form-control" required maxlength="98" value="<?php echo $boat['spicies'] ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">作業地點</label>
									<div class="col-sm-10">
										<input type="text" name="location" id="location" class="form-control" required maxlength="98" value="<?php echo $boat['location'] ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">研究需求</label>
									<div class="col-sm-10">
										<input type="text" name="requirement" id="requirement" class="form-control" required maxlength="98" value="<?php echo $boat['requirement'] ?>">
									</div>
								</div>
								<div align="center">
								<a class="btn btn-default" href="boat_manager.php">取消</a>
								<button class="btn btn-theme" type="submit">更新</button>
								</div>
							</form>
						</div>
					</div>
					<!-- col-lg-12-->
				</div>
				<!-- /row -->
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


	<!--common script for all pages-->
	<script src="assets/js/common-scripts.js"></script>

	<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
	<script type="text/javascript" src="assets/js/gritter-conf.js"></script>

	<!--script for this page-->
	<script src="assets/js/sparkline-chart.js"></script>
	<script src="assets/js/zabuto_calendar.js"></script>
</body>
</html>