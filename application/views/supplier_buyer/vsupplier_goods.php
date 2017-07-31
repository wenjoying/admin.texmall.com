<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php inc_css('bootstrap.min');?>
    <link href="<?php inc_file('bootstrap-table/bootstrap-table.min.css', 'plugins')?>" rel="stylesheet">
    <?php inc_js('jquery-2.2.4.min');?>
    <?php inc_js('bootstrap.min');?>
</head>
<body>
    <div class="col-sm-12" style="margin-top:15px;">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">企业订单</h3>
            </div>

            <div id="page-content">
			    <!--Panel heading-->
			    <div class="panel-heading">
			        <div class="panel-control pull-left">
			            <ul class="nav nav-tabs">
			                <li class="active"><a data-toggle="tab" href="#demo-icon-box-1" aria-expanded="true">未付款</a></li>
			                <li><a data-toggle="tab" href="#demo-icon-box-2" aria-expanded="false">已付款</a></li>
			                <li><a data-toggle="tab" href="#demo-icon-box-3" aria-expanded="false">已完成</a></li>
			                <li><a data-toggle="tab" href="#demo-icon-box-4" aria-expanded="false">已评价</a></li>
			                <li><a data-toggle="tab" href="#demo-icon-box-5" aria-expanded="false">退款/售后</a></li>
			            </ul>
			        </div>
			        <h3 class="panel-title">&nbsp;</h3>
			    </div>
			
			    <!--Panel body-->
			    <div class="panel-body">
			        <div class="tab-content">
    		            <div id="demo-icon-box-1" class="tab-pane fade active in">
    		                <div class="clearfix demo-icon-list">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">订单号</th>
                                            <th>下单用户</th>
                                            <th>订单总价</th>
                                            <th>状态</th>
                                            <th>下单时间</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($res as $r):?>
                                        <?php if($r->order_state==1):?>
                                        <tr>
                                            <td class="text-center"><a class="btn-link" target="_blank" href="<?php echo base_url('Corder/page/'.$r->id);?>"><?php echo $r->platform_code?></a></td>
                                            <td><?php echo $r->username?></td>
                                            <td><?php echo $r->sum_order_price?></td>
                                            <td><span style="color:red;"><?php echo $status_arr[$r->order_status]?></span></td>
                                            <td><?php echo date('Y-m-d H:i:s', $r->time)?></td>
                                        </tr>
                                        <?php endif;?>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
    		                </div>
    		            </div>
    		
    		            <div id="demo-icon-box-2" class="tab-pane fade">
    		                <div class="clearfix demo-icon-list">
    		                   <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">订单号</th>
                                            <th>下单用户</th>
                                            <th>订单总价</th>
                                            <th>状态</th>
                                            <th>下单时间</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($res as $r):?>
                                        <?php if($r->order_state==2):?>
                                        <tr>
                                            <td class="text-center"><a class="btn-link" target="_blank" href="<?php echo base_url('Corder/page/'.$r->id);?>"><?php echo $r->platform_code?></a></td>
                                            <td><?php echo $r->username?></td>
                                            <td><?php echo $r->sum_order_price?></td>
                                            <td><span style="color:red;"><?php echo $status_arr[$r->order_status]?></span></td>
                                            <td><?php echo date('Y-m-d H:i:s', $r->time)?></td>
                                        </tr>
                                        <?php endif;?>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
    		                </div>
    		            </div>
    		
    		            <div id="demo-icon-box-3" class="tab-pane fade">
    		                <div class="clearfix demo-icon-list">
    		                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">订单号</th>
                                            <th>下单用户</th>
                                            <th>订单总价</th>
                                            <th>状态</th>
                                            <th>下单时间</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($res as $r):?>
                                        <?php if($r->order_state==3):?>
                                        <tr>
                                            <td class="text-center"><a class="btn-link" target="_blank" href="<?php echo base_url('Corder/page/'.$r->id);?>"><?php echo $r->platform_code?></a></td>
                                            <td><?php echo $r->username?></td>
                                            <td><?php echo $r->sum_order_price?></td>
                                            <td><span style="color:red;"><?php echo $status_arr[$r->order_status]?></span></td>
                                            <td><?php echo date('Y-m-d H:i:s', $r->time)?></td>
                                        </tr>
                                        <?php endif;?>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
    		                </div>
    		            </div>
    		            
    		            <div id="demo-icon-box-4" class="tab-pane fade">
    		                <div class="clearfix demo-icon-list">
    		                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">订单号</th>
                                            <th>下单用户</th>
                                            <th>订单总价</th>
                                            <th>状态</th>
                                            <th>下单时间</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($res as $r):?>
                                        <?php if($r->order_state==4):?>
                                        <tr>
                                            <td class="text-center"><a class="btn-link" target="_blank" href="<?php echo base_url('Corder/page/'.$r->id);?>"><?php echo $r->platform_code?></a></td>
                                            <td><?php echo $r->username?></td>
                                            <td><?php echo $r->sum_order_price?></td>
                                            <td><span style="color:red;"><?php echo $status_arr[$r->order_status]?></span></td>
                                            <td><?php echo date('Y-m-d H:i:s', $r->time)?></td>
                                        </tr>
                                        <?php endif;?>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
    		                </div>
    		            </div>
    		            
    		            <div id="demo-icon-box-5" class="tab-pane fade">
    		                <div class="clearfix demo-icon-list">
    		                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">订单号</th>
                                            <th>下单用户</th>
                                            <th>订单总价</th>
                                            <th>状态</th>
                                            <th>下单时间</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($res as $r):?>
                                        <?php if($r->order_state==5):?>
                                        <tr>
                                            <td class="text-center"><a class="btn-link" target="_blank" href="<?php echo base_url('Corder/page/'.$r->id);?>"><?php echo $r->platform_code?></a></td>
                                            <td><?php echo $r->username?></td>
                                            <td><?php echo $r->sum_order_price?></td>
                                            <td><span style="color:red;"><?php echo $status_arr[$r->order_status]?></span></td>
                                            <td><?php echo date('Y-m-d H:i:s', $r->time)?></td>
                                        </tr>
                                        <?php endif;?>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
    		                </div>
    		            </div>
		            </div>
		       </div>
		       <?php if(count($res)):?>
		       <a target="_blank" href="<?php echo base_url('Corder/grid?item='.$res[0]->buyer_name)?>"><button class="btn btn-primary">更多</button></a>
               <?php endif;?>
            </div>
        </div>
    </div>
</body>
</html>