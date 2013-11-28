<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>

	<link href="{$FULL_PATH}/css/template.css" rel="stylesheet">
	<link href="{$FULL_PATH}/css/login.css" rel="stylesheet">
</head>
<body>

	<div class="container">

		{if $error}
		<div class="alert alert-error">
			<span class="label label-important">ERROR</span> 
			{$error}
		</div>
		{/if}

		<form action="{$BASE_URL}/login/validar/" class="form-signin clearfix" method="post">
			<h2 class="form-signin-heading">Login</h2>
			<input name="username" type="text" class="input-block-level" placeholder="Usuario">
			<input name="password" type="password" class="input-block-level" placeholder="Contraseña">
			<button class="btn btn btn-primary pull-right" type="submit">Sign in</button>
		</form>

	</div> <!-- /container -->

</body>
</html>