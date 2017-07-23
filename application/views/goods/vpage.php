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
					                <p class="text-sm text-muted" >标准图：<span style="color:red;"><?php echo $res->platform_name?></span></p>
					            </div>
					            
					            <p class="text-semibold text-main pad-all mar-no">
					               <?php if($this->admin->id==1):?>
					               <a class="btn-link" href="<?php echo base_url('Cgoods/next/'.$res->id)?>"><button class="btn btn-sm btn-primary">下一个</button></a>
					               <?php endif;?>
					               <?php if($res->is_sale==1 && $res->is_check==2):?>
					               <a class="btn-link" href="<?php echo base_url('Cgoods_cart/add?goods_id='.$res->id)?>"><button class="btn btn-sm btn-success">加入购物车</button></a>
					               <?php endif;?>
					            </p>
					            
					            <p class="text-semibold text-main pad-all mar-no">产品详情</p>
					            <div class="pad-hor mar-btm">
					               <p>供应商型号：<?php echo $res->supplier_code?></p>
					               <p>供应商商：<a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$res->supplier_id)?>"><?php echo $res->supplier_name?></a></p>
					               <p>上传用户：<a class="btn-link" href="<?php echo base_url('Cuser/page/'.$res->uid)?>"><?php echo $res->username?></a></p>
					               <p>价格：<strong style="color:red;"><?php echo $res->price?></strong>元/米</p>
					               <p>库存：<?php echo $res->in_stock?>米</p>
					               <p>成分：<?php echo $res->component?></p>
					               <p>门幅：<?php echo $res->width?></p>
					               <p>平方克重：<?php echo $res->square_weight?></p>
					               <p>缩水率：<?php echo $res->shrinkage?></p>
					               <p>格型：<?php echo $res->lattice?></p>
					               <p>颜色：<?php echo $res->color?></p>
					               <p>潘通色号：<?php echo $res->pantone_color?></p>
					               <p>格子：<?php echo $res->tex_grid?></p>
					               <p>纱织密度：<?php echo $res->yarn_density?></p>
					               <p>花回尺寸：<?php echo $res->back_size?></p>
					               <p>厚薄：<?php echo $res->thickness?></p>
					               <p>工艺组成：<?php echo $res->tech_composed?></p>
					               <p>风格：<?php echo $res->style?></p>
					               <p>类目：<?php echo $res->category?></p>
					               <p>来源：<?php echo $res->source?></p>
					               <p>创建时间：<?php echo date('Y-m-d H:i:s', $res->time)?></p>
					            </div>
					            <p class="text-semibold text-main pad-all mar-no">主图</p>
					            <div class="pad-hor mar-btm">
					               <?php if(!empty($res->cover_img)):?>
					               <img width=150 src="<?php echo $this->config->image_url.$res->cover_img?>">
					               <?php endif;?>
					            </div>
					        </div>
					    </div>
					    <div class="fluid">
					
					        <div class="fixed-fluid">
					        
					            <div class="fixed-lg-300 pull-lg-right">
					                <div class="panel">
					                    <div class="panel-heading">
					                        <h3 class="panel-title">产品订单</h3>
					                    </div>
					                    <div class="list-group bg-trans">
					                        <a class="btn-link" href="###" class="list-group-item">
					                            嗡嗡嗡嗡嗡
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
					                                    <h3 class="panel-title">原图</h3>
					                                </div>
					                                
					                                <div class="mar-top pad-top bord-top">
					                                <?php foreach(explode('|', $res->original_img) as $o):?>
    					                                <img height=150 alt="Profile Picture" src="<?php echo $this->config->image_url.$o?>">
    					                            <?php endforeach;?>
    					                            </div>
    					                            
					                            </div>
					                        </div>
					                    </div>
					                </div>
					                <div class="panel">
					                    <div class="panel-body">
					                        <div class="media-block">
					                            <div class="media-body">
					                                <div class="pad-btm">
					                                    <h3 class="panel-title">产品简介</h3>
					                                </div>
					                                <div class="media-body"><?php echo $res->des?></div>
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