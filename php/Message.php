<?php
if ( isset( $_GET[ 'msg' ] ) ) {
	if ( $_GET[ 'msg' ] == 0 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！請稍後再嘗試，謝謝！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 11 ) {
		echo '<div class="alert alert-success alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>新增成功！！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 12 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！帳號已存在！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 13 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！檔案已存在！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 14 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！請上傳20MB以內的檔案！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 15 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！僅支援PDF檔案格式！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 16 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>上傳檔案錯誤！！請稍後再試，謝謝！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 21 ) {
		echo '<div class="alert alert-success alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>刪除成功！！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 22 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！尚有使用者屬於該身份！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 23 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！尚有使用者屬於該實驗室！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 24 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！僅可刪除開始前五分鐘之預約！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 31 ) {
		echo '<div class="alert alert-success alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>更新成功！！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 41 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！您的帳號尚未通過審核！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 42 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！您選擇的時間範圍有誤！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 43 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！您選擇的時段已被預約！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 44 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！您只能預約一個月內的時段！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 45 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！該儀器目前暫停開放！';
		echo '</div>';
	} else if ( $_GET[ 'msg' ] == 46 ) {
		echo '<div class="alert alert-danger alert-dismissable fade in">';
		echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>錯誤！！請與其他預約時段至少間隔5分鐘！';
		echo '</div>';
	}
}
?>