<?php include('admin/inc/isloginStudent.php');?>
<!doctype html>
<html lang="en" dir="ltr">
	

    <head>
        <?php include('admin/inc/headST.php');?>
  
	</head>

    <body class="main-body app sidebar-mini">
    

        <!-- Loader -->
        <div id="global-loader">
            <img src="{{ URL::to('/') }}/admin/assets/img/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /Loader -->

        <!-- Page -->
        <div class="page">
            <?php include('admin/inc/headerST.php');?> 

				<!-- /main-header -->


                <!-- container -->
				<div class="container-fluid">
              
                    <!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
							<div>
							  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi <?=Session::get('S_FIRST_NAME')?>, welcome back!</h2>
							  <p class="mg-b-0">Dashboard</p>
							</div>
						</div>
					</div>
					<!-- /breadcrumb -->
                 
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('status') }}
                        </div>
                        @elseif(session('failed'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('failed') }}
                        </div>
                        @endif

                    <div class="row">
                
                        <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
							<div class="card  box-shadow-0 ">
								<div class="card-header">
									<h4 class="card-title mb-1">Live Lectures Area</h4>
								</div>

                                <?php if($live == NULL):?>
								<div class="card-body pt-0">
                                    No Live Lecture
								</div>
                                <?php elseif($live != NULL):?>
                                    <div class="card-body pt-0 ">
                      
                               

                                        <div class="row">
                                    
                                            <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12">
                                            <?=$live[0]->LC_LESSON?>
                                            </div>

                                            <div class="col-lg-6 col-xl-7 col-md-12 col-sm-12">
                                                <a href="<?=$live[0]->LC_LINK?>">
                                                    <button class="btn btn-success-gradient btn-block" style="width:100%" >
                                                        <div class="spinner-grow spinner-grow-sm" role="status">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>&nbsp; Connect
                                                    </button>
                                                </a>
                                            </div>

                                        
                                        </div>
                             
								</div>
                                <?php endif ?>

							</div>
						</div>



                        <?php if($payment == TRUE): ?>

                                            <div class="col-xl-3 col-lg-3 col-md-6 col-xm-12">
                                                <div class="card overflow-hidden sales-card bg-success-gradient">
                                                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                                        <div class="">
                                                            <h6 class="mb-3 tx-12 text-white">PAYMENTS STATUS</h6>
                                                        </div>
                                                        <div class="pb-0 mt-0">
                                                            <div class="d-flex">
                                                                <div class="">
                                                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">Payments are Completed this month!</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                            <?php else: ?>

                                    
                                            <div class="col-xl-3 col-lg-3 col-md-6 col-xm-12">
                                                <div class="card overflow-hidden sales-card bg-danger-gradient">
                                                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                                        <div class="">
                                                            <h6 class="mb-3 tx-12 text-white">PAYMENTS STATUS</h6>
                                                        </div>
                                                        <div class="pb-0 mt-0">
                                                            <div class="d-flex">
                                                                <div class="">
                                                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">Payments are due this month!</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                            <?php endif;?>

                        <div class="col-lg-6 col-xl-3 col-md-6 col-12">
							<div class="card bg-success-gradient text-white ">
								<div class="card-body">
									<div class="row">
										<div class="col-6">
											<div class="icon1 mt-2 text-center">
												<i class="fe fe-video tx-40"></i>
											</div>
										</div>
										<div class="col-6">
											<div class="mt-0 text-center">
												<span class="text-white">Video Lessons</span>
												<h2 class="text-white mb-0"><?=$videos[0]->videoCount?></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


  

                        <div class="col-xl-6 col-md-12 col-lg-6">
							<div class="card">
								<div class="card-header pb-1">
									<h3 class="card-title mb-2">Announcements</h3>
                                </div>
								<div class="product-timeline card-body pt-2 mt-1">
									<ul class="timeline-1 mb-0">
                                        <?php foreach($announcements AS $announcement):?>
                                            <li class="mt-0"> <i class="fa fa-bullhorn bg-primary-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 "><?=$announcement->A_TITLE?></span> <a href="#" class="float-right tx-11 text-muted"><?=$announcement->A_CREATE_DATE?></a>
                                                <p class="mb-0 text-muted tx-12"><?=$announcement->A_CONTENT?></p>
                                            </li>
                                        <?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>



                        
                        <div class="col-xl-6 col-md-12 col-lg-6">
							<div class="card">
								<div class="card-header pb-1">
									<h3 class="card-title mb-2">Latest Video Lessons</h3>
                                </div>
								<div class="product-timeline card-body pt-2 mt-1">
                                <div class="table-responsive">
                                <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
										<thead>
											<tr>
												<th class="wd-lg-25p">#</th>
												<th class="wd-lg-25p tx-right">Subject</th>
												<th class="wd-lg-25p tx-right">Chapter</th>
												<th class="wd-lg-25p tx-right">Name</th>
												<th class="wd-lg-25p tx-right">Play</th>
											</tr>
										</thead>
										<tbody>
                                            <?php
                                                $count =0;
                                                foreach($videoLessons AS $videoLesson):
                                                    $count++;
                                            ?>
											<tr>
												<td><?=$count?></td>
												<td class="tx-right tx-medium tx-inverse"><?= $videoLesson->V_SUBJECT ?></td>
												<td class="tx-right tx-medium tx-inverse"><?= $videoLesson->V_CHAPTER ?></td>
												<td class="tx-right tx-medium tx-danger"><?= $videoLesson->V_NAME ?></td>
												<td> 
                                                    <div class="btn-icon-list">
                                                        <a href="/PlayVideoLesson/<?= $videoLesson->V_ID?>"><button class="btn btn-dark btn-with-icon btn-block"><i class="fa fa-play"></i> Play</button></a>
                                                    </div>
                                                </td>
											</tr>
                                            <?php endforeach; ?>
										</tbody>
									</table>
                                </div>
								</div>
							</div>
						</div>


                    </div>

				
                </div>
				<!-- Container closed -->

			</div>
			<!-- main-content closed -->


            
                        <!-- Footer opened -->
                         @include('layout/footer')
			<!-- Footer closed -->
        </div>
		<!-- End Page -->



        <!-- JQuery min js -->
        <script src="{{ URL::to('/') }}/admin/assets/plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap js -->
        <script src="{{ URL::to('/') }}/admin/assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="{{ URL::to('/') }}/admin/assets/plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Ionicons js -->
        <script src="{{ URL::to('/') }}/admin/assets/plugins/ionicons/ionicons.js"></script>

        <!-- Moment js -->
        <script src="{{ URL::to('/') }}/admin/assets/plugins/moment/moment.js"></script>

        <!-- P-scroll js -->
        <script src="{{ URL::to('/') }}/admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="{{ URL::to('/') }}/admin/assets/plugins/perfect-scrollbar/p-scroll.js"></script>

        <!-- Sticky js -->
        <script src="{{ URL::to('/') }}/admin/assets/js/sticky.js"></script>

        <!-- eva-icons js -->
        <script src="{{ URL::to('/') }}/admin/assets/js/eva-icons.min.js"></script>

        <!-- Rating js-->
        <script src="{{ URL::to('/') }}/admin/assets/plugins/rating/jquery.rating-stars.js"></script>
        <script src="{{ URL::to('/') }}/admin/assets/plugins/rating/jquery.barrating.js"></script>

        <!-- Sidebar js -->
        <script src="{{ URL::to('/') }}/admin/assets/plugins/side-menu/sidemenu.js"></script>

        <!-- Right-sidebar js -->
        <script src="{{ URL::to('/') }}/admin/assets/plugins/sidebar/sidebar.js"></script>
        <script src="{{ URL::to('/') }}/admin/assets/plugins/sidebar/sidebar-custom.js"></script>

        
		<!--Internal  Datepicker js -->
		<script src="{{ URL::to('/') }}/admin/assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>

		<!-- Internal Flot js -->
		<script src="{{ URL::to('/') }}/admin/assets/plugins/jquery.flot/jquery.flot.js"></script>
		<script src="{{ URL::to('/') }}/admin/assets/plugins/jquery.flot/jquery.flot.pie.js"></script>
		<script src="{{ URL::to('/') }}/admin/assets/plugins/jquery.flot/jquery.flot.resize.js"></script>

		<!-- Internal Select2 js-->
		<script src="{{ URL::to('/') }}/admin/assets/plugins/select2/js/select2.min.js"></script>

		<!-- Internal Chart flot js -->
		<script src="{{ URL::to('/') }}/admin/assets/js/chart.flot.js"></script>

	
        <!-- Horizontalmenu js-->
        <script src="{{ URL::to('/') }}/admin/assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

        <!-- custom js -->
        <script src="{{ URL::to('/') }}/admin/assets/js/custom.js"></script>

        <!-- Switcher js -->
	<script src="{{ URL::to('/') }}/admin/assets/switcher/js/switcher.js"></script>

    </body>


</html>



















