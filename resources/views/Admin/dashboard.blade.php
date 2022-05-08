@include('layout/isloginAdmin')
<!doctype html>
<html lang="en" dir="ltr">
	

    <head>
        @include('layout/head')
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	</head>

    <body class="main-body app sidebar-mini">
    

        <!-- Loader -->
        <div id="global-loader">
            <img src="{{ URL::to('/') }}/admin/assets/img/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /Loader -->

        <!-- Page -->
        <div class="page">
            @include('layout/header')

				<!-- /main-header -->


                <!-- container -->
				<div class="container-fluid">
                  			<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
							<div>
							  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
							  <p class="mg-b-0">Dashboard</p>
							</div>
						</div>
						<div class="main-dashboard-header-right">
							<div>
								<label class="tx-13">Curent Date</label>
								<div class="main-star">
									 <span><?= date('m.d.Y') ?></span>
								</div>
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


                    <div class="row row-sm">

						<div class="col-lg-6 col-xl-3 col-md-6 col-12">
							<div class="card bg-primary-gradient text-white ">
								<div class="card-body">
									<div class="row">
										<div class="col-6">
											<div class="icon1 mt-2 text-center">
												<i class="fe fe-user tx-40"></i>
											</div>
										</div>
										<div class="col-6">
											<div class="mt-0 text-center">
												<span class="text-white">Students</span>
												<h2 class="text-white mb-0"><?= $student[0]->studentCount ?></h2>
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
												<h2 class="text-white mb-0"><?= $Video[0]->videoCount ?></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

                        <div class="col-lg-6 col-xl-3 col-md-6 col-12">
							<div class="card bg-warning-gradient text-white ">
								<div class="card-body">
									<div class="row">
										<div class="col-6">
											<div class="icon1 mt-2 text-center">
												<i class="fe fe-users tx-40"></i>
											</div>
										</div>
										<div class="col-6">
											<div class="mt-0 text-center">
												<span class="text-white">Day Attendances</span>
												<h2 class="text-white mb-0"><?= $TodayAttendance[0]->attendanceCount ?></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-xl-3 col-md-6 col-12">
							<div class="card bg-danger-gradient text-white ">
								<div class="card-body">
									<div class="row">
										<div class="col-6">
											<div class="icon1 mt-2 text-center">
												<i class="fe fe-users tx-40"></i>
											</div>
										</div>
										<div class="col-6">
											<div class="mt-0 text-center">
												<span class="text-white">Employees</span>
												<h2 class="text-white mb-0"><?=$Employee[0]->employeecount ?></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
							<div class="card">
								<div class="card-body">
									<div class="card-widget">
										<h6 class="mb-2">Day Profit</h6>
										<h2 class="text-right"><i class="mdi mdi-credit-card   float-left text-success text-success-shadow"></i><span>LKR <?=(($TodayPayment1[0]->todaypayment)+($TodayPayment2[0]->todaypayment))-($TodayExpenses[0]->todayexpenses)?></span></h2>
										<p class="mb-0">Monthly Profit<span class="float-right">LKR <?=(($MonthPayment1[0]->monthpayment)+($MonthPayment2[0]->monthpayment))-($MonthExpenses[0]->monthexpenses)?></span></p>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
							<div class="card">
								<div class="card-body">
									<div class="card-widget">
										<h6 class="mb-2">Day Income</h6>
										<h2 class="text-right"><i class="mdi mdi-credit-card   float-left text-warning text-warning-shadow"></i><span>LKR <?=($TodayPayment1[0]->todaypayment)+($TodayPayment2[0]->todaypayment)?></span></h2>
										<p class="mb-0">Monthly Income<span class="float-right">LKR <?=($MonthPayment1[0]->monthpayment)+($MonthPayment2[0]->monthpayment)?></span></p>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
							<div class="card">
								<div class="card-body">
									<div class="card-widget">
										<h6 class="mb-2">Day Expenses</h6>
										<h2 class="text-right"><i class="mdi mdi-credit-card   float-left text-danger text-danger-shadow"></i><span>LKR <?=$TodayExpenses[0]->todayexpenses?></span></h2>
										<p class="mb-0">Monthly Expenses<span class="float-right">LKR <?=$MonthExpenses[0]->monthexpenses?></span></p>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
							<div class="card">
								<div class="card-body">
									<div class="card-widget">
										<h6 class="mb-2">Day Student Payments</h6>
										<h2 class="text-right"><i class="mdi mdi-credit-card   float-left text-success text-success-shadow"></i><span>LKR <?=$TodayPayment1[0]->todaypayment?></span></h2>
										<p class="mb-0">Monthly ST Payments<span class="float-right">LKR <?=$MonthPayment1[0]->monthpayment?></span></p>
									</div>
								</div>
							</div>
						</div>


			
						<div class="col-md-12 col-xl-6">
							<div class="card">
								<div class="card-body">
									<div class="d-flex justify-content-between">
										<h4 class="card-title">Profit Status</h4>
									</div>
									<canvas id="profitChart" style="width:100%;max-width:600px"></canvas>
								</div>
							</div>
						</div>

						<div class="col-md-12 col-xl-6">
							<div class="card">
								<div class="card-body">
									<div class="d-flex justify-content-between">
										<h4 class="card-title">Student Status</h4>
									</div>
									<canvas id="myChart" style="width:100%;max-width:600px;height:285px" ></canvas>
								</div>
							</div>
						</div>




						<div class="col-md-12 col-lg-8 col-xl-8">
							<div class="card card-table-two">
								<div class="d-flex justify-content-between mb-2">
									<h4 class="card-title mb-1">Low Quantity Items in Stock</h4>
								</div>
								<div class="table-responsive country-table">
									<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
										<thead>
											<tr>
												<th class="wd-lg-25p">Item Code</th>
												<th class="wd-lg-25p">Item Name</th>
												<th class="wd-lg-25p">Qty</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($stok as $stok):
												if($stok->SM_ITEM_QTY <= 1):
													echo '<tr style="background-color:#ffb5c6">';
												elseif($stok->SM_ITEM_QTY <= 5):
													echo '<tr style="background-color:#feffb5">';
												else:
													echo '<tr>';
												endif;
													?>
											

												<td class="tx-right tx-medium tx-inverse"><?= $stok->ITEM_CODE?></td>
												<td><?= $stok->ITEM_NAME?></td>
												<td class=" tx-medium tx-inverse"><?= $stok->SM_ITEM_QTY?></td>
											</tr>
											<?php endforeach ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>


						<div class="col-md-12 col-lg-4 col-xl-4">
							<div class="card card-dashboard-eight pb-2">
								<h6 class="card-title">System Payments</h6>
								<div class="list-group">
									<div class="list-group-item border-top-0">
										<i class="fa fa-money text-success flag-icon-squared"></i>
										<p>Full Payments</p><span class="text-primary">LKR <?= $STYearPayment[0]->yearpayment + $OtherYearPayment[0]->yearpayment?></span>
									</div>
									<div class="list-group-item">
										<i class="fa fa-money text-success flag-icon-squared"></i>
										<p>Student Payments</p><span class="text-primary">LKR <?= $STYearPayment[0]->yearpayment?></span>
									</div>
									<div class="list-group-item">
										<i class="fa fa-money text-success flag-icon-squared"></i>
										<p>Other Incomes</p><span class="text-primary">LKR <?= $OtherYearPayment[0]->yearpayment?></span>
									</div>
									<div class="list-group-item">
										<i class="fa fa-money text-success flag-icon-squared"></i>
										<p>Expenses</p><span class="text-primary">LKR <?= $YearExpenses[0]->yearexpenses?></span>
									</div>
									<div class="list-group-item">
										<i class="fa fa-money text-success flag-icon-squared"></i>
										<p>Profit</p><span class="text-primary">LKR <?= ($STYearPayment[0]->yearpayment + $OtherYearPayment[0]->yearpayment) - $YearExpenses[0]->yearexpenses?></span>
									</div>
								</div>
							</div>
						</div>




                    </div>



				
                </div>
				<!-- Container closed -->

			</div>
			<!-- main-content closed -->


            
			<!-- Footer closed -->     
        </div>
		<!-- End Page -->


        <script>
            var xValues = ["Disabled", "Active"];
            var yValues = [<?=$Disablestudent[0]->studentCount?>,<?=$student[0]->studentCount-$Disablestudent[0]->studentCount?>];
            var barColors = [
            "#ee335e",
            "#069a6a"
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




		<?php 
			$month1 = (int)(($MonthPayment1[0]->monthpayment)+($MonthPayment2[0]->monthpayment))-($MonthExpenses[0]->monthexpenses);
			$month2 = (int)(($Pre1MonthPayment1[0]->monthpayment)+($Pre1MonthPayment2[0]->monthpayment))-($Pre1MonthExpenses[0]->monthexpenses);
			$month3 = (int)(($Pre2MonthPayment1[0]->monthpayment)+($Pre2MonthPayment2[0]->monthpayment))-($Pre2MonthExpenses[0]->monthexpenses);

			function GetMonth($month){
				if($month == 01):
					return "January";
				elseif($month == 2):
					return "February";
				elseif($month == 3):
					return "March";
				elseif($month == 4):
					return "April";
				elseif($month == 5):
					return "May";
				elseif($month == 6):
					return "June";
				elseif($month == 7):
					return "July";
				elseif($month == 8):
					return "August";
				elseif($month == 9):
					return "September";
				elseif($month == 10):
					return "October";
				elseif($month == 11):
					return "November";
				elseif($month == 12):
					return "December";
				endif;
				return 0;
			}


		
		?>

		<script>
			var xValues = ["<?=GetMonth(date('m'))?>", "<?=GetMonth(date('m')-1)?>", "<?=GetMonth(date('m')-2)?>"];
			var yValues = [<?=$month1?>, <?=$month2?>, <?=$month3?>];
			var barColors = ["#0160e9", "#f94160","#f66f31"];

			new Chart("profitChart", {
				type: "bar",
				data: {
					labels: xValues,
					datasets: [{
					backgroundColor: barColors,
					data: yValues
					}]
				},
				options: {
					legend: {display: false},
					title: {
					display: true,
					}
				}
			});
		</script>

            <!-- Footer opened -->
                         @include('layout/footer')

                    <!-- Back-to-top -->
        <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>



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

		<!-- Internal Select2 js-->
		<script src="{{ URL::to('/') }}/admin/assets/plugins/select2/js/select2.min.js"></script>

		<!--Internal  Clipboard js-->
		<script src="{{ URL::to('/') }}/admin/assets/plugins/clipboard/clipboard.min.js"></script>
		<script src="{{ URL::to('/') }}/admin/assets/plugins/clipboard/clipboard.js"></script>

		<!-- Internal Prism js-->
		<script src="{{ URL::to('/') }}/admin/assets/plugins/prism/prism.js"></script>

	
        <!-- Horizontalmenu js-->
        <script src="{{ URL::to('/') }}/admin/assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

        <!-- custom js -->
        <script src="{{ URL::to('/') }}/admin/assets/js/custom.js"></script>

        <!-- Switcher js -->
	<script src="{{ URL::to('/') }}/admin/assets/switcher/js/switcher.js"></script>
    </body>


</html>



















