

<!DOCTYPE html>
<html lang="en">
	
<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="dashboard, admin, bootstrap admin template, codeigniter, php, php framework, codeigniter 4, php mvc, php codeigniter, best php framework, codeigniter admin, codeigniter dashboard, admin panel template, bootstrap 4 admin template, bootstrap dashboard template"/>

        		<!-- Title -->
		<title>WITC | Login</title>

		<!-- Favicon -->
		<link rel="icon" href="/admin/assets/img/brand/favicon.png" type="image/x-icon"/>

		<!-- Bootstrap css-->
		<link href="/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>


		<!-- Style css -->
		<link href="/admin/assets/css/style.css" rel="stylesheet">

    </head>

	<body class="main-body">


		<!-- Loader -->
		<div id="global-loader">
			<img src="/admin/assets/img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->

        
		<!-- Page -->
		<div class="error-page1  bg-light">
			<div class="page">

				<div class="container-fluid">
					<div class="row no-gutter">
						<!-- The image half -->
						<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primery-transparent">
							<div class="row wd-100p mx-auto text-center">
								<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
									<img src="/admin/assets/img/loginLogo.png" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
								</div>
							</div>
						</div>
						<!-- The content half -->
						<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
							<div class="login d-flex align-items-center py-2">
								<!-- Demo content-->
								<div class="container p-0">
									<div class="row">
										<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
											<div class="card-sigin">
												<div class="mb-5 d-flex"> <a href="Home"><img src="/admin/assets/img/brand/logo.png" class="sign-favicon ht-40" alt="logo"></a></div>
												<div class="card-sigin">
													<div class="main-signup-header">

														
														<h5 class="font-weight-semibold mb-4">Please sign in to continue.</h5>
                                                        
                                                        <?php if (session('status')): ?>
                                                        <div class="alert alert-success" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                            <?= session('status') ?>
                                                        </div>
                                                        <?php endif ?>

                                                        <?php if (session('failed')): ?>
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                            <?= session('failed') ?>
                                                        </div>
                                                        <?php endif ?>
                                                        
														<form  action="/CheckLogin" method="POST">
                                                            {{csrf_field()}}
															<div class="form-group">
																<label>Email</label> <input class="form-control" name="email"  type="email" required>
															</div>
															<div class="form-group">
																<label>Password</label> <input class="form-control" name="password" type="password" required>
															</div>
															<button  type="submit" class="btn btn-main-primary btn-block">Sign In</button>
														
														</form>
													</div> 
												</div>
											</div>
										</div>
									</div>
								</div><!-- End -->
							</div>
						</div><!-- End -->
					</div>
				</div>

			</div>
		</div>
		<!-- End Page -->

	
        		<!-- JQuery min js -->
		<script src="/admin/assets/plugins/jquery/jquery.min.js"></script>

		<!-- Bootstrap js -->
        <script src="/admin/assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="/admin/assets/plugins/bootstrap/js/bootstrap.js"></script>

		<!-- custom js -->
		<script src="/admin/assets/js/custom.js"></script>

		<!-- Switcher js -->
    </body>
</html>