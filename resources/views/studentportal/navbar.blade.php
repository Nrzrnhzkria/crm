@if (Session::get('student_login_id'))
<nav class="navbar navbar-expand-lg navbar-light sticky-top px-5" style="background-color: #ffffff; padding-top:1%; padding-bottom:1%; box-shadow: 0 0px 30px 0 rgba(0, 0, 0, 0.2);">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="site-logo-inner pr-3" href="#">
            <img src="{{ asset('assets/images/logo.png') }}" class="custom-logo" width="70" alt="">
        </a>
        <div class="collapse navbar-collapse " id="navbarTogglerDemo03">
            {{-- left element --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="/student/dashboard">Home</a>
                </li>
                {{-- shauqi add --}}
                {{-- <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="{{ route('student.link') }}">Event Link</a>
                </li> --}}

                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="{{ route('student.invite_list') }}">Customer Invite</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="{{ route('invoices.receipt') }}">Invoices & Receipt</a>
                </li>
				
            </ul>

            {{-- right element --}}
            <ul class="nav navbar-nav justify-content-end">
                <!-- Authentication Links -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-link active" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i> <span class="caret"></span>
                    </a>
    
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">  
                        {{-- <li class="nav-item">
                            {{-- <a class="dropdown-item" href="/manageprofile"><i class="fas fa-address-card pr-3"></i> Manage Profile</a> 
                            <!-- Button trigger modal -->
                            <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#passwordModal"><i class="fas fa-address-card pr-3"></i> Change Password</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="dropdown-item" href="/student/form-current-password">
                                <i class="bi bi-key pr-2"></i> Reset Password
                            </a>
    
                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item" href="/student/logout">
                                 <i class="bi bi-box-arrow-right pr-2"></i> Logout
                            </a>
    
                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endif

<script>
var wsn = new WebSocket("ws://{{ env('CS_WS_Server') }}/notify");

wsn.onopen = function(){
	console.log("Server Open");
	
	wsn.onmessage = function(m){
		var data = m.data;
		
		switch(data.action){
			case "notify":
				
			break;
		}
	};
	
	
};

wsn.onclose = function(){
	console.log("Connection to websocket server closed.");
};

wsn.onerror = function(e){
	console.log("Connection to websocket server error: ", e);
};
</script>