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
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0">LEARNING MANAGEMENT / &nbsp;</span>
                                <h4 class="content-title mb-0 my-auto"> Add Student</h4>
							</div>
						</div>
						<div class="d-flex my-xl-auto right-content">
							<div class="mb-xl-0">
								<div class="btn-group dropdown">
									<a href="/AD_ManageStudents"><button type="button" class="btn btn-primary">Manage Students</button></a> 
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



                    <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12">
							<div class="card  box-shadow-0 ">
								<div class="card-header">
									<h4 class="card-title mb-1">Create New Student</h4>
								</div>
                                

                                
								<div class="card-body pt-0">
									<form action="CreateStudent" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    
                                        <div class="row"> 
                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Student Number</label>
                                                    <input type="text" class="form-control bg-primary text-white" value="<?=$StudentNumber?>" name="S_NUMBER"  readonly required>
                                                </div>
                                            </div>
                                        </div>
                    

										<div class="row"> 
                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <label class="m-0 mt-2"> <b>Personal Details</b> </label><hr class="mt-1 mb-2">
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>First Name <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="S_FIRST_NAME"  maxlength="50" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Last Name <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="S_LAST_NAME"  maxlength="50" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Full Name <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="S_FULL_NAME"  maxlength="200" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>NIC Number</label>
                                                    <input type="text" class="form-control" name="S_NIC"  maxlength="12">
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-xl-2 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Age <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="S_AGE"  maxlength="2" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Date of Birth <font color="red">*</font></label>
                                                    <input type="date" class="form-control" name="S_BIRTHDAY"  maxlength="10" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Gender <font color="red">*</font></label><br>
                                                    <input type="radio" name="S_GENDER" value="MALE" required> Male
                                                    <input type="radio" class="ml-3" name="S_GENDER" value="FEMALE" required> Female
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <label class="m-0 mt-2"> <b>Contact Details</b> </label><hr class="mt-1 mb-2">
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Contact Number <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="S_CONTACT_NUMBER_1"  maxlength="10" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Another Contact Number</label>
                                                    <input type="text" class="form-control" name="S_CONTACT_NUMBER_2"  maxlength="10">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Whatsapp Number</label>
                                                    <input type="text" class="form-control" name="S_WHATSAPP_NUMBER"  maxlength="15">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" name="S_EMAIL"  maxlength="100">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Address <font color="red">*</font></label>
                                                    <textarea name="S_ADDRESS" class="form-control" maxlength="255"  rows="3" required></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <label class="m-0 mt-2"> <b>Parents Details</b> </label><hr class="mt-1 mb-2">
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Full Name <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="S_P_NAME"  maxlength="200" required>
                                                </div>
                                            </div>
                                       
                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Contact Number <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="S_P_CONTACT_NUMBER"  maxlength="10" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <label class="m-0 mt-2"> <b>Class Details</b> </label><hr class="mt-1 mb-2">
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Select Class <font color="red">*</font></label>
                                                    <select name="S_CLASS_ROOM_ID" class="form-control" required>
                                                        <option disabled selected hidden value> -- select an option -- </option>
                                                        <?php foreach($classrooms AS $classroom): ?>
                                                            <option value="<?= $classroom->C_ID ?>"><?= $classroom->C_NAME ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                      
										
										</div>
                                        <input type="submit" class="btn btn-primary  mb-0" value="CREATE" name="save">
									</form>
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



















