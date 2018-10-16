<?php
require_once( 'php/Check_Identity.php' );
require_once( 'php/Connect_DB.php' );

if ( $_GET ) {
	$account = $_GET[ "account" ];
	$identity = $_SESSION['identity'];


//	if ( $identity == 2 ) { //研究人員
		/* 取得漁產業者資料 */
		$query = "	SELECT	member.*
					FROM 	member
					WHERE 	member.account = '$account';";	
		$result = mysqli_query( $conn, $query );
		$member = mysqli_fetch_assoc( $result );
}
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
				
				<div class="row mt">								
					<div class="col-lg-6">
					<?php
						if( $identity == 2 ) { //研究人員
						?>
						<div class="form-panel">
							<div class="centered" style="margin-bottom: 20px">
								<img src="images/boat.png" style="max-height: 500px; max-width: 500px;">
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">帳號</label>
								<div class="col-sm-9">
									<p>
										<?php echo $member['account'] ?>
									</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">等級</label>
								<div class="col-sm-9">
									<p>
										<?php echo $member['level'] ?>
									</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">自我介紹</label>
								<div class="col-sm-9">
									<p>
										<?php echo $member['introduction'] ?>
									</p>
								</div>
							</div>							
							<div class="form-group">
								<label class="col-sm-3 control-label">漁船</label>
								<div class="col-sm-9">
									<table class="table table-bordered table-striped table-condensed">
										<thead>
											<tr>
												<th>船型</th>
												<th>捕撈魚種</th>
												<th>作業地點</th>
												<th>研究需求</th>
											</tr>
										</thead>
										<tbody>
											
											<?php
											/* 取得漁產業者資料 */
											$query = "	SELECT	member.*, boat.*
														FROM 	boat
														LEFT JOIN member ON member.account = boat.account
														WHERE 	member.level != 0 AND
																member.identity = 3 AND
																member.account = '$account';";		
											
											$result = mysqli_query( $conn, $query );
											while ( $row = mysqli_fetch_assoc( $result ) ) {
												echo "<tr>";
												echo "<td>{$row['type']}</td>";
												echo "<td>{$row['spicies']}</td>";
												echo "<td>{$row['location']}</td>";
												echo "<td>{$row['requirement']}</td>";
												echo "</tr>";
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
							<div align="center">
								<a class="btn btn-default" href="matching_list.php">返回</a>
							</div>
						</div>
						<?php	
						}else if ( $identity == 3 ) { //漁產業者							
						?>
						<div class="form-panel">
							<div class="centered" style="margin-bottom: 20px">
								<img src="images/researcher.png" style="max-height: 500px; max-width: 500px;">
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">帳號</label>
								<div class="col-sm-9">
									<p>
										<?php echo $member['account'] ?>
									</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">等級</label>
								<div class="col-sm-9">
									<p>
										<?php echo $member['level'] ?>
									</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">自我介紹</label>
								<div class="col-sm-9">
									<p>
										<?php echo $member['introduction'] ?>
									</p>
								</div>
							</div>		
							<?php
							$query = "SELECT	R.*, D.username AS dname, researcher.*
										FROM 	researcher
										LEFT JOIN member AS R ON R.account = researcher.account
										LEFT JOIN member AS D ON D.account = researcher.department
										WHERE 	R.level != 0 AND
												R.identity = 2 AND
												R.account = '{$account}';";
							$result = mysqli_query( $conn, $query );
							$researcher = mysqli_fetch_assoc( $result );
							?>			
							<div class="form-group">
								<label class="col-sm-3 control-label">研究專長</label>
								<div class="col-sm-9">
									<p>
										<?php echo $researcher['skill'] ?>
									</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">研究經驗</label>
								<div class="col-sm-9">
									<p>
										<?php echo $researcher['study'] ?>
									</p>
								</div>
							</div>		
							<div class="form-group">
								<label class="col-sm-3 control-label">實務經驗</label>
								<div class="col-sm-9">
									<p>
										<?php echo $researcher['practice'] ?>
									</p>
								</div>
							</div>	
							<div class="form-group">
								<label class="col-sm-3 control-label">方便聯絡時間</label>
								<div class="col-sm-9">
									<p>
										<?php echo $researcher['contact'] ?>
									</p>
								</div>
							</div>	
							<div align="center">
								<a class="btn btn-default" href="matching_list.php">返回</a>
							</div>
						</div>
						<?php 
						} 
						?>
					</div>
					<!-- col-lg-12-->
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

</body>

</html>