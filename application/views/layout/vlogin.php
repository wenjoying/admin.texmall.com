<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">

        <meta name="description" content="texmall">
        <meta name="keywords" content="texmall, Texmall, TexMall, tex, mall, TEXMALL">

        <title>Texmall后台管理</title>
            
        <!-- CSS -->
        <?php inc_css('bootstrap.min');?>
        <?php inc_css('form');?>
        <?php inc_css('style');?>
        <?php inc_css('animate');?>
        <?php inc_css('generics');?>
        <script>
            //根地址
            var base_url = '<?php echo base_url();?>';
        </script>
    </head>
    <body id="skin-tectile">
        <section id="login">
            <header>
                <h1>Texmall Admin</h1>
                <p>Welcome to Texmall! Please login below </p>
            </header>
        
            <div class="clearfix"></div>
            
            <!-- Login -->
            <form class="box tile animated active" action="<?php echo base_url('Clogin/check_login');?>" method="post" id="box-login">
                <h2 class="m-t-0 m-b-15">Login 登陆后台</h2>
                <input type="text" class="login-control m-b-10" name="username" maxlength="20" required="required" placeholder="用户名或手机号">
                <input type="password" class="login-control m-b-10" name="password" maxlength="20" required="required" placeholder="密码">
                <input type="text" class="login-control" style="width:50%;float:left;" name="captcha" maxlength="4" required="required" placeholder="图形验证码">
                <span class="captcha"></span>
                <input type="hidden" name="code" required="required" value="<?php echo $code?>">
                <div class="checkbox m-b-20" style="clear:both;"> </div>
                <button class="btn btn-sm m-r-5" type="submit">登陆</button>
                
                <small>
                    <a data-switch="box-register" href="javascript:;">没有账户?</a> or <!-- class="box-switcher"  -->
                    <a data-switch="box-reset" href="javascript:alert('请联系管理员');">忘记密码?</a><!--  class="box-switcher" -->
                </small>
            </form>
            
            <!-- Register -->
            <form class="box animated tile" id="box-register">
                <h2 class="m-t-0 m-b-15">Register</h2>
                <input type="text" class="login-control m-b-10" placeholder="Full Name">
                <input type="text" class="login-control m-b-10" placeholder="Username">
                <input type="email" class="login-control m-b-10" placeholder="Email Address">    
                <input type="password" class="login-control m-b-10" placeholder="Password">
                <input type="password" class="login-control m-b-20" placeholder="Confirm Password">

                <button class="btn btn-sm m-r-5">Register</button>

                <small><a class="box-switcher" data-switch="box-login" href="">Already have an Account?</a></small>
            </form>
            
            <!-- Forgot Password -->
            <form class="box animated tile" id="box-reset">
                <h2 class="m-t-0 m-b-15">Reset Password</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur commodo lorem fringilla enim feugiat commodo sed ac lacus.</p>
                <input type="email" class="login-control m-b-20" placeholder="Email Address">    

                <button class="btn btn-sm m-r-5">Reset Password</button>

                <small><a class="box-switcher" data-switch="box-login" href="">Already have an Account?</a></small>
            </form>
            
            
            
        </section>                      
        
        <!-- Javascript Libraries -->
        <!-- jQuery -->
        <?php inc_js('jquery.min');?>
        
        <!-- Bootstrap -->
        <?php inc_js('bootstrap.min');?>
        
        <!--  Form Related -->
        <?php inc_js('icheck');?>
        <!-- Custom Checkbox + Radio -->
        
        <!-- All JS functions -->
        <?php inc_js('functions');?>
        <script>
		$(function(){
			var get_captcha = function(){
				$.post(base_url+'Clogin/get_captcha', {}, function(json){
					$('span.captcha').html(json.image);
				}, 'json');
			}
			get_captcha();
			$('form.box').on('click', '.captcha', function(){
				get_captcha();
			});
		});
        </script>
    </body>
</html>
