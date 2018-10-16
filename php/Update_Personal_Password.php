<?php
	session_start();
	require_once( 'Connect_DB.php' );

	$account = $_SESSION['account'];

	if($_POST){
		foreach ($_POST as $key => $value) {
     		$$key = $value;
		}
		
		/* 更新密碼 */
		$hash = hashSSHA( $password );
		$encrypted_password = $hash[ "encrypted" ]; // encrypted password
		$salt = $hash[ "salt" ]; // salt
		
		$stmt = $conn->prepare( "	UPDATE	member 
									SET 	password = ?, salt = ? 
									WHERE 	account = ?;" );
		$stmt->bind_param( "sss", $encrypted_password, $salt, $account);
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
		header("location: ../personal.php?msg={$result}");
	}
	else
		header("location: ../personal.php");

	/* Hash 加密 */
	function hashSSHA( $password ) {
		$salt = sha1( rand() );
		$salt = substr( $salt, 0, 10 );
		$encrypted = base64_encode( sha1( $password . $salt, true ) . $salt );
		$hash = array( "salt" => $salt, "encrypted" => $encrypted );
		return $hash;
	}
?>