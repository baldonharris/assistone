<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= $title ?></title>
	<link rel="icon" href="<?=base_url('assets/img/assistone/logo.png')?>">

	<!-- Bootstrap core CSS -->
	<link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/css/bootstrap-editable.css" rel="stylesheet">

	<link href="<?=base_url()?>assets/fonts/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/css/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css"></head>
	<link href="<?=base_url()?>assets/css/animate/animate.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/daterangepicker.css" rel="stylesheet">

	<!-- Custom styling plus plugins -->
	<link href="<?=base_url()?>assets/css/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/angular-chart.css" rel="stylesheet"/>
	<link href="<?=base_url()?>assets/css/custom.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/css/super-custom.css" rel="stylesheet"/>

	<?php for($x=0; $x<count($css); $x++) echo '<link href="'.base_url().'assets/css/'.$css[$x].'" rel="stylesheet">'; ?>

	<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
	<script src="<?=base_url()?>assets/js/nprogress.js"></script>

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
			<div class="col-md-3 left_col menu_fixed">
				<div class="left_col scroll-view">

					<div class="navbar nav_title" style="text-align: center; margin-left: -6%">
						<a href="<?=base_url()?>" class="site_title">
							<img src="<?=base_url('assets/img/assistone/logo.png')?>"/> assist<span style="color:#fb8200">one</span>
						</a>
					</div>
					<div class="clearfix"></div>

					<!-- menu prile quick info -->
					<div class="profile">
						<div class="profile_pic">
							<img src="<?=base_url()?>assets/images/<?= ($this->session->userdata('display_picture') != NULL) ? $this->session->userdata('display_picture') : 'user.png' ?>" alt="..." class="img-circle profile_img" height="55px" width="50px">
						</div>
						<div class="profile_info">
							<span>Welcome,</span>
							<h2><?= $this->session->userdata('fullname') ?></h2>
						</div>
					</div>
					<!-- /menu prile quick info -->

					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3 <?= $this->uri->segment(0) ?>>&nbsp;</h3>
							<ul class="nav side-menu">
                                <li class=""><a href="<?=base_url('home')?>"><i class="fa fa-home"></i> Home</a></li>
                                <li class=""><a href="<?=base_url('reservations/listing/'.$page['curr_page'].'/'.$set_sortby.'/'.$set_orderby.'/'.$set_display)?>"><i class="fa fa-ticket"></i> Loan Reservations</a></li>
								<li class=""><a href="<?=base_url('customers/listing/'.$page['curr_page'].'/'.$set_sortby.'/'.$set_orderby.'/'.$set_display)?>"><i class="fa fa-chain"></i> Loans</a></li>
								<li class=""><a href="<?=base_url('investors/listing/')?>"><i class="fa fa-money"></i> Investors</a></li>
								<li class=""><a><i class="fa fa-line-chart"></i> Reports <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display: none">
										<li><a href="<?=base_url('reports/collection_statement')?>">Collection Statement</a></li>
										<li><a href="<?=base_url('reports/interest_report')?>">Interest Report</a></li>
										<li><a href="<?=base_url('reports/review_performance')?>">Review Performance</a></li>
										<li><a href="<?=base_url('reports/investments')?>">Investments</a></li>
									</ul>
								</li>
                                <li class=""><a href="<?=base_url('funds')?>"><i class="fa fa-list"></i> Fund Management</a>
								<li class=""><a href="<?=base_url('admin')?>"><i class="fa fa-gears"></i> Admin Center</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /sidebar menu -->
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
									<img src="<?=base_url()?>assets/images/<?= ($this->session->userdata('display_picture') != NULL) ? $this->session->userdata('display_picture') : 'user.png' ?>" alt=""><?= $this->session->userdata('username') ?>
									<span class=" fa fa-angle-down"></span>
								</a>
								<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
									<li><a href="#" id="add_admin_btn"><i class="fa fa-users pull-right"></i>Add Admin</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#" id="upd_admin_btn"><i class="fa fa-user pull-right"></i>Profile</a></li>
									<li><a href="<?= base_url('account/logout') ?>"><i class="fa fa-sign-out pull-right"></i>Log Out</a></li>
								</ul>
							</li>
						</ul>
					</nav>
		        </div>

		      </div>
			<!-- /top navigation -->


			<!-- page content -->
			<div class="right_col" role="main" ng-app="assistOne">

				<div class>
                    <?php if($this->uri->segment(1) != 'reports'){ ?>
					<div class="page-title">
						<div class="title_left">
							<h3><?= $header ?> <small><?= $subheader ?></small></h3>
						</div>
					</div>
                    <?php } ?>
					<div class="clearfix"></div>