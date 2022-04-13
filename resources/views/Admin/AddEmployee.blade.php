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
                            <span class="text-muted mt-1 tx-13 ml-2 mb-0">EMPLOYEE MANAGEMENT / &nbsp;</span>
                            <h4 class="content-title mb-0 my-auto">Add Employee</h4>
							</div>
						</div>
						<div class="d-flex my-xl-auto right-content">
							<div class="mb-xl-0">
								<div class="btn-group dropdown">
									<a href="/AD_ManageEmployees"><button type="button" class="btn btn-primary">Manage Employee</button></a>
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
									<h4 class="card-title mb-1">Create New Employee Account</h4>
								</div>
                                

                                
								<div class="card-body pt-0">
									<form action="CreateEmloyee" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}

                                        <div class="row">
                                            <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Employee Number</label>
                                                    <input type="text" class="form-control" name="EM_NUMBER" value="<?=($EMNUMBER)?>" maxlength="100" readonly required>
                                                </div>
                                            </div>
                                        </div>  

										<div class="row"> 

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>First Name <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="FIRST_NAME"  maxlength="100" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Last Name <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="LAST_NAME"  maxlength="100" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Designation <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="DESIGNAMTION"  maxlength="200" required>
                                                </div>
                                            </div>
										
                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>System Role <font color="red">*</font></label>
                                                    <select name="SYSTEM_ROLE" class="form-control" required>
                                                        <option value="" selected disabled hidden>Choose here</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Administrator">Administrator</option>
                                                        <option value="LMS_Manager">LMS Manager</option>
                                                        <option value="Store_Manager">Store Manager</option>
                                                        <option value="Accountant">Accountant</option>
                                                    </select>
                                                </div>
                                            </div>

                                            
                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Age <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="AGE"  maxlength="2" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Birthday <font color="red">*</font></label>
                                                    <input type="date" class="form-control" name="BIRTHDAY"  maxlength="200" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Contact Number <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="CONTACT_NUMBER"  maxlength="10" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Profile Picture</label>
                                                    <input type="file" class="form-control" name="PHOTO">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control" name="ADDRESS" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="ccol-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Email <font color="red">*</font></label>
                                                    <input type="email" class="form-control" name="EMAIL"  maxlength="200" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Password <font color="red">*</font></label>
                                                    <input type="password" class="form-control" name="PASSWORD" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Re-Password <font color="red">*</font></label>
                                                    <input type="password" class="form-control" name="RE_PASSWORD" required>
                                                </div>
                                            </div>
                                      
										
										</div>
                                        <input type="submit" class="btn btn-primary mt-3 mb-0" value="CREATE" name="save">
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



















