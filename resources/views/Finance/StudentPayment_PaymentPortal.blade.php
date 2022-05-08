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
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0">FINANCE MANAGEMENT / </span>
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0"><?= $Student[0]->S_NUMBER ?> / &nbsp;</span>
                                <h4 class="content-title mb-0 my-auto">Student Payment Portal</h4>
							</div>
						</div>
						<div class="d-flex my-xl-auto right-content">
							<div class="mb-xl-0">
								<div class="btn-group dropdown">
									<a href="/Get_Student_Payment"><button type="button" class="btn btn-primary">Student Payment</button></a> 
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

                        <div class="col-xl-4 col-md-12 col-lg-6">

                        <?php

                            $month = date('m');
                            $year = date('Y');
                            foreach($PaymentDetails AS $PaymentDetail){
                                $db_date = date_create($PaymentDetail->SP_DATE);
                                $p_month = date_format($db_date,"m");
                                $p_year = date_format($db_date,"Y");

                                if(($month == $p_month) && ($year == $p_year)){
                                    $paid = 1;
                                }
                            }
                          
                            if(isset($paid)){
                        ?>
                            <div class="alert alert-solid-success mg-b-0 mb-3" role="alert">
                                <strong>Payment Compelete!</strong> Payment is complete this month.
                            </div>
                        <?php }else{ ?>
                            <div class="alert alert-solid-danger mg-b-0 mb-3" role="alert">
                                <strong>Payment Needed!</strong> Payment is due this month.
                            </div>
                        <?php } ?>

							<div class="card">
								<div class="card-header pb-1">
									<h3 class="card-title mb-2">Student Details</h3>
									<p class="tx-12 mb-0 text-muted">The student details is bio data of student</p>
								</div>  

                                <div class="table-responsive country-table p-3">
									<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
										<tbody>
                                            <tr>
                                                <th width="35%">Student Number</th>
                                                <td><?=$Student[0]->S_NUMBER?></td>
                                            </tr>
                                            <tr>
                                                <th>Class</th>
                                                <td><?=$Student[0]->C_NAME?></td>
                                            </tr>
                                            <tr>
                                                <th>Full Name</th>
                                                <td><?=$Student[0]->S_FULL_NAME?></td>
                                            </tr>
                                            <tr>
                                                <th>NIC Number</th>
                                                <td><?=$Student[0]->S_NIC?></td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td><?=$Student[0]->S_GENDER?></td>
                                            </tr>
										</tbody>
									</table>
								</div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-12 col-lg-6">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title mb-2">Payment Details Form</h3>
									<p class="tx-12 mb-0 text-muted">The payment details form is where the student's payment information is entered</p>
								</div>  
                                <div class="card-body">

                                <form action="PlacePayment" method="POST">
                                 {{csrf_field()}}

                                    <input type="text" class="form-control" name="P_INVOICE" value="<?=$InvoiceNumber?>"  maxlength="4" hidden required>
                                    <input type="text" class="form-control" name="S_ID" value="<?=$Student[0]->S_ID?>"  maxlength="4" hidden required>
                                    
                                    <label>Payment Date <font color="red">*</font></label>
                                    <div class="row"> 
                                        <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="P_YEAR" value="<?=date('Y')?>"  maxlength="4" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <select name="P_MONTH" class="form-control" required>
                                                    <option value="<?=date('m')?>" selected hidden> <?=date('M')?> </option>
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
                                                <select name="P_DATE" class="form-control" required>
                                                    <option value="<?=date('d')?>" selected hidden> <?=date('d')?> </option>
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
                                                <label>Payment For <font color="red">*</font></label>
                                                <input type="text" class="form-control" name="P_FOR" value="Installment Course Fee"  maxlength="100" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Amount (LKR)<font color="red">*</font></label>
                                                <input type="text" class="form-control" name="P_AMOUNT"   maxlength="50" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Remark</label>
                                                <textarea name="P_REMARK" class="form-control" rows="2" maxlength="150"></textarea>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <input type="submit" class="btn btn-primary  mb-0" value="SUBMIT" name="save" width="100%">
                                </form>

                                </div> 
                            </div>
                        </div>



                        <div class="col-xl-4 col-md-12 col-lg-12">

                            <div class="card">
                                <div class="card-header pb-1">
                                    <h3 class="card-title mb-2">Payment History</h3>
                                    <p class="tx-12 mb-0 text-muted">Payment History is the information on payments made by the student</p>
                                </div>  

                                <div class="table-responsive country-table p-3">
                                    <table class="table table-responsive table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap" >
                                        <thead>
                                            <tr>
                                                <th width="30%">Invoice No</th>
                                                <th width="15%">Date</th>
                                                <th width="35%">Payment For</th>
                                                <th width ="20%">Amount (LKR)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($PaymentDetails AS $PaymentDetail): ?>
                                                <tr>
                                                    <td><a href="/DownloadInvoice/<?=$PaymentDetail->SP_INVOICE_NO?>"><?=$PaymentDetail->SP_INVOICE_NO?> <i class="fa fa-download"></i></a></td>
                                                    <td><?=$PaymentDetail->SP_DATE?></td>
                                                    <td><?=$PaymentDetail->SP_FOR?></td>
                                                    <td><?=number_format($PaymentDetail->SP_AMOUNT,2)?></td>
                                                </tr>
                                            <?php endforeach; ?>
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


















