<?php
	session_start();
	require_once( 'Connect_DB.php' );

	$department= $_SESSION['account'];
	$account = $_GET['account'];

	/* 刪除帳號 */
	$stmt = $conn->prepare( "DELETE FROM member WHERE account = ?;" );
	$stmt->bind_param( "s", $account);
	$result = $stmt->execute();

	$stmt = $conn->prepare( "DELETE FROM researcher WHERE account = ?;" );
	$stmt->bind_param( "s", $account);
	$result = $stmt->execute();
	
	$stmt->close();	
	if($result){
		$result = 21;		
	}
	else{
		$result = 0;
	}

	mysqli_close( $conn );
	header("location: ../student_manager.php?msg={$result}");
	
?>