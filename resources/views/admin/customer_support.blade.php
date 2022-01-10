@extends('layouts.app')

@section('title')
    Dashboard
@endsection


@section('content')
<style>
html, body {
	height: 100%;
}

.issue-card {
	height: calc(100% - 100px);
}

.container-fluid {
	height: calc(100% - 50px);
}

.h-100{
	height: 100%;
}

.h-m-100 {
	height: calc(100% - 95px)
}

.subject-row {
	padding: 10px;
	border-bottom: 1px solid #e0e0e0;
	cursor: pointer;
}

.subject-row.active {
	background-color: #c7c7c7;
}

.subject-row:hover {
	background-color: #e0e0e0;
	
}

.notify {
	/* display: none; */
}

#chat-container {
	display: none;
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

#mi-chat-container {
	padding: 5px;
	overflow-y: scroll;
}
</style>
<div class="row h-100">
	<div class="col-md-12 h-100">     
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2">Customer Support</h1>
			<p class="lead">Chat base customer support</p>
		</div>
		
		@if ($maintenance)
			<div class="alert alert-danger alert-block">	
				<strong>This page is currently closed for while due to constrcution in progress.</strong>
			</div>
		@else
		
		<div class="row h-m-100">
			<div class="col-md-4 h-100">
				<div class="card h-100">
					<div class="card-header">
						<span class="fas fa-list"></span> Issues Listing
					</div>
					
					<div class="card-body p-0" id="subject-list" style="overflow-y: auto;">
					</div>
				</div>
			</div>
			
			<div class="col-md-8 h-100">
				<div class="card h-100" id="chat-container">
					<div class="card-header">
						<div class="row">
							<div class="col-md-6" id="sender-name">
								Username
							</div>
							
							<div class="col-md-6 text-right">								
								<button class="btn btn-warning btn-sm" id="close-case">
									Close Case <span class="fas fa-bookmark"></span>
								</button>
								
								<button class="btn btn-danger btn-sm" id="close-chat">
									Close <span class="fas fa-times"></span>
								</button>
							</div>
						</div>
						
					</div>
					
					<div class="card-body" id="mi-chat-container">
						
					</div>
					
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12 col-sm-8">
								<input type="text" autofocus="on" class="form-control" placeholder="Reply..." id="message" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
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

var ws = null;
var current_channel = null;

$("#close-case").on("click", function(){
	var x = confirm("Are you sure to close this case?");
	
	if(x){
		//console.log("asdadasd");
		
		if(current_channel != null){
			ws.send(JSON.stringify({
				action: "subject",
				option: "close",
				ct: current_channel
			}));
		}
	}
});

$(document).ready(function(){
	console.log("JQuery is ready now!");
	
	run_ws_client();
});

$(document).on("click", ".subject-row", function(){
	current_channel = $(this).data("channel");
	$("#notify-" + current_channel).hide();
	
	ws.send(JSON.stringify({
		action: "chat",
		option: "load",
		ct: current_channel
	}));
});

$(document).on("click", "#close-chat", function(){
	current_channel = null;
	
	$("#chat-container").hide();
});

$("#chat-send").on("click", function(){
	//
	//
	//
	$("#chat-content").val("");
});

