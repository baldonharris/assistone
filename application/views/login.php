<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>assistone | login</title>

  <!-- Bootstrap core CSS -->

  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

  <link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="assets/css/custom.css" rel="stylesheet">
  <link href="assets/css/icheck/flat/green.css" rel="stylesheet">


  <script src="assets/js/jquery.min.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">
  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <form id="login_form" baseurl="<?= base_url() ?>" action="<?=base_url('account/login')?>" method="post">
            <h1>Login</h1>
            <div>
              <input type="text" name="username" class="form-control" placeholder="Username" required="" />
            </div>
            <div>
              <input type="password" name="password" class="form-control" placeholder="Password" required="" />
            </div>
            <div>
              <button type="submit" class="btn btn-default submit">Log in</button>
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              <div class="clearfix"></div>
              <br />
              <div>
                <h1><!-- <i class="fa fa-paw" style="font-size: 26px;"></i> -->
                <img src="<?=base_url('assets/img/assistone/logo.png')?>" style="height:26px; width:26px"/>
                <span style="color:#1a75ff">assist</span>one <small>lending corporation</small></h1>
                <p>©2016 All Rights Reserved.</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
      $('#login_form').submit(function(event){
        event.preventDefault();
        console.log($(this).serialize());
        $.post($(this).attr('action'), $(this).serialize(), function(response){
          console.log(response);
          if(parseInt(response)){
            window.location.href = $('#login_form').attr('baseurl');
          }else{
            alert("Invalid username or password!");
          }
        });
      });
    });
  </script>

</body>

</html>
