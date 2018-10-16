<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Pacific Alliances">
	<meta name="keyword" content="FishTalk">

	<title>FishTalk</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>

  <body>

	  <div id="signup-page">
	  	<div class="container">
	  	<?php
			require_once( 'php/Connect_DB.php' );
			?>
	  	
		      <form class="form-signup" action="sign_up_confirm.php" method="post">
		        <h2 class="form-signup-heading">註冊</h2>
		        <div class="signup-wrap">
		            <input type="text" name="account" id="account" class="form-control" placeholder="帳號" autofocus required maxlength="16">
		            <br>
		            <input type="password" name="password" id="password" class="form-control" placeholder="密碼" required rangelength="6,20">
		            <br>
		            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="確認密碼" required equalTo="#password">
		            <hr>
		            <br>
		            <input type="text" name="username" id="username" class="form-control" placeholder="姓名" required maxlength="28">		            
		            <br>
		            <input type="email" name="email" id="email" class="form-control required email" placeholder="E-mail">
		            <br>
		            <select class="form-control required" placeholder="身份" name="identity" id="identity" onChange="isResearch()">
						<option value="2">研究人員</option>
						<option value="3">漁產業者</option>
					</select>
	            	<br>
	            	<div id="department_div">
	            		<select class="form-control required" placeholder="單位" name="department" id="department">
						<option value="2">AIT</option>
						<option value="3">NSYSU</option>
					</select>
	            	</div>		            
		            <br>
		            <select class="form-control required" placeholder="時區" name="zone" id="zone">
						
						<?php
							$timezones = array(
								'US/Samoa'             => "(GMT-11:00)",
								'US/Hawaii'            => "(GMT-10:00)",
								'US/Alaska'            => "(GMT-09:00)",
								'US/Pacific'           => "(GMT-08:00)",
								'US/Arizona'           => "(GMT-07:00)",
								'America/Mexico_City'  => "(GMT-06:00)",
								'US/Eastern'           => "(GMT-05:00)",
								'Canada/Atlantic'      => "(GMT-04:00)",
								'America/Buenos_Aires' => "(GMT-03:00)",
								'Atlantic/Stanley'     => "(GMT-02:00)",
								'Atlantic/Azores'      => "(GMT-01:00)",
								'Europe/London'        => "(GMT 00:00)",
								'Europe/Amsterdam'     => "(GMT+01:00)",
								'Europe/Athens'        => "(GMT+02:00)",
								'Asia/Baghdad'         => "(GMT+03:00)",
								'Asia/Baku'            => "(GMT+04:00)",
								'Asia/Karachi'         => "(GMT+05:00)",
								'Asia/Yekaterinburg'   => "(GMT+06:00)",
								'Asia/Novosibirsk'     => "(GMT+07:00)",
								'Asia/Krasnoyarsk'     => "(GMT+08:00)",
								'Asia/Irkutsk'         => "(GMT+09:00)",
								'Asia/Yakutsk'         => "(GMT+10:00)",
								'Asia/Vladivostok'     => "(GMT+11:00)",
								'Asia/Magadan'         => "(GMT+12:00)",
							);
						$i = -11;
						foreach($timezones as $timezone) {
							echo "<option value=$i>{$timezone}</option>";
							$i++;
						}														
						?>
					</select>
		            <br>	
					<textarea name="introduction" id="introduction" class="form-control" placeholder="自我介紹" maxlength="500">
					</textarea>
					<br>
		            <hr>
		            <input type="hidden" name="rid" id="rid" value="2">
		            <input type="hidden" name="verify" id="verify" value="0">
		            <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN UP</button>
		        </div>
		      </form>
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="js/jquery-validate/jquery.validate.js"></script>
	<script src="js/jquery-validate/localization/messages_zh_TW.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
		$().ready(function() {
    		$("form").validate();
		});
		
		function isResearch() {
			if ( $( '#identity' ).val() == 2 )
				$( '#department_div' ).show('fast');
			else
				$( '#department_div' ).hide('fast');
		}
        $.backstretch("assets/img/bg.jpg", {speed: 500});
    </script>

  </body>
</html>
