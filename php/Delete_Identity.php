<?php
	session_start();
	require_once( 'Connect_DB.php' );

	$uid = $_SESSION['uid'];
	$iid = $_GET['iid'];

	/* 檢查 student 是否有參考到該 identity */
	$query = "	SELECT	student.iid
						FROM 	student 
						WHERE 	iid = {$iid};";

	$result = mysqli_query( $conn, $query );
	$count = mysqli_num_rows( $result );
	if($count == 0){
		/* 刪除 identity */
		$stmt = $conn->prepare( "DELETE FROM identity WHERE iid = ?;" );
		$stmt->bind_param( "i", $iid);
		$result = $stmt->execute();
		$stmt->close();	
		if($result){
			$result = 21;		
		}
		else{
			$result = 0;
		}
	}
	else{
		$result = 22;
	}
	mysqli_close( $conn );
	header("location: ../identity_manager.php?msg={$result}");
	
?>