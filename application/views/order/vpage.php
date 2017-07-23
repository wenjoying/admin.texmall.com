<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					<div class="fixed-fluid">
					    <div class="fixed-sm-200 fixed-lg-250 pull-sm-left">
					        <div class="panel">
					            <!-- Simple profile -->
					            <div class="text-center pad-all bord-btm">
					                <h4 class="text-lg text-overflow mar-no"><?php echo $res->platform_code?></h4>
					                <p class="text-sm text-muted" style="color:red;"><?php echo $status_arr[$res->order_status]?></p>
					            </div>
					            <p class="text-semibold text-main pad-all mar-no">订单资料</p>
					            <div class="pad-hor mar-btm">
					               <p>购买总价：<?php echo $state_arr[$res->order_state]?></p>
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
					    <div class="fluid">
					
					        <div class="fixed-fluid">
					            <div class="fixed-lg-300 pull-lg-right">
					                <div class="panel">
					                    <div class="panel-heading">
					                        <h3 class="panel-title">物流状态</h3>
					                    </div>
					                    <div class="list-group bg-trans">
					                        <a class="btn-link" href="###" class="list-group-item">
					                            <p class="mar-no">qwqwq</p>
					                        </a>
					                    </div>
					                </div>
					            </div>
					            <div class="fluid">
					                <div class="panel">
					                    <div class="panel-body">
					                        <div class="media-block">
					                            <div class="media-body">
					                                <div class="pad-btm">
					                                    <h3 class="panel-title">订单产品</h3>
					                                </div>
					                                <?php foreach($order_goods as $o):?>
					                                <div class="mar-top pad-top bord-top">
    					                                <a class="media-left" href="<?php echo base_url('Cgoods/page/'.$o->goods_id)?>"><img class="img-circle img-sm" alt="Profile Picture" src="<?php echo $this->config->image_url.$o->cover_img?>"></a>
    					                                <div class="media-body">
        					                                <p class="mar-no">型号：<a class="btn-link" href="<?php echo base_url('Cgoods/page/'.$o->goods_id)?>"><?php echo $o->supplier_code?></a></p>
        					                                <p class="mar-no">供应商：<a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$o->supplier_id)?>"><?php echo $o->supplier_name?></a></p>
        					                                <p class="mar-no">原价：<?php echo $o->price?>元/米</p>
        					                                <p class="mar-no"><span>订单价：<?php echo $o->order_price?>元/米</span><span style="margin-left:15px;">数量：<?php echo $o->number?>米</span></p>
        					                                <p class="mar-no">总价：<strong style="color:red;"><?php echo $o->sum_goods_price?></strong>元</p>
        					                                <ul class="list-inline mar-hor">
                            					                <li class="tag tag-sm">PHP Programming</li>
                            					                <li class="tag tag-sm">Marketing</li>
                            					                <li class="tag tag-sm">Graphic Design</li>
                            					                <li class="tag tag-sm">Sketch</li>
                            					                <li class="tag tag-sm">Photography</li>
                            					            </ul>
        					                                <small class="text-muted">创建时间：<?php echo date('Y-m-d H:i:s', $o->time)?></small>
        					                            </div>
    					                            </div>
    					                            <?php endforeach;?>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					                <div class="panel">
					                    <div class="panel-body">
					                        <div class="media-block">
					                            <div class="media-body">
					                                <div class="pad-btm">
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
					            </div>
					        </div>
					    </div>
					</div>
					<script>
					var get_html = function(url){
						layer.open({
							  type: 2,
							  title: false,
							  area: ['893px', '600px'],
							  content: [url], //iframe的url，no代表不显示滚动条
						});
					}
					
					</script>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            