<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);
/**
 * 聊天主逻辑
 * 主要是处理 onMessage onClose 
 */
use \GatewayWorker\Lib\Gateway;
class Events
{
   /**
    * 有消息时
    * @param int $client_id
    * @param mixed $message
    */
   public static function onMessage($client_id, $message)
   {
        // debug
        echo "client:{$_SERVER['REMOTE_ADDR']}:{$_SERVER['REMOTE_PORT']} gateway:{$_SERVER['GATEWAY_ADDR']}:{$_SERVER['GATEWAY_PORT']}  client_id:$client_id session:".json_encode($_SESSION)." onMessage:".$message."\n";
        
        // 客户端传递的是json数据
        $message_data = json_decode($message, true);
        if(!$message_data)
        {
            return ;
        }
        
        // 根据类型执行不同的业务
        switch($message_data['type'])
        {
            // 客户端回应服务端的心跳
            case 'pong':
                return;
            // 客户端登录 message格式: {type:login, name:xx, room_id:1} ，添加到客户端，广播给所有客户端xx进入聊天室
            case 'login':
                // 判断是否有房间号
                /*
                if(!isset($message_data['room_id']))
                {
                    throw new \Exception("\$message_data['room_id'] not set. client_ip:{$_SERVER['REMOTE_ADDR']} \$message:$message");
                }*/
                
                // 把房间号昵称放到session中
                //$room_id = $message_data['room_id'];
                $client_name = htmlspecialchars($message_data['client_name']);
                //$_SESSION['room_id'] = $room_id;
                $_SESSION['client_name'] = $client_name;
                
                $a = array();
                //$room_id = $message_data['room_id'];
                $client_name = htmlspecialchars($message_data['client_name']);
                //$_SESSION['room_id'] = $room_id;
                $_SESSION['client_name'] = $client_name;
				
				
				$servername = "140.117.169.140";
				$username = "fishtalk";
				$password = "fish2018";
				$dbname = "fishtalk";
                $conn = new mysqli($servername, $username, $password, $dbname);
				$sql = 'SELECT * FROM matching WHERE account_A = "'.$_SESSION['client_name'].'" OR account_B = "'.$_SESSION['client_name'].'"  ';
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						if($row["account_A"] == $_SESSION['client_name'])
						{
							array_push($a, $row["account_B"]);
						}
						else if($row["account_B"] == $_SESSION['client_name'])
						{
							array_push($a, $row["account_A"]);
						}
					}
				} else {
					echo "0 results";
				}
                $conn->close();
                
                echo $a[0];
                // 获取房间内所有用户列表 
                /*
                $clients_list = Gateway::getClientSessionsByGroup($room_id);
                foreach($clients_list as $tmp_client_id=>$item)
                {
                    $clients_list[$tmp_client_id] = $item['client_name'];
                }
                $clients_list[$client_id] = $client_name;*/
                
                // 转播给当前房间的所有客户端，xx进入聊天室 message {type:login, client_id:xx, name:xx} 
                $new_message = array('type'=>$message_data['type'], 'client_id'=>$client_id, 'client_name'=>htmlspecialchars($client_name), 'time'=>date('Y-m-d H:i:s'));
                //Gateway::sendToGroup($room_id, json_encode($new_message));
                //Gateway::joinGroup($client_id, $room_id);
               
                // 给当前用户发送用户列表 
                $new_message['client_list'] = $a;
                Gateway::sendToCurrentClient(json_encode($new_message));
                return;
                
