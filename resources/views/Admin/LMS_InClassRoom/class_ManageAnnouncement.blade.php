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
								<h4 class="content-title mb-0 my-auto">Manage Announcements</h4>
							</div>
						</div>
					</div>
					<!-- breadcrumb -->

              
                        <div class="col-xl-12">
							<div class="card mg-b-20">
								<div class="card-header pb-0">
									<div class="d-flex justify-content-between">
										<h4 class="card-title mg-b-0">Manage Announcements</h4>
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
													<th class="border-bottom-0">Created Date</th>
                                                    <th class="border-bottom-0">Heading</th>
                                                    <th class="border-bottom-0">Content</th>
                                                    <th class="border-bottom-0">Action</th>
												</tr>
											</thead>
											<tbody>

                                            <?php
                                                $count = 0; 
                                                foreach ($announcements as $announcement): 
                                                    $count++;
                                            ?>  

												<tr>
													<td><?= $count ?></td>
													<td><?= $announcement->A_CREATE_DATE ?></td>
													<td><?= $announcement->A_TITLE ?></td>
													<td><?= $announcement->A_CONTENT ?></td>
                                                    <td>
                                                        <div class="btn-icon-list">
                                                            <a href="/class_EditAnnouncement/<?= $announcement->A_ID."/".$classroom[0]->C_ID?>"><button class="btn btn-primary btn-icon ml-1 mr-1"><i class="far fa-edit"></i></button></a>
                                                            <a href="/class_DeleteAnnouncement/<?= $announcement->A_ID."/".$classroom[0]->C_ID?>" onclick="return confirm('Are you sure you want to delete this item?');"><button class="btn btn-danger btn-icon mr-1"><i class="far fa-trash-alt"></i></button></a>
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



















