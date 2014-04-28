<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Login</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="stylesheet" href="{$FULL_PATH}/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="{$FULL_PATH}/assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="{$FULL_PATH}/assets/css/ace-fonts.css" />
		<link rel="stylesheet" href="{$FULL_PATH}/assets/css/ace.min.css" />
		<link rel="stylesheet" href="{$FULL_PATH}/fixes/css/login.css" />

		<!--[if lt IE 9]>
		<link rel="stylesheet" href="{$FULL_PATH}/assets/css/font-awesome-ie7.min.css" />
		<link rel="stylesheet" href="{$FULL_PATH}/assets/css/ace-ie.min.css" />
		<script src="{$FULL_PATH}/assets/js/html5shiv.js"></script>
		<script src="{$FULL_PATH}/assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">

							<div class="loginBox position-relative">
	
								{if $error}
								<div class="alert alert-danger">
									<span class="label label-danger">ERROR</span>
									{$error}
								</div>
								{/if}

								<div id="login-box" class="login-box visible widget-box no-border">

									<div class="widget-body">
										<div class="widget-main">

											<div class="center avatar">
												<img src="{$FULL_PATH}/fixes/img/avatar_2x.png" alt="">
											</div>

											<div class="space-6"></div>

											<form action="{$BASE_URL}/login/validar/" class="form-signin clearfix" method="post">
												<fieldset>

													<div class="clearfix">
														<span class="block input-icon input-icon-left primero">
															<input type="text" class="form-control" placeholder="Username" name="username" />
															<i class="icon-user"></i>
														</span>

														<span class="block input-icon input-icon-left">
															<input type="password" class="form-control" placeholder="Password" name="password" />
															<i class="icon-lock"></i>
														</span>
													</div>

													<div class="space"></div>

													<div class="clearfix">
														<button type="submit" class="width-100 btn btn-primary">
															Login
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

										</div><!-- /widget-main -->
									</div><!-- /widget-body -->
								</div><!-- /login-box -->

							</div><!-- /position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
		</div><!-- /.main-container -->

	</body>
</html>
