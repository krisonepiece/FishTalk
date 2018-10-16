<?php
//function show_header(){
//	echo <<<EOT
//		<header class="header black-bg">
//			<div class="sidebar-toggle-box">
//				<div class="fa fa-bars tooltips" data-placement="right" data-original-title="工具列"></div>
//			</div>
//			<!--logo start-->
//			<a href="matching.php" class="logo"><img src="images/logo.png" width="185" height="45/></a>
//			<!--logo end-->
//			<div class="top-menu">
//				<ul class="nav pull-right top-menu">
//					<li><a class="logout" href="php/Logout.php">登出</a>
//					</li>
//				</ul>
//			</div>
//		</header>
//EOT;
//}

function show_header() {
	echo <<<EOT
		<style type="text/css">
		.nav > li > a{
			font-size: 18px;
		}
	</style>
			<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" style="width:100%;">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <a href="index.php" class="navbar-brand" style="padding-top: 5px;"><img src="images/logo.png" width="185" height="42/></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
	  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">會員 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="personal.php">個人資料修改</a></li>
EOT;
	if ( $_SESSION[ 'identity' ] == 1 )
		echo '<li><a href="researcher_manager.php">研究人員管理</a></li>';
	else if ( $_SESSION[ 'identity' ] == 3 )
		echo '<li><a href="boat_manager.php">漁船管理</a></li>';
	echo <<<EOT
          </ul>
        </li>
EOT;
	if ( $_SESSION[ 'identity' ] != 1 ) {
		echo <<<EOT
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">好友 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="friend_manager.php">好友管理</a></li>
            <li><a href="matching.php">配對</a></li>
            <li><a href="http://140.117.169.56:55151/chat.php?u={$_SESSION['username']}&id={$_SESSION['identity']}">聊天</a></li>			
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">學習 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="study_manager.php">學習管理</a></li>
            <li><a href="forum.php">討論</a></li>
          </ul>
        </li>
EOT;
	}
	echo <<<EOT
      </ul> 
	  <ul class="nav pull-right top-menu">
					<li><a class="logout" href="php/Logout.php">登出</a>
					</li>
				</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
EOT;
}

function show_sidebar( $active = '' ) {
	//	echo '<aside>';
	//	echo '<div id="sidebar" class="nav-collapse ">';
	//	echo '<!-- sidebar menu start-->';
	//	echo '<ul class="sidebar-menu" id="nav-accordion">';
	//	
	//	echo '<li class="sub-menu">';
	//	echo '<a '.(($active == 'personal' || $active == 'researcher_manager' || $active == 'boat_manager')? 'class="active"' : '') .'href="javascript:;">';						
	//    echo '<i class="fa fa-file-text-o"></i>';
	//    echo '<span>會員</span>';
	//    echo '</a>';				
	//	echo '<ul class="sub">';
	//	echo '<li '.(($active == 'personal')? 'class="active"' : '').'><a href="personal.php">個人資料修改</a></li>';
	//	echo '<li '.(($active == 'researcher_manager')? 'class="active"' : '').'><a href="researcher_manager.php">研究人員管理</a></li>';
	//	echo '<li '.(($active == 'boat_manager')? 'class="active"' : '').'><a href="boat_manager.php">漁船管理</a></li>';
	//	echo '</ul>';
	//	echo '</li>';
	//	echo '<li class="sub-menu">';
	//	echo '<a ' .(($active == 'friend_manager' || $active == 'matching' || $active == 'chat') ? 'class="active"' : '') .' href="javascript:;">';
	//	echo '<i class="fa fa-cog"></i>';
	//	echo '<span>好友</span>';
	//	echo '</a>';					
	//	echo '<ul class="sub">';	
	//	echo '<li ' .(($active == 'friend_manager') ? 'class="active"' : '') .' ><a href="friend_manager.php">好友管理</a></li>';
	//	echo '<li ' .(($active == 'matching') ? 'class="active"' : '') .' ><a href="matching.php">配對</a></li>';
	//	echo '<li ' .(($active == 'chat') ? 'class="active"' : '') .' ><a href="http://140.117.169.56:55151/chat.php?u='.$_SESSION['username'].'">聊天</a></li>';
	//	echo '</ul>';
	//	echo '</li>';
	//	echo '<li class="sub-menu">';
	//	echo '<a ' .(($active == 'study_manager' || $active == 'forum') ? 'class="active"' : '') .' href="javascript:;">';
	//	echo '<i class="fa fa-cog"></i>';
	//	echo '<span>學習</span>';
	//	echo '</a>';					
	//	echo '<ul class="sub">';	
	//	echo '<li ' .(($active == 'study_manager') ? 'class="active"' : '') .' ><a href="study_manager.php">學習管理</a></li>';
	//	echo '<li ' .(($active == 'forum') ? 'class="active"' : '') .' ><a href="forum.php">討論</a></li>';
	//	echo '</ul>';
	//	echo '</li>';
	//	echo '</ul>';
	//	echo '<!-- sidebar menu end-->';
	//	echo '</div>';
	//	echo '</aside>';
}

function show_footer() {
	echo <<<EOT
		<footer class="site-footer">
			<div class="text-center">
				Pacific Alliance
				<a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
			
			</div>
		</footer>
EOT;
}
?>