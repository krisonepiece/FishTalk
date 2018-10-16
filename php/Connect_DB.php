<?php
	/* 資料庫連線資訊 */
	$dbhost = '140.117.169.140';
	$dbuser = 'fishtalk';
	$dbpass = 'fish2018';
	$dbname = 'fishtalk';

	/* 建立資料庫連線 */
	$conn = mysqli_connect( $dbhost, $dbuser, $dbpass, $dbname );

	/* 檢查連接 */
	if ( !$conn ) {
		die( "資料庫連接失敗: " . mysqli_connect_error() );
	}

	/* 設定語系 */
	mysqli_query( $conn, "SET NAMES 'UTF8'" );
?>