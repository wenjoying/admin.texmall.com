<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
                    <?php if($res->status==1):?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel">
    		                    <form class="form-horizontal" action="<?php echo base_url('Csupplier_buyer/up_status');?>" method="post">
    					            <div class="alert alert-danger">
					                   <strong>注意！</strong>提交审核后不能恢复，请谨慎操作！
					                </div>
					                <input type="hidden" name="id" value="<?php echo $res->id?>">
					                <div class="form-group pad-ver">
					                    <label class="col-md-3 control-label">审核状态*</label>
					                    <div class="col-md-6">
				                            <select class="selectpicker" required="required" name="status">
                                                <option value="2">通过</option>
                                                <option value="3">不通过</option>
                                            </select>
					                    </div>
					                </div>
				                    <div class="panel-footer">
					                    <div class="row">
					                        <div class="col-sm-9 col-sm-offset-3">
					                            <button class="btn btn-mint" type="submit">审核</button>
					                        </div>
					                    </div>
					                </div>
					            </form>
			                </div>
		                </div>
	                </div>
	                <?php endif;?>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel">
                                <div class="panel-heading">
			                        <h3 class="panel-title">企业详情</h3>
			                        <?php if($res->type==1):?>
		                                <a style="float: right;margin: -40px 10px;" href="<?php echo base_url('Corder/grid?item='.$res->company_name)?>" class="btn btn-sm btn-primary">查看订单</a>
				                    <?php else :?>
				                        <a style="float: right;margin: -40px 10px;" href="<?php echo base_url('Cgoods/grid?item='.$res->company_name)?>" class="btn btn-sm btn-primary">查看产品</a>
				                    <?php endif;?>
			                    </div>
					            <div class="pad-hor mar-btm">
					               <p>企业名称：<?php echo $res->company_name?></p>
					               <p>类型：<?php echo $res->type==1?'采购商':'供应商'?></p>
					               <p>管理员：<a class="btn-link" href="<?php echo base_url('Cuser/page/'.$res->uid)?>"><?php echo $res->username?></a></p>
					               <p>企业状态：<span style="color:red;"><?php echo $status_arr[$res->status]?></span></p>
    					           <?php if($res->platform_grade):?>
    					           <p>平台等级：<span style="color:red;"><?php echo $grade_arr[$res->platform_grade]?></span></p>
    					           <?php endif;?>
					               <p>地址：<?php echo $res->province_name.$res->city_name.$res->district_name.$res->ads_des?></p>
					               <p>电话：<?php echo $res->office_tel?></p>
					               <p>主营：<?php echo $res->main_business?></p>
					               <p>简介：<?php echo $res->des?></p>
					               <p>创建时间：<?php echo date('Y-m-d H:i:s', $res->time)?></p>
					            </div>
					            <div class="panel-heading">
			                        <h3 class="panel-title">企业二维码</h3>
			                    </div>
					            <div class="pad-hor mar-btm">
					               <?php if(!empty($res->qr_img)):?>
					               <img width=150 src="<?php echo $this->config->image_url.$res->qr_img?>">
					               <?php endif;?>
					            </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel" style="padding:15px;">
                                <div id="allmap" style="width: 100%;height: 400px;overflow: hidden;margin:0;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">企业员工(<?php echo count($workers)?>)</h3>
			                        <a style="float: right;margin: -40px 10px;" href="<?php echo base_url('Cuser/add?companyid='.$res->id.'&company_name='.$res->company_name.'&role_id='.$res->type)?>" class="btn btn-sm btn-primary">添加员工</a>
			                    </div>
			                    <div class="list-group bg-trans">
			                        <?php foreach ($workers as $w) :?>
			                        <a class="list-group-item" href="###" class="list-group-item">
			                            <div class="media-left pos-rel">
			                                <img class="img-circle img-xs" src="<?php echo $this->config->image_url.$w->userimg?>" alt="Profile Picture">
			                            </div>
			                            <div class="media-body">
			                                <p class="mar-no"><?php echo $w->positions.' '.$w->username?></p>
			                                <small class="text-muted"><?php echo $w->mobile?></small>
			                            </div>
			                        </a>
			                        <?php endforeach;?>
			                    </div>
			                </div>
                        </div>
                    </div>
                    
					<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=1dc771f8e1d5ab15e12a9503773c18f3"></script>
					<?php $lnglat = explode(',', $res->lnglat);?>
					<script type="text/javascript">
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