$("#message").on("keyup", function(e){
	if(e.keyCode == 13){
		if(ws != null || ws.readystate == 1){
			ws.send(JSON.stringify({
				action: "chat",
				option: "send",
				message: base64_encode($(this).val()),
				ct: current_channel
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

function load_list(){
	$("#subject-list").html("");
	
	ws.send(JSON.stringify({
		"action": "subject",
		"option": "list"
	}));
}

function run_ws_client(){
	ws = new WebSocket("{{ env('CS_WS_Server') }}admin/{{$uc->channel}}");
	
	ws.onopen = function(){
		console.log("Connected to Chat Server");
		
		load_list();
	};
	
	ws.onmessage = function(m){
		var d = JSON.parse(m.data);
		
		switch(d.action){
			case "subject":
				switch(d.option){
					case "list":
						d.data.forEach(function(s){
							var noti = "none";
							
							if(s.unread == true){
								noti = "";
							}
							
							var badge = "";
							if(s.status == 1){
								badge = "<span class='badge badge-secondary'>CLOSED</span>";
							}else{
								badge = "<span class='badge badge-secondary' id='closed-"+ s.ukey +"' style='display: none;'>CLOSED</span>";
							}
							
							$("#subject-list").append('\
								<div class="subject-row" data-id="subject-'+ s.ukey +'" data-channel="'+ s.ukey +'">\
									<span class="fa fa-circle text-danger notify" style="display: '+ noti +';" id="notify-'+ s.ukey +'"></span> \
									<strong><u>'+ base64_decode(s.title) +'</u></strong> '+ badge +' <br />\
									'+ s.user.name +'<br />\
									'+ s.user.email +' - '+ s.user.phone +'\
								</div>\
							');
						});
					break;
					
					case "create":
						$("#subject-list").prepend('\
							<div class="subject-row" data-id="subject-'+ d.data.ct.ukey +'" data-channel="'+ d.data.ct.ukey +'">\
								<span class="fa fa-circle text-danger" id="notify-'+ d.data.ct.ukey +'"></span> \
								<strong><u>'+ base64_decode(d.data.ct.title) +'</u></strong> <span class="badge badge-secondary" id="closed-'+ d.data.ct.ukey +'" style="display: none;">CLOSED</span><br />\
								'+ d.data.uc.name +'<br />\
								'+ d.data.uc.email +' - '+ d.data.uc.phone +'\
							</div>\
						');
					break;
					
					case "close":
						if(current_channel == d.data.ct){
							$("#closed-" + d.data.ct).show();
							$("#message").prop("disabled", true);
							$("#close-case").hide();
						}
					break;
				}
			break;
			
			case "chat":
				switch(d.option){
					case "chat":
						if($("#notify-" + d.data.ct).length > 0 && d.data.ct != current_channel){
							$("#notify-" + d.data.ct).show();
						}
						
						if(d.data.ct == current_channel){
							$("#mi-chat-container").append('\
								<div class="chat-remote mb-2">\
									'+ base64_decode(d.data.message) +' \
								</div>\
							');
							
							ws.send(JSON.stringify({
								action: "chat",
								option: "read",
								ct: current_channel
							}));
							
							auto_scroll();
						}
					break;
					
					case "load":
						$("#mi-chat-container").html("");
						if(d.status == "success"){
							if(d.data.ct.ukey == current_channel){
								var addText = "";
								if(d.data.ct.status == 1){
									$("#message").prop("disabled", true); 
									addText = "<br /><small>This case has been closed.</small>";
									$("#close-case").hide();
								}else{
									$("#message").prop("disabled", false);
									$("#close-case").show();
								}
								
								$("#chat-container").css("display", "flex");
								
								$("#sender-name").html(d.data.uc.name + ": " + base64_decode(d.data.ct.title) + addText);
								
								d.data.chat.forEach(function(x){
									if(x.from == "{{$uc->channel}}"){
										$("#mi-chat-container").append('\
											<div class="chat-local mb-2">\
												'+ base64_decode(x.message) +' \
											</div>\
										');
									}else{
										$("#mi-chat-container").append('\
											<div class="chat-remote mb-2">\
												'+ base64_decode(x.message) +' \
											</div>\
										');
									}
								});
								
								auto_scroll();
							}
						}else{
							current_channel = null;
							
							alert(d.message);
						}
					break;
				}
			break;
		}
	};
}

function auto_scroll(){
	document.getElementById("mi-chat-container").scrollTop = document.getElementById("mi-chat-container").scrollHeight + 200;
}
</script>

@endsection














