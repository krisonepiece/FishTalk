<?php
require_once( 'php/Connect_DB.php' );
if ( $_POST ) {
	$account = $_POST[ "account" ];
	$email = $_POST[ "email" ];
	$password = random_password( 6 );

	/* 檢查該帳號是否存在 */
	$query = "	SELECT * 
					FROM member 
					WHERE account = '{$account}' AND email = '{$email}';";

	$result = mysqli_query( $conn, $query );

	if ( $result && mysqli_num_rows( $result ) > 0 ) {
		$row = mysqli_fetch_assoc( $result );

		/* 重置密碼 */
		$hash = hashSSHA( $password );
		$encrypted_password = $hash[ "encrypted" ]; // encrypted password
		$ssalt = $hash[ "salt" ]; // salt
		$stmt = $conn->prepare( "	UPDATE 	member 
										SET 	password = ?, salt = ?
										WHERE	account = ? AND email = ?;" );
		$stmt->bind_param( "ssss", $encrypted_password, $ssalt, $account, $email );
		$result = $stmt->execute();
		$stmt->close();

		/* 檢查是否新增成功 */
		if ( $result ) {
			$mailToname = $row[ 'username' ]; //收件者
			$mailTo = $email; //收件者
			$mailfromname = "FISHTALK"; //寄件者姓名
			$mailfrom = "m053040018@student.nsysu.edu.tw"; //寄件者電子郵件
			$mailSubject = "FISHTALK - 忘記密碼通知"; //主旨
			$mailContent = "<html>
				<body>
					<p>
					===========================================<br>
					FISHTALK<br>
					===========================================<br>
					</p>
					<p>
					{$row['username']} 您好：<br>
						   您的新密碼為：{$password}<br>
					請立即登入系統，並更新您的密碼，謝謝！<br>
					===========================================<br><br>

					CHEM 系統機器人
					</p>
				</body>
				</html>"; //內容
			//以下內容不要改
			$mailTo = "=?UTF-8?B?" . base64_encode( $mailToname ) . "?= <" . $mailTo . ">";
			$mailfrom = "=?UTF-8?B?" . base64_encode( $mailfromname ) . "?= <" . $mailfrom . ">";
			$mailSubject = "=?UTF-8?B?" . base64_encode( $mailSubject ) . "?="; //主旨編碼成UTF-8

			if ( mail($mailTo,$mailSubject,$mailContent,"Mime-Version: 1.0\nFrom:" . $mailfrom . "\nContent-Type: text/html ; charset=UTF-8") ) {
				$result = 1;
			} else {
				$result = 0;
			}
		} else {
			$result = 0;
		}
	} else {
		$result = -1;
	}
	mysqli_close( $conn );
}
/* Hash 加密 */
function hashSSHA( $password ) {
	$salt = sha1( rand() );
	$salt = substr( $salt, 0, 10 );
	$encrypted = base64_encode( sha1( $password . $salt, true ) . $salt );
	$hash = array( "salt" => $salt, "encrypted" => $encrypted );
	return $hash;
}
/*預設密碼長度為 6 位 */
function random_password( $length = 6 ) {
	$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.-+=_,!@$#*%<>[]{}";
	$password = substr( str_shuffle( $str ), 0, $length );
	return $password;
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

	<!-- Custom styles for this template -->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/style-responsive.css" rel="stylesheet">
</head>

<body>
	<div id="login-page">
		<div class="container">

			<form class="form-login" action="login.php">
				<h2 class="form-login-heading">忘記密碼</h2>
				<div class="login-wrap">
					<?php 
						if($result == -1)
							echo "<p>您輸入的帳號或E-mail資訊有誤！請重新嘗試，謝謝！</p>";								
						else if($result == 0)
							echo "<p>系統錯誤！請稍後再試，謝謝！</p>";
						else
							echo "<p>已發送新的密碼至您的信箱，請立即確認並更換新的密碼！</p>";				
					?>
					</label>
					<button class="btn btn-theme btn-block" href="login.php" type="submit"><i class="fa fa-home"></i> 返回</button>
				</div>
			</form>

		</div>
	</div>

	<!-- js placed at the end of the document so the pages load faster -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!--BACKSTRETCH-->
	<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
	<script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
	<script>
		$.backstretch( "assets/img/bg.jpg", {
			speed: 500
		} );
	</script>


</body>

</html>