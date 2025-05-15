<!DOCTYPE html>

<html lang="en">

<?php

	include 'layout/head.php';

?>

	

<body class="hold-transition theme-primary bg-img" style="background-image: url(assets/images/auth-bg/bg-1.jpg)">

	

	<div class="container h-p100">

		<div class="row align-items-center justify-content-md-center h-p100">	

			

			<div class="col-12">

				<div class="row justify-content-center no-gutters">

					<div class="col-lg-5 col-md-5 col-12">

						<div class="bg-white rounded30 shadow-lg">

							<!-- <div class="content-top-agile p-20 pb-0">

								<h2 class="text-primary">SCHOOL NAME</h2>

								<p class="mb-0">Sign in to continue.</p>							

							</div> -->

							<div class="content-top-agile p-20">

								<img src="../assets/images/logo.png" alt="User Image" class="rounded-circle" height="100" width="100"> 

								<h3 class="mb-0">SCHOOL NAME</h3>	

								<h4>Teacher's Portal</h4>

							</div>

							<?php

								if (isset($_GET['type'])) {

                                    if ($_GET['type']=='error') {

                                            echo'<center>

											<div class="col-sm-8" style="margin-bottom:-35px; margin-top:10px;">

                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">

                                                            '.$_GET['msg'].'     

                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                                                        </div>

                                                    </div>

											</center>';

									}

									if ($_GET['type']=='information') {

										echo'<center>

										<div class="col-sm-8" style="margin-bottom:-35px; margin-top:10px;">

													<div class="alert alert-success alert-dismissible fade show" role="alert">

														'.$_GET['msg'].'     

														<button style="margin-left: 20px;" type="button" class="btn-close btn text-white" data-bs-dismiss="alert" aria-label="Close">x</button>

													</div>

												</div>

										</center>';

								}

								}

							?>

							<div class="p-40">

								<form action="includes/login_code.php" method="post">

									<div class="form-group">

										<div class="input-group mb-3">

											<div class="input-group-prepend">

												<span class="input-group-text bg-transparent"><i class="ti-email"></i></span>

											</div>

											<input type="email" name="email" class="form-control pl-15 bg-transparent" placeholder="email">

										</div>

									</div>

									<div class="form-group">

										<div class="input-group mb-3">

											<div class="input-group-prepend">

												<span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>

											</div>

											<input type="password" name="password" class="form-control pl-15 bg-transparent" placeholder="Password">

										</div>

									</div>

									  <div class="row">

										<div class="col-12 text-center">

										  <button type="submit" name="login" class="btn btn-danger mt-10">SIGN IN</button>

										</div>

									  </div>

								</form>	

							</div>						

						</div>

						<div class="text-center">

						  <p class="mt-20 text-white">- Teacher Portal -</p>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>	





	<!-- Vendor JS -->

	<script src="js/vendors.min.js"></script>

	<script src="js/pages/chat-popup.js"></script>

    <script src="../assets/icons/feather-icons/feather.min.js"></script>	

<!-- JavaScript Bundle with Popper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>

