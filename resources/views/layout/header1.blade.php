            		<!-- main-sidebar -->
                    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
			<aside class="app-sidebar sidebar-scroll ">
				<div class="main-sidebar-header active">
					<a class="desktop-logo logo-light active" href="/AD_Dashboard"><img src="{{ URL::to('/') }}/admin/assets//img/brand/logo.png" class="main-logo" alt="logo"></a>
					<a class="desktop-logo logo-dark active" href="/AD_Dashboard"><img src="{{ URL::to('/') }}/admin/assets//img/brand/logo-white.png" class="main-logo dark-theme" alt="logo"></a>
					<a class="logo-icon mobile-logo icon-light active" href="/AD_Dashboard"><img src="{{ URL::to('/') }}/admin/assets//img/brand/favicon.png" class="logo-icon" alt="logo"></a>
					<a class="logo-icon mobile-logo icon-dark active" href="/AD_Dashboard"><img src="{{ URL::to('/') }}/admin/assets//img/brand/favicon-white.png" class="logo-icon dark-theme" alt="logo"></a>
				</div>
				<div class="main-sidemenu">
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

                        
						<li class="side-item side-item-category">Class Room&nbsp;<i class="fa fa-arrow-down" aria-hidden="true"></i><br><?=$classroom[0]->C_NAME?></li>
						<br>
						<li class="slide">
							<a class="side-menu__item" href="/class_dashboard/<?=$classroom[0]->C_ID?>"><i class="fa fa-tachometer  mr-2" aria-hidden="true"></i><span class="side-menu__label">Class Dashboard</span></a>
						</li>

						<li class="slide">
							<a class="side-menu__item" href="/class_Students/<?=$classroom[0]->C_ID?>"><i class="fa fa-users  mr-2" aria-hidden="true"></i><span class="side-menu__label">Students</span></a>
						</li>
						
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="fa fa-video-camera  mr-2" aria-hidden="true"></i><span class="side-menu__label">Video Lessons</span><i class="angle fe fe-chevron-down"></i></a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="/class_EmbedVideo/<?=$classroom[0]->C_ID?>">Embed Video Lesson</a></li>
								<li><a class="slide-item" href="/class_manageVideos/<?=$classroom[0]->C_ID?>">Manage Video Lessons</a></li>
							</ul>
						</li>

						
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="fa fa-bullhorn  mr-2" aria-hidden="true"></i><span class="side-menu__label">Announcement</span><i class="angle fe fe-chevron-down"></i></a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="/class_SendAnnouncement/<?=$classroom[0]->C_ID?>">Send Announcement</a></li>
								<li><a class="slide-item" href="/class_manageAnnouncements/<?=$classroom[0]->C_ID?>">Manage Announcement</a></li>
							</ul>
						</li>

						<li class="slide">
							<a class="side-menu__item" href="/class_Payments_step1/<?=$classroom[0]->C_ID?>"><i class="fa fa-money  mr-2" aria-hidden="true"></i><span class="side-menu__label">Student Payments</span></a>
						</li>

						<li class="slide">
							<a class="side-menu__item" href="/AD_ClassRooms"><i class="fa fa-bars  mr-2" aria-hidden="true"></i><span class="side-menu__label">Main Menu</span></a>
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