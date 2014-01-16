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
					{foreach $MENU as $i => $item}
						{if $item.controller}
						<li {if $item.active}class="active"{/if}><a href="{$BASE_URL}/{$item.controller}"><i class="{$item.icono}"></i> {$i}</a></li>
						{elseif $item.submenu}
							<li class="dropdown {foreach $item.submenu as $submenu}{if $submenu.active}active{/if}{/foreach}">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="{$item.icono}"></i> {$i} <b class="caret"></b></a>
								<ul class="dropdown-menu">
								{foreach $item.submenu as $k => $submenu}
									<li {if $submenu.active}class="active"{/if}><a href="{$BASE_URL}/{$submenu.controller}"><i class="{$submenu.icono}"></i> {$k}</a></li>
								{/foreach}
								</ul>
							</li>
						{/if}
					{/foreach}
				</ul>
				{if $USERNAME}
				<ul class="nav pull-right">
					<li><a href="{$BASE_URL}/login/logout/"><i class="icon-user"></i> {$USERNAME} (salir)</a></li>
				</ul>
				{/if}
			</div>
		</div>
	</div>
	<!-- /MENU -->

	{$CONTENIDO}
	
</body>
</html>