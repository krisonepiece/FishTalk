<?php
	session_start();
	require_once( 'Connect_DB.php' );

	$mid = $_SESSION['mid'];

	if($_POST){
		foreach ($_POST as $key => $value) {
     		$$key = $value;
		}
		
		/* 更新密碼 */
		$hash = hashSSHA( $password );
		$encrypted_password = $hash[ "encrypted" ]; // encrypted password
		$salt = $hash[ "salt" ]; // salt
		
		$stmt = $conn->prepare( "	UPDATE	member 
									SET 	password = ?, salt = ?, 
											updid = ?, updtime = NOW()
									WHERE 	mid = ?;" );
		$stmt->bind_param( "ssss", $encrypted_password, $salt, $mid, $mid);
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
		header("location: ../member.php?msg={$result}");
	}
	else
		header("location: ../member.php");

	/* Hash 加密 */
	function hashSSHA( $password ) {
		$salt = sha1( rand() );
		$salt = substr( $salt, 0, 10 );
		$encrypted = base64_encode( sha1( $password . $salt, true ) . $salt );
		$hash = array( "salt" => $salt, "encrypted" => $encrypted );
		return $hash;
	}
?>