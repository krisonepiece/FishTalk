<?php
//session_start();
require_once( 'Connect_DB.php' );

$number = $_GET[ 'number' ];

if ( $_GET ) {
	/* 更新會員資料 */
	$stmt = $conn->prepare( "DELETE FROM matching WHERE number = ?;" );
	$stmt->bind_param( "i", $number);
	$result = $stmt->execute();
	$stmt->close();
	/* 檢查是否更新成功 */
	if ( $result ) {
		$result = 31;
	} else {
		$result = 0;
	}
	mysqli_close( $conn );
	header( "location: ../friend_manager.php?msg={$result}" );
} else
	header( "location: ../friend_manager.php" );
?>