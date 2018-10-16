<?php
session_start();
require_once( 'Connect_DB.php' );

$account = $_SESSION[ 'account' ];
$identity = $_SESSION[ 'identity' ];

if ( $_POST ) {
	foreach ( $_POST as $key => $value ) {
		$$key = $value;
	}
	//echo $_POST['introduction'];
	/* 更新會員資料 */
	$stmt = $conn->prepare( "	UPDATE 	member
									SET		email = ?, introduction = ? 
									WHERE	member.account = ?;" );
	$stmt->bind_param( "sss", $email, $introduction, $account );
	$result = $stmt->execute();
	//$stmt->free_result();
	//update researcher

	if ( $identity == '2' ) {
		$stmt = $conn->prepare( "	UPDATE 	researcher
										SET		skill = ?, study = ?, practice = ?, 
												contact = ?
										WHERE	researcher.account = ?;" );
		$stmt->bind_param( "sssss", $skill, $study, $practice, $contact, $account );
		$result = $stmt->execute();

	}
	$stmt->close();
	/* 檢查是否更新成功 */
	if ( $result ) {
		$result = 31;
	} else {
		$result = 0;
	}
	mysqli_close( $conn );
	header( "location: ../Personal.php?msg={$result}" );
} else
	header( "location: ../Personal.php" );
?>