<?php
	session_start();
	require_once( 'Connect_DB.php' );

	$account = $_SESSION['account'];
	$number = $_GET['number'];

	/* 檢查 student 是否有參考到該 identity */
	/*$query = "	SELECT	student.number
						FROM 	student 
						WHERE 	number = {$number};";

	$result = mysqli_query( $conn, $query );
	$count = mysqli_num_rows( $result );*/
	if($count == 0){
		/* 刪除 identity */
		$stmt = $conn->prepare( "DELETE FROM boat WHERE number = ?;" );
		$stmt->bind_param( "i", $number);
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
	header("location: ../boat_manager.php?msg={$result}");
	
?>