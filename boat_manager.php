<?php 
require_once('php/Check_Identity.php'); 
$account = $_SESSION[ 'account' ];
?>

<!DOCTYPE html>
<html lang="en">
	


<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Kris">
	<meta name="keyword" content="Booking">

	<title>FISHTALK 漁船管理</title>

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
				<?php
					require_once('php/Message.php');
				?>
				<div class="row mt">
					<div class="col-md-12">
						<div class="content-panel table-responsive">
							<table class="table table-striped table-advance table-hover">
								<h4><i class="fa fa-angle-right"></i> 漁船管理</h4>
								<hr>
								<thead>
									<tr>
										<th width="150px"><i class="fa fa-tag"></i> 船型</th>
										<th width="150px"><i class="fa fa-bookmark"></i> 捕撈魚種</th>
										<th width="150px"><i class="fa fa-user"></i> 作業地點</th>
										<th width="150px"><i class="fa fa-user"></i> 研究需求</th>
										<th width="100px"><button class='btn btn-info btn-xs' data-toggle="modal" data-target="#addModal"><i class='fa fa-plus'></i></button>
										</th>
									</tr>
								</thead>								
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
							<form enctype="multipart/form-data" id="addForm" class="form-horizontal style-form" action="php/Insert_Boat.php" method="post">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">新增漁船</h4>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label class="col-sm-2 control-label">船型</label>
										<div class="col-sm-10">
											<input type="text" name="type" id="type" class="form-control" required maxlength="28">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">捕撈魚種</label>
										<div class="col-sm-10">
											<input type="text" name="spicies" id="spicies" class="form-control" maxlength="98">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">作業地點</label>
										<div class="col-sm-10">
											<input type="text" name="location" id="location" class="form-control" maxlength="98">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">研究需求</label>
										<div class="col-sm-10">
											<input type="text" name="requirement" id="requirement" class="form-control" maxlength="98">
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
		$("form").validate();
	</script>

</body>

</html>