            		<!-- main-sidebar -->
                    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar sidebar-scroll">
				<div class="main-sidebar-header active">
					<a class="desktop-logo logo-light active" href="/AD_Dashboard"><img src="{{ URL::to('/') }}/admin/assets//img/brand/logo.png" class="main-logo" alt="logo"></a>
					<a class="desktop-logo logo-dark active" href="/AD_Dashboard"><img src="{{ URL::to('/') }}/admin/assets//img/brand/logo-white.png" class="main-logo dark-theme" alt="logo"></a>
					<a class="logo-icon mobile-logo icon-light active" href="/AD_Dashboard"><img src="{{ URL::to('/') }}/admin/assets//img/brand/favicon.png" class="logo-icon" alt="logo"></a>
					<a class="logo-icon mobile-logo icon-dark active" href="/AD_Dashboard"><img src="{{ URL::to('/') }}/admin/assets//img/brand/favicon-white.png" class="logo-icon dark-theme" alt="logo"></a>
				</div>
				<div class="main-sidemenu table-responsive">
					<div class="app-sidebar__user clearfix">
						<div class="dropdown user-pro-body">
							<div class="">
								<img alt="user-img" class="avatar avatar-xl brround" src="/employee/<?=Session::get('image');?>"><span class="avatar-status profile-status bg-green"></span>
							</div>
							<div class="user-info">
								<h4 class="font-weight-semibold mt-3 mb-0"><?=Session::get('AdminFirstName');?></h4>
								<span class="mb-0 text-muted"><?=Session::get('AdminEmNumber');?></span>
							</div>
						</div>
					</div>
					<ul class="side-menu">
                 
						<?php if(in_array(1, Session::get('empSys'))):?>
							<li class="side-item side-item-category">Main</li>
							<li class="slide">
								<a class="side-menu__item" href="/AD_Dashboard"><i class="fa fa-tachometer mr-2" aria-hidden="true" ></i><span class="side-menu__label">Dashboard</span></a>
							</li>
						<?php endif?>

						<?php if(in_array(2, Session::get('empSys'))):?>
							<li class="side-item side-item-category">Finance Management</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#"><i class="fa fa-money  mr-2" aria-hidden="true"></i><span class="side-menu__label">Student Payments</span><i class="angle fe fe-chevron-down"></i></a>
								<ul class="slide-menu">
									<li><a class="slide-item" href="/Get_Student_Payment">Get Student Payment</a></li>
									<li><a class="slide-item" href="/Manage_Student_Payments">Manage Students Payments</a></li>
								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#"><i class="fa fa-usd  mr-2" aria-hidden="true"></i><span class="side-menu__label">Other Incomes</span><i class="angle fe fe-chevron-down"></i></a>
								<ul class="slide-menu">
									<li><a class="slide-item" href="/Get_Other_Income">Get Other Income</a></li>
									<li><a class="slide-item" href="/Manage_Other_Incomes">Manage Other Incomes</a></li>
								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#"><i class="fas fa-money  mr-2" aria-hidden="true"></i><span class="side-menu__label">Expenses</span><i class="angle fe fe-chevron-down"></i></a>
								<ul class="slide-menu">
									<li><a class="slide-item" href="/Add_Expenses">Add Expenses</a></li>
									<li><a class="slide-item" href="/Manage_Expenses">Manage Expenses</a></li>
								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" href="/FinanceReport"><i class="fa fa-file-excel-o  mr-2" aria-hidden="true"></i><span class="side-menu__label">Reports</span></a>
							</li>
							
						<?php endif?>

						<?php if(in_array(3, Session::get('empSys'))):?>
							<li class="side-item side-item-category">Learning Management</li>
							<li class="slide">
								<a class="side-menu__item" href="/AD_ClassRooms"><i class="fa fa-window-restore  mr-2" aria-hidden="true"></i><span class="side-menu__label">Class Rooms</span></a>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#"><i class="fas fa-chalkboard  mr-2" aria-hidden="true"></i><span class="side-menu__label">Classes</span><i class="angle fe fe-chevron-down"></i></a>
								<ul class="slide-menu">
									<li><a class="slide-item" href="/AD_ManageClassRoom">Manage Classroom</a></li>
									<li><a class="slide-item" href="/AD_AddClassRoom">Create New Classroom</a></li>
								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#"><i class="fa fa-user  mr-2" aria-hidden="true"></i><span class="side-menu__label">Students</span><i class="angle fe fe-chevron-down"></i></a>
								<ul class="slide-menu">
									<li><a class="slide-item" href="/AD_AddStudent">Add Student</a></li>
									<li><a class="slide-item" href="/AD_ManageStudents">Manage Students</a></li>
								</ul>
							</li>
						<?php endif?>

						<?php if(in_array(7, Session::get('empSys'))):?>
							<li class="side-item side-item-category">Stock Management</li>
							<li class="slide">
								<a class="side-menu__item" href="/removels"><i class="fa fa-minus-square  mr-2" aria-hidden="true"></i><span class="side-menu__label">Items Removals</span></a>
							</li>
							<li class="slide">
								<a class="side-menu__item" href="/removelList"><i class="fa fa-list  mr-2" aria-hidden="true"></i><span class="side-menu__label">Removal List</span></a>
							</li>
							<li class="slide">
								<a class="side-menu__item" href="/store"><i class="fa fa-plus-square  mr-2" aria-hidden="true"></i><span class="side-menu__label">Store Items </span></a>
							</li>
							<li class="slide">
								<a class="side-menu__item" href="/stockHistory"><i class="fa fa-list  mr-2" aria-hidden="true"></i><span class="side-menu__label">Stock History</span></a>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#"><i class="fa fa-square-o  mr-2" aria-hidden="true"></i><span class="side-menu__label">Manage Items</span><i class="angle fe fe-chevron-down"></i></a>
								<ul class="slide-menu">
									<li><a class="slide-item" href="/AddNewItem">New Item</a></li>
									<li><a class="slide-item" href="/ManageItems">Manage Items</a></li>
								</ul>
							</li>
						
						<?php endif?>

						<?php if(in_array(4, Session::get('empSys'))):?>
							<li class="side-item side-item-category">ST Attendance & Payment</li>
							<li class="slide">
								<a class="side-menu__item" href="/AttendanceSelector"><i class="fa fa-sign-language mr-2" aria-hidden="true" ></i><span class="side-menu__label">Mark Attendance</span></a>
							</li>
							<li class="slide">
								<a class="side-menu__item" href="/ManageAttendanceSelector"><i class="fa fa-sign-language mr-2" aria-hidden="true" ></i><span class="side-menu__label">Manage Attendance</span></a>
							</li>
						<?php endif?>

						
						<?php if(in_array(5, Session::get('empSys'))):?>
							<li class="side-item side-item-category">Task Management</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#"><i class="fa fa-thumb-tack  mr-2" aria-hidden="true"></i><span class="side-menu__label">Tasks</span><i class="angle fe fe-chevron-down"></i></a>
								<ul class="slide-menu">
									<li><a class="slide-item" href="/AD_AddTask">Add Task</a></li>
									<li><a class="slide-item" href="/AD_ManageTasks">Manage Tasks</a></li>
								</ul>
							</li>
						<?php endif?>

						<?php if(in_array(6, Session::get('empSys'))):?>
							<li class="side-item side-item-category">Employee Management</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#"><i class="fa fa-users  mr-2" aria-hidden="true"></i><span class="side-menu__label">Employees</span><i class="angle fe fe-chevron-down"></i></a>
								<ul class="slide-menu">
									<li><a class="slide-item" href="/AD_AddEmployee">Add Employee</a></li>
									<li><a class="slide-item" href="/AD_ManageEmployees">Manage Employees</a></li>
								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#"><i class="fa fa-cog  mr-2" aria-hidden="true"></i><span class="side-menu__label">System Assign</span><i class="angle fe fe-chevron-down"></i></a>
								<ul class="slide-menu">
									<li><a class="slide-item" href="/AddSystem">Add Systems</a></li>
									<li><a class="slide-item" href="/ManageSystems">Manage Employee Systems</a></li>
								</ul>
							</li>
						<?php endif?>
					

						
				



						<li class="side-item side-item-category">General</li>
						<li class="slide">
							<a class="side-menu__item" href="/AD_MyManageTasks"><i class="fa fa-tasks  mr-2" aria-hidden="true"></i><span class="side-menu__label">My Tasks</span></a>
						</li>

					
					</ul>
				</div>
			</aside>
			<!-- main-sidebar -->
            <!-- main-content -->
			<div class="main-content app-content">

            				<!-- main-header -->
				<div class="main-header sticky side-header nav nav-item layout-pin">
					<div class="container-fluid">
						<div class="main-header-left ">
							<div class="responsive-logo">
								<a href="/AD_Dashboard"><img src="{{ URL::to('/') }}/admin/assets//img/brand/logo.png" class="logo-1" alt="logo"></a>
								<a href="/AD_Dashboard"><img src="{{ URL::to('/') }}/admin/assets//img/brand/logo-white.png" class="dark-logo-1" alt="logo"></a>
								<a href="/AD_Dashboard"><img src="{{ URL::to('/') }}/admin/assets//img/brand/favicon.png" class="logo-2" alt="logo"></a>
								<a href="/AD_Dashboard"><img src="{{ URL::to('/') }}/admin/assets//img/brand/favicon-white.png" class="dark-logo-2" alt="logo"></a>
							</div>
							<div class="app-sidebar__toggle" data-toggle="sidebar">
								<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
								<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
							</div>


						</div>
						<div class="main-header-right">
						
							<div class="nav nav-item  navbar-nav-right ml-auto">
						
								<div class="nav-item full-screen fullscreen-button">
									<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
								</div>
								<div class="dropdown main-profile-menu nav nav-item nav-link">
									<a class="profile-user d-flex" href="#"><img alt="" src="/employee/<?=Session::get('image');?>"></a>
									<div class="dropdown-menu">
										<div class="main-header-profile bg-primary p-3">
											<div class="d-flex wd-100p">
												<div class="main-img-user"><img alt="" src="/employee/<?=Session::get('image');?>" class=""></div>
												<div class="ml-3 my-auto">
													<h6><?=Session::get('AdminFirstName');?>  <?=Session::get('AdminLastName');?>	</h6><span><?=Session::get('AdminSystemRole');?></span><span><?=Session::get('AdminEmNumber');?></span>
												</div>
											</div>
										</div>
										<a class="dropdown-item" href="/Logout"><i class="bx bx-log-out"></i> Sign Out</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>