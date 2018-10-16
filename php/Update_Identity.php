<?php
	session_start();
	require_once( 'Connect_DB.php' );

	$uid = $_SESSION['uid'];
	$iid = $_GET['iid'];

	if($_POST){
		foreach ($_POST as $key => $value) {
     		$$key = $value;
		}
		/* 更新身份資料 */
		$stmt = $conn->prepare( "	UPDATE	identity 
									SET 	iname = ?, inote = ?, 
											updid = ?, updtime = NOW()
									WHERE 	iid = ?;" );
		$stmt->bind_param( "sssi", $iname, $inote, $uid, $iid);
		$result = $stmt->execute();
		$stmt->free_result();
		$stmt->close();

		/* 檢查是否更新成功 */
		if ( $result ) {
			$result = 31;
		} else {
			$result = 0;
		}
		mysqli_close( $conn );
		header("location: ../identity_manager.php?msg={$result}");
	}
	else
		header("location: ../identity_manager.php");
?>