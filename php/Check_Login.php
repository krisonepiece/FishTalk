<?php
	session_start();
	require_once( 'Connect_DB.php' );

	if(isset($_POST['account']) && isset($_POST['password'])){

		$account = $_POST['account'];
		$password = $_POST['password'];
		$query = "	SELECT * 
					FROM member 
					WHERE account = '{$account}';";

		$result = mysqli_query( $conn, $query );
		$count = mysqli_num_rows( $result );			
			if($count > 0){
				$user = mysqli_fetch_assoc( $result );
				// verifying user password
				$salt = $user['salt'];
				$encrypted_password = $user['password'];
				$hash = checkhashSSHA($salt, $password);

				// check for password equality
				if ($encrypted_password != $hash) {
					$user = false;		
					
				}
				// check for verify
				else if ($user['level'] == 0){
					$user = 'level';		
				}
			}
			else{
				$user = false;
			}        
		
		if($user == 'level'){
			header("location: ../login.php?msg=1");
		}
		else if($user != false){
			$_SESSION['account'] = $user['account'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['identity'] = $user['identity'];
			header("location: ../index.php");
		}
		else{
			header("location: ../login.php?msg=0");
		}
	}
	function checkhashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
 
        return $hash;
    }
?>