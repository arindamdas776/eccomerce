 <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('admin.dashboard')}}">Company name</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#" onclick="
			document.getElementById('logout-form').submit();
	  ">Sign out</a>
	  
	  <form method="POST" action="{{route('logout')}}" id="logout-form">
	  @csrf
	  </form>
    </li>
  </ul>
</nav>