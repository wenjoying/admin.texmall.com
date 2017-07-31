<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                <?php inc_css('morris.min')?>
                <?php inc_js('morris.min')?>
                <?php inc_js('raphael.min')?>
             
                    <div class="col-lg-12">
				        <div class="row">
				            <div class="col-sm-6 col-lg-3">
    				            <a href="<?php echo base_url('Cuser/grid')?>">
    				                <div class="panel panel-success panel-colorful">
    				                    <div class="pad-all">
    				                        <p class="text-lg text-semibold"><i class="demo-pli-data-storage icon-fw"></i>注册用户</p>
    				                        <p class="mar-no">
    				                            <span class="pull-right text-bold"><?php echo $user_num['month_num']?>人</span>本月
    				                        </p>
    				                        <p class="mar-no">
    				                            <span class="pull-right text-bold"><?php echo $user_num['all_num']?>人</span>总计
    				                        </p>
    				                    </div>
    				                </div>
				                </a>
				            </div>
				            <div class="col-sm-6 col-lg-3">
				                <a href="<?php echo base_url('Csupplier_buyer/grid')?>">
    				                <div class="panel panel-info panel-colorful">
    				                    <div class="pad-all">
    				                        <p class="text-lg text-semibold"><i class="demo-pli-wallet-2 icon-fw"></i>注册企业</p>
    				                        <p class="mar-no">
    				                            <span class="pull-right text-bold"><?php echo $company_num['month_num']?>家</span>供应商
    				                        </p>
    				                        <p class="mar-no">
    				                            <span class="pull-right text-bold"><?php echo $company_num['all_num']?>家</span>采购商
    				                        </p>
    				                    </div>
    				                </div>
				                </a>
				            </div>
				            <div class="col-sm-6 col-lg-3">
				                <a href="<?php echo base_url('Cgoods/grid')?>">
    				                <div class="panel panel-purple panel-colorful">
    				                    <div class="pad-all">
    				                        <p class="text-lg text-semibold"><i class="demo-pli-bag-coins icon-fw"></i>产品管理</p>
    				                        <p class="mar-no">
    				                            <span class="pull-right text-bold"><?php echo $goods_num['month_num']?></span>本月
    				                        </p>
    				                        <p class="mar-no">
    				                            <span class="pull-right text-bold"><?php echo $goods_num['all_num']?></span>总计
    				                        </p>
    				                    </div>
    				                </div>
			                    </a>
				            </div>
				            <div class="col-sm-6 col-lg-3">
				                <a href="<?php echo base_url('Corder/grid')?>">
    				                <div class="panel panel-warning panel-colorful">
    				                    <div class="pad-all">
    				                        <p class="text-lg text-semibold"><i class="demo-pli-check icon-fw"></i>订单管理</p>
    				                        <p class="mar-no">
    				                            <span class="pull-right text-bold">￥<?php echo $order_num['month_money']?>元/<?php echo $order_num['month_num']?>个</span>本月
    				                        </p>
    				                        <p class="mar-no">
    				                            <span class="pull-right text-bold">￥<?php echo $order_num['all_money']?>元/<?php echo $order_num['all_num']?>个</span>总计
    				                        </p>
    				                    </div>
    				                </div>
				                </a>
				            </div>
				        </div>
				    </div>
				    
				    <div class="row">
                        <div class="col-lg-6">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">月订单数</h3>
					            </div>
					            <div class="panel-body">
					                <div id="moth-order" style="height:212px"></div>
					            </div>
					        </div>
					    </div>
					    <div class="col-lg-6">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">月销售额</h3>
					            </div>
					            <div class="panel-body">
					                <div id="moth-amount" style="height:212px"></div>
					            </div>
					        </div>
					    </div>
                    </div>
                    <script> 
                     	Morris.Line({
                         	element: 'moth-order',
                         	data: <?php echo $moth_order?>,
                         	xkey: 'xaxis',
                         	ykeys: ['val'],
                         	labels: ['value2'],
                         	gridEnabled: false,
                         	gridLineColor: 'transparent',
                         	lineColors: ['#045d97'],
                         	lineWidth: 2,
                         	parseTime: false,
                         	resize:true,
                         	hideHover: 'auto'
                     	});
                     	Morris.Line({
                         	element: 'moth-amount',
                         	data: <?php echo $moth_amount?>,
                         	xkey: 'xaxis',
                         	ykeys: ['val'],
                         	labels: ['value2'],
                         	gridEnabled: false,
                         	gridLineColor: 'transparent',
                         	lineColors: ['#045d97'],
                         	lineWidth: 2,
                         	parseTime: false,
                         	resize:true,
                         	hideHover: 'auto'
                     	});
                 	</script>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            