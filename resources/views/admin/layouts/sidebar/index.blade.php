<aside class="sideMenu">
	<ul class="list-unstyled mb-0">
		
		<li>
			<a href="{{ url('admin/exams')  }}" class="sideMenu__link {{ ( \Request::route()->getName() === 'admin/exams') ? 'active' : ''  }}"> 
				<i class="icon-subadmin"></i> Manage Exams
			</a>
		</li>

	</ul>
</aside>
