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
        <?php inc_css('animate.min');?>
        <?php inc_css('font-awesome.min');?>
        <?php inc_css('form');?>
        <?php inc_css('calendar');?>
        <?php inc_css('style');?>
        <?php inc_css('icons');?>
        <?php inc_css('generics');?>
        <script>
            //根地址
            var base_url = '<?php echo base_url();?>';
            /**@确认提示*/
            var layer_conf = function(url){
            	layer.confirm('是否确认删除？', function(index){
                	window.location.href = url;
                });
            }
        </script>
        <?php inc_js('jquery.min');?> <!-- jQuery Library -->
    </head>
    <body id="skin-tectile">

        <header id="header" class="media">
            <a href="" id="menu-toggle"></a> 
            <a class="logo pull-left" href="index.html">Texmall Admin</a>
            
            <div class="media-body">
                <div class="media" id="top-menu">
                    <div class="pull-left tm-icon">
                        <a data-drawer="messages" class="drawer-toggle" href="">
                            <i class="sa-top-message"></i>
                            <i class="n-count animated">5</i>
                            <span>消息</span>
                        </a>
                    </div>
                    <div class="pull-left tm-icon">
                        <a data-drawer="notifications" class="drawer-toggle" href="">
                            <i class="sa-top-updates"></i>
                            <i class="n-count animated">9</i>
                            <span>更新</span>
                        </a>
                    </div>

                    

                    <div id="time" class="pull-right">
                        <span id="hours"></span>
                        :
                        <span id="min"></span>
                        :
                        <span id="sec"></span>
                    </div>
                    
                    <div class="media-body">
                        <input type="text" class="main-search">
                    </div>
                </div>
            </div>
        </header>
        
        <div class="clearfix"></div>
        
        <section id="main" class="p-relative" role="main">
            
            <!-- Sidebar -->
            <aside id="sidebar">
                
                <!-- Sidbar Widgets -->
                <div class="side-widgets overflow">
                    <!-- Profile Menu -->
                    <div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
                        <a href="" data-toggle="dropdown">
                            <img class="profile-pic animated" src="<?php echo $this->config->image_url.$this->admin->userimg;?>" alt="">
                        </a>
                        <ul class="dropdown-menu profile-menu">
                            <li><a href="<?php echo base_url('Cadmin_user/profile');?>">个人信息</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                            <li><a href="#">消息</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                            <li><a href="<?php echo base_url('Clogin/login_out');?>">退出</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                        </ul>
                        <h4 class="m-0"><?php echo $this->admin->username;?></h4><?php echo $this->admin->mobile;?>
                    </div>
                    
                    <!-- Calendar -->
                    <div class="s-widget m-b-25">
                        <div id="sidebar-calendar"></div>
                    </div>
                    
                    <!-- Projects -->
                    <div class="s-widget m-b-25">
                        <h2 class="tile-title">
                            Projects on going
                        </h2>
                        
                        <div class="list-group m-t-10">
                            <a href="<?php echo base_url('Clogin/login_out');?>" class="list-group-item"><span class="icon">&#61720;</span>退出登陆</a>
                        </div>
                    </div>
                </div>
                
                <!-- Side Menu -->
                <ul class="list-unstyled side-menu">
                    <li class="<?php if($one_level=='Texmall后台首页') echo 'active'?>">
                        <a class="sa-side-home" href="<?php echo base_url('Cadmin_user/index');?>">
                            <span class="menu-item">后台主页</span>
                        </a>
                    </li>
                    
                    <li class="dropdown <?php if($one_level=='用户管理') echo 'active'?>">
                        <a class="sa-side-chart" href="">
                            <span class="menu-item">用户管理</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a class="<?php if($two_level=='用户列表') echo 'active';?>" href="<?php echo base_url('Cuser/grid');?>">用户列表</a></li>
                            
                        </ul>
                    </li>
                    
                    <li class="dropdown">
                        <a class="sa-side-page" href="">
                            <span class="menu-item">产品中心</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a class="<?php if($two_level=='') echo 'active';?>" href="<?php echo base_url();?>">第三方接口管理</a></li>
                            
                        </ul>
                    </li>
                    
                    <li class="dropdown <?php if($one_level=='后台管理员') echo 'active';?>">
                        <a class="sa-side-folder" href="">
                            <span class="menu-item">后台管理员</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a class="<?php if($two_level=='个人信息') echo 'active';?>" href="<?php echo base_url('Cadmin_user/profile');?>">个人信息</a></li>
                            <li><a class="<?php if($two_level=='管理员列表') echo 'active';?>" href="<?php echo base_url('Cadmin_user/grid');?>">管理员列表</a></li>
                            <li><a class="<?php if($two_level=='管理员角色') echo 'active';?>" href="<?php echo base_url('Cadmin_role/grid');?>">管理员角色</a></li>
                            <li><a class="<?php if($two_level=='权限列表') echo 'active';?>" href="<?php echo base_url('Cadmin_action/grid');?>">权限列表</a></li>
                            <li><a class="<?php if($two_level=='访问日志') echo 'active';?>" href="<?php echo base_url('Cadmin_log/grid');?>">访问日志</a></li>
                            
                        </ul>
                    </li>
                    
                    <li class="dropdown <?php if($one_level=='网站设置') echo 'active';?>">
                        <a class="sa-side-widget" href="content-widgets.html">
                            <span class="menu-item">网站设置</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a class="<?php if($two_level=='轮播图&广告图') echo 'active';?>" href="<?php echo base_url('Cad_img/grid');?>">轮播图&广告图</a></li>
                            <li><a class="<?php if($two_level=='第三方接口') echo 'active';?>" href="<?php echo base_url('Cthird_manage/grid');?>">第三方接口</a></li>
                            <li><a class="<?php if($two_level=='字体图标') echo 'active';?>" href="<?php echo base_url('Csetting/fonts');?>">字体</a></li>
                            <li><a href="<?php echo base_url('Clogin/show_404');?>">404</a></li>
                        </ul>
                    </li>
                    
                    
                </ul>

            </aside>
        
            <!-- Content -->
            <section id="content" class="container">
            
                <!-- Messages Drawer -->
                <div id="messages" class="tile drawer animated">
                    <div class="listview narrow">
                        <div class="media">
                            <a href="">Send a New Message</a>
                            <span class="drawer-close">&times;</span>
                            
                        </div>
                        <div class="overflow" style="height: 254px">
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="<?php inc_file('profile-pics/1.jpg')?>" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Nadin Jackson - 2 Hours ago</small><br>
                                    <a class="t-overflow" href="">Mauris consectetur urna nec tempor adipiscing. Proin sit amet nisi ligula. Sed eu adipiscing lectus</a>
                                </div>
                            </div>
                            
                        </div>
                        <div class="media text-center whiter l-100">
                            <a href=""><small>VIEW ALL</small></a>
                        </div>
                    </div>
                </div>
                
                <!-- Notification Drawer -->
                <div id="notifications" class="tile drawer animated">
                    <div class="listview narrow">
                        <div class="media">
                            <a href="">Notification Settings</a>
                            <span class="drawer-close">&times;</span>
                        </div>
                        <div class="overflow" style="height: 254px">
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="<?php inc_file('profile-pics/1.jpg')?>" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Nadin Jackson - 2 Hours ago</small><br>
                                    <a class="t-overflow" href="">Mauris consectetur urna nec tempor adipiscing. Proin sit amet nisi ligula. Sed eu adipiscing lectus</a>
                                </div>
                            </div>
                            
                        </div>
                        <div class="media text-center whiter l-100">
                            <a href=""><small>VIEW ALL</small></a>
                        </div>
                    </div>
                </div>
                
                <!-- Breadcrumb -->
                <ol class="breadcrumb hidden-xs">
                    <li><a href="<?php echo base_url('Clogin/index');?>">Home</a></li>
                    <li><a href="#"><?php echo $one_level;?></a></li>
                    <li class="active"><a href="#"><?php echo $two_level;?></a></li>
                </ol>
                
                <h4 class="page-title"><?php echo $one_level;?></h4>