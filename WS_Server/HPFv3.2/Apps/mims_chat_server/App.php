<?php
header("Content-Type: text/plain");
include_once(__DIR__ . "/Addons/vendor/autoload.php");

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class MyChat implements MessageComponentInterface {
	private $users = [];
	private $customers = [], $admin = [];
	
    public function __construct(){
		echo "Server Called on " .  gethostbyname(gethostname()) . "\n";
    }

    public function onOpen(ConnectionInterface $conn){
		$us = explode("/", ltrim($conn->httpRequest->getUri()->getPath(), "/"));
		$error = true;
		
		//print_r($us);
		
		if(count($us) > 1){
			switch($us[0]){
				case "admin":
					if(isset($us[1])){
						$uc = user_chat::getBy([
							"channel"	=> $us[1]
						]);
						
						if(count($uc)){
							$error = false;
							$uc = $uc[0];
							
							$this->users[$us[1]] = $conn;
							$this->admin[$us[1]] = $conn;
						}
					}
				break;
				
				case "customer":
					if($us[1] != ""){
						$error = false;
						
						$this->users[$us[1]] = $conn;
						
						$uc = user_chat::getBy([
							"channel"	=> $us[1]
						]);
						
						if(count($uc)){
							$uc = $uc[0];
							
							$ct = chat_topic::getBy(["user_chat" => $uc->channel, "status" => 0]);
							
							if(count($ct)){
								$ct = $ct[0];
								
								$c = chat::list(["where" => "topic_id = $ct->id AND status = 0 AND user_chat <> '{$us[1]}'"]);
								
								if(count($c) > 0){
									$unread = true;
								}else{
									$unread = false;
								}
								
								$conn->send(json_encode([
									"action"	=> "registered",
									"data"		=> [
										"ct"		=> $ct->ukey,
										"ix"		=> $ct->id,
										"unread"	=> $unread,
										"date"		=> date("Y-m-d H:i:s\ ")
									]
								]));
							}							
						}
					}
				break;
			}
		}
		
		if($error){
			$conn->close();
		}
    }

    public function onMessage(ConnectionInterface $from, $msg){
		$us = explode("/", $from->httpRequest->getUri()->getPath());
		$msg = json_decode($msg);
		// print_r($msg);
		// print_r($us);
		
		if(count($us) > 1){
			switch($us[1]){
				case "admin":
					if(isset($this->admin[$us[2]])){
						switch($msg->action){
							case "subject":
								switch($msg->option){
									case "list":
										$cts = chat_topic::list(["order" => "id,status DESC"]);
										
										$data = [];
										
										foreach($cts as $ct){
											$uc = user_chat::getBy(["channel" => $ct->user_chat]);
											
											if(count($uc)){
												$uc = $uc[0];
												
												$ct->user = $uc;
												
												$c = chat::list(["where" => "topic_id = $ct->id AND status = 0 AND user_chat <> '{$us[2]}'"]);
												
												if(count($c)){
													$unread = true;
												}else{
													$unread = false;
												}
												
												$ct->unread = $unread;
												
												$data[] = $ct;
											}
										}
										
										$r = json_encode([
											"status"	=> "success",
											"action"	=> "subject",
											"option"	=> "list",
											"data"		=> $data
										]);
										
										$from->send($r);
									break;
									
									case "close":
										$ct = chat_topic::getBy(["ukey" => $msg->ct]);
										
										if(count($ct)){
											$ct = $ct[0];
											
											chat_topic::updateBy(["id" => $ct->id], [
												"status" => 1, 
												"updated_at" => date("Y-m-d H:i:s\ ")
											]);
											
											$from->send(json_encode([
												"action"	=> "subject",
												"option"	=> "close",
												"data"		=> [
													"ct"	=> $msg->ct
												]
											]));
											
											if(isset($this->users[$ct->user_chat])){
												$this->users[$ct->user_chat]->send(json_encode([
													"action"	=> "subject",
													"option"	=> "close"
												]));
											}
										}										
									break;
									
									case "update":
									
									break;
								}
							break;
							
							case "chat":
								switch($msg->option){
									case "load":
										$ct = chat_topic::getBy([
											"ukey"			=> $msg->ct
										]);
										
										if(count($ct)){
											$ct = $ct[0];
											
											$uc = user_chat::getBy([
												"channel"	=> $ct->user_chat
											]);
											
											if(count($uc)){
												$uc = $uc[0];
												
												$cs = chat::getBy(["topic_id" => $ct->id]);
											
												$data = [];
												
												foreach($cs as $c){
													$data[] = [
														"message"	=> $c->message,
														"from"		=> $c->user_chat
													];
												}
												
												DB::conn()->query("UPDATE chat SET status = 1 WHERE topic_id = $ct->id AND user_chat <> '{$us[2]}'");
												
												$from->send(json_encode([
													"status"	=> "success",
													"action"	=> "chat",
													"option"	=> "load",
													"data"		=> [
														"chat"	=> $data,
														"uc"	=> $uc,
														"ct"	=> $ct
													]
												]));
											}else{
												$from->send(json_encode([
													"action"	=> "chat",
													"option"	=> "load",
													"status"	=> "error",
													"message"	=> "Selected user information no found."
												]));
											}											
										}
									break;
									
									case "send":
										$ct = chat_topic::getBy([
											"ukey"			=> $msg->ct
										]);
										
										if(count($ct)){
											$ct = $ct[0];
											
											chat::insertInto([
												"created_at"	=> date("Y-m-d H:i:s\ "),
												"updated_at"	=> date("Y-m-d H:i:s\ "),
												"user_chat"		=> $us[2],
												"stud_id"		=> 0,
												"user_id"		=> $us[2],
												"message"		=> F::Encode64(htmlspecialchars(F::Decode64($msg->message))),
												"topic_id"		=> $ct->id,
												"status"		=> 0
											]);
											
											if(isset($this->users[$ct->user_chat])){
												$this->users[$ct->user_chat]->send(json_encode([
													"action"	=> "chat",
													"option"	=> "chat",
													"data"		=> [
														"message"	=> F::Encode64(htmlspecialchars(F::Decode64($msg->message)))
													]
												]));
											}
										}
									break;
									
									case "read":
										$ct = chat_topic::getBy([
											"ukey"			=> $msg->ct
										]);
										
										if(count($ct)){
											$ct = $ct[0];
											
											DB::conn()->query("UPDATE chat SET status = 1 WHERE topic_id = $ct->id AND user_chat <> '{$us[2]}'");
										}
									break;
								}
							break;
						}
					}
				break;
				
				default:
					if(isset($this->users[$us[2]])){
						switch($msg->action){
							case "register-student":
								$uc = user_chat::getBy(["channel" => $msg->data->key]);
								
								if(count($uc)){
									$uc = $uc[0];
									$d = $mdg->data;
									$ukey = F::UniqKey();
									
									chat_topic::insertInto([
										"created_at"=> date("Y-m-d H:i:s\ "),
										"updated_at"=> date("Y-m-d H:i:s\ "),
										"title"		=> F::Encode64(htmlspecialchars(F::Decode64($d->subject))),
										"status"	=> 0,
										"user_chat"	=> $uc->channel,
										"ukey"		=> $ukey
									]);
									
									$ct = chat_topic::getBy(["ukey" => $ukey]);
									
									if(count($ct)){
										$ct = $ct[0];
										
										chat::insertInto([
											"created_at"=> date("Y-m-d H:i:s\ "),
											"updated_at"=> date("Y-m-d H:i:s\ "),
											"topic_id"	=> $ct->id,
											"user_chat"	=> $uc->channel,
											"user_id"	=> 0,
											"stud_id"	=> 0,
											"message"	=> F::Encode64(htmlspecialchars(F::Decode64($d->subject))),
											"status"	=> 0
										]);
										
										$from->send(json_encode([
											"status"	=> "success",
											"action"	=> "register",
											"message"	=> "Chat service is ready!",
											"data"		=> [
												"ct"	=> $ukey
											]
										]));
										
										foreach($this->admin as $ad){
											$ad->send(json_encode([
												"action"	=> "subject",
												"option"	=> "create",
												"data"		=> [
													"ct"	=> $ct,
													"uc"	=> $uc
												]
											]));
										}
									}
								}
							break;
							
							case "register":
								$d = $msg->data;
								
								user_chat::insertInto([
									"name"		=> htmlspecialchars($d->name),
									"phone"		=> htmlspecialchars($d->phone),
									"email"		=> htmlspecialchars($d->email),
									"channel"	=> $us[2],
									"stud_id"	=> 0,
									"topic_id"	=> 0,
									"user_id"	=> 0,
									"notes"		=> 0
								]);
								
								$uc = user_chat::getBy([
									"channel"	=> $us[2]
								]);
								
								if(count($uc)){
									$uc = $uc[0];
									$ukey = F::UniqKey();
									
									chat_topic::insertInto([
										"created_at"=> date("Y-m-d H:i:s\ "),
										"updated_at"=> date("Y-m-d H:i:s\ "),
										"title"		=> F::Encode64(htmlspecialchars(F::Decode64($d->subject))),
										"status"	=> 0,
										"user_chat"	=> $us[2],
										"ukey"		=> $ukey
									]);
									
									$ct = chat_topic::getBy(["ukey" => $ukey]);
									
									if(count($ct)){
										$ct = $ct[0];
										
										chat::insertInto([
											"created_at"=> date("Y-m-d H:i:s\ "),
											"updated_at"=> date("Y-m-d H:i:s\ "),
											"topic_id"	=> $ct->id,
											"user_chat"	=> $uc->channel,
											"user_id"	=> 0,
											"stud_id"	=> 0,
											"message"	=> F::Encode64(htmlspecialchars(F::Decode64($d->subject))),
											"status"	=> 0
										]);
										
										$from->send(json_encode([
											"status"	=> "success",
											"action"	=> "register",
											"message"	=> "Chat service is ready!",
											"data"		=> [
												"ct"	=> $ukey
											]
										]));
										
										foreach($this->admin as $ad){
											$ad->send(json_encode([
												"action"	=> "subject",
												"option"	=> "create",
												"data"		=> [
													"ct"	=> $ct,
													"uc"	=> $uc
												]
											]));
										}
									}else{
										$from->send(json_encode([
											"status"	=> "error",
											"message"	=> "Internal server eror, Cannot accept your subject now."
										]));
									}
								}else{
									$from->send(json_encode([
										"status"	=> "error",
										"message"	=> "Internal server eror, Cannot accept your registration now."
									]));
								}
							break;
							
							case "chat":
								switch($msg->option){
									case "load":
										$ct = chat_topic::getBy([
											"user_chat"		=> $us[2],
											"ukey"			=> $msg->ct,
											"status"		=> 0
										]);
										
										if(count($ct)){
											$ct = $ct[0];
											
											$cs = chat::getBy(["topic_id" => $ct->id]);
											
											$data = [];
											
											foreach($cs as $c){
												$data[] = [
													"message"	=> $c->message,
													"from"		=> $c->user_chat
												];
											}
											
											DB::conn()->query("UPDATE chat SET status = 1 WHERE topic_id = $ct->id AND user_chat <> '{$us[2]}'");
											
											$from->send(json_encode([
												"action"	=> "chat",
												"option"	=> "load",
												"data"		=> $data
											]));
										}
									break;
									
									case "send":
										$ct = chat_topic::getBy([
											"user_chat"		=> $us[2],
											"ukey"			=> $msg->ct,
											"status"		=> 0
										]);
										
										if(count($ct)){
											$ct = $ct[0];
											
											chat::insertInto([
												"created_at"	=> date("Y-m-d H:i:s\ "),
												"updated_at"	=> date("Y-m-d H:i:s\ "),
												"user_chat"		=> $us[2],
												"stud_id"		=> 0,
												"user_id"		=> 0,
												"message"		=> F::Encode64(htmlspecialchars(F::Decode64($msg->message))),
												"topic_id"		=> $ct->id,
												"status"		=> 0
											]);
											
											foreach($this->admin as $t){
												$t->send(json_encode([
													"action"	=> "chat",
													"option"	=> "chat",
													"data"		=> [
														"message"	=> F::Encode64(htmlspecialchars(F::Decode64($msg->message))),
														"ct"		=> $ct->ukey
													]
												]));
											}
										}
									break;
									
									case "read":
										$ct = chat_topic::getBy([
											"user_chat"		=> $us[2],
											"ukey"			=> $msg->ct,
											"status"		=> 0
										]);
										
										if(count($ct)){
											$ct = $ct[0];
											
											DB::conn()->query("UPDATE chat SET status = 1 WHERE topic_id = $ct->id AND user_chat <> '{$us[2]}'");
										}
									break;
								}
							break;
						}
					}
				break;
			}
		}
	}

    public function onClose(ConnectionInterface $conn){
		$url = str_replace("/echo/", "", $conn->httpRequest->getUri()->getPath());
		$us = explode("/", $url);
    }

    public function onError(ConnectionInterface $conn, \Exception $e){
		echo "Server Error \n";
		print_r($e->getMessage());
        $conn->close();
    }
}

$app = new HttpServer(new WsServer(new MyChat()));

//For none SSL server, use this code: (comment it if want to use ssl)
$server = IoServer::factory(
	$app,
	PORT
);
$server->run();

/*
//For SSL server can user this code:
$loop = \React\EventLoop\Factory::create();

$secure_websockets = new \React\Socket\Server(HOST . ":" . PORT, $loop);
$secure_websockets = new \React\Socket\SecureServer($secure_websockets, $loop, [
	'local_cert' => SSL_CERT,
	'local_pk' => SSL_KEY,
	'verify_peer' => false,
	'allow_self_signed' => true,
]);

$secure_websockets_server = new \Ratchet\Server\IoServer($app, $secure_websockets, $loop);
$secure_websockets_server->run();
*/