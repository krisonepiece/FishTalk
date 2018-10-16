<?php 
require_once('php/Check_Identity.php'); 
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
			background-image: url(images/bg-masthead.jpg);
            background-color: #e7feff;
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
		?>
		<!--main content start-->
		<section id="main-content">
			<section class="wrapper">
				<?php
				require_once( 'php/Message.php' );
				?>

				<div class="row">
					<center>
					<div class="row mt">								
					<div class="col-lg-12" style="background-color:white; margin-bottom: 40px">
					
						<img src='images/Logo.png' width='800' height='200' style='margin-top: 1%; margin-bottom: 1%'/>
					</div>
					</div>
					<div class="col-lg-4" >
					<img src='images/matching.png' width='300' height='250'/>
						<h1 style="color: white">配對</h1>
						<div class="col-lg-6" style="left:25%">						
						<h4 style="color: white">尋找世界各地的專家、業者們，在研究、建議和規劃上給予協助</h4>
						</div>	
					</div>
					<div class="col-lg-4">
						<img src='images/study.png' width='250' height='250'/>
						<h1 style="color: white">學習</h1>
						<div class="col-lg-6" style="left:25%">						
						<h4 style="color: white">讓漁產業者認識海洋管理委員會的各項漁業增能工具，透過這個城市讓業者進行自主學習</h4>
						</div>	
					</div>
					<div class="col-lg-4">
					<img src='images/exam.png' width='250' height='250'/>
						<h1 style="color: white">認證</h1>
						<div class="col-lg-6" style="left:25%">						
						<h4 style="color: white">透過世界各國的專家、研究人員和博士研究生的協助，輕鬆取得永續認證</h4>
						</div>	
					</div>
					<a href="matching.php" class="btn btn-warning btn-xl" style="margin-top: 20px">開始配對</a>
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