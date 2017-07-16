<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="texmall">
    <meta name="keywords" content="texmall, Texmall, TexMall, tex, mall, TEXMALL">
    <title>Texmall后台管理</title>

    <!--STYLESHEET-->
    <!--Open Sans Font [ OPTIONAL ]-->
    <?php inc_css('fonts-css');?>

    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <?php inc_css('bootstrap.min');?>

    <!--Nifty Stylesheet [ REQUIRED ]-->
    <?php inc_css('nifty.min');?>

    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <?php inc_css('demo/nifty-demo-icons.min');?>
        
    <!--Demo [ DEMONSTRATION ]-->
    <?php inc_css('demo/nifty-demo.min');?>


    <!--Magic Checkbox [ OPTIONAL ]-->
    <link href="<?php inc_file('magic-check/css/magic-check.min.css', 'plugins');?>" rel="stylesheet">
    
    <!--JAVASCRIPT-->

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="<?php inc_file('pace/pace.min.css', 'plugins')?>" rel="stylesheet">
    <script src="<?php inc_file('pace/pace.min.js', 'plugins')?>"></script>

    <!--jQuery [ REQUIRED ]-->
    <?php inc_js('jquery-2.2.4.min');?>

    <!--BootstrapJS [ RECOMMENDED ]-->
    <?php inc_js('bootstrap.min');?>

    <!--NiftyJS [ RECOMMENDED ]-->
    <?php inc_js('nifty.min');?>
    
    <!--Background Image [ DEMONSTRATION ]-->
    <?php inc_js('demo/bg-images');?>
    <script>
        //根地址
        var base_url = '<?php echo base_url();?>';
    </script>
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
	<div id="container" class="cls-container">
		
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay"></div>
		
		
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h3 class="h4 mar-no">Texmall Admin Login</h3>
		                <p class="text-muted">后台登陆</p>
		            </div>
		            <form action="<?php echo base_url('Clogin/check_login');?>" method="post">
		                <div class="form-group">
		                    <input type="text" class="form-control" placeholder="Username" name="username" maxlength="20" required="required" autofocus>
		                </div>
		                <div class="form-group">
		                    <input type="password" class="form-control" placeholder="Password" name="password" maxlength="20" required="required">
		                </div>
		                <div class="form-group">
		                    <input type="text" style="width:50%;float:left;" placeholder="图形验证码" class="form-control" name="captcha" maxlength="4" required="required" >
		                    <span class="captcha"></span>
                            <input type="hidden" name="code" required="required" value="<?php echo $code?>">
		                </div>
		                <input type="hidden" name="backurl" value="<?php echo $backurl?>">
		                <div style="clear:both;"> </div>
		                <button class="btn btn-primary btn-lg btn-block" type="submit">登陆</button>
		            </form>
		        </div>
		
		        <div class="pad-all">
		            <a href="javascript:alert('请联系管理员');" class="btn-link mar-rgt">忘记密码 ?</a>
		            <a href="javascript:;" class="btn-link mar-lft">Create a new account</a>
		            
		            <!-- 
		            <div class="media pad-top bord-top">
		                <div class="pull-right">
		                    <a href="#" class="pad-rgt"><i class="demo-psi-facebook icon-lg text-primary"></i></a>
		                    <a href="#" class="pad-rgt"><i class="demo-psi-twitter icon-lg text-info"></i></a>
		                    <a href="#" class="pad-rgt"><i class="demo-psi-google-plus icon-lg text-danger"></i></a>
		                </div>
		                <div class="media-body text-left">
		                    Login with
		                </div>
		            </div>
		             -->
		             
		        </div>
		    </div>
		</div>
		<!--===================================================-->
		
		
		<!-- DEMO PURPOSE ONLY -->
		<!--===================================================-->
		<div class="demo-bg">
		    <div id="demo-bg-list">
		        <div class="demo-loading"><i class="psi-repeat-2"></i></div>
		        <img class="demo-chg-bg bg-trans active" src="<?php inc_file('bg-img/thumbs/bg-trns.jpg')?>" alt="Background Image">
		        <img class="demo-chg-bg" src="<?php inc_file('bg-img/thumbs/bg-img-1.jpg')?>" alt="Background Image">
		        <img class="demo-chg-bg" src="<?php inc_file('bg-img/thumbs/bg-img-2.jpg')?>" alt="Background Image">
		        <img class="demo-chg-bg" src="<?php inc_file('bg-img/thumbs/bg-img-3.jpg')?>" alt="Background Image">
		        <img class="demo-chg-bg" src="<?php inc_file('bg-img/thumbs/bg-img-4.jpg')?>" alt="Background Image">
		        <img class="demo-chg-bg" src="<?php inc_file('bg-img/thumbs/bg-img-5.jpg')?>" alt="Background Image">
		        <img class="demo-chg-bg" src="<?php inc_file('bg-img/thumbs/bg-img-6.jpg')?>" alt="Background Image">
		        <img class="demo-chg-bg" src="<?php inc_file('bg-img/thumbs/bg-img-7.jpg')?>" alt="Background Image">
		    </div>
		</div>
		<!--===================================================-->
		
		
		
	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->


		</body>
		
		 <script>
		$(function(){
			var get_captcha = function(){
				$.post(base_url+'Clogin/get_captcha', {}, function(json){
					$('span.captcha').html(json.image);
				}, 'json');
			}
			get_captcha();
			$('form').on('click', '.form-group .captcha', function(){
				get_captcha();
			});
		});
        </script>
</html>
