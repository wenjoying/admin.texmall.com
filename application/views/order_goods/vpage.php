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
					            </div>
					            <p class="text-semibold text-main pad-all mar-no">详情</p>
					            <div class="pad-hor mar-btm">
					               <p class="text-sm text-muted">型号：<?php echo $res->supplier_code?></p>
					               <p class="text-sm text-muted">供应商：<?php echo $res->supplier_name?></p>
					               <p>原价：<?php echo $res->price?></p>
					               <p>下单价：<?php echo $res->order_price?></p>
					               <p>数量：<?php echo $res->number?></p>
					               <p>总价：<?php echo $res->sum_goods_price?></p>
					               <p>属性：<?php echo $res->goods_attr?></p>
					               <p>下单时间：<?php echo date('Y-m-d H:i:s', $res->time)?></p>
					            </div>
					        </div>
					    </div>
					    <div class="fluid">
					        <div class="bg-trans-light pad-all mar-btm clearfix">
					            <hr class="new-section-xs bord-no">
					            <div class="col-md-7">
					                <div class="row text-center mar-btm">
					                    <div class="col-xs-3">
					                        <p class="h4 mar-no"><?php echo $res->des_core?>分</p>
					                        <small class="text-muted">描述</small>
					                    </div>
					                    <div class="col-xs-3">
					                        <p class="h4 mar-no"><?php echo $res->ser_core?>分</p>
					                        <small class="text-muted">服务</small>
					                    </div>
					                    <div class="col-xs-3">
					                        <p class="h4 mar-no"><?php echo $res->del_core?>分</p>
					                        <small class="text-muted">物流</small>
					                    </div>
					                </div>
					            </div>
					        </div>
					
					        <div class="fixed-fluid">
					            <div class="fluid">
					                <div class="panel">
					                    <div class="panel-body">
					                        <div class="media-block">
					                            <div class="media-body">
					                                <div class="pad-btm">
					                                    <h3 class="panel-title">评论</h3>
					                                </div>
					                                <div class="media-body"><?php $res->des?></div>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					                <div class="panel">
					                    <div class="panel-body">
					                        <div class="media-block">
					                            <div class="media-body">
					                                <div class="pad-btm">
					                                    <h3 class="panel-title">晒图</h3>
					                                </div>
					                                <div class="media-body">
					                                <?php if(!empty($res->imgs)):?>
					                                <?php foreach(explode('|', $res->imgs) as $i) :?>
					                                <img height=200 src="<?php echo $this->config->image_url.$i?>">
					                                <?php endforeach;?>
					                                <?php endif;?>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					            </div>
					        </div>
					    </div>
					</div>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            