            // 客户端发言 message: {type:say, to_client_id:xx, content:xx}
            case 'say':
                // 非法请求
				$talk_name = $message_data['to_client']; //account_B
                if(!isset($_SESSION['room_id']))
                {
                    throw new \Exception("\$_SESSION['room_id'] not set. client_ip:{$_SERVER['REMOTE_ADDR']}");
                }
                $room_id = $_SESSION['room_id'];
                $client_name = $_SESSION['client_name'];
                // 私聊
                if($message_data['to_client_id'] != 'all')
                {
                    $new_message = array(
                        'type'=>'say',
                        'from_client_id'=>$client_id, 
                        'from_client_name' =>$client_name,
                        'to_client_id'=>$message_data['to_client_id'],
                        'content'=>"<b>对你说: </b>".nl2br(htmlspecialchars($message_data['content'])),
                        'time'=>date('Y-m-d H:i:s'),
                    );
					
					$servername = "140.117.169.140";
					$username = "fishtalk";
					$password = "fish2018";
					$dbname = "fishtalk";
					$conn = new mysqli($servername, $username, $password, $dbname);
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} 
					$sql = "INSERT INTO content (account_A, account_B, message)
					VALUES ('client_id', '$talk_name', '$message_data['content']')";

					if ($conn->query($sql) === TRUE) {
						echo "New record created successfully";
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}

					$conn->close();
					
                    Gateway::sendToClient($message_data['to_client_id'], json_encode($new_message));
                    $new_message['content'] = "<b>你对".htmlspecialchars($message_data['to_client_name'])."说: </b>".nl2br(htmlspecialchars($message_data['content']));
                    return Gateway::sendToCurrentClient(json_encode($new_message));
                }
                
                $new_message = array(
                    'type'=>'say', 
                    'from_client_id'=>$client_id,
                    'from_client_name' =>$client_name,
                    'to_client_id'=>'all',
                    'content'=>nl2br(htmlspecialchars($message_data['content'])),
                    'time'=>date('Y-m-d H:i:s'),
                );
				
					$servername = "140.117.169.140";
					$username = "fishtalk";
					$password = "fish2018";
					$dbname = "fishtalk";
					$conn = new mysqli($servername, $username, $password, $dbname);
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} 
					$sql = "INSERT INTO content (account_A, account_B, message)
					VALUES ('client_id', '$talk_name', '$message_data['content']')";

					if ($conn->query($sql) === TRUE) {
						echo "New record created successfully";
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}

					$conn->close();
				
                return Gateway::sendToGroup($room_id ,json_encode($new_message));
			case 'require_content':
				$talk_name = $message_data['to_client']; //account_B
				$a = array();
				$_SESSION['client_name'] = "Bob";
				$_SESSION['talkname_name'] = "ted";
				$servername = "140.117.169.140";
				$username = "fishtalk";
				$password = "fish2018";
				$dbname = "fishtalk";
				
                $conn = new mysqli($servername, $username, $password, $dbname);
				$sql = 'SELECT * FROM content WHERE (account_A = "'.$_SESSION['client_name'].'" AND account_B = "'.$_SESSION['talkname_name'].'") OR (account_B = "'.$_SESSION['client_name'].'" AND account_A = "'.$_SESSION['talkname_name'].'")  ';
				$result = $conn->query($sql);
				while($row = $result->fetch_array())
				{
					$rows[] = $row;
				}
				$conn->close();
				$new_message = array('type'=>$message_data['type'], 'client_id'=>$client_id, 'client_name'=>htmlspecialchars($client_name), 'time'=>date('Y-m-d H:i:s'));
				$new_message['content_entity'] = $a;
                Gateway::sendToCurrentClient(json_encode($new_message));
                return;
				
        }
   }
   
   /**
    * 当客户端断开连接时
    * @param integer $client_id 客户端id
    */
   public static function onClose($client_id)
   {
       // debug
       echo "client:{$_SERVER['REMOTE_ADDR']}:{$_SERVER['REMOTE_PORT']} gateway:{$_SERVER['GATEWAY_ADDR']}:{$_SERVER['GATEWAY_PORT']}  client_id:$client_id onClose:''\n";
       
       // 从房间的客户端列表中删除
       if(isset($_SESSION['room_id']))
       {
           $room_id = $_SESSION['room_id'];
           $new_message = array('type'=>'logout', 'from_client_id'=>$client_id, 'from_client_name'=>$_SESSION['client_name'], 'time'=>date('Y-m-d H:i:s'));
           Gateway::sendToGroup($room_id, json_encode($new_message));
       }
   }
  
}