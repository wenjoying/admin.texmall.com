<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					<div class="fixed-fluid">
					    <div class="fixed-sm-200 fixed-lg-250 pull-sm-left">
					        <div class="panel">
					            <!-- Simple profile -->
					            <div class="text-center pad-all bord-btm">
					                <h4 class="text-lg text-overflow mar-no"><?php echo $res->company_name?>(<?php echo $res->type==1?'采购商':'供应商'?>)</h4>
					                <p class="text-sm text-muted">管理员：<a class="btn-link" href="<?php echo base_url('Cuser/page/'.$res->uid)?>"><?php echo $res->username?></a></p>
					            </div>
					            <p class="text-semibold text-main pad-all mar-no">公司资料</p>
					            <div class="pad-hor mar-btm">
    					           <p>公司状态：<span style="color:red;"><?php echo $status_arr[$res->status]?></span></p>
    					           <p>平台等级：<span style="color:red;"><?php echo $grade_arr[$res->platform_grade]?></span></p>
					               <p>地址：<?php echo $res->province_name.$res->city_name.$res->district_name.$res->ads_des?></p>
					               <p>电话：<?php echo $res->office_tel?></p>
					               <p>主营：<?php echo $res->main_business?></p>
					               <p>简介：<?php echo $res->des?></p>
					               <p>创建时间：<?php echo date('Y-m-d H:i:s', $res->time)?></p>
					            </div>
					            
					            <p class="text-semibold text-main pad-all mar-no">公司二维码</p>
					            <div class="pad-hor mar-btm">
					               <?php if(!empty($res->qr_img)):?>
					               <img width=150 src="<?php echo $this->config->image_url.$res->qr_img?>">
					               <?php endif;?>
					            </div>
					
					        </div>
					    </div>
					    <div class="fluid">
					        <div class="bg-trans-light pad-all mar-btm clearfix">
					            <hr class="new-section-xs bord-no">
					            <div class="col-md-7">
					                <div class="row text-center mar-btm">
					                    <?php if($res->type==1):?>
					                    <div class="col-xs-3">
					                        <p class="h4 mar-no"><a class="btn-link" href="javascript:get_html('<?php echo base_url('Corder/buyer_order/'.$res->id)?>');"><i class="ion-star"></i></a></p>
					                        <small class="text-muted">订单(<?php echo $goods_or_order?>)</small>
					                    </div>
					                    <?php else :?>
					                    <div class="col-xs-3">
					                        <p class="h4 mar-no"><a class="btn-link" href="javascript:get_html('<?php echo base_url('Cgoods/supplier_goods/'.$res->id)?>');"><i class="ion-star"></i></a></p>
					                        <small class="text-muted">产品(<?php echo $goods_or_order?>)</small>
					                    </div>
					                    <?php endif;?>
					                    <div class="col-xs-3">
					                        <p class="h4 mar-no"><a class="btn-link" href="javascript:get_html('<?php echo base_url('Cuser_log/user_grid/'.$res->id)?>');"><i class="ion-eye"></i></a></p>
					                        <small class="text-muted">浏览</small>
					                    </div>
					                    <div class="col-xs-3">
					                        <p class="h4 mar-no"><a class="btn-link" href="javascript:get_html('<?php echo base_url('Csearch_log/user_grid/'.$res->id)?>');"><i class="ion-search"></i></a></p>
					                        <small class="text-muted">搜索</small>
					                    </div>
					                    <div class="col-xs-3">
					                        <p class="h4 mar-no"><i class="demo-psi-star icon-fw text-warning"></i>4.5</p>
					                        <small class="text-muted">Ranking</small>
					                    </div>
					                </div>
					            </div>
					        </div>
					
					        <div class="fixed-fluid">
					            <div class="fixed-lg-300 pull-lg-right">
					
					                <div class="panel">
					                    <div class="panel-heading">
					                        <h3 class="panel-title">公司员工(<?php echo count($workers)?>)</h3>
					                        <a style="float: right;margin: -40px 10px;" href="<?php echo base_url('Cuser/add?companyid='.$res->id.'&company='.$res->company_name.'&role_id='.$res->type)?>" class="btn btn-sm btn-primary">添加员工</a>
					                    </div>
					                    <div class="list-group bg-trans">
					                        <?php foreach ($workers as $w) :?>
					                        <?php if ($res->id != $w->id) :?>
					                        <a class="btn-link" href="###" class="list-group-item">
					                            <div class="media-left pos-rel">
					                                <img class="img-circle img-xs" src="<?php echo $this->config->image_url.$w->userimg?>" alt="Profile Picture">
					                            </div>
					                            <div class="media-body">
					                                <p class="mar-no"><?php echo $w->positions.' '.$w->username?></p>
					                                <small class="text-muted"><?php echo $w->mobile?></small>
					                            </div>
					                        </a>
					                        <?php endif;?>
					                        <?php endforeach;?>
					                    </div>
					                </div>
					                
					            </div>
					            <div class="fluid">
					                <div class="panel">
					                    <div class="panel-body">
					                        <div class="media-block">
					                            <div class="media-body">
					                                <div class="pad-btm">
					                                    <h3 class="panel-title">公司位置</h3>
					                                </div>
					                                <div class="media-body" id="allmap" style="width: 100%;height: 400px;overflow: hidden;margin:0;">
    					                            </div>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					                
					            </div>
					        </div>
					    </div>
					</div>
					<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=1dc771f8e1d5ab15e12a9503773c18f3"></script>
					<?php $lnglat = explode(',', $res->lnglat);?>
					<script type="text/javascript">
					var get_html = function(url){
						layer.open({
							  type: 2,
							  title: false,
							  area: ['893px', '600px'],
							  content: [url], //iframe的url，no代表不显示滚动条
						});
					}

					// 百度地图API功能
					var map = new BMap.Map("allmap");
					var point = new BMap.Point(<?php echo $lnglat[0]?>, <?php echo $lnglat[1]?>);
					map.centerAndZoom(point, 15);
					var marker = new BMap.Marker(point);  // 创建标注
					map.addOverlay(marker);               // 将标注添加到地图中
					marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
					map.addControl(new BMap.NavigationControl());               // 添加平移缩放控件
					map.addControl(new BMap.ScaleControl());                    // 添加比例尺控件
					map.addControl(new BMap.OverviewMapControl());              //添加缩略地图控件
					map.enableScrollWheelZoom();                            //启用滚轮放大缩小
					</script>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            