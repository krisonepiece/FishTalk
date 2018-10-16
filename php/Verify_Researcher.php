<?php
//session_start();
require_once( 'Check_Department.php' );
require_once( 'Connect_DB.php' );

$account = $_GET[ 'account' ];
$verify = $_GET[ 'verify' ];

if ( $_GET ) {
	/* 更新會員資料 */
	$stmt = $conn->prepare( "	UPDATE 	member
								SET		level = ?
								WHERE	account = ?;" );
	
	$stmt->bind_param( "is", $verify, $account );
	$result = $stmt->execute();
	$stmt->close();
	/* 檢查是否更新成功 */
	if ( $result ) {
		$result = 31;
	} else {
		$result = 0;
	}
	mysqli_close( $conn );
	header( "location: ../researcher_manager.php?msg={$result}" );
} else
	header( "location: ../researcher_manager.php" );
?>