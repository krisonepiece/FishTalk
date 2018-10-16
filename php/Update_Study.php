<?php
	session_start();
	require_once( 'Connect_DB.php' );

	$account = $_SESSION['account'];
	$number = $_GET['number'];

	if($_POST){
		foreach ($_POST as $key => $value) {
     		$$key = $value;
		}
		/* 更新身份資料 */
		$stmt = $conn->prepare( "INSERT INTO studuy(account, number, timestamp) VALUES (?, ?, NOW());" );
		$stmt->bind_param( "si", $account, $number);
		$result = $stmt->execute();
		$stmt->free_result();
		$stmt->close();

		/* 檢查是否更新成功 */
		if ( $result ) {
			$result = 11;
		} else {
			$result = 0;
		}
		mysqli_close( $conn );
		header("location: ../study_manager.php?msg={$result}");
	}
	else
		header("location: ../study_manager.php");
?>