@include('layout/isloginAdmin')
<!doctype html>
<html lang="en" dir="ltr">
	

    <head>
        @include('layout/head')
        <!-- Internal Select2 css -->
        <link href="{{ URL::to('/') }}/admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet">
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
                                <h4 class="content-title mb-0 my-auto"> Removal</h4>
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

                


                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
							<div class="card  box-shadow-0 ">
								<div class="card-header">
									<h4 class="card-title mb-1">Add Item  </h4>
								</div>
								<div class="card-body pt-0">
									<form action="/AddToCart" method="GET" enctype="multipart/form-data">
                                    {{csrf_field()}}
										<div class="row"> 
                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="search-box">
                                                    <select class="form-control select2" name="item">
                                                    <option label="Choose one">  </option>

                                                        <?php foreach($items as $item): ?>
                                                            <option value="<?= $item->ITEM_CODE ?>"><?= $item->ITEM_NAME ?></option>
                                                        <?php endforeach;?>

                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                                <div class="form-group" >
                                                    <input type="submit" class="btn btn-primary  mb-0" value="ADD" name="save">
                                                </div>
                                            </div>
										</div>
									</form>
								</div>
							</div>
						</div>

            

                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                            <div class="card  box-shadow-0">
                                <div class="card-header">
									<h4 class="card-title mb-1">Operation</h4>
								</div>
                                <div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered mg-b-0 text-md-nowrap">
											<thead>
												<tr>
													<th>#</th>
													<th>Item Code</th>
													<th>Item Name</th>
													<th width="25%">Qty</th>
													<th>Remove</th>
												</tr>
											</thead>
											<tbody>
                                            <form action="/ActionStokOut" method="POST" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <?php
                                                    $count = 0;
                                                    foreach($cart as $cartItem):
                                                        $count++;
                                                ?>
												<tr>
													<th><?= $count ?></th>
													<td><?= $cartItem->C_ITEM_ID ?></td>
													<td><?= $cartItem->ITEM_NAME ?></td>
													<td>
                                                        <input type="text" name="ItemCode[]"  value="<?= $cartItem->C_ITEM_ID ?>" hidden required>
                                                        <input type="number" class="count form-control" name="qty[]" max="<?= $cartItem->SM_ITEM_QTY ?>" min="1" value="1" maxlength="5" required>
                                                    </td>
                                                    <td>
                                                        <a href="/removeFromCart/<?= $cartItem->C_ID ?>" class="btn btn-danger btn-icon ml-1 mr-1"><i class="fa fa-times"></i></a>
                                                    </td>
												</tr>
                                                <?php
                                                    endforeach;
                                                ?>
											
											</tbody>
										</table>
									</div>
                                    <?php if(!empty($cart)): ?>
                                    <a class="ml-1 mr-1"><button class="btn btn-dark btn-block " data-effect="effect-scale" data-toggle="modal" href="#modaldemo9">PROCESS</button></a>
                                    <?php endif ?>
								</div>
                            </div>
                        </div>
				
                </div>


      
           
				            			<!-- Modal effects -->
			<div class="modal" id="modaldemo9">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">Stork Out Details</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
                                   
										<div class="row"> 
                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Recipient name <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="Recipient" maxlength="100"  required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Recipient Contact Number <font color="red">*</font></label>
                                                    <input type="text" class="form-control" name="contact" maxlength="10" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Remark</label>
                                                    <textarea name="remark" class="form-control" rows="3" maxlength="200"></textarea>
                                                </div>
                                            </div>
										</div>
                                        
									
						</div>
						<div class="modal-footer">
							<input type="submit" class="btn ripple btn-primary" value="STORK OUT" name="submit">
							<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                            </form>
						</div>
					</div>
				</div>
			</div>
			<!-- End Modal effects-->
     





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
    <script src="{{ URL::to('/') }}/admin//assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{ URL::to('/') }}/admin//assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Ionicons js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/ionicons/ionicons.js"></script>

    <!-- Moment js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/moment/moment.js"></script>

    <!-- P-scroll js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ URL::to('/') }}/admin//assets/plugins/perfect-scrollbar/p-scroll.js"></script>

    <!-- Sticky js -->
    <script src="{{ URL::to('/') }}/admin//assets/js/sticky.js"></script>

    <!-- eva-icons js -->
    <script src="{{ URL::to('/') }}/admin//assets/js/eva-icons.min.js"></script>

    <!-- Rating js-->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/rating/jquery.rating-stars.js"></script>
    <script src="{{ URL::to('/') }}/admin//assets/plugins/rating/jquery.barrating.js"></script>

    <!-- Sidebar js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/side-menu/sidemenu.js"></script>

    <!-- Right-sidebar js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/sidebar/sidebar.js"></script>
    <script src="{{ URL::to('/') }}/admin//assets/plugins/sidebar/sidebar-custom.js"></script>


    <!--Internal  Datepicker js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>

    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/jquery.maskedinput/jquery.maskedinput.js"></script>

    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/date-picker/spectrum.js"></script>

    <!-- Internal Select2.min js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/select2/js/select2.min.js"></script>

    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>

    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js"></script>

    <!-- Ionicons js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js"></script>

    <!--Internal  pickerjs js -->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/pickerjs/picker.min.js"></script>

    <!-- Internal form-elements js -->
    <script src="{{ URL::to('/') }}/admin//assets/js/form-elements.js"></script>


    <!-- Horizontalmenu js-->
    <script src="{{ URL::to('/') }}/admin//assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

    <!-- custom js -->
    <script src="{{ URL::to('/') }}/admin//assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="{{ URL::to('/') }}/admin//assets/switcher/js/switcher.js"></script>

    
    </body>


</html>



















