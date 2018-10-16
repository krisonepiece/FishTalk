<?php
	session_start();
	require_once( 'Connect_DB.php' );

	$account_A = $_SESSION['account'];
	$account_B = $_GET['account'];

	/* 新增配對資料 */
	$stmt = $conn->prepare( "INSERT INTO matching(account_A, account_B, accept, timestamp) VALUES (?, ?, 0, NOW());" );
	$stmt->bind_param( "ss", $account_A, $account_B);
	$result = $stmt->execute();
	$stmt->free_result();
	$stmt->close();

	/* 檢查是否新增成功 */
	if ( $result ) {
		$result = 51;	
	} else {
		$result = 0;
	}
	mysqli_close( $conn );
	header("location: ../matching_list.php?msg={$result}");
?>