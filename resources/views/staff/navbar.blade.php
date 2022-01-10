@if (Session::get('role_id') == 'ROD005')
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
                    <a class="nav-link active" aria-current="page" href="{{ route('staff.dashboard') }}">Home</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="{{ route('staff.link') }}">Event Link</a>
                </li>

                {{-- <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="{{ route('staff.link') }}">Staff Link</a>
                </li> --}}

                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Customer
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="/customer_profiles"><i class="bi bi-person-lines-fill pr-2"></i>Customer Profile</a></li>
                        <li><a class="dropdown-item" href="/trackprogram"><i class="bi bi-graph-up pr-2"></i>Sales Report</a></li>

                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/emailblast"><i class="bi bi-envelope pr-2"></i>Email Blasting</a></li>
						<li><a class="dropdown-item" href="/emailtemplate"><i class="bi bi-envelope pr-2"></i>Email Template</a></li>
                    </ul>
                </li> --}}
                
                {{-- @if(Auth::user()->role_id == 'ROD001' || Auth::user()->role_id == 'ROD002')
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
                      <li><a class="dropdown-item" href="/product"><i class="bi bi-calendar4-event pr-2"></i>Event</a></li>
                      <li><a class="dropdown-item" href="/view-offer"><i class="bi bi-tags pr-2"></i>Offer</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/manageuser">User</a>
                </li>
                @endif --}}
				
				{{-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/customer-support">
						Customer Support 
						<span class="fas fa-circle text-dark"></span>
					</a>
                </li> --}}
            </ul>

            {{-- right element --}}
            <ul class="nav navbar-nav justify-content-end">
                <!-- Authentication Links -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-link active" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i> <span class="caret"></span>
                    </a>
    
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">  
                        <li class="nav-item">
                            <a class="dropdown-item" href="{{ route('staff.logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right pr-2"></i> Logout
                            </a>
    
                            <form id="logout-form" action="{{ route('staff.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

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
@else

@endif