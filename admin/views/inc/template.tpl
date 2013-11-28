<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>

	<link href="{$FULL_PATH}/css/template.css" rel="stylesheet">
	{foreach $css as $c}
	<link href="{$c}" rel="stylesheet">
	{/foreach}

	<script src="{$FULL_PATH}/js/jquery/jquery-2.0.3.min.js"></script>
	<script src="{$FULL_PATH}/js/bootstrap/bootstrap.min.js"></script>
	{foreach $js as $j}
	<script src="{$j}"></script>
	{/foreach}
</head>
<body>

	<!-- MENU -->
	<div class="navbar">
		<div class="navbar-inner navbar-fixed-top">
			<div class="container">
				<ul class="nav">
					<li {if $URL|strstr:"php/inicio"}class="active"{/if}><a href="{$BASE_URL}/inicio"><i class="icon-home"></i> Inicio</a></li>
					<li {if $URL|strstr:"php/proyectos"}class="active"{/if}><a href="{$BASE_URL}/proyectos"><i class="icon-tag"></i> Proyectos</a></li>
					<li {if $URL|strstr:"php/modelos"}class="active"{/if}><a href="{$BASE_URL}/modelos"><i class="icon-tags"></i> Modelos</a></li>
					<li class="dropdown {if $URL|strstr:"php/comunas" || $URL|strstr:"php/provincias" || $URL|strstr:"php/regiones"}active{/if}">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> Configuración <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{$BASE_URL}/usuarios"><i class="icon-user"></i> Usuarios</a></li>
							<li><a href="{$BASE_URL}/media"><i class="icon-picture"></i> Archivos</a></li>
							<li><a href="{$BASE_URL}/comunas"><i class="icon-map-marker"></i> Comunas</a></li>
							<li><a href="{$BASE_URL}/provincias"><i class="icon-map-marker"></i> Provincias</a></li>
							<li><a href="{$BASE_URL}/regiones"><i class="icon-map-marker"></i> Regiones</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav pull-right">
					<li><a href="{$BASE_URL}/login/logout/"><i class="icon-off"></i> {$USERNAME} (salir)</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /MENU -->

	{$CONTENIDO}
	
</body>
</html>