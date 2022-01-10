@if (Auth::guest())
@else
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
                    <a class="nav-link active" aria-current="page" href="/dashboard">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Customer
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="/customer_profiles"><i class="bi bi-person-lines-fill pr-2"></i>Customer Profile</a></li>
                        
                        @if (Auth::user()->user_id == 'UID001')
                        <li><a class="dropdown-item" href="/customer_details"><i class="bi bi-person-lines-fill pr-2"></i>Business Customer Detail</a></li>
                        {{-- <li><a class="dropdown-item" href="/customer-invite"><i class="bi bi-person-lines-fill pr-2"></i>Customer Invite List</a></li> --}}
                        @endif
                        @if(Auth::user()->user_id == 'UID002' || Auth::user()->user_id == 'UID003' || Auth::user()->user_id == 'UID004')
                        @else 
                        <li><a class="dropdown-item" href="/membership"><i class="bi bi-person-badge pr-2"></i>Membership Programme</a></li>
                        @endif
                        <li><a class="dropdown-item" href="/trackprogram"><i class="bi bi-graph-up pr-2"></i>Sales Report</a></li>

                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/emailblast"><i class="bi bi-envelope pr-2"></i>Email Blasting</a></li>
						<li><a class="dropdown-item" href="/emailtemplate"><i class="bi bi-palette pr-2"></i>Email Template</a></li>
                        
                        @if(Auth::user()->role_id == 'ROD003' || Auth::user()->role_id == 'ROD004')
                        @else   
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/smsblast"><i class="bi bi-chat-left-text pr-2"></i>SMS Blasting</a></li>
						<li><a class="dropdown-item" href="/smstemplate"><i class="bi bi-chat-left-text pr-2"></i>SMS Template</a></li>
						<li><a class="dropdown-item" href="/zoom"><i class="bi bi-camera-reels pr-2"></i>Zoom Meeting</a></li>
                        @endif
                    </ul>
                </li>
                
                @if(Auth::user()->role_id == 'ROD003' || Auth::user()->role_id == 'ROD004')
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Employee
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                      <li><a class="dropdown-item" href=""><i class="bi bi-person-lines-fill pr-2"></i>Employee Profile</a></li>
                      <li><a class="dropdown-item" href=""><i class="bi bi-currency-dollar pr-2"></i>Commission</a></li>
                    </ul>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Event
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                      <li><a class="dropdown-item" href="/product"><i class="bi bi-calendar4-event pr-2"></i>Manage Event</a></li>
                      <li><a class="dropdown-item" href="/view-offer"><i class="bi bi-tags pr-2"></i>Manage Offer</a></li>
                      <li><hr class="dropdown-divider"></li>                      
                      <li><a class="dropdown-item" href="/collection-id"><i class="bi bi-cash-stack pr-2"></i>Collection ID</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/manageuser">User</a>
                </li>
                @endif
				
				<li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/customer-support">
						Customer Support 
						<span class="fas fa-circle" id="noti-indicator"></span>
					</a>
                </li>
            </ul>

            {{-- right element --}}
            <ul class="nav navbar-nav justify-content-end">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <!--<li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>-->
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle nav-link active" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                           <i class="bi bi-person-circle pr-1"></i> {{ Auth::user()->email }} <span class="caret"></span>
                        </a>
        
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">  
                            {{-- <li class="nav-item">
                                {{-- <a class="dropdown-item" href="/manageprofile"><i class="fas fa-address-card pr-3"></i> Manage Profile</a> 
                                <!-- Button trigger modal -->
                                <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#passwordModal"><i class="fas fa-address-card pr-3"></i> Change Password</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="dropdown-item" href="/logout"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                   <i class="bi bi-box-arrow-right pr-2"></i> Logout
                                </a>
        
                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<script>
var wsn = new WebSocket("{{ env('CS_WS_Server') }}notify");

wsn.onopen = function(){
	console.log("Server Open");
	
	wsn.onmessage = function(m){
		var data = m.data;
		
		switch(data.action){
			case "notify":
				$("#noti-indicator").addClass("text-success");
			break;
		}
	};	
};

wsn.onclose = function(){
	//console.log("Connection to websocket server closed.");
};

wsn.onerror = function(e){
	//console.log("Connection to websocket server error: ", e);
};
</script>

@endif
<!-- Modal -->
{{-- <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ url('updateprofile') }}/{{ Auth::user()->user_id }}">
        @csrf
            <div class="modal-body">

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ Auth::user()->password }}" required autocomplete="new-password">
        
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ Auth::user()->password }}" required autocomplete="new-password">
                </div>
                      
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
    </div>
</div> --}}

