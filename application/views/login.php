<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>assistone | login</title>
		<link rel="icon" href="<?=base_url('assets/img/assistone/logo.png')?>">

		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet">

		<link href="<?=base_url('assets/css/pnotify.custom.min.css')?>" media="all" rel="stylesheet" type="text/css" />
		<link href="assets/css/custom.min.css" rel="stylesheet">

		<script src="assets/js/jquery.min.js"></script>
	</head>
	<body style="background:#F7F7F7;">
		<div class="container">
			<div class="col-md-4 col-md-offset-4 col-xs-12 col-sm-12" style="margin-top:5%">
				<div class="panel panel-default">
					<div class="panel-body">
						<h1 style="text-align:center">
							<img src="<?=base_url('assets/img/assistone/logo.png')?>"/>
							<br/>
							assist<span style="color:#fb8200">one</span>
						</h1>
						<form class="form-horizontal" id="login_form" baseurl="<?= base_url() ?>" action="<?=base_url('account/login')?>" method="post">
							<div class="form-group">
								<div class="col-sm-12 col-xs-12">
									<input type="text" name="username" class="form-control" placeholder="Username" required="" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12 col-xs-12">
									<input type="password" name="password" class="form-control" placeholder="Password" required="" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12 col-xs-12">
									<button type="submit" class="btn btn-default submit btn-block btn-warning">Log in</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<p style="text-align:center"><small>©2016 All Rights Reserved.</small></p>
			</div>
		</div>
		<script type="text/javascript" src="<?=base_url()?>assets/js/notify/pnotify.custom.min.js"></script>
		<script>
			$(document).ready(function(){
				PNotify.prototype.options.styling = "bootstrap3";
				$('#login_form').submit(function(event){
					event.preventDefault();
					$.post($(this).attr('action'), $(this).serialize(), function(response){
						if(parseInt(response)){
							window.location.href = $('#login_form').attr('baseurl');
						}else{
							new PNotify({
								title:'Oh no!',
								text:'Invalid username or password.',
								type:"error",
								delay:3000,
								animation:"fade",
								mobile:{swipe_dismiss:true,styling:true},
								buttons:{closer:false,sticker:false},
								desktop: {desktop: true,fallback: true}
							});
						}
					});
				});
			});
		</script>
	</body>
</html>