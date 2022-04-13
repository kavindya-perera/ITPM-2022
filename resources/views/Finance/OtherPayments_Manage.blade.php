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
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0">FINANCE MANAGEMENT / &nbsp;</span>
								<h4 class="content-title mb-0 my-auto">Manage Other Incomes</h4>
							</div>
						</div>
						<div class="d-flex my-xl-auto right-content">
							<div class="mb-xl-0">
								<div class="btn-group dropdown">
									<a href="/Get_Other_Income"><button type="button" class="btn btn-primary">Get Other Income</button></a>
								</div>
							</div>
						</div>
					</div>
					<!-- breadcrumb -->

                                                    

              
                        <div class="col-xl-12">

							<div class="card mg-b-20">
								<div class="card-header pb-0">
                                             
									<div class="d-flex justify-content-between">
                                        <div class="btn-icon-list">
                                            <a class="ml-1 mr-1"><button class="btn btn-dark btn-block " data-effect="effect-scale" data-toggle="modal" href="#modaldemo9">Filter by date range</button></a>
                                            <a href="/Manage_Other_Incomes_Today" class="ml-1 mr-1"><button class="btn btn-dark btn-block " >Today</button></a>
                                        </div>
                                                 
										<i class="mdi mdi-dots-horizontal text-gray"></i>
									</div>
								</div>

                          

								<div class="card-body">

                                <?php if (session('status')): ?>
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <?= session('status') ?>
                                </div>
                                <?php endif ?>

                                <?php if (session('failed')): ?>
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <?= session('failed') ?>
                                </div>
                                <?php endif ?>

									<div class="table-responsive">
										<table id="example1" class="table key-buttons text-md-nowrap">
											<thead>
												<tr>
													<th class="border-bottom-0">#</th>
													<th class="border-bottom-0">Invoice No</th>
													<th class="border-bottom-0">Payment Date</th>
													<th class="border-bottom-0">Customer Name</th>
													<th class="border-bottom-0">Customer Contact</th>
													<th class="border-bottom-0">Customer Address</th>
                                                    <th class="border-bottom-0">Description</th>
                                                    <th class="border-bottom-0">Amount (LKR)</th>
                                                    <th class="border-bottom-0">Remark</th>
                                                    <th class="border-bottom-0">Employee</th>
                                                    <th class="border-bottom-0">Action</th>
												</tr>
											</thead>
											<tbody>

                                            <?php
                                                $count = 0; 
                                                foreach ($Payments as $Payment): 
                                                     $count++;
                                            ?>  
												<tr>
                                                    <td><?= $count ?></td>
                                                    <td><a href="/DownloadInvoiceOtherPayment/<?=$Payment->OP_INVOICE_NO?>"><?= $Payment->OP_INVOICE_NO ?> <i class="fa fa-download"></i></a></td>
                                                    <td><?= $Payment->OP_DATE ?></td>
                                                    <td><?= $Payment->OP_CUSTOMER_NAME?></td>
                                                    <td><?= $Payment->OP_CUSTOMER_CONTACT?></td>
                                                    <td><?= $Payment->OP_CUSTOMER_ADDRESS?></td>
                                                    <td><?= $Payment->OP_FOR?></td>
                                                    <td><?= number_format($Payment->OP_AMOUNT,2) ?></td>
                                                    <td><?= $Payment->OP_REMARK?></td>
                                                    <td><?= $Payment->EM_NUMBER?></td>
                                                    <td>
                                                        <div class="btn-icon-list">
                                                            <a href="/AD_EditOtherPayment/<?= $Payment->OP_ID ?>" onclick="return confirm('Are you sure you want to edit this payment?');"><button class="btn btn-primary btn-icon ml-1 mr-1"><i class="far fa-edit"></i></button></a>
                                                            <a href="/AD_DeleteOtherPayment/<?= $Payment->OP_ID ?>" onclick="return confirm('Are you sure you want to delete this payment?');"><button class="btn btn-danger btn-icon mr-1"><i class="far fa-trash-alt"></i></button></a>
                                                        </div>
                                                    </td>
												</tr>
                                            <?php endforeach ?>

											
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>



                    
				
                </div>
				<!-- Container closed -->





			</div>
			<!-- main-content closed -->







            			<!-- Modal effects -->
			<div class="modal" id="modaldemo9">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">Filter by Date Range</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
                                    <form action="/Manage_Other_Incomes/DateBy" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
										<div class="row"> 
                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Since <font color="red">*</font></label>
                                                    <input type="date" class="form-control" name="Date_Since"  required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>To <font color="red">*</font></label>
                                                    <input type="date" class="form-control" name="Date_To"  required>
                                                </div>
                                            </div>
										</div>
                                        
									
						</div>
						<div class="modal-footer">
							<input type="submit" class="btn ripple btn-primary" value="Filter" name="submit">
							<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                            </form>
						</div>
					</div>
				</div>
			</div>
			<!-- End Modal effects-->


            
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



















