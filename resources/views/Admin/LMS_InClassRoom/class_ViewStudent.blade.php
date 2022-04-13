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
								<h4 class="content-title mb-0 my-auto">Student</h4>
							</div>
						</div>
						<div class="d-flex my-xl-auto right-content">
							<div class="mb-xl-0">
                                <div class="btn-group dropdown">
                                    <?php 
                                        if($student[0]->S_STATUS == 1){
                                            echo "<a href='/AD_StatusStudent/".$student[0]->S_ID."/0' onclick='return confirm(`Are you sure you want to disable this student?`);'><button class='btn btn-dark btn-block'>Disable</button></a>";
                                        }else if($student[0]->S_STATUS == 0){
                                            echo "<a href='/AD_StatusStudent/".$student[0]->S_ID."/1' onclick='return confirm(`Are you sure you want to activate this student?`);'><button class='btn btn-dark btn-block'>Activate</button></a>";
                                        }
                                    ?>
                                    <a href="/AD_DeleteStudent/<?= $student[0]->S_ID  ?>" onclick="return confirm('Are you sure you want to delete this item?');"><button class="btn btn-danger btn-icon ml-1 mr-1"><i class="far fa-trash-alt"></i></button></a>
									<a href="/class_Students/<?=$classroom[0]->C_ID?>"><button type="button" class="btn btn-primary">Class Students</button></a>
								</div>
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




					<!-- row -->
					<div class="row row-sm">
						<div class="col-lg-4">
							<div class="card mg-b-20">
								<div class="card-body">
									<div class="pl-0">
										<div class="main-profile-overview ">
											<div class="mb-2">
												<center><img alt="" src="/admin/assets/img/faces/comonImage.jpg" class="rounded-circle"></center>
											</div>
											<div class="d-flex justify-content-center mg-b-20">
												<div>
													<h5 class="main-profile-name"><?=$student[0]->S_FIRST_NAME." ".$student[0]->S_LAST_NAME?></h5>
													<p class="main-profile-name-text">
                                                        <?=$student[0]->S_NUMBER?> | 
                                                        <?php
                                                            if($student[0]->S_STATUS == 1){
                                                                echo "<a class='badge badge-success text-white pt-2 pb-2 pr-4 pl-4'>ACTIVE</a>";
                                                            }else{
                                                                echo "<a class='badge badge-danger text-white pt-2 pb-2 pr-4 pl-4'>DISABLE</a>";
                                                            }
                                                        ?>
                                                        
                                                        
                                                    </p>
												</div>
											</div>

                                     

                                            <div class="country-table p-2">
                                                <table class="table table-striped table-bordered mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="2">Full Name<br><b><?=$student[0]->S_FULL_NAME?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="50%">Student Number<br><b><?=$student[0]->S_NUMBER?></b></td>
                                                            <td width="50%">NIC Number<br><b><?=$student[0]->S_NIC?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="50%">Age<br><b><?=$student[0]->S_AGE?></b></td>
                                                            <td width="50%">Birthday<br><b><?=$student[0]->S_BIRTHDAY?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="50%">Gender<br><b><?=$student[0]->S_GENDER?></b></td>
                                                            <td width="50%">Contact 01<br><b><?=$student[0]->S_CONTACT_NUMBER_1?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="50%">Contact 02<br><b><?=$student[0]->S_CONTACT_NUMBER_2?></b></td>
                                                            <td width="50%">Whatsapp<br><b><?=$student[0]->S_WHATSAPP_NUMBER?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">Email<br><b><?=$student[0]->S_EMAIL?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">Address<br><b><?=$student[0]->S_ADDRESS?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="50%">Parnet Name<br><b><?=$student[0]->S_P_NAME?></b></td>
                                                            <td width="50%">Parnet Contact<br><b><?=$student[0]->S_P_CONTACT_NUMBER?></b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

										
										
										</div>
									</div>
								</div>
							</div>
						</div>
                               
						<div class="col-lg-8">
                                
							
							<div class="card">
								<div class="card-body">
									<div class="tabs-menu ">
										<!-- Tabs -->
										<ul class="nav nav-tabs profile navtab-custom panel-tabs">
											<li class="active">
												<a href="#payments" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-money tx-16 mr-1"></i></span> <span class="hidden-xs">Payments</span> </a>
											</li>
                                            <li class="">
												<a href="#Attendance" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-user-circle-o tx-15 mr-1"></i></span> <span class="hidden-xs">Attendance</span> </a>
											</li>
											<li class="">
												<a href="#download" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-download tx-15 mr-1"></i></span> <span class="hidden-xs">Downloads</span> </a>
											</li>
										</ul>
									</div>
									<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
										<div class="tab-pane active" id="payments">
                                        <div class="table-responsive">
                                                <table id="example1" class="table key-buttons text-md-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-bottom-0">Invoice No</th>
                                                            <th class="border-bottom-0">Payment Date</th>
                                                            <th class="border-bottom-0">Descrition</th>
                                                            <th class="border-bottom-0">Amount (LKR)</th>
                                                            <th class="border-bottom-0">Remark</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php foreach ($payments as $payment): ?>  
                                                        <tr>
                                                            <td><a href="/DownloadInvoice/<?=$payment->SP_INVOICE_NO?>"><?= $payment->SP_INVOICE_NO ?> <i class="fa fa-download"></i></a></td>
                                                            <td><?= $payment->SP_DATE ?></td>
                                                            <td><?= $payment->SP_FOR?></td>
                                                            <td><?= number_format($payment->SP_AMOUNT,2) ?></td>
                                                            <td><?= $payment->SP_REMARK?></td>
                                                    
                                                        </tr>
                                                    <?php endforeach ?>

                                                    
                                                    </tbody>
                                                </table>
                                            </div>
										</div>
                                        
                                        <div class="tab-pane" id="Attendance">
                                            
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-bottom-0">#</th>
                                                            <th class="border-bottom-0">Date</th>
                                                            <th class="border-bottom-0">Time</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php 
                                                        $count=0;
                                                        foreach ($attendances as $attendances): 
                                                            $count++;
                                                    ?>  
                                                        <tr>

                                                            <td><?= $count?></td>
                                                            <td><?= $attendances->A_DATE ?></td>
                                                            <td><?= $attendances->A_TIME?></td>
                                                    
                                                        </tr>
                                                    <?php endforeach ?>

                                                    
                                                    </tbody>
                                                </table>
                                            </div>
										</div>
                                        
										<div class="tab-pane" id="download">
                                                <table class="table table-striped table-bordered mb-0">
                                                    <tbody>
                                                       <tr>
                                                           <th width="75%">Download Name</th>
                                                           <th>Download</th>
                                                       </tr>
                                                       <tr>
                                                           <td>Student Infromation</td>
                                                           <td><a href="/Download_Setudent_Details/<?=$student[0]->S_ID?>"><button class="btn btn-indigo btn-with-icon btn-block"><i class="fa fa-download"></i> Download</button></a></td>
                                                       </tr>
                                                       <tr>
                                                           <td>Student Payment Report</td>
                                                           <td><a href="/Download_Setudent_Payment/<?=$student[0]->S_ID?>"><button class="btn btn-indigo btn-with-icon btn-block"><i class="fa fa-download"></i> Download</button></a></td>
                                                       </tr>
                                                    </tbody>
                                                </table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- row closed -->
				
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
       <!-- Internal Data tables -->
       <script src="/admin/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="/admin/assets/plugins/datatable/js/dataTables.dataTables.min.js"></script>
        <script src="/admin/assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
        <script src="/admin/assets/plugins/datatable/js/responsive.dataTables.min.js"></script>
        <script src="/admin/assets/plugins/datatable/js/jquery.dataTables.js"></script>
        <script src="/admin/assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
        <script src="/admin/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
        <script src="/admin/assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
        <script src="/admin/assets/plugins/datatable/js/jszip.min.js"></script>
        <script src="/admin/assets/plugins/datatable/js/pdfmake.min.js"></script>
        <script src="/admin/assets/plugins/datatable/js/vfs_fonts.js"></script>
        <script src="/admin/assets/plugins/datatable/js/buttons.html5.min.js"></script>
        <script src="/admin/assets/plugins/datatable/js/buttons.print.min.js"></script>
        <script src="/admin/assets/plugins/datatable/js/buttons.colVis.min.js"></script>
        <script src="/admin/assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
        <script src="/admin/assets/plugins/datatable/js/responsive.bootstrap4.min.js"></script>

        <!--Internal  Datatable js -->
        <script src="/admin/assets/js/table-data.js"></script>
    </body>


</html>



















