<?php
	session_start();
	require_once( 'Connect_DB.php' );

	$account = $_SESSION['account'];	
	if($_POST){
		foreach ($_POST as $key => $value) {
     		$$key = $value;
		}
		/* 新增身份資料 */
		$stmt = $conn->prepare( "INSERT INTO boat(account, type, spicies, location, requirement) VALUES (?, ?, ?, ?, ?);" );
		$stmt->bind_param( "sssss", $account, $type, $spicies, $location, $requirement );
		$result = $stmt->execute();
		$stmt->free_result();
		$stmt->close();

		/* 檢查是否新增成功 */
		if ( $result ) {
			$result = 11;	
		} else {
			$result = 0;
		}
		mysqli_close( $conn );
		header("location: ../boat_manager.php?msg={$result}");
	}
	else
		header("location: ../boat_manager.php");
?>