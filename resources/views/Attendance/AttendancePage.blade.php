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
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0">STUDENT ATTENDANCE & PAYMENT / &nbsp;</span>
                                <h4 class="content-title mb-0 my-auto">Attendance Page</h4>
							</div>
						</div>
						<div class="d-flex my-xl-auto right-content">
							<div class="mb-xl-0">
								<div class="btn-group dropdown">
									<a href="/AttendanceSelector"><button type="button" class="btn btn-primary">Student Selector</button></a> 
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

                    <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
                            <?php
                                $month = date('m');
                                $year = date('Y');
                                if(isset($details[0]->SP_ID)){
                                    foreach($details AS $detail){
                                        if(($month == $detail->SP_MONTH) && ($year == $detail->SP_YEAR)){
                                            $paid = 1;
                                        }
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
                                                <td><?=$details[0]->S_NUMBER?></td>
                                            </tr>
                                            <tr>
                                                <th>Class</th>
                                                <td><?=$details[0]->C_NAME?></td>
                                            </tr>
                                            <tr>
                                                <th>Full Name</th>
                                                <td><?=$details[0]->S_FULL_NAME?></td>
                                            </tr>
                                            <tr>
                                                <th>NIC Number</th>
                                                <td><?=$details[0]->S_NIC?></td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td><?=$details[0]->S_GENDER?></td>
                                            </tr>
										</tbody>
									</table>
								</div>
                            </div>
						</div>



                        <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12">

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
                                            <?php 
                                            if(isset($details[0]->SP_ID)){
                                            foreach($details AS $detail): ?>
                                                <tr>
                                                    <td><a href="/DownloadInvoice/<?=$detail->SP_INVOICE_NO?>"><?=$detail->SP_INVOICE_NO?> <i class="fa fa-download"></i></a></td>
                                                    <td><?=$detail->SP_MONTH."-".$detail->SP_DATE."-".$detail->SP_YEAR?></td>
                                                    <td><?=$detail->SP_FOR?></td>
                                                    <td><?=$detail->SP_AMOUNT?></td>
                                                </tr>
                                            <?php endforeach; }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12">
                            <div class="card">
								<div class="card-header pb-1">
									<h3 class="card-title mb-2">Operations</h3>
								</div>  
                                <div class="card-body">
                                        <a href="MarkAttend/<?=$details[0]->S_ID?>" ><button class="btn btn-primary btn-block mb-2">Attend</button></a>
                                        <a class="btn btn-success btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">Make Payment</a>
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
							<h6 class="modal-title">Make Payment</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
                                <form action="/PlacePaymentAttend" method="POST">
                                 {{csrf_field()}}

                                    <input type="text" class="form-control" name="P_INVOICE" value="<?=$InvoiceNumber?>"  maxlength="4" hidden required>
                                    <input type="text" class="form-control" name="S_ID" value="<?=$details[0]->S_ID?>"  maxlength="4" hidden required>
                                    
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
                                  
						</div>
						<div class="modal-footer">
                            
                                <input type="submit" class="btn ripple btn-primary" value="Pay & Attend" name="PayAttend">
                                <input type="submit" class="btn ripple btn-primary" value="Pay Only" name="PayOnly">
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

    
    </body>


</html>



















