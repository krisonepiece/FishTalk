<?php
require_once( 'php/Connect_DB.php' );

if ( $_POST ) {
	foreach ( $_POST as $key => $value ) {
		$$key = $value;
	}

	/* 檢查該帳號是否存在 */
	$stmt = $conn->prepare( "SELECT account from member WHERE account = ?" );
	$stmt->bind_param( "s", $account );
	$stmt->execute();
	$stmt->store_result();
	if ( $stmt->num_rows > 0 ) {
		// user existed 
		$stmt->close();
		$result = 'repeat';
	} else {
		/* 新增會員資料 */
		$hash = hashSSHA( $password );
		$encrypted_password = $hash[ "encrypted" ]; // encrypted password
		$salt = $hash[ "salt" ]; // salt
		//member table
		$stmt = $conn->prepare( "INSERT INTO member(account, password, salt, username, email, introduction, identity, zone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)" );
		$stmt->bind_param( "ssssssss", $account, $encrypted_password, $salt, $username, $email, $introduction, $identity, $zone);
		$result = $stmt->execute();
		//researcher table
		if($identity == 2) {
			$stmt = $conn->prepare("INSERT INTO researcher(account) VALUES(?)");
			$stmt->bind_param("s", $account);
			$result = $stmt->execute();
		}
		$stmt->close();
		
		/* 檢查是否新增成功 */
		if ( $result ) {
			$stmt = $conn->prepare( "SELECT * FROM member WHERE account = ?" );
			$stmt->bind_param( "s", $account );
			$stmt->execute();
			$user = $stmt->get_result()->fetch_assoc();
			$stmt->close();
			$result = $user[ 'account' ];

			/* 寄信 */

			$mailToname = $username; //收件者
			$mailTo = $email; //收件者
			$mailfromname = "預約系統"; //寄件者姓名
			$mailfrom = "m053040018@student.nsysu.edu.tw"; //寄件者電子郵件
			$mailSubject = "FISHTALK - 註冊成功通知"; //主旨
			$mailContent = "
				<html>
				<body>
					<p>
					===========================================<br>
					FISHTALK<br>
					===========================================<br>
					</p>
					<p>
					{$username} 您好：<br>
				   我們將盡快審核您的註冊資訊，並寄信通知審核結果，感謝您的註冊！<br>
					===========================================<br><br>

					CHEM 系統機器人
					</p>
				</body>
				</html>
					"; //內容
			//以下內容不要改
			$mailTo = "=?UTF-8?B?" . base64_encode( $mailToname ) . "?= <" . $mailTo . ">";
			$mailfrom = "=?UTF-8?B?" . base64_encode( $mailfromname ) . "?= <" . $mailfrom . ">";
			$mailSubject = "=?UTF-8?B?" . base64_encode( $mailSubject ) . "?="; //主旨編碼成UTF-8

			if ( !mail( $mailTo, $mailSubject, $mailContent, "Mime-Version: 1.0\nFrom:" . $mailfrom . "\nContent-Type: text/html ; charset=UTF-8" ) ) {
				$result = 'failure';
			}

		} else {
			$result = 'failure';
		}
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
				<h2 class="form-login-heading">會員註冊資訊</h2>
				<div class="login-wrap">
					<?php 
						if($result == 'failure')
							echo "<p>註冊失敗！請稍後再試，謝謝！</p>";								
						else if($result == 'repeat')
							echo "<p>該帳號已被註冊！請嘗試其他帳號，謝謝！</p>";
						else
							echo "<p>{$username} 您好！</p></br><p>我們將盡快審核您的註冊資訊，並寄信通知審核結果，感謝您的註冊！</p>";				
					?>
					</label>
					<button class="btn btn-theme btn-block" href="login.php" type="submit"><i class="fa fa-home"></i> 返回</button>
					<hr>
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
		$.backstretch( "assets/img/login-bg.jpg", {
			speed: 500
		} );
	</script>


</body>

</html>