            		<!-- main-sidebar -->
                    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
			<aside class="app-sidebar sidebar-scroll">
				<div class="main-sidebar-header active">
					<a class="desktop-logo logo-light active" href="/ST_Dashboard"><img src="/admin/assets//img/brand/logo.png" class="main-logo" alt="logo"></a>
					<a class="desktop-logo logo-dark active" href="/ST_Dashboard"><img src="/admin/assets//img/brand/logo-white.png" class="main-logo dark-theme" alt="logo"></a>
					<a class="logo-icon mobile-logo icon-light active" href="/ST_Dashboard"><img src="/admin/assets//img/brand/favicon.png" class="logo-icon" alt="logo"></a>
					<a class="logo-icon mobile-logo icon-dark active" href="/ST_Dashboard"><img src="/admin/assets//img/brand/favicon-white.png" class="logo-icon dark-theme" alt="logo"></a>
				</div>
				<div class="main-sidemenu">
					<div class="app-sidebar__user clearfix">
						<div class="dropdown user-pro-body">
							<div class="">
								<img alt="user-img" class="avatar avatar-xl brround" src="/employee/<?=Session::get('imageST');?>"><span class="avatar-status profile-status bg-green"></span>
							</div>
							<div class="user-info">
								<h4 class="font-weight-semibold mt-3 mb-0"><?=Session::get('S_FIRST_NAME');?></h4>
								<span class="mb-0 text-muted"><?=Session::get('S_NUMBER');?></span>
							</div>
						</div>
					</div>
					<ul class="side-menu">
                        
						<li class="side-item side-item-category">Main</li>
						<li class="slide">
							<a class="side-menu__item" href="/ST_Dashboard"><i class="fa fa-tachometer mr-2" aria-hidden="true" ></i><span class="side-menu__label">Dashboard</span></a>
						</li>



						<li class="side-item side-item-category">General</li>
						<li class="slide">
							<a class="side-menu__item" href="/ST_Videos"><i class="fa fa-video  mr-2" aria-hidden="true"></i><span class="side-menu__label">Video Lessons</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" href="/MyPayments"><i class="fa fa-money  mr-2" aria-hidden="true"></i><span class="side-menu__label">My Payments</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" href="/Profile"><i class="fa fa-user  mr-2" aria-hidden="true"></i><span class="side-menu__label">Profile</span></a>
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
								<a href="/ST_Dashboard"><img src="/admin/assets//img/brand/logo.png" class="logo-1" alt="logo"></a>
								<a href="/ST_Dashboard"><img src="/admin/assets//img/brand/logo-white.png" class="dark-logo-1" alt="logo"></a>
								<a href="/ST_Dashboard"><img src="/admin/assets//img/brand/favicon.png" class="logo-2" alt="logo"></a>
								<a href="/ST_Dashboard"><img src="/admin/assets//img/brand/favicon-white.png" class="dark-logo-2" alt="logo"></a>
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
									<a class="profile-user d-flex" href="#"><img alt="" src="/employee/<?=Session::get('imageST');?>"></a>
									<div class="dropdown-menu">
										<div class="main-header-profile bg-primary p-3">
											<div class="d-flex wd-100p">
												<div class="main-img-user"><img alt="" src="/employee/<?=Session::get('imageST');?>" class=""></div>
												<div class="ml-3 my-auto">
													<h6><?=Session::get('S_FIRST_NAME');?>  <?=Session::get('S_LAST_NAME');?>	</h6><span><?=Session::get('S_NUMBER');?></span>
												</div>
											</div>
										</div>
										<a class="dropdown-item" href="/Profile"><i class="fa fa-user"></i> Profile</a>
										<a class="dropdown-item" href="/LogoutST"><i class="bx bx-log-out"></i> Sign Out</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>