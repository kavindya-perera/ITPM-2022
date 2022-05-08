@include('layout/isloginAdmin')
<!doctype html>
<html lang="en" dir="ltr">
	

    <head>
        @include('layout/head')
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
						<div class="my-auto">
							<div class="d-flex">
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0">TASK MANAGEMENT / &nbsp;</span>
								<h4 class="content-title mb-0 my-auto">Manage Tasks</h4>
							</div>
						</div>
						<div class="d-flex my-xl-auto right-content">
							<div class="mb-xl-0">
								<div class="btn-group dropdown">
									<a href="/AD_AddTask"><button type="button" class="btn btn-primary">Create Task</button></a>
								</div>
							</div>
						</div>
					</div>
					<!-- breadcrumb -->

              
                        <div class="col-xl-12">
							<div class="card mg-b-20">
								<div class="card-header pb-0">
									<div class="d-flex justify-content-between">
										<h4 class="card-title mg-b-0">Manage Tasks</h4>
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
													<th class="border-bottom-0">Created</th>
													<th class="border-bottom-0">Task Number</th>
                                                    <th class="border-bottom-0">Assign To</th>
                                                    <th class="border-bottom-0">Task Name</th>
                                                    <th class="border-bottom-0">Status</th>
                                                    <th class="border-bottom-0">Time Duration</th>
                                                    <th class="border-bottom-0">View</th>
                                                    <th class="border-bottom-0">Action</th>
												</tr>
											</thead>
											<tbody>

                                            <?php
                                                $count = 0; 
                                                foreach ($Tasks as $Task): 
                                                     $count++;
                                            ?>  
												<tr>
                                                    <td><?= $count ?></td>
                                                    <td><?= $Task->T_CREATED_DATE ?></td>
                                                    <td><?= $Task->T_NUMBER ?></td>
                                                    <td><?= $Task->EM_FirstName." ".$Task->EM_LastName." - ".$Task->EM_NUMBER ?></td>
                                                    <td><?= $Task->T_NAME ?></td>
                                                    <td>
                                                        <?php 
                                                            $status = $Task->T_STATUS;
                                                            if($status == "COMPLETED"){
                                                                echo "<p class='badge badge-success mb-0' href='#'>COMPLETED</p>";
                                                            }else{
                                                                echo "<p class='badge badge-danger mb-0' href='#'>INCOMPLETE</p>";
                                                                
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?= $Task->T_TIME_FROM." - ".$Task->T_TIME_TO ?></td>
                                                    <td><a href='/AD_ViewTask/<?= $Task->T_ID ?>'><button class='btn btn-dark btn-block'>View</button></a></td>
                                                    <td>
                                                        <div class="btn-icon-list">
                                                            <a href="/AD_EditTask/<?= $Task->T_ID ?>"><button class="btn btn-primary btn-icon ml-1 mr-1"><i class="far fa-edit"></i></button></a>
                                                            <a href="/AD_DeleteTask/<?= $Task->T_ID ?>" onclick="return confirm('Are you sure you want to delete this item?');"><button class="btn btn-danger btn-icon mr-1"><i class="far fa-trash-alt"></i></button></a>
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
                         @include('layout/footer')
			<!-- Footer closed -->
        </div>
		<!-- End Page -->

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

        
        <!-- Internal Data tables -->
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/dataTables.dataTables.min.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/responsive.dataTables.min.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/jquery.dataTables.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/pdfmake.min.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/vfs_fonts.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
    <script src="{{ URL::to('/') }}/admin/assets/plugins/datatable/js/responsive.bootstrap4.min.js"></script>

    <!--Internal  Datatable js -->
    <script src="{{ URL::to('/') }}/admin/assets/js/table-data.js"></script>
    </body>


</html>



















