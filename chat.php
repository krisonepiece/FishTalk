<?php require_once('php/Check_Identity.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Kris">
	<meta name="keyword" content="Booking">

	<title>FISHTALK聊天</title>

	<!-- Bootstrap core CSS -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<!--external css-->
	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
	<link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css"/>
	<link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">

	<!-- Custom styles for this template -->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>

    
    <link href="css/style.css" rel="stylesheet">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/swfobject.js"></script>
    <script type="text/javascript" src="/js/web_socket.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript">
    if (typeof console == "undefined") {    this.console = { log: function (msg) {  } };}
    // 如果浏览器不支持websocket，会使用这个flash自动模拟websocket协议，此过程对开发者透明
    WEB_SOCKET_SWF_LOCATION = "/swf/WebSocketMain.swf";
    // 开启flash的websocket debug
    WEB_SOCKET_DEBUG = true;
	  
    var ws, name, client_list={}, global_client_list={}, introduction_list={};

    // 连接服务端
    function connect() {
       // 创建websocket
       ws = new WebSocket("ws://"+document.domain+":7272");
       // 当socket连接打开时，输入用户名
       ws.onopen = onopen;
       // 当有消息时根据消息类型显示不同信息
       ws.onmessage = onmessage; 
       ws.onclose = function() {
    	  console.log("關閉連線");
          connect();
       };
       ws.onerror = function() {
     	  console.log("出現錯誤");
       };
    }

    // 连接建立时发送登录信息
    function onopen()
    {
        
        show_prompt();
        var my_name = document.getElementById("my_name");
        my_name.innerHTML = name;
        document.getElementById("profile-img").src = "http://140.117.169.140/FishTalk/images/" + name + ".png";
        // 登入
        var login_data = '{"type":"login","client_name":"'+name.replace(/"/g, '\\"')+'","room_id":"<?php echo isset($_GET['room_id']) ? $_GET['room_id'] : 1?>"}';
        console.log("websocket握手成功:"+login_data);
        ws.send(login_data);
    }

    // 服务端发来消息时
    function onmessage(e)
    {
        console.log(e.data);
        var data = eval("("+e.data+")");
        switch(data['type']){
            // 服务端ping客户端
            case 'ping':
                ws.send('{"type":"pong"}');
                break;;
            // 登入 更新用户列表
            case 'login':
                //{"type":"login","client_id":xxx,"client_name":"xxx","client_list":"[...]","time":"xxx"}
                //say(data['client_id'], data['client_name'],  data['client_name']+' 加入了聊天室', data['time']);

                client_list = data['client_list'];
                introduction_list = data['introduction_list'];
                //console.log(data['client_list']);
                var contact = document.getElementById("contact_list");
                contact.innerHTML = "";
                for(var p in client_list){
                    contact.innerHTML += "<li id='"+client_list[p]+"' class='contact' onclick='startChat(" + "this.id" + ")' >"+
                                        "<div class='wrap'>" +
                                            "<span class='contact-status online'></span>"+
                                            "<img src='http://140.117.169.140/FishTalk/images/"+ client_list[p] +".png' alt='' />"+
                                            "<div class='meta'>"+
                                                "<p class='name'>"+ client_list[p] +"</p>"+
                                                "<p class='preview'>" + introduction_list[p] +"</p>"+
                                            "</div>"+
                                        "</div>"+
                                     "</li>";
                    //console.log(client_list[p]);
                }

                //console.log(data['client_name']+"登入成功");
                break;
            case 'require_content':
                message_list = document.getElementById("message_list");
                console.log(data['content_entity']);
                
                for(var c in data['content_entity']){
                    if(data['content_entity'][c]["account_A"] == name){
                        message_list.innerHTML += "<li class='sent'>"+
                                                        "<img src='http://140.117.169.140/FishTalk/images/" + name + ".png' alt='' />"+
                                                        "<p>" + data['content_entity'][c]["message"] + "</p>"+
                                                    "</li>";
                    } else{
                        var talk_name = document.getElementById("contact-profile-name").innerHTML;
                        message_list.innerHTML += "<li class='replies'>"+
                                                        "<img src='http://140.117.169.140/FishTalk/images/" + talk_name + ".png' alt='' />"+
                                                        "<p>" + data['content_entity'][c]["message"] + "</p>"+
                                                    "</li>";
                    }
                }
                $(".messages").animate({ scrollTop: $(document).height() }, "fast");
                break;
            // 发言
            case 'say':
                //{"type":"say","from_client_id":xxx,"to_client_id":"all/client_id","content":"xxx","time":"xxx"}
                say(data['from_client_id'], data['from_client_name'], data['content'], data['time']);
                break;
            // 用户退出 更新用户列表
            case 'logout':
                //{"type":"logout","client_id":xxx,"time":"xxx"}
                say(data['from_client_id'], data['from_client_name'], data['from_client_name']+' 退出了', data['time']);
                delete client_list[data['from_client_id']];
                flush_client_list();
                break;
            case 'global_list':
                global_client_list = data['global_client_list'];
                console.log("client:" + global_client_list);
                break;
            case 'online_message':
                var content = data['content'];
                var contact_profile_name = document.getElementById("contact-profile-name").innerHTML;
                
                if(data['from_client_name'] == contact_profile_name){
                    message_list = document.getElementById("message_list");
                    message_list.innerHTML += "<li class='replies'>"+
                                                            "<img src='http://140.117.169.140/FishTalk/images/" + contact_profile_name + ".png' alt='' />"+
                                                            "<p>" + content + "</p>"+
                                                        "</li>";
                    $(".messages").animate({ scrollTop: $(document).height() }, "fast");
                }

                break;
            case 'get_introduction':
                console.log("Intro:" + data["message"]);
                break;
        }
    }

    // 输入姓名
    function show_prompt(){  
        name = prompt('输入你的名字：', '');
        if(!name || name=='null'){  
            name = '游客';
        }
    }

  </script>

	<style type="text/css">
		.pn {
			height: 300px;
		}
		.multi_ellipsis {
			display: block;
			overflow: hidden;
			display: -webkit-box;
			-webkit-box-orient: vertical;
			-webkit-line-clamp: 1;
			line-height: 15px;
			height: 15px;
		}
	</style>
	<?php 
		require_once('php/Show_Function.php');
	?>
</head>

<body onload="connect()">

	<section id="container">
		<?php
		show_header();
		show_sidebar( 'chat' );
		?>
		<!--main content start-->
		<section id="main-content">
			<section class="">
                <div id="frame">
                    <div id="sidepanel">
                        <div id="profile">
                            <div class="wrap">
                                <img id="profile-img" src="" class="online" alt="" />
                                <p id="my_name"></p>
                                <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
                                <div id="status-options">
                                    <ul>
                                        <li id="status-online" class="active">
                                            <span class="status-circle"></span>
                                            <p>Online</p>
                                        </li>
                                        <li id="status-away">
                                            <span class="status-circle"></span>
                                            <p>Away</p>
                                        </li>
                                        <li id="status-busy">
                                            <span class="status-circle"></span>
                                            <p>Busy</p>
                                        </li>
                                        <li id="status-offline">
                                            <span class="status-circle"></span>
                                            <p>Offline</p>
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div id="contacts">
                            <ul id="contact_list">
                            </ul>
                        </div>
                    </div>
                    <div class="content">
                        <div class="contact-profile">
                            <img id="contact-profile-image" src="" alt="" />
                            <p id="contact-profile-name"></p>
                            
                        </div>
                        <div class="messages" id="message">
                            <ul id="message_list">                            
                            </ul>
                        </div>
                        <div class="message-input">
                            <div class="wrap">
                                <input id="textarea" type="text" placeholder="Write your message..." />
                                <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                                <button class="submit">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
				<!--/row -->
			</section>
		</section>

		<!--main content end-->
		
   
	<!-- js placed at the end of the document so the pages load faster -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/jquery-1.8.3.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
	<script src="assets/js/jquery.scrollTo.min.js"></script>
	<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
	<script src="assets/js/jquery.sparkline.js"></script>
	<!--common script for all pages-->
	<script src="assets/js/common-scripts.js"></script>

	<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
	<script type="text/javascript" src="assets/js/gritter-conf.js"></script>

	<!--script for this page-->
	<script src="assets/js/sparkline-chart.js"></script>
    <script src="assets/js/zabuto_calendar.js"></script>
    <script src="js/chat.js"></script>
    <script>
        $('.submit').click(function() {
            var input = document.getElementById("textarea");
            var talk_name = document.getElementById("contact-profile-name").innerHTML;
            if(talk_name in global_client_list){
                //online
                ws.send('{"type":"online_message","to_client_id":"' + global_client_list[talk_name] + '","to_client":"'+ talk_name +'","content":"'+input.value.replace(/"/g, '\\"').replace(/\n/g,'\\n').replace(/\r/g, '\\r')+'"}');
            } else
                ws.send('{"type":"offline_message","to_client":"'+ talk_name +'","content":"'+input.value.replace(/"/g, '\\"').replace(/\n/g,'\\n').replace(/\r/g, '\\r')+'"}');
            newMessage(name);
            $(".messages").animate({ scrollTop: $(document).height() }, "fast");
            
        });

        $(window).on('keydown', function(e) {
        if (e.which == 13) {
            var input = document.getElementById("textarea");
            var talk_name = document.getElementById("contact-profile-name").innerHTML;
            console.log("talkname:" + talk_name);
            if(talk_name in global_client_list){
                //online
                ws.send('{"type":"online_message","to_client_id":"' + global_client_list[talk_name] + '","to_client":"'+ talk_name +'","content":"'+input.value.replace(/"/g, '\\"').replace(/\n/g,'\\n').replace(/\r/g, '\\r')+'"}');
            } else
                ws.send('{"type":"offline_message","to_client":"'+ talk_name +'","content":"'+input.value.replace(/"/g, '\\"').replace(/\n/g,'\\n').replace(/\r/g, '\\r')+'"}');
            newMessage(name);
            $(".messages").animate({ scrollTop: $(document).height() }, "fast");
            
            return false;
        }
        });

        function startChat(current_user){
            var talk_name = current_user.toString();
            var contact_profile_name = document.getElementById("contact-profile-name");
            var contact_profile_image = document.getElementById("contact-profile-image");
            contact_profile_name.innerHTML = talk_name;
            contact_profile_image.src = "http://140.117.169.140/FishTalk/images/"+ talk_name +".png";

            ws.send('{"type":"require_content","to_client":"'+ talk_name +'"}');
            
            document.getElementById("message_list").innerHTML="";
        }

    </script>

</body>

</html>