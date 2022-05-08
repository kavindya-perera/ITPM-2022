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
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0">STORK MANAGEMENT / &nbsp;</span>
								<h4 class="content-title mb-0 my-auto">Stock History</h4>
							</div>
						</div>
					</div>
					<!-- breadcrumb -->

              
                        <div class="col-xl-12">
							<div class="card mg-b-20">
								<div class="card-header pb-0">
									<div class="d-flex ">
										<h4 class="card-title mg-b-0">Manage History</h4>
                                   </div>
                                   <div class="btn-icon-list mt-2">
                
                                        <a class=" mr-1"><button class="btn btn-dark btn-block " data-effect="effect-scale" data-toggle="modal" href="#modaldemo9">Filter by date range</button></a>
                                        <a href="/clearHistory" class="ml-1 mr-1" onclick="return confirm('Are you sure you want to clear stock history?');"><button class="btn btn-danger btn-block " >Clear History</button></a>
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
                                                    <th class="border-bottom-0">Date</th>
                                                    <th class="border-bottom-0">Time</th>
                                                    <th class="border-bottom-0">Item Code</th>
                                                    <th class="border-bottom-0">Item Name</th>
                                                    <th class="border-bottom-0">Handler</th>
                                                    <th class="border-bottom-0">Description</th>
												</tr>
											</thead>
											<tbody>

                                            <?php
                                                $count = 0; 
                                                foreach ($historyData as $item): 
                                                    $count++;
                                            ?>  
												<tr>
													<td><?= $count ?></td>
                                                    <td><?= $item->SH_DATE ?></td>
                                                    <td><?= $item->SH_TIME ?></td>
                                                    <td><?= $item->SH_ITEM_CODE ?></td>
                                                    <td><?= $item->ITEM_NAME ?></td>
                                                    <td><?= $item->Employee_ID ?></td>
                                                    <td><?= $item->SH_DESCRIPTION ?></td>
                                                  
												</tr>
                                            <?php endforeach ?>

											
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>



                    </div>
				
                </div>
				<!-- Container closed -->


           			<!-- Modal effects -->
                       <div class="modal" id="modaldemo9">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">Filter by Date Range</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
                                    <form action="/stockHistoryFilter" method="POST" enctype="multipart/form-data">
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
<script src="admin/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="admin/assets/plugins/datatable/js/dataTables.dataTables.min.js"></script>
<script src="admin/assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script src="admin/assets/plugins/datatable/js/responsive.dataTables.min.js"></script>
<script src="admin/assets/plugins/datatable/js/jquery.dataTables.js"></script>
<script src="admin/assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
<script src="admin/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="admin/assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
<script src="admin/assets/plugins/datatable/js/jszip.min.js"></script>
<script src="admin/assets/plugins/datatable/js/pdfmake.min.js"></script>
<script src="admin/assets/plugins/datatable/js/vfs_fonts.js"></script>
<script src="admin/assets/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="admin/assets/plugins/datatable/js/buttons.print.min.js"></script>
<script src="admin/assets/plugins/datatable/js/buttons.colVis.min.js"></script>
<script src="admin/assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script src="admin/assets/plugins/datatable/js/responsive.bootstrap4.min.js"></script>

<!--Internal  Datatable js -->
<script src="admin/assets/js/table-data.js"></script>
    </body>


</html>



















