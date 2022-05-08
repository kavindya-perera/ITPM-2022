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
             @include('layout/header1')

				<!-- /main-header -->


                <!-- container -->
				<div class="container-fluid">
              
                    <!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="my-auto">
							<div class="d-flex">
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0">LEARNING  MANAGEMENT / </span>
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0"><?=$classroom[0]->C_NAME?> / &nbsp;</span>
								<h4 class="content-title mb-0 my-auto">Change Classroom</h4>
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
									<h4 class="card-title mb-1">Change Classroom</h4>
								</div>
            

                                
								<div class="card-body pt-0">

                                            
                                            <div class="country-table p-2">
                                                <table class="table table-striped table-bordered mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="2">Full Name<br><b><?=$student[0]->S_FULL_NAME?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="50%">Student Number<br><b><?=$student[0]->S_NUMBER?></b></td>
                                                            <td width="50%">NIC Number<br><b><?=$student[0]->S_NIC?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="50%">Age<br><b><?=$student[0]->S_AGE?></b></td>
                                                            <td width="50%">Birthday<br><b><?=$student[0]->S_BIRTHDAY?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="50%">Gender<br><b><?=$student[0]->S_GENDER?></b></td>
                                                            <td width="50%">Contact 01<br><b><?=$student[0]->S_CONTACT_NUMBER_1?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="50%">Contact 02<br><b><?=$student[0]->S_CONTACT_NUMBER_2?></b></td>
                                                            <td width="50%">Whatsapp<br><b><?=$student[0]->S_WHATSAPP_NUMBER?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">Email<br><b><?=$student[0]->S_EMAIL?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">Address<br><b><?=$student[0]->S_ADDRESS?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="50%">Parnet Name<br><b><?=$student[0]->S_P_NAME?></b></td>
                                                            <td width="50%">Parnet Contact<br><b><?=$student[0]->S_P_CONTACT_NUMBER?></b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                    
                         
                   
									<form action="/ChangeClassroomAction/<?=$student[0]->S_ID."/".$classroom[0]->C_ID?>" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}

                                    

                                    

										<div class="row"> 

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Select Classroom <font color="red">*</font></label>
                                                    <select name="C_ID" class="form-control" required>
                                                        <option value="<?=$student[0]->C_ID; ?>" selected hidden> <?=$student[0]->C_NAME; ?> </option>
                                                        <?php foreach($classrooms AS $class): ?>
                                                            <option value="<?=$class->C_ID?>"><?=$class->C_NAME?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            

										
										</div>
                                        <input type="submit" class="btn btn-primary  mb-0" value="CHANGE" name="save">
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



















