<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Admin</title>

	<link rel="stylesheet" href="{$FULL_PATH}/assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="{$FULL_PATH}/assets/css/font-awesome.min.css" />
	{foreach $css as $c}
	<link href="{$c}" rel="stylesheet">
	{/foreach}
	<link rel="stylesheet" href="{$FULL_PATH}/assets/css/ace-fonts.css" />
	<link rel="stylesheet" href="{$FULL_PATH}/assets/css/ace.min.css" />
	<link rel="stylesheet" href="{$FULL_PATH}/assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="{$FULL_PATH}/fixes/css/estilos.css" />

	<script src="{$FULL_PATH}/assets/js/jquery-1.10.2.min.js"></script>
	<script src="{$FULL_PATH}/assets/js/ace-extra.min.js"></script>
	<script src="{$FULL_PATH}/assets/js/bootstrap.min.js"></script>
	<script src="{$FULL_PATH}/assets/js/ace-elements.min.js"></script>
	<script src="{$FULL_PATH}/assets/js/ace.min.js"></script>
	{foreach $js as $j}
	<script src="{$j}"></script>
	{/foreach}

	<!--[if lt IE 9]>
	<link rel="stylesheet" href="{$FULL_PATH}/assets/css/font-awesome-ie7.min.css" />
	<link rel="stylesheet" href="{$FULL_PATH}/assets/css/ace-ie.min.css" />
	<script src="{$FULL_PATH}/assets/js/html5shiv.js"></script>
	<script src="{$FULL_PATH}/assets/js/respond.min.js"></script>
	<![endif]-->
</head>


<body>
	<div class="navbar navbar-default" id="navbar">
		<div class="navbar-container container" id="navbar-container">
			<div class="navbar-header pull-left">
				<a href="#" class="navbar-brand">
					<small>
						<i class="icon-th-large"></i>
						Admin
					</small>
				</a><!-- /.brand -->
			</div><!-- /.navbar-header -->

			<div class="navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">

					<li class="light-blue">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<img class="nav-user-photo" src="{$FULL_PATH}/fixes/img/avatar_2x.png" alt="{$USERNAME}" />
							<span class="user-info">
								<small>Conectado como</small>
								{$USERNAME}
							</span>

							<i class="icon-caret-down"></i>
						</a>

						<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li>
								<a href="#">
									<i class="icon-cog"></i>
									Settings
								</a>
							</li>

							<li class="divider"></li>

							<li>
								<a href="{$BASE_URL}/login/logout/">
									<i class="icon-off"></i>
									Logout
								</a>
							</li>
						</ul>
					</li>
				</ul><!-- /.ace-nav -->
			</div><!-- /.navbar-header -->
		</div><!-- /.container -->
	</div>

	<div class="main-container container" id="main-container">

		<div class="main-container-inner">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<div class="sidebar" id="sidebar">
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<h5>Menu</h5>
				</div><!-- #sidebar-shortcuts -->

				<ul class="nav nav-list">
					{foreach $MENU as $i => $item}
						{if $item.controller}
						<li {if $item.active}class="active"{/if}>
							<a href="{$BASE_URL}/{$item.controller}/">
								<i class="{$item.icono}"></i>
								<span class="menu-text"> {$i} </span>
							</a>
						</li>

						{elseif $item.submenu}
						<li class="{foreach $item.submenu as $submenu}{if $submenu.active}active open{/if}{/foreach}">
							<a href="#" class="dropdown-toggle">
								<i class="{$item.icono}"></i>
								<span class="menu-text"> {$i} </span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								{foreach $item.submenu as $k => $submenu}
								<li {if $submenu.active}class="active"{/if}>
									<a href="{$BASE_URL}/{$submenu.controller}/">
										<i class="{$submenu.icono}"></i> {$k}
									</a>
								</li>
								{/foreach}
							</ul>
						</li>
						{/if}
					{/foreach}
				</ul>

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
				</div>
			</div>

			<div class="main-content">

				{*
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="#">Home</a>
						</li>

						<li>
							<a href="#">Other Pages</a>
						</li>
						<li class="active">Blank Page</li>
					</ul><!-- .breadcrumb -->

					<div class="nav-search" id="nav-search">
						<form class="form-search">
							<span class="input-icon">
								<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
								<i class="icon-search nav-search-icon"></i>
							</span>
						</form>
					</div><!-- #nav-search -->
				</div>
				*}

				<div class="page-content">
					<div class="row">
						<div class="col-xs-12">

							{$CONTENIDO}

						</div>
					</div>
				</div><!-- /.page-content -->

			</div><!-- /.main-content -->
		</div><!-- /.main-container-inner -->
	</div><!-- /.main-container -->

</body>
</html>