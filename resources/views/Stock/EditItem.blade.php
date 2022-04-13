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
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0">STORK MANAGEMENT / &nbsp;</span>
                                <h4 class="content-title mb-0 my-auto"> Edit New Item</h4>
							</div>
						</div>
						<div class="d-flex my-xl-auto right-content">
							<div class="mb-xl-0">
								<div class="btn-group dropdown">
									<a href="/ManageItems"><button type="button" class="btn btn-primary">Manage Items</button></a> 
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



                    <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
							<div class="card  box-shadow-0 ">
								<div class="card-header">
									<h4 class="card-title mb-1">Edit New Item</h4>
								</div>
                                

                                
								<div class="card-body pt-0">
									<form action="/EditAction/<?=$Item[0]->ITEM_ID; ?>" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                    

										<div class="row"> 

                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Item Name <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="ITEM_NAME" value="<?=$Item[0]->ITEM_NAME; ?>" maxlength="100" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Remark <font color="red">*</font></label>
                                                    <textarea name="ITEM_REMARK" class="form-control" maxlength="500" rows="3" required><?=$Item[0]->ITEM_REMARK; ?></textarea>
                                                </div>
                                            </div>
										</div>
                                        <input type="submit" class="btn btn-primary mt-3 mb-0" value="SAVE" name="save">
									</form>
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

    
    </body>


</html>



















