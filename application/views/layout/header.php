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
        
    <!--JAVASCRIPT-->
    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="<?php inc_file('pace/pace.min.css', 'plugins')?>" rel="stylesheet">
    <link href="<?php inc_file('magic-check/css/magic-check.min.css', 'plugins')?>" rel="stylesheet">
    <link href="<?php inc_file('bootstrap-table/bootstrap-table.min.css', 'plugins')?>" rel="stylesheet">
    <link href="<?php inc_file('bootstrap-select/bootstrap-select.min.css', 'plugins')?>" rel="stylesheet">
    <link href="<?php inc_file('bootstrap-datepicker/bootstrap-datepicker.min.css', 'plugins')?>" rel="stylesheet">
    <link href="<?php inc_file('ionicons/css/ionicons.min.css', 'plugins')?>" rel="stylesheet">

    <script src="<?php inc_file('pace/pace.min.js', 'plugins')?>"></script>
    <!--jQuery [ REQUIRED ]-->
    <?php inc_js('jquery-2.2.4.min');?>
    <?php inc_js('layer/layer');?>
    <!--BootstrapJS [ RECOMMENDED ]-->
    <?php inc_js('bootstrap.min');?>

    <!--NiftyJS [ RECOMMENDED ]-->
    <?php inc_js('nifty.min');?>
    <?php inc_js('demo/icons');?>
    
    <script src="<?php inc_file('bootstrap-table/bootstrap-table.min.js', 'plugins')?>"></script>
    <script src="<?php inc_file('bootstrap-select/bootstrap-select.min.js', 'plugins')?>"></script>
    <script src="<?php inc_file('bootstrap-datepicker/bootstrap-datepicker.min.js', 'plugins')?>"></script>
    <script src="<?php inc_file('bootstrap-datepicker/bootstrap-datepicker.zh.js', 'plugins')?>"></script>
    
	<script>
    //根地址
    var base_url = '<?php echo base_url();?>';
    //@确认提示
    var layer_ask = function(url, keys){
        var cont = '';
    	switch (keys) {
        	case 1:
        		cont = '是否确认修改这条信息的状态？';
        	    break;
        	case 2:
        		cont = '...';
        	    break;
        	default:
        		cont = '删除后不能恢复，是否确认删除？';
    	}
    	layer.confirm(cont, function(index){
        	window.location.href = url;
        });
    }
    </script>

