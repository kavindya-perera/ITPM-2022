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
            <?php include('admin/inc/header.php');?>

				<!-- /main-header -->


                <!-- container -->
				<div class="container-fluid">


                    <!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="my-auto">
							<div class="d-flex">
								<h4 class="content-title mb-0 my-auto">View My Task</h4>
							</div>
						</div>
						<div class="d-flex my-xl-auto right-content">
							<div class="mb-xl-0">
								<div class="btn-group dropdown">
									<a href="/AD_MyManageTasks"><button type="button" class="btn btn-primary">Manage Tasks</button></a>
								</div>
							</div>
						</div>
					</div>
					<!-- breadcrumb -->


                <div class="row">


                    <div class="col-xl-5 col-md-12 col-lg-6">
							<div class="card">
								<div class="card-header pb-1">
									<h3 class="card-title mb-2">About Task</h3>
									<p class="tx-12 mb-0 text-muted">The about task is details of task</p>
								</div>  

                                <div class="table-responsive country-table p-3">
									<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
										<tbody>
											<tr>
												<th >Task Number</th>
												<td><?=$Task1[0]->T_NUMBER?></td>
											</tr>
                                            <tr>
												<th>Task Name</th>
												<td><?=$Task1[0]->T_NAME?></td>
											</tr>
                                            <tr>
												<th>Created By</th>
												<td><?=$Task1[0]->EM_FirstName." ".$Task1[0]->EM_LastName." (".$Task1[0]->EM_NUMBER.")"?></td>
											</tr>
                                            <tr>
												<th>Assign To</th>
												<td><?=$Task2[0]->EM_FirstName." ".$Task2[0]->EM_LastName." (".$Task2[0]->EM_NUMBER.")"?></td>
											</tr>
                                            <tr>
												<td colspan="2">
                                                    <b>Description</b><br>
                                                    <?=$Task1[0]->T_DESCRIPTION?> 
                                                </td>
											</tr>
                                            <tr>
												<th>Status</th>
												<td>
                                                    <?php 
                                                        if($Task1[0]->T_STATUS == "COMPLETED"){
                                                            echo "<p class='badge badge-success mb-0' href='#'>COMPLETED</p>";
                                                        }else{
                                                            echo "<p class='badge badge-danger mb-0' href='#'>INCOMPLETE</p>";       
                                                        }
                                                    ?>
                                                </td>
											</tr>
                                            <tr>
												<td><b>To :</b>  <?=$Task1[0]->T_TIME_TO?> </td>
												<td><b>From :</b> <?=$Task1[0]->T_TIME_FROM?></td>
											</tr>
										</tbody>
									</table>
								</div>
                            </div>
                    </div>

              

                        <div class="col-xl-4 col-md-12 col-lg-6">
							<div class="card">
								<div class="card-header pb-1">
									<h3 class="card-title mb-2">Time Line</h3>
									<p class="tx-12 mb-0 text-muted">The timeline is a view of process on task</p>
								</div>
								<div class="product-timeline card-body pt-2 mt-1">
									<ul class="timeline-1 mb-0">
										<li class="mt-0">  <i class="fa fa-dot-circle-o  bg-primary-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">TASK CREATED</span> <a class="float-right tx-11 text-muted"><?=$Task1[0]->T_CREATED_DATE."<br>".$Task1[0]->T_CREATED_TIME?></a>
											<p class="mb-0 text-muted tx-12"><?="By ".$Task1[0]->EM_FirstName." ".$Task1[0]->EM_LastName." (".$Task1[0]->EM_NUMBER.")"?></p>
										</li>
                                        <?php if($Task1[0]->T_PROCESS_STATUS == 1):?> 
										<li class="mt-0"> <i class="fa fa-spinner bg-success-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">THE PROCESS HAS BEGUN</span> <a class="float-right tx-11 text-muted"><?=$Task1[0]->T_PROCESS_DATE."<br>".$Task1[0]->T_PROCESS_TIME?></a>
											<p class="mb-0 text-muted tx-12"><?="By ".$Task2[0]->EM_FirstName." ".$Task2[0]->EM_LastName." (".$Task2[0]->EM_NUMBER.")"?></p>
										</li>
                                        <?php endif ?>
                                        <?php if($Task1[0]->T_COMPLETE_STATUS == 1):?> 
                                            <li class="mt-0"> <i class="fa fa-check-circle bg-warning-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">COMPETED</span> <a  class="float-right tx-11 text-muted"><?=$Task1[0]->T_COMPLETE_DATE."<br>".$Task1[0]->T_COMPLETE_TIME ?></a>
                                                <p class="mb-0 text-muted tx-12"><?="By ".$Task2[0]->EM_FirstName." ".$Task2[0]->EM_LastName." (".$Task2[0]->EM_NUMBER.")"?></p>
                                            </li>  
                                        <?php endif ?>
                                        <?php if($Task4 != NULL):?>  
                                            <li class="mt-0"> <i class="fa fa-ban bg-danger-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">CANCELED</span> <a  class="float-right tx-11 text-muted"><?=$Task1[0]->CANCEL_DATE."<br>".$Task1[0]->CANCEL_TIME ?></a>
                                                <p class="mb-0 text-muted tx-12"><?="By ".$Task4[0]->EM_FirstName." ".$Task4[0]->EM_LastName." (".$Task4[0]->EM_NUMBER.")"?></p>
                                            </li>
                                        <?php endif ?>
                                        <?php if($Task3 != NULL):?> 
                                            <li class="mt-0 mb-0"> <i class="fa fa-check-square-o bg-primary-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">CHECKED</span> <a  class="float-right tx-11 text-muted"><?=$Task1[0]->CHECK_DATE."<br>".$Task1[0]->CHECK_TIME ?></a>
                                                <p class="mb-0 text-muted tx-12"><?="By ".$Task3[0]->EM_FirstName." ".$Task3[0]->EM_LastName." (".$Task3[0]->EM_NUMBER.")"?></p>
                                            </li>
                                        <?php endif ?>
                                  
									</ul>
								</div>
							</div>
						</div>


                        <div class="col-xl-3 col-md-12 col-lg-6">
							<div class="card">
								<div class="card-header pb-1">
									<h3 class="card-title mb-2">Operations</h3>
								</div>
                                <div class="card-body">
                                        <?php if($Task1[0]->T_COMPLETE_STATUS == 0):?> 
                                            <?php if($Task1[0]->CANCEL_DATE == NULL):?> 
                                                <a href="/AD_CancelkTask/<?= $Task1[0]->T_ID?>" onclick="return confirm('Are you sure you want to cancel this task?');">
                                                    <button class="btn btn-danger btn-with-icon btn-block mb-2"><i class="fa fa-ban"></i> Cancel</button>
                                                </a>
                                            <?php endif ?>
                                        <?php endif ?>
                                        
                                    <?php if($Task1[0]->T_COMPLETE_STATUS == 0):?> 
                                        <?php if($Task1[0]->CANCEL_DATE == NULL):?> 
                                        <?php if($Task1[0]->T_PROCESS_STATUS == 0):?> 
                                            <a href="/AD_ProcessTask/<?= $Task1[0]->T_ID?>" onclick="return confirm('Are you sure you want to process this task?');">
                                                <button class="btn btn-success btn-with-icon btn-block mb-2"><i class="fa fa-check-square-o"></i> Start Process </button>
                                            </a>
                                        <?php endif ?>
                                        <?php if($Task1[0]->T_PROCESS_STATUS == 1):?> 
                                            <a href="/AD_CompleteTask/<?= $Task1[0]->T_ID?>" onclick="return confirm('Are you sure you want to complete this task?');">
                                                <button class="btn btn-primary btn-with-icon btn-block mb-2"><i class="fa fa-thumbs-o-up"></i> Cmplete </button>
                                            </a>
                                        <?php endif ?>
                                        <?php endif ?>
                                    <?php endif ?>

                                    
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

                    <!-- Back-to-top -->
        <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

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

		<!-- Internal Select2 js-->
		<script src="/admin/assets/plugins/select2/js/select2.min.js"></script>

		<!--Internal  Clipboard js-->
		<script src="/admin/assets/plugins/clipboard/clipboard.min.js"></script>
		<script src="/admin/assets/plugins/clipboard/clipboard.js"></script>

		<!-- Internal Prism js-->
		<script src="/admin/assets/plugins/prism/prism.js"></script>

	
        <!-- Horizontalmenu js-->
        <script src="/admin/assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

        <!-- custom js -->
        <script src="/admin/assets/js/custom.js"></script>

        <!-- Switcher js -->
	<script src="/admin/assets/switcher/js/switcher.js"></script>



<!--Internal  Datatable js -->
<script src="admin/assets/js/table-data.js"></script>
    </body>


</html>



















