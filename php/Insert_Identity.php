<?php
	session_start();
	require_once( 'Connect_DB.php' );

	$uid = $_SESSION['uid'];	
	if($_POST){
		foreach ($_POST as $key => $value) {
     		$$key = $value;
		}
		/* 新增身份資料 */
		$stmt = $conn->prepare( "INSERT INTO identity(iname, inote, createid, createtime, updid, updtime) VALUES (?, ?, ?, NOW(), ?, NOW());" );
		$stmt->bind_param( "ssss", $iname, $inote, $uid, $uid );
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
		header("location: ../identity_manager.php?msg={$result}");
	}
	else
		header("location: ../identity_manager.php");
?>