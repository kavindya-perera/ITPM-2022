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
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0">FINANCE  MANAGEMENT / &nbsp;</span>
                                <h4 class="content-title mb-0 my-auto"> Update Other Income</h4>
							</div>
						</div>
						<div class="d-flex my-xl-auto right-content">
							<div class="mb-xl-0">
								<div class="btn-group dropdown">
									<a href="/Manage_Other_Incomes"><button type="button" class="btn btn-primary">Manage Incomes</button></a> 
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
									<h4 class="card-title mb-1">Update Other Income</h4>
								</div>

                                <?php
                                    $date=date_create($payment[0]->OP_DATE);
                                    $p_Year = date_format($date,"Y");
                                    $p_Month = date_format($date,"m");
                                    $p_Date = date_format($date,"d");
                                ?>

                                
								<div class="card-body pt-0">
									<form action="/OtherIncomeUpdateAction/<?=$payment[0]->OP_ID ?>" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                       
										<div class="row"> 

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Customer Name <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="O_CUSTOMER_NAME" value="<?=$payment[0]->OP_CUSTOMER_NAME ?>" maxlength="150" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Customer Contact <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="O_CUSTOMER_CONTACT" value="<?=$payment[0]->OP_CUSTOMER_CONTACT ?>" maxlength="10" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Customer Address <font color="red">*</font></label>
                                                    <textarea name="O_CUSTOMER_ADDRESS" class="form-control" maxlength="255" rows="3" required><?=$payment[0]->OP_CUSTOMER_ADDRESS ?></textarea>
                                                </div>
                                            </div>

										</div>
                                        <label>Payment Date <font color="red">*</font></label>
                                        <div class="row"> 
                                        <div class="col-lg-2 col-xl-4 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="O_YEAR" value="<?=$p_Year ?>"  maxlength="4" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 col-xl-5 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <select name="O_MONTH" class="form-control" required>
                                                    <option value="<?=$p_Month ?>" selected hidden> <?= $p_Month ?> </option>
                                                    <option value="01">January</option>
                                                    <option value="02">February</option>
                                                    <option value="03">March</option>
                                                    <option value="04">April</option>
                                                    <option value="05">May</option>
                                                    <option value="06">June</option>
                                                    <option value="07">July</option>
                                                    <option value="08">August</option>
                                                    <option value="09">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <select name="O_DATE" class="form-control" required>
                                                    <option value="<?=$p_Date ?>" selected hidden> <?=$p_Date ?></option>
                                                    <option value="01">1</option>
                                                    <option value="02">2</option>
                                                    <option value="03">3</option>
                                                    <option value="04">4</option>
                                                    <option value="05">5</option>
                                                    <option value="06">6</option>
                                                    <option value="07">7</option>
                                                    <option value="08">8</option>
                                                    <option value="09">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Amount (LKR) <font color="red">*</font></label>
                                                <input type="text" class="form-control" name="O_AMOUNT" value="<?=$payment[0]->OP_AMOUNT ?>"  maxlength="50" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Payment For <font color="red">*</font></label>
                                                <input type="text" class="form-control" name="O_FOR" value="<?=$payment[0]->OP_FOR ?>" maxlength="150" required>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Remark</label>
                                                <textarea name="O_REMARK" class="form-control" rows="2" maxlength="150"><?=$payment[0]->OP_REMARK ?></textarea>
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



















