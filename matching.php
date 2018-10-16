<?php 
require_once('php/Check_Identity.php'); 
$identity = $_SESSION['identity'];
?>
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
	<link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css"/>
	<link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">

	<!-- Custom styles for this template -->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/style-responsive.css" rel="stylesheet">

	<style type="text/css">
		
		body {
            background-color: #0299ff;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }
	</style>
	<?php 
		require_once('php/Show_Function.php');
	?>
</head>

<body>

	<section id="container">
		<?php
		show_header();
		show_sidebar( 'matching' );
		?>
		<!--main content start-->
		<section id="main-content">
			<section class="wrapper">
				<?php
				require_once( 'php/Message.php' );
				?>

				<div class="row">
					<center>
						<?php
							if($identity == 2)	//研究人員
								echo "<img src='images/matching_fishman.png' width='400' height='400' style='margin-top: 10%'/>";
							else if($identity == 3)	//漁產業者
								echo "<img src='images/matching_researcher.png' width='400' height='400' style='margin-top: 10%'/>";
						?>
						<h2 style="color: white">一起為海洋資源盡一份力吧！</h2>
						<form class="form-horizontal style-form form-inline" action="matching_list.php" method="get"  style="display: inline">
							<div class="col-sm-12">
								<input type="text" name="keyword" id="keyword" style="width: 180px" class="form-control" required>
								<button type="submit" class="btn btn-theme"><i class="fa fa-search"></i> 配對</button>
							</div>
						</form>
					</center>
				</div>
				<!--/row -->
			</section>
		</section>

		<!--main content end-->
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

</body>

</html>