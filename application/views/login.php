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
		<link href="assets/css/animate/animate.min.css" rel="stylesheet">

		<link href="<?=base_url('assets/css/pnotify.custom.min.css')?>" media="all" rel="stylesheet" type="text/css" />
		<link href="assets/css/custom.min.css" rel="stylesheet">
        <link href="assets/css/login.css" rel="stylesheet">

		<script src="assets/js/jquery.min.js"></script>
	</head>
	<body style="height: 100vh; background-size: cover;">
		<div class="container">
			<div class="col-md-3 col-xs-12 col-sm-12">
                <div class="panel panel-default animated slideInDown">
                    <div class="panel-body">
                        <h1 style="text-align:center">
                            <img src="<?=base_url('assets/img/assistone/logo.png')?>"/>
                            <br/>
                            assist<span style="color:#fb8200">one</span>
                        </h1>
                        <form class="form-horizontal" id="login_form" baseurl="<?= base_url('home') ?>" action="<?=base_url('account/login')?>" method="post">
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
                                    <button type="submit" class="btn btn-default submit btn-block btn-warning">
                                        <span>Log in</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="animated fadeInLeft" style="text-align:center"><small>© <?= date('Y'); ?> All Rights Reserved.</small></p>
			</div>
		</div>
		<script type="text/javascript" src="<?=base_url()?>assets/js/notify/pnotify.custom.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.easybg.js"></script>
		<script>
			$(document).ready(function(){
				PNotify.prototype.options.styling = "bootstrap3";

                $('body').easybg({
                    images : [
                        "<?= base_url('assets/img/bg1.jpg') ?>",
                        "<?= base_url('assets/img/bg2.jpg') ?>",
                        "<?= base_url('assets/img/bg3.jpg') ?>"
                    ],
                    interval : 15000,
                    changeMode : 'random'
                });

				$('#login_form').submit(function(event){
					event.preventDefault();

					var $submitBtn = $($(this).find('button[type=submit]'));

					$submitBtn.find('span').addClass('hidden');
					$submitBtn.addClass('submitting');

					var ajaxCall = $.post($(this).attr('action'), $(this).serialize());
					ajaxCall.done(function (response) {
                        if(parseInt(response)){
                            window.location.href = $('#login_form').attr('baseurl');
                        }else{
                            $submitBtn.find('span').removeClass('hidden');
                            $submitBtn.removeClass('submitting');
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

					ajaxCall.fail(function () {
                        $submitBtn.find('span').removeClass('hidden');
                        $submitBtn.removeClass('submitting');
                        new PNotify({
                            title:'Oh no!',
                            text:'Internal server error. Please contact administrator.',
                            type:"error",
                            delay:3000,
                            animation:"fade",
                            mobile:{swipe_dismiss:true,styling:true},
                            buttons:{closer:false,sticker:false},
                            desktop: {desktop: true,fallback: true}
                        });
                    });
				});
			});
		</script>
	</body>
</html>