<?php include('admin/inc/isloginAdmin.php');?>
<!doctype html>
<html lang="en" dir="ltr">
	

    <head>
        <?php include('admin/inc/head.php');?>
        
	</head>

    <body class="main-body app sidebar-mini">
    

        <!-- Loader -->
        <div id="global-loader">
            <img src="/admin/assets/img/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /Loader -->

        <!-- Page -->
        <div class="page">
            <?php include('admin/inc/header1.php');?>

				<!-- /main-header -->


                <!-- container -->
				<div class="container-fluid">
              
                    <!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="my-auto">
							<div class="d-flex">
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0">LEARNING  MANAGEMENT / </span>
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0"><?=$classroom[0]->C_NAME?> / &nbsp;</span>
								<h4 class="content-title mb-0 my-auto">Dashboard</h4>
							</div>
						</div>
					</div>
					<!-- breadcrumb -->
                 
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
                                    <form action="/LiveClassInsert/<?=$classroom[0]->C_ID?>" method="POST">
                                    {{csrf_field()}}

                                        <div class="row">
                                    
                                            <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="L_TITLE"  maxlength="50" placeholder="Lesson Title" required>
                                                </div>
                                            </div>

                                            
                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <input type="link" class="form-control" name="L_LINK"  maxlength="500" placeholder="Meeting Link" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary" name="submit" value="POST">
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </form>
								</div>
                                <?php elseif($live != NULL):?>
                                    <div class="card-body pt-0">
                      
                               

                                        <div class="row">
                                    
                                            <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12">
                                            <?=$live[0]->LC_LESSON?>
                                            </div>

                                            <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12">
                                                <a href="<?=$live[0]->LC_LINK?>">
                                                    <button class="btn btn-success-gradient btn-block">
                                                        <div class="spinner-grow spinner-grow-sm" role="status">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>&nbsp; Connect
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12">
                                                <a href="/EndLive/<?=$live[0]->LC_ID."/".$classroom[0]->C_ID?>"><button class="btn btn-danger-gradient btn-block">End</button></a>
                                            </div>

                                        
                                        </div>
                             
								</div>
                                <?php endif ?>

							</div>
						</div>






                        <div class="col-lg-6 col-xl-3 col-md-6 col-12">
							<div class="card bg-primary-gradient text-white ">
								<div class="card-body">
									<div class="row">
										<div class="col-6">
											<div class="icon1 mt-2 text-center">
												<i class="fe fe-users tx-40"></i>
											</div>
										</div>
										<div class="col-6">
											<div class="mt-0 text-center">
												<span class="text-white">Students</span>
												<h2 class="text-white mb-0"><?=$Students[0]->numOfStudents?></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

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
												<h2 class="text-white mb-0"><?=$Videos[0]->numOfVideo?></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


                        <div class="col-md-6">
							<div class="card mg-b-20 mg-md-b-0">
								<div class="card-body">
									<div class="main-content-label mg-b-5">
										Students Status
									</div>
									<canvas id="myChart" style="width:100%;max-width:600px"></canvas>
								</div>
							</div>
						</div>

                        <div class="col-md-6">
							<div class="card mg-b-20 mg-md-b-0">
								<div class="card-body">
									<div class="main-content-label mg-b-5 mb-3">
										Payment Status
									</div>


                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
                                                <div class="card overflow-hidden sales-card bg-primary-gradient">
                                                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                                        <div class="">
                                                            <h6 class="mb-3 tx-12 text-white">TODAY PAYMENTS</h6>
                                                        </div>
                                                        <div class="pb-0 mt-0">
                                                            <div class="d-flex">
                                                                <div class="">
                                                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">LKR <?= number_format($TodayPayments[0]->totalPayments,2)?></h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
                                                <div class="card overflow-hidden sales-card bg-warning-gradient">
                                                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                                        <div class="">
                                                            <h6 class="mb-3 tx-12 text-white">THIS MONTH PAYMENTS</h6>
                                                        </div>
                                                        <div class="pb-0 mt-0">
                                                            <div class="d-flex">
                                                                <div class="">
                                                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">LKR <?= number_format($MonthPayments[0]->totalPayments,2)?></h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-6 col-xm-12">
                                                <div class="card overflow-hidden sales-card bg-success-gradient">
                                                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                                        <div class="">
                                                            <h6 class="mb-3 tx-12 text-white">TOTAL PAYMENTS</h6>
                                                        </div>
                                                        <div class="pb-0 mt-0">
                                                            <div class="d-flex">
                                                                <div class="">
                                                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">LKR <?= number_format($TotalPayments[0]->totalPayments,2)?></h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                        <?php include('admin/inc/footer.php');?>
			<!-- Footer closed -->
        </div>
		<!-- End Page -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

        <script>
            var xValues = ["Disabled", "Active"];
            var yValues = [(<?=($Students[0]->numOfStudents)-($ActiveStudents[0]->numOfStudents)?>), (<?=$ActiveStudents[0]->numOfStudents?>) ];
            var barColors = [
            "#ee335e",
            "#22c03c"
            ];

            new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{ 
                backgroundColor: barColors,
                data: yValues
                }]
            },
            options: {
                title: {
                display: true,
                }
            }
            });
        </script>


        <!-- JQuery min js -->
        <script src="/admin/assets/plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap js -->
        <script src="/admin/assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="/admin/assets/plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Ionicons js -->
        <script src="/admin/assets/plugins/ionicons/ionicons.js"></script>

        <!-- Moment js -->
        <script src="/admin/assets/plugins/moment/moment.js"></script>

        <!-- P-scroll js -->
        <script src="/admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="/admin/assets/plugins/perfect-scrollbar/p-scroll.js"></script>

        <!-- Sticky js -->
        <script src="/admin/assets/js/sticky.js"></script>

        <!-- eva-icons js -->
        <script src="/admin/assets/js/eva-icons.min.js"></script>

        <!-- Rating js-->
        <script src="/admin/assets/plugins/rating/jquery.rating-stars.js"></script>
        <script src="/admin/assets/plugins/rating/jquery.barrating.js"></script>

        <!-- Sidebar js -->
        <script src="/admin/assets/plugins/side-menu/sidemenu.js"></script>

        <!-- Right-sidebar js -->
        <script src="/admin/assets/plugins/sidebar/sidebar.js"></script>
        <script src="/admin/assets/plugins/sidebar/sidebar-custom.js"></script>

        
		<!--Internal  Datepicker js -->
		<script src="/admin/assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>

		<!-- Internal Flot js -->
		<script src="/admin/assets/plugins/jquery.flot/jquery.flot.js"></script>
		<script src="/admin/assets/plugins/jquery.flot/jquery.flot.pie.js"></script>
		<script src="/admin/assets/plugins/jquery.flot/jquery.flot.resize.js"></script>

		<!-- Internal Select2 js-->
		<script src="/admin/assets/plugins/select2/js/select2.min.js"></script>

		<!-- Internal Chart flot js -->
		<script src="/admin/assets/js/chart.flot.js"></script>

	
        <!-- Horizontalmenu js-->
        <script src="/admin/assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

        <!-- custom js -->
        <script src="/admin/assets/js/custom.js"></script>

        <!-- Switcher js -->
	<script src="/admin/assets/switcher/js/switcher.js"></script>

    </body>


</html>



















