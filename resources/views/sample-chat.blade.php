@extends('layouts.app')

@section('content')

<style>
.mi-floating-button {
	position: absolute;
	bottom: 20px;
	right: 20px;
	background-color: #dd161b;
	text-align: center;
	padding: 10px;
	border-radius: 50%;
	display: none;
}

.mi-floating-button:hover {
	background-color: #a30a0e;
	cursor: pointer;
}

.mi-floating-button > img {
	width: 50px;
	height: 50px;
}

.mi-chat-box {
	display: none;
	position: absolute;
	bottom: 20px;
	right: 20px;
	width: 350px;
	height: 400px;
	border: 1px solid #dd161b;
}

.mi-chat-header {
	background-color: #dd161b;
	padding: 10px;
	color: white;
	position: relative;
}

.mi-chat-close {
	position: absolute;
	color: white;
	right: 5px;
	top: 50%; 
	transform: translate(-50%, -50%);
	pading: 5px;
}

.mi-chat-close:hover {
	cursor: pointer;
}

.mi-registration-body, .mi-chat-body {
	height: calc(100% - 40px);
}

.mi-chat-body {
	position: relative;
}

.mi-registration-body {
	height: calc(100% - 40px);
	padding: 10px;
	overflow-y: auto;
}

.mi-registration-student-body {
	height: calc(100% - 40px);
	padding: 10px;
	overflow-y: auto;
	display: none;
}

.mi-chat-sender {
	position: absolute;
	width: 95%;
	bottom: 5px;
	left: 50%;
	transform: translate(-50%, 0);
}

.mi-chat-container {
	height: calc(100% - 45px);
	padding: 5px;
	overflow-y: auto;
}

.chat-local {
	width: 80%;
	margin-left: auto;
	background-color: #ffd1d2;
	padding: 5px;
}

.chat-remote {
	width: 80%;
	margin-right: auto;
	background-color: #d1f4ff;
	padding: 5px;
}

.mi-notify {
	font-size: 39pt;
	position: absolute;
	font-weight: 900;
	right: 50px;
	top: -10;
	display: none;
}
</style>


<div class="mi-chat-box">
	<div class="mi-chat-header">
		Customer Support
		
		<div class="mi-chat-close">
			<strong>X</strong>
		</div>
	</div>
	
	<div class="mi-chat-body">
		<div class="mi-chat-container" id="mi-chat-container">
			
		</div>
		
		<div class="mi-chat-sender">
			<input type="text" class="form-control" id="message" placeholder="Message..." />
		</div>
	</div>
	
	<div class="mi-registration-body">
		<small>*Please insert your detail to chat with us.</small><br />
		Name:
		<input type="text" class="form-control mb-2" placeholder="Name" id="name" />
		
		Email:
		<input type="email" class="form-control mb-2" placeholder="Email" id="email" />
		
		Phone:
		<input type="tel" class="form-control mb-2" placeholder="Phone" id="phone" />
		
		Subject:
		<input type="text" class="form-control mb-3" placeholder="Subject" id="subject" />
		
		<button class="btn btn-primary" id="register">
			Register
		</button>
	</div>
	
	<div class="mi-registration-student-body">
		<small>*Please insert your subject to chat with us.</small><br />
		
		Subject:
		<input type="text" class="form-control mb-3" placeholder="Subject" id="subject" />
		
		<button class="btn btn-primary" id="register-student">
			Register
		</button>
	</div>
</div>

<div class="mi-floating-button">
	<img src="{{url('assets/images/chat.png')}}" />
	<span class="text-warning mi-notify">!</span>
</div>

<script>
function base64_encode(str) {
	return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
		function toSolidBytes(match, p1) {
			return String.fromCharCode('0x' + p1);
	}));
}

function base64_decode(str) {
	return decodeURIComponent(atob(str).split('').map(function(c) {
		return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
	}).join(''));
}

