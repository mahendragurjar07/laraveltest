<header id="Adminheader" class="adminHeader bg-white">
	<div class="adminHeader__logo d-flex align-items-center">
		<a href="{{ url('admin/exams') }}">
			Logo Here
		</a>
		<button type="button" id="sideNavCollapse" class="sidenavToggleBtn d-block d-xl-none p-0 border-0">
				<span class="icon-bars"></span>
		</button>
	</div>
	<div class="adminHeader__topNav d-flex align-items-center justify-content-end h-100">
		<div class="adminHeader__right">
			<div class="dropdown adminProfile ">
			  <a class="dropdown-toggle d-flex align-items-center font-rg " href="#" role="button" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <span class="font-md">Admin</span>
			  </a>
			  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
			    <a class="dropdown-item" href="{{ url('admin/logout') }}">Logout</a>
			  </div>
			</div>
		</div>
	</div>
</header>