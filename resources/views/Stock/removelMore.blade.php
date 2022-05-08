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
								<h4 class="content-title mb-0 my-auto">Removal More Details</h4>
							</div>
						</div>
						<div class="d-flex my-xl-auto right-content">
							<div class="mb-xl-0">
								<div class="btn-group dropdown">
                                    <a href="/RemovelDetailsDownload/<?= $removelDetails[0]->JO_ID?>" ><button class="btn btn-warning  btn-icon mr-1"><i class="fa fa-download"></i></button></a>
                                    <a href="/DeleteRemovel/<?= $removelDetails[0]->JO_ID?>" onclick="return confirm('When this item is deleted the items here will be added back to the stock.');"><button class="btn btn-danger btn-icon mr-1"><i class="far fa-trash-alt"></i></button></a>
									<a href="/removelList"><button type="button" class="btn btn-primary">Removel List</button></a> 
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

                        <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12">
							<div class="card  box-shadow-0 ">
								<div class="card-header">
									<h4 class="card-title mb-1">Removel Details</h4>
								</div>

                                    
								<div class="card-body pt-0">
                                <table class="table table-bordered mg-b-0 text-md-nowrap">
                                   
                                        <tr>
                                            <th style="background-color:#ecf0fa;">Date</th>
                                            <td><?= $removelDetails[0]->JO_DATE; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#ecf0fa;">Recipient name</th>
                                            <td><?= $removelDetails[0]->JO_TO; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#ecf0fa;">Contact Number</th>
                                            <td><?= $removelDetails[0]->JO_CONTACT; ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="background-color:#ecf0fa;">Remark</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><?= $removelDetails[0]->JO_DESCRIPTION; ?></td>
                                        </tr>
                                 
                                </table>

					
                                 
								</div>
                                
							
							</div>
						</div>


                        <div class="col-lg-7 col-xl-7 col-md-12 col-sm-12">
							<div class="card  box-shadow-0 ">
								<div class="card-header">
									<h4 class="card-title mb-1">Reovel Items</h4>
								</div>
                                <div class="card-body pt-0">
									<form action="/ClassroomEdit/<?= $removelDetails[0]->JO_ID; ?>" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                    
                                        <table class="table table-bordered mg-b-0 text-md-nowrap">
											<thead>
												<tr>
													<th>#</th>
													<th>Item Code</th>
													<th>Item Name</th>
													<th width="25%">Qty</th>
												</tr>
											</thead>
											<tbody>
                                          
                                                <?php
                                                    $count = 0;
                                                    foreach($removelItemsDetails as $index=>$removelItemsDetail):
                                                        $count++;
                                                ?>
                                             
												<tr>
													<th><?= $count ?></th>
													<td><?= $removelItemsDetail->ITEM_CODE ?></td>
													<td><?= $removelItemsDetail->ITEM_NAME ?></td>
													<td><?= $removelItemsDetail->JOI_QTY ?></td>
												</tr>

                                                <?php
                                                    endforeach;
                                                ?>
											
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

    
    </body>


</html>



















