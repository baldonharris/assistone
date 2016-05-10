<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= $title ?></title>

	<!-- Bootstrap core CSS -->

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">

	<link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet">
	<link href="assets/css/animate.min.css" rel="stylesheet">

	<!-- Custom styling plus plugins -->
	<link href="assets/css/custom.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/maps/jquery-jvectormap-2.0.3.css" />
	<link href="assets/css/icheck/flat/green.css" rel="stylesheet" />
	<link href="assets/css/floatexamples.css" rel="stylesheet" type="text/css" />

	<?php for($x=0; $x<count($css); $x++) echo '<link href="'.base_url().'assets/css/'.$css[$x].'" rel="stylesheet">'; ?>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/nprogress.js"></script>

	<!--[if lt IE 9]>
	<script src="../assets/js/ie8-responsive-file-warning.js"></script>
	<![endif]-->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>


<body class="nav-md">

	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">

					<div class="navbar nav_title" style="border: 0;">
						<a href="<?=base_url()?>" class="site_title"><i class="fa fa-paw"></i> <span>assistone</span></a>
					</div>
					<div class="clearfix"></div>

					<!-- menu prile quick info -->
					<div class="profile">
						<div class="profile_pic">
							<img src="assets/images/<?= ($this->session->userdata('display_picture') != NULL) ? $this->session->userdata('display_picture') : 'user.png' ?>" alt="..." class="img-circle profile_img">
						</div>
						<div class="profile_info">
							<span>Welcome,</span>
							<h2><?= $this->session->userdata('username') ?></h2>
						</div>
					</div>
					<!-- /menu prile quick info -->

					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3 <?= $this->uri->segment(0) ?>>&nbsp;</h3>
							<ul class="nav side-menu">
								<li class=""><a href="<?=base_url('customers')?>"><i class="fa fa-users"></i> Customers <!-- <span class="fa fa-chevron-down"></span> --></a>
									<!-- <ul class="nav child_menu" style="display: none">
										<li><a href="empty.html">Sub1.1</a>
										</li>
										<li><a href="empty.html">Sub1.2</a>
										</li>
									</ul> -->
								</li>
								<li><a><i class="fa fa-edit"></i> Loans <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display: none">
										<li><a href="empty.html">Menu2.1</a>
										</li>
										<li><a href="empty.html">Meny2.2s</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small">
						<a data-toggle="tooltip" data-placement="top" title="Settings">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="FullScreen">
							<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Lock">
							<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" href="<?= base_url('account/logout') ?>" title="Logout">
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
						</a>
					</div>
					<!-- /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">

		        <div class="nav_menu">
					<nav class="" role="navigation">
						<div class="nav toggle">
							<a id="menu_toggle"><i class="fa fa-bars"></i></a>
						</div>

						<ul class="nav navbar-nav navbar-right">
							<li class="">
								<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<img src="assets/images/<?= ($this->session->userdata('display_picture') != NULL) ? $this->session->userdata('display_picture') : 'user.png' ?>" alt=""><?= $this->session->userdata('username') ?>
									<span class=" fa fa-angle-down"></span>
								</a>
								<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
									<li><a href="javascript:;">  Profile</a></li>
									<li><a href="<?= base_url('account/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
								</ul>
							</li>
						</ul>
					</nav>
		        </div>

		      </div>
			<!-- /top navigation -->


			<!-- page content -->
			<div class="right_col" role="main">

				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="dashboard_graph">

							<div class="row x_title">
								<div class="col-md-6">
									<h3><?= $header ?> <small><?= $subheader ?></small></h3>
								</div>
								<div class="col-md-6"></div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12">