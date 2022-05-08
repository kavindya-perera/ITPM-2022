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
								<h4 class="content-title mb-0 my-auto">View Task</h4>
							</div>
						</div>
						<div class="d-flex my-xl-auto right-content">
							<div class="mb-xl-0">
								<div class="btn-group dropdown">
									<a href="/AD_ManageTasks"><button type="button" class="btn btn-primary">Manage Tasks</button></a>
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
												<td><b>FROM :</b>  <?=$Task1[0]->T_TIME_FROM?> </td>
												<td><b>TO :</b> <?=$Task1[0]->T_TIME_TO?></td>
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
                                    <div class="btn-icon-list">
                                        <a href="/AD_EditTask/<?= $Task1[0]->T_ID ?>"><button class="btn btn-primary btn-icon ml-1 mr-1"><i class="far fa-edit"></i></button></a>
                                        <a href="/AD_DeleteTask/<?= $Task1[0]->T_ID?>" onclick="return confirm('Are you sure you want to delete this item?');"><button class="btn btn-danger btn-icon mr-1"><i class="far fa-trash-alt"></i></button></a>
                                    </div><hr>
                                    <?php if($Task1[0]->T_COMPLETE_STATUS == 1):?> 
                                        <?php if($Task1[0]->CHECK_STATUS == 0):?> 
                                            <a href="/AD_CheckTask/<?= $Task1[0]->T_ID?>" onclick="return confirm('Are you sure you want to ckeck this task?');">
                                                <button class="btn btn-primary btn-with-icon btn-block mb-2"><i class="fa fa-check-square-o"></i> Check</button>
                                            </a>
                                        <?php elseif($Task1[0]->CHECK_STATUS == 1): ?>
                                            <a href="/AD_UncheckTask/<?= $Task1[0]->T_ID?>" onclick="return confirm('Are you sure you want to Unckeck this task?');">
                                                <button class="btn btn-primary btn-with-icon btn-block mb-2"><i class="fa fa-check-square-o"></i> Uncheck</button>
                                            </a>
                                        <?php endif ?>
                                    <?php endif ?>
                                    <?php if($Task1[0]->CANCEL_DATE != NULL || $Task1[0]->T_COMPLETE_STATUS == 1):?> 
                                        <a class="btn btn-success btn-with-icon btn-block" data-effect="effect-fall" data-toggle="modal" href="#modaldemo8"><i class="fa fa-retweet"></i> Re-Open</a>
                                    <?php endif ?>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                    
				
                </div>
				<!-- Container closed -->
			</div>
			<!-- main-content closed -->







			<!-- Modal effects -->
            <div class="modal" id="modaldemo8">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title"><i class="fa fa-retweet"></i> Re-Open Task</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<h6>Time Duration</h6>
                            
                            <form action="/AD_ReOpenTasks/<?= $Task1[0]->T_ID?>" method="POST">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>From <font color="red">*</font></label>
                                        <input type="date" class="form-control" name="TASK_FROM" value="<?= $Task1[0]->T_TIME_FROM?>" maxlength="100" required>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>To <font color="red">*</font></label>
                                        <input type="date" class="form-control" name="TASK_TO" value="<?= $Task1[0]->T_TIME_TO?>" maxlength="100" required>
                                    </div>
                                </div>
                            </div>

                            </div>
						<div class="modal-footer">
							<button class="btn ripple btn-primary" type="submit">Save changes</button>
                            </form>
							<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End Modal effects-->







            
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



<!--Internal  Datatable js -->
<script src="admin/assets/js/table-data.js"></script>
    </body>


</html>



