$(document).ready(function(){
	var ws = null;
	var ct = null;
	var new_ct = null;
	var key = null;
	var logged_in = false;
	var opened = false;
	var student = false;
	var closing = false;
	var first = true;
	
	@if(Session::has('chat_channel'))
		//Student logged in
		console.log("student logged in");
		
		key = "{{ Session::get('chat_channel') }}";
		student = true;
		
		$(".mi-chat-body").hide();
		$(".mi-registration-body").hide();
		$(".mi-registration-student-body").show();
	@else
		console.log("Student not logged in");
		$(".mi-chat-body").hide();
		$(".mi-registration-body").show();
		
		key = "";
		
		if(localStorage.getItem("chat_channel") == undefined || localStorage.getItem("chat_channel") == null){
			key = "uid" + Math.random().toString(16).slice(2);
			
			localStorage.setItem("chat_channel", key);
		}else{
			key = localStorage.getItem("chat_channel");
		}
	@endif
	
	start_ws();
	
	$("#message").on("keyup", function(e){
		if(e.keyCode == 13){
			if(ws != null || ws.readystate == 1){
				ws.send(JSON.stringify({
					action: "chat",
					option: "send",
					message: base64_encode($(this).val()),
					ct: ct
				}));
				
				$("#mi-chat-container").append('\
					<div class="chat-local mb-2">\
						'+ $(this).val() +'\
					</div>\
				');
				
				$(this).val("");
				auto_scroll();
			}else{
				alert("Cannot send our message at the moment. Please try again.");
			}
		}
	});

	$("#register").on("click", function(){
		if(ws == null){
			alert("Fail registration. You are not connected to chat server.");
		}else{			
			ws.send(JSON.stringify({
				action: "register",
				data: {
					name: $("#name").val(),
					phone: $("#phone").val(),
					email: $("#email").val(),
					subject: base64_encode($("#subject").val())
				}
			}));
		}
	});
	
	$("#register-student").on("click", function(){
		if(ws == null){
			alert("Fail registration. You are not connected to chat server.");
		}else{			
			ws.send(JSON.stringify({
				action: "register-student",
				data: {
					key: key,
					subject: base64_encode($("#subject").val())
				}
			}));
		}
	});
	
	$(".mi-floating-button").on("click", function(){
		$(".mi-chat-box").show();
		$(".mi-floating-button").hide();
		
		if(ct != null){
			opened = true;
			
			if(closing){
				key = "uid" + Math.random().toString(16).slice(2);
				localStorage.setItem("chat_channel", key);
				ws.close();
				ws = null;
				ct = null;							
				auto_scroll();
				closing = false;
				$(".mi-notify").hide();
			}else{
				ws.send(JSON.stringify({
					action: "chat",
					option: "load",
					ct: ct
				}));
				
				$(".mi-notify").hide();
				
				auto_scroll();
			}			
		}else{
			if(student){
				$(".mi-chat-body").hide();
				$(".mi-registration-body").hide();
				$(".mi-registration-student-body").show();
			}else{
				if(ws == null){
					start_ws();
				}
				
				$(".mi-chat-body").hide();
				$(".mi-registration-body").show();
			}
		}
	});

	$(".mi-chat-close").on("click", function(){
		$(".mi-chat-box").hide();
		$(".mi-floating-button").show();
		
		opened = false;
	});
	
	function auto_scroll(){
		document.getElementById("mi-chat-container").scrollTop = document.getElementById("mi-chat-container").scrollHeight + 200;
	}
	
	function start_ws(){
		ws = new WebSocket("{{ env('CS_WS_Server') }}customer/" + key);
	
		ws.onopen = function(){
			console.log("Chat server connected");
			
			$("#message").prop("disabled", false);
			
			if(first){
				$(".mi-floating-button").show();
				first = false;
			}
		};
			
		ws.onmessage = function(m){
			var d = JSON.parse(m.data);
			
			switch(d.action){
				case "subject":
					switch(d.option){
						case "close":
							@if(!Session::has('chat_channel'))
								$("#mi-chat-container").append('\
									<div class="chat-remote mb-2">\
										Thank you for contacting us. This case has been close. You can fill the form to chat with us again. :)\
									</div>\
								');
								
								if(!opened){
									closing = true;
									$(".mi-notify").show();
								}else{
									key = "uid" + Math.random().toString(16).slice(2);
									localStorage.setItem("chat_channel", key);
									ws.close();
									ws = null;
									ct = null;							
									auto_scroll();
								}
								
								$("#message").prop("disabled", true);
							@else
								$("#mi-chat-container").append('\
									<div class="chat-remote mb-2">\
										Thank you for contacting us. This case has been close. You can reopen this chat to start new issue. :)\
									</div>\
								');
								$("#message").prop("disabled", true);
								ct = null;
								auto_scroll();
							@endif
						break;
					}
				break;
				
				case "chat":
					switch(d.option){
						case "load":
							$("#mi-chat-container").html("");
							d.data.forEach(function(x){
								if(key == x.from){
									$("#mi-chat-container").append('\
										<div class="chat-local mb-2">\
											'+ base64_decode(x.message) +'\
										</div>\
									');
								}else{
									$("#mi-chat-container").append('\
										<div class="chat-remote mb-2">\
											'+ base64_decode(x.message) +'\
										</div>\
									');
								}
							});
							
							auto_scroll();
							opened = true;
						break;
						
						case "chat":
							$("#mi-chat-container").append('\
								<div class="chat-remote mb-2">\
									'+ base64_decode(d.data.message) +'\
								</div>\
							');
							
							if(opened){
								ws.send(JSON.stringify({
									action: "chat",
									option: "read",
									ct: ct
								}));
							}else{
								$(".mi-notify").show();
							}
							
							auto_scroll();
						break;
					}
				break;
				
				case "register":
					if(d.status == "success"){
						$("#message").prop("disabled", false);
						$(".mi-chat-body").show();
						$(".mi-registration-body").hide();
						
						ct = d.data.ct;
						
						ws.send(JSON.stringify({
							action: "chat",
							option: "load",
							ct: ct
						}));
						
						$("#name").val("");
						$("#phone").val("");
						$("#email").val("");
						$("#subject").val("");
					}else{
						aler(d.message);
					}
				break;
				
				case "registered":
					$("#message").prop("disabled", false);
					$(".mi-chat-body").show();
					$(".mi-registration-body").hide();
					
					ct = d.data.ct;
					
					if(d.data.unread){
						$(".mi-notify").show();
					}
				break;
			}
		};
		
		ws.onclose = function(){
			console.log("Connection to chat server closed.");
		};
	}
});
</script>

@endsection




