</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg navbar-fixed">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
            <div id="navbar-container" class="boxed">

                <!--Brand logo & name-->
                <!--================================-->
                <div class="navbar-header">
                    <a href="index.html" class="navbar-brand">
                        <img src="<?php inc_file('logo.png')?>" alt="Texmall Logo" class="brand-icon">
                        <div class="brand-title">
                            <span class="brand-text">Texmall</span>
                        </div>
                    </a>
                </div>
                <!--================================-->
                <!--End brand logo & name-->

                <!--Navbar Dropdown-->
                <!--================================-->
                <div class="navbar-content clearfix">
                    <ul class="nav navbar-top-links pull-left">

                        <!--Navigation toogle button-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" href="#">
                                <i class="demo-pli-view-list"></i>
                            </a>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End Navigation toogle button-->

                        <!--Notification dropdown-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                <i class="demo-pli-bell"></i>
                                <span class="badge badge-header badge-danger"></span>
                            </a>

                            <!--Notification dropdown menu-->
                            <div class="dropdown-menu dropdown-menu-md">
                            </div>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End notifications dropdown-->

                        <!--Mega dropdown-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="mega-dropdown">
                            <a href="#" class="mega-dropdown-toggle">
                                <i class="demo-pli-layout-grid"></i>
                            </a>
                            <div class="dropdown-menu mega-dropdown-menu">
                                
                            </div>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End mega dropdown-->

                    </ul>
                    <ul class="nav navbar-top-links pull-right">

                        <!--User dropdown-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li id="dropdown-user" class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="pull-right">
                                    <!--<img class="img-circle img-user media-object" src="img/profile-photos/1.png" alt="Profile Picture">-->
                                    <i class="demo-pli-male ic-user"></i>
                                </span>
                                <div class="username hidden-xs"><?php echo $this->admin->username?></div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">

                                <!-- User dropdown menu -->
                                <ul class="head-list">
                                    <li>
                                        <a href="<?php echo base_url('Cadmin_user/profile');?>">
                                            <i class="demo-pli-male icon-lg icon-fw"></i> 个人信息
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-danger pull-right">9</span>
                                            <i class="demo-pli-mail icon-lg icon-fw"></i> 消息
                                        </a>
                                    </li>
                                </ul>

                                <!-- Dropdown footer -->
                                <div class="pad-all text-right">
                                    <a href="<?php echo base_url('Clogin/login_out');?>" class="btn btn-primary">
                                        <i class="demo-pli-unlock"></i>退出
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End user dropdown-->

                        <li>
                            <a href="#" class="aside-toggle navbar-aside-icon">
                                <i class="pci-ver-dots"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--================================-->
                <!--End Navbar Dropdown-->

            </div>
        </header>
        <!--===================================================-->
        <!--END NAVBAR-->

        <div class="boxed">

            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <nav id="mainnav-container">
                <div id="mainnav">

                    <!--Menu-->
                    <!--================================-->
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">

                                <!--Profile Widget-->
                                <!--================================-->
                                <div id="mainnav-profile" class="mainnav-profile">
                                    <div class="profile-wrap">
                                        <div class="pad-btm">
                                            <img class="img-circle img-sm img-border" src="<?php echo $this->config->image_url.$this->admin->userimg;?>" alt="Profile Picture">
                                        </div>
                                        <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>
                                            <p class="mnp-name"><?php echo $this->admin->username?></p>
                                            <span class="mnp-desc"><?php echo $this->admin->mobile?></span>
                                        </a>
                                    </div>
                                    <div id="profile-nav" class="collapse list-group bg-trans">
                                        <a href="<?php echo base_url('Cadmin_user/profile');?>" class="list-group-item">
                                            <i class="demo-pli-male icon-lg icon-fw"></i>个人信息
                                        </a>
                                        <a href="<?php echo base_url('Clogin/login_out');?>" class="list-group-item">
                                            <i class="demo-pli-unlock icon-lg icon-fw"></i>退出
                                        </a>
                                    </div>
                                </div>
                                
                                <ul id="mainnav-menu" class="list-group">
						
						            <li class="<?php if($one_level=='Texmall后台首页') echo 'active-sub'?>">
						                <a href="<?php echo base_url()?>">
						                    <i class="demo-psi-home"></i>
						                    <span class="menu-title">
												<strong>首页</strong>
											</span>
						                </a>
						            </li>
						
						            <li class="<?php if($one_level=='用户管理') echo 'active-sub'?>">
						                <a href="#">
						                    <i class="ion-person-stalker"></i>
						                    <span class="menu-title"><strong>用户管理</strong></span>
											<i class="arrow"></i>
						                </a>
						                <ul class="collapse <?php if($one_level=='用户管理') echo 'in'?>">
						                    <li class="<?php if($two_level=='用户列表') echo 'active-link';?>"><a href="<?php echo base_url('Cuser/grid');?>"><i class="ion-navicon"></i>用户列表</a></li>
						                    <li class="<?php if($two_level=='通讯录') echo 'active-link';?>"><a href="<?php echo base_url('Cuser_mail_list/grid');?>"><i class="ion-navicon"></i>通讯录</a></li>
						                    <li class="<?php if($two_level=='收藏') echo 'active-link';?>"><a href="<?php echo base_url('Cuser_enshrine/grid');?>"><i class="ion-star"></i>收藏</a></li>
						                    <li class="<?php if($two_level=='搜索记录') echo 'active-link';?>"><a href="<?php echo base_url('Csearch_log/grid');?>"><i class="ion-navicon"></i>搜索记录</a></li>
						                    <li class="<?php if($two_level=='浏览记录') echo 'active-link';?>"><a href="<?php echo base_url('Cuser_log/grid');?>"><i class="ion-navicon"></i>浏览记录</a></li>
						                </ul>
						            </li>
						            
						            <li class="<?php if($one_level=='公司管理') echo 'active-sub'?>">
						                <a href="#">
						                    <i class="ion-grid"></i>
						                    <span class="menu-title"><strong>公司管理</strong></span>
											<i class="arrow"></i>
						                </a>
						                <ul class="collapse <?php if($one_level=='公司管理') echo 'in'?>">
						                    <li class="<?php if($two_level=='公司列表') echo 'active-link';?>"><a href="<?php echo base_url('Csupplier_buyer/grid');?>"><i class="ion-navicon"></i>公司列表</a></li>
                                        </ul>
						            </li>
						            
						            <li class="<?php if($one_level=='产品中心') echo 'active-sub'?>">
						                <a href="#">
						                    <i class="ion-navicon-round"></i>
						                    <span class="menu-title"><strong>产品中心</strong></span>
											<i class="arrow"></i>
						                </a>
						                <ul class="collapse <?php if($one_level=='产品中心') echo 'in'?>">
						                    <li class="<?php if($two_level=='产品列表') echo 'active-link';?>"><a href="<?php echo base_url('Cgoods/grid');?>"><i class="ion-navicon"></i>产品列表</a></li>
                                            <li class="<?php if($two_level=='标准图片') echo 'active-link';?>"><a href="<?php echo base_url('Ccorrect_img/grid');?>"><i class="ion-image"></i>标准图片</a></li>
                                            <li class="<?php if($two_level=='产品属性') echo 'active-link';?>"><a href="<?php echo base_url('Cgoods_attr_set/grid');?>"><i class="ion-pull-request"></i>产品属性</a></li>
                                            <li class="<?php if($two_level=='特价&推荐') echo 'active-link';?>"><a href="<?php echo base_url('Cgoods_attr_set/grid');?>"><i class="ion-pull-request"></i>特价&推荐</a></li>
                                        </ul>
						            </li>
						            
						            <li class="<?php if($one_level=='订单管理') echo 'active-sub'?>">
						                <a href="#">
						                    <i class="ion-compose"></i>
						                    <span class="menu-title"><strong>订单管理</strong></span>
											<i class="arrow"></i>
						                </a>
						                <ul class="collapse <?php if($one_level=='订单管理') echo 'in'?>">
						                    <li class="<?php if($two_level=='订单列表') echo 'active-link';?>"><a href="<?php echo base_url('Corder/grid');?>"><i class="ion-navicon"></i>订单列表</a></li>
						                    <li class="<?php if($two_level=='订单产品') echo 'active-link';?>"><a href="<?php echo base_url('Corder_goods/grid');?>"><i class="ion-navicon"></i>订单产品</a></li>
						                    <li class="<?php if($two_level=='订单评价') echo 'active-link';?>"><a href="<?php echo base_url('Corder_reviews/grid');?>"><i class="ion-chatbubble-working"></i>订单评价</a></li>
						                    <li class="<?php if($two_level=='购物车') echo 'active-link';?>"><a href="<?php echo base_url('Cgoods_cart/grid');?>"><i class="ion-navicon"></i>购物车</a></li>
						                </ul>
						            </li>
						            
						            <li class="<?php if($one_level=='询价管理') echo 'active-sub'?>">
						                <a href="#">
						                    <i class="ion-radio-waves"></i>
						                    <span class="menu-title"><strong>询价管理</strong></span>
											<i class="arrow"></i>
						                </a>
						                <ul class="collapse <?php if($one_level=='询价管理') echo 'in'?>">
						                    <li class="<?php if($two_level=='询价列表') echo 'active-link';?>"><a href="<?php echo base_url('Cenquiry/grid');?>"><i class="ion-navicon"></i>询价列表</a></li>
						                    <li class="<?php if($two_level=='报价列表') echo 'active-link';?>"><a href="<?php echo base_url('Cenquiry_respond/grid');?>"><i class="ion-navicon"></i>报价列表</a></li>
						                </ul>
						            </li>
						            
						            <li class="<?php if($one_level=='认证审核') echo 'active-sub'?>">
						                <a href="#">
						                    <i class="ion-ribbon-b"></i>
						                    <span class="menu-title"><strong>认证审核</strong></span>
											<i class="arrow"></i>
						                </a>
						                <ul class="collapse <?php if($one_level=='认证审核') echo 'in'?>">
						                    <li class="<?php if($two_level=='个人认证') echo 'active-link';?>"><a href="<?php echo base_url('Cauthenticate_personal/grid');?>"><i class="ion-eye"></i>个人认证</a></li>
                                            <li class="<?php if($two_level=='公司认证') echo 'active-link';?>"><a href="<?php echo base_url('Cauthenticate_enterprise/grid');?>"><i class="ion-eye"></i>公司认证</a></li>
                                            <li class="<?php if($two_level=='平台服务商') echo 'active-link';?>"><a href="<?php echo base_url('Cplatform_service/grid');?>"><i class="ion-person-add"></i>平台服务商</a></li>
                                        </ul>
						            </li>
						            
						            <li class="<?php if($one_level=='后台管理员') echo 'active-sub'?>">
						                <a href="#">
						                    <i class="ion-laptop"></i>
						                    <span class="menu-title"><strong>后台管理员</strong></span>
											<i class="arrow"></i>
						                </a>
						                <ul class="collapse <?php if($one_level=='后台管理员') echo 'in'?>">
						                    <li class="<?php if($two_level=='个人信息') echo 'active-link';?>"><a href="<?php echo base_url('Cadmin_user/profile');?>"><i class="demo-pli-male ic-user"></i>个人信息</a></li>
                                            <li class="<?php if($two_level=='管理员列表') echo 'active-link';?>"><a href="<?php echo base_url('Cadmin_user/grid');?>"><i class="ion-navicon"></i>管理员列表</a></li>
                                            <li class="<?php if($two_level=='管理员角色') echo 'active-link';?>"><a href="<?php echo base_url('Cadmin_role/grid');?>"><i class="ion-contrast"></i>管理员角色</a></li>
                                            <li class="<?php if($two_level=='权限列表') echo 'active-link';?>"><a href="<?php echo base_url('Cadmin_action/grid');?>"><i class="ion-navicon"></i>权限列表</a></li>
                                            <li class="<?php if($two_level=='访问日志') echo 'active-link';?>"><a href="<?php echo base_url('Cadmin_log/grid');?>"><i class="ion-navicon"></i>访问日志</a></li>
                                        </ul>
						            </li>
						            
						            <li class="<?php if($one_level=='资讯&帮助中心') echo 'active-sub'?>">
						                <a href="#">
						                    <i class="ion-clipboard"></i>
						                    <span class="menu-title"><strong>资讯&帮助中心</strong></span>
											<i class="arrow"></i>
						                </a>
						                <ul class="collapse <?php if($one_level=='资讯&帮助中心') echo 'in'?>">
						                    <li class="<?php if($two_level=='分类') echo 'active-link';?>"><a href="<?php echo base_url('Chelp_category/grid');?>"><i class="ion-quote"></i>分类</a></li>
						                    <li class="<?php if($two_level=='信息列表') echo 'active-link';?>"><a href="<?php echo base_url('Chelp_center/grid');?>"><i class="ion-navicon"></i>信息列表</a></li>
						                </ul>
						            </li>
						            
						            <li class="<?php if($one_level=='网站设置') echo 'active-sub'?>">
						                <a href="#">
						                    <i class="ion-gear-b"></i>
						                    <span class="menu-title"><strong>网站设置</strong></span>
											<i class="arrow"></i>
						                </a>
						                <ul class="collapse <?php if($one_level=='网站设置') echo 'in'?>">
						                    <li class="<?php if($two_level=='轮播图&广告图') echo 'active-link';?>"><a href="<?php echo base_url('Cad_img/grid');?>"><i class="ion-images"></i>轮播图&广告图</a></li>
                                            <li class="<?php if($two_level=='应用授权') echo 'active-link';?>"><a href="<?php echo base_url('Cauth2/grid');?>"><i class="ion-link"></i>应用授权</a></li>
                                            <li class="<?php if($two_level=='第三方接口') echo 'active-link';?>"><a href="<?php echo base_url('Cthird_manage/grid');?>"><i class="ion-arrow-swap"></i>第三方接口</a></li>
                                            <li class="<?php if($two_level=='意见反馈') echo 'active-link';?>"><a href="<?php echo base_url('Cfeedback/grid');?>"><i class="ion-arrow-return-left"></i>意见反馈</a></li>
                                            <li class="<?php if($two_level=='字体') echo 'active-link';?>"><a href="<?php echo base_url('Cfonts/grid');?>"><i class="ion-arrow-return-left"></i>字体</a></li>
                                            <li><a href="<?php echo base_url('Clogin/show_404');?>"><i class="ion-alert"></i>404</a></li>
                                        </ul>
						            </li>
						            
						            <li>
						                <a href="<?php echo base_url('Clogin/login_out');?>">
						                    <i class="demo-pli-unlock icon-lg icon-fw"></i>
						                    <span class="menu-title">
												<strong>退出</strong>
											</span>
						                </a>
						            </li>
						
						        </ul>

                            </div>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End menu-->

                </div>
            </nav>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->
            
            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow">Tex Mall 管理后台</h1>
                    <!--Searchbox-->
                    <div class="searchbox">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..">
                            <span class="input-group-btn">
                                <button class="text-muted" type="button"><i class="demo-pli-magnifi-glass"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->

                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <ol class="breadcrumb">
					<li><a href="<?php echo base_url()?>">Home</a></li>
					<li><a class="btn-link" href="###"><?php echo $one_level?></a></li>
					<li class="active"><?php echo $two_level?></li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->