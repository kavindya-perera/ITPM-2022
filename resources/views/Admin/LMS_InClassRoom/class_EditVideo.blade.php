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
								<h4 class="content-title mb-0 my-auto">Edit Embedded Video Lesson</h4>
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
									<h4 class="card-title mb-1">Edit Embedded Video</h4>
								</div>
            

                                
								<div class="card-body pt-0">
                   
									<form action="/EditVideoAction/<?=$video[0]->V_ID."/".$classroom[0]->C_ID?>" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}

                                    

										<div class="row"> 

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Subject <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="V_SUBJECT" value="<?=$video[0]->V_SUBJECT?>"  maxlength="100" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Chapter Name <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="V_CHAPTER" value="<?=$video[0]->V_CHAPTER?>" maxlength="100" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Video Name <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="V_NAME" value="<?=$video[0]->V_NAME?>" maxlength="200" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Video Description <font color="red">*</font></label>
                                                    <textarea name="V_DESCRIPTION"  class="form-control"  rows="3" maxlength="200"><?=$video[0]->V_DESCRIPTION?></textarea>
                                                </div>
                                            </div>
                                      
                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Embed Code <font color="red">*</font></label>
                                                    <textarea name="V_CODE"  class="form-control"  rows="3" maxlength="10000"><?=$video[0]->V_CODE?></textarea>
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


















