<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel">
                                <div class="panel-heading">
			                        <h3 class="panel-title">产品详情</h3>
			                        <a style="float: right;margin: -40px 10px;" href="<?php echo base_url('Corder/next/'.$res->id)?>"><button class="btn btn-sm btn-primary">下一个</button></a>
				                </div>
				                <div class="pad-hor mar-btm">
					               <p>分类：<?php echo $state_arr[$res->order_state]?></p>
					               <p>状态：<?php echo $status_arr[$res->order_status]?></p>
					               <p>采购商：<a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$res->buyer_id)?>"><?php echo $res->buyer_name?></a></p>
					               <p>用户：<a class="btn-link" href="<?php echo base_url('Cuser/page/'.$res->uid)?>"><?php echo $res->username?></a></p>
					               <p>购买种类：<?php echo $res->sum_goods?></p>
					               <p>购买总价：<strong style="color:red;"><?php echo $res->sum_order_price?></strong></p>
					               <p>备注：<?php echo $res->note?></p>
					               <p>下单时间：<?php echo date('Y-m-d H:i:s', $res->time)?></p>
					               <p>更新时间：<?php if($res->update_time) echo date('Y-m-d H:i:s', $res->update_time)?></p>
					               <p>支付时间：<?php if($res->pay_time) echo date('Y-m-d H:i:s', $res->pay_time)?></p>
					               <p>发货时间：<?php if($res->send_time) echo date('Y-m-d H:i:s', $res->send_time)?></p>
					               <p>收货时间：<?php if($res->receive_time) echo date('Y-m-d H:i:s', $res->receive_time)?></p>
					               <p>评价时间：<?php if($res->reviews_time) echo date('Y-m-d H:i:s', $res->reviews_time)?></p>
					            </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">订单产品</h3>
                                </div>
                                <?php foreach($order_goods as $o):?>
                                <div style="padding:15px;border-bottom:1px solid #e7ecf3">
	                                <a class="media-left" href="<?php echo base_url('Corder_goods/page/'.$o->id)?>"><img class="img-circle img-sm" alt="Profile Picture" src="<?php echo $this->config->image_url.$o->cover_img?>"></a>
	                                <div class="media-body">
		                                <p class="mar-no">型号：<a class="btn-link" href="<?php echo base_url('Cgoods/page/'.$o->goods_id)?>"><?php echo $o->supplier_code?></a></p>
		                                <p class="mar-no">供应商：<a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$o->supplier_id)?>"><?php echo $o->supplier_name?></a></p>
		                                <p class="mar-no">原价：<?php echo $o->price?>元/米</p>
		                                <p class="mar-no"><span>订单价：<?php echo $o->order_price?>元/米</span><span style="margin-left:15px;">数量：<?php echo $o->number?>米</span></p>
		                                <p class="mar-no">总价：<strong style="color:red;"><?php echo $o->sum_goods_price?></strong>元</p>
		                                <ul class="list-inline mar-hor">
		                                    <?php foreach(json_decode($o->goods_attr, TRUE) as $attr):?>
		                                    <?php if(!empty($attr)):?>
        					                <li class="tag tag-sm"><?php echo $attr?></li>
        					                <?php endif;?>
        					                <?php endforeach;?>
        					            </ul>
		                                <small class="text-muted">创建时间：<?php echo date('Y-m-d H:i:s', $o->time)?></small>
		                            </div>
	                            </div>
	                            <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">订单物流</h3>
                                </div>
                                <div class="pad-hor mar-btm">
                                    <?php if($order_deliver!==FALSE):?>
                                    <p>快递名称：<?php echo $order_deliver['deliver']->deliver_name?></p>
                                    <p>快递状态：<?php echo $deliver_status[$order_deliver['deliver']->status]?></p>
                                    <p>创建时间：<?php echo date('Y-m-d H:i:s', $order_deliver['deliver']->update_time)?></p>
                                    <p>
                                    <?php foreach($order_deliver['deliver_gps'] as $g){
                                        echo date('Y-m-d H:i:s', $g->time).'-'.$g->username.'-'.$g->gps.'</br>';
                                    }?>
                                    </p>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">订单评价</h3>
                                </div>
                                <?php foreach ($order_reviews as $reviews):?>
                                <div class="media-body">
	                                <p class="mar-no">评价用户：<?php echo $reviews->username?></p>
	                                <p class="mar-no">产品型号：<?php echo $reviews->supplier_code?></p>
	                                <small class="text-muted">描述：<?php echo $reviews->des_core?>分</small>
	                                <small class="text-muted">服务：<?php echo $reviews->ser_core?>分</small>
	                                <small class="text-muted">物流：<?php echo $reviews->del_core?>分</small>
	                                <p class="mar-no">评价内容：<?php echo $reviews->des?></p>
	                                <?php if(!empty($reviews->img)):?>
	                                <ul class="list-unstyled list-inline text-justify">
	                                    <?php foreach(explode('|', $reviews->img) as $i):?>
			                            <li class="pad-btm"><img src="<?php echo $this->config->image_url.$i?>" alt="thumbs"></li>
			                            <?php endforeach;?>
			                        </ul>
	                                <?php endif;?>
	                                <small class="text-muted">评价时间：<?php echo date('Y-m-d H:i:s', $reviews->time)?></small>
	                            </div>
	                            <?php endforeach;?>
                            </div>
                        </div>
                        
                    </div>
					
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            