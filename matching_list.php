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
		.pn {
			height: 320px;
			margin-top: 20px;
		}
		.multi_ellipsis {
			display: block;
			overflow: hidden;
			display: -webkit-box;
			-webkit-box-orient: vertical;
			-webkit-line-clamp: 1;
			line-height: 15px;
			height: 15px;
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
						<?php					
						require_once( 'php/Connect_DB.php' );
						$account_A = $_SESSION['account'];
						if($identity == 2){	//研究人員
							// 查詢字串
						$keyword = (isset($_GET['keyword'])? $_GET['keyword']: '');
							$query = "	SELECT	member.*, boat.*
										FROM 	boat
										LEFT JOIN member ON member.account = boat.account
										WHERE 	member.level != 0 AND
												member.identity = 3 AND
												(boat.type LIKE '%{$keyword}%' OR
												boat.spicies LIKE '%{$keyword}%' OR
												boat.location LIKE '%{$keyword}%' OR
												boat.requirement LIKE '%{$keyword}%' OR
												'{$keyword}'='') AND
												member.account NOT IN ( SELECT account_A
												FROM matching
												WHERE account_B = '$account_A') AND
												member.account NOT IN ( SELECT account_B
												FROM matching
												WHERE account_A = '$account_A')
										ORDER BY member.level DESC;";
							$result = mysqli_query( $conn, $query );
							while ( $row = mysqli_fetch_assoc( $result ) ) {
								/*  PANEL START  */
								echo "<div class='col-md-4 col-sm-4 col-lg-3'>";
								echo "<a href='matching_detial.php?account={$row['account']}'>";
								echo "<div class='gw-panel pn'>";
								echo "<div class='gw-header'>";
								echo "<h5>{$row['account']}</h5>";
								echo "</div>";
								echo "<div class='centered'>";
								echo "<img src='images/boat.png' width='120px' style='min-height: 120px;' class='img-circle'>";
								echo "</div>";
								echo "<div class='row'>";
								echo "<div class='col-sm-12 col-xs-12 goleft'>";
								echo "<p class='multi_ellipsis'><i class='fa fa-ship'></i>{$row['type']}</p>";
								echo "<p class='multi_ellipsis'><i class='fa fa-anchor'></i>{$row['spicies']}</p>";
								echo "<p class='multi_ellipsis'><i class='fa fa-map-marker'></i>{$row['location']}</p>";
								echo "<p class='multi_ellipsis'><i class='fa fa-info-circle'></i>{$row['requirement']}</p>";
								echo "</div>";								
								echo "</div>";
								echo "<a class='btn btn-sm btn-clear-g' href='php/Insert_Matching.php?account={$row['account']}&keyword={$keyword}' onclick='return confirm(\"邀請{$row['account']}成為好友？\");'>送出邀請</a>";
								echo "</div>";
								echo "</a>";
								echo "</div>";
								/* PANEL END */
							}
						}
						else if($identity == 3){	//漁產業者
								// 查詢字串
						$keyword = (isset($_GET['keyword'])? $_GET['keyword']: '');
							$query = "	SELECT	R.*, D.username AS dname, researcher.*
										FROM 	researcher
										LEFT JOIN member AS R ON R.account = researcher.account
										LEFT JOIN member AS D ON D.account = researcher.department
										WHERE 	R.level != 0 AND
												R.identity = 2 AND
												(researcher.skill LIKE '%{$keyword}%' OR
												researcher.study LIKE '%{$keyword}%' OR
												researcher.practice LIKE '%{$keyword}%' OR
												'{$keyword}'='') AND
												R.account NOT IN ( SELECT account_A
												FROM matching
												WHERE account_B = '$account_A') AND
												R.account NOT IN ( SELECT account_B
												FROM matching
												WHERE account_A = '$account_A')
										ORDER BY R.level DESC;";
							$result = mysqli_query( $conn, $query );
							while ( $row = mysqli_fetch_assoc( $result ) ) {
								/*  PANEL START  */
								echo "<div class='col-md-4 col-sm-4 col-lg-3'>";
								echo "<a href='matching_detial.php?account={$row['account']}'>";
								echo "<div class='gw-panel pn'>";
								echo "<div class='gw-header'>";
								echo "<h5>{$row['account']}</h5>";
								echo "</div>";
								echo "<div class='centered'>";
								echo "<img src='images/researcher.png' width='120px' style='min-height: 120px;' class='img-circle'>";
								echo "</div>";
								echo "<div class='row'>";
								echo "<div class='col-sm-12 col-xs-12 goleft'>";
								echo "<p class='multi_ellipsis'><i class='fa fa-suitcase'></i>{$row['dname']}</p>";
								echo "<p class='multi_ellipsis'><i class='fa fa-star'></i>{$row['skill']}</p>";
								echo "<p class='multi_ellipsis'><i class='fa fa-book'></i>{$row['study']}</p>";
								echo "<p class='multi_ellipsis'><i class='fa fa-wrench'></i>{$row['practice']}</p>";
								echo "</div>";								
								echo "</div>";
								echo "<a class='btn btn-sm btn-clear-g' href='php/Insert_Matching.php?account={$row['account']}&keyword={$keyword}' onclick='return confirm(\"邀請{$row['account']}成為好友？\");'>送出邀請</a>";
								echo "</div>";
								echo "</a>";
								echo "</div>";
								/* PANEL END */
							}
						}
						

						?>
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
	<script src="assets/js/sparkline-chart.js"></script>
	<script src="assets/js/zabuto_calendar.js"></script>

</body>

</html>