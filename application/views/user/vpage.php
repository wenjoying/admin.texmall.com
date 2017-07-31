<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel">
					            <!-- Simple profile -->
					            <div class="text-center pad-all bord-btm">
					                <div class="pad-ver">
					                    <img src="<?php echo $this->config->image_url.$res->userimg?>" class="img-lg img-border img-circle" alt="Profile Picture">
					                </div>
					            </div>
					            <div class="panel-heading">
			                        <h3 class="panel-title">我的资料</h3>
		                        </div>
					            <div class="pad-hor mar-btm">
					               <p>身份证：<?php echo $res->username?></p>
					               <p>身份证：<?php echo $res->mobile?></p>
					               <p>手机唯一码：<?php echo $res->device_id?></p>
					               <p>身份证：<?php echo $res->id_card?></p>
					               <p>性别：<?php echo $sex_arr[$res->sex]?></p>
					               <p>生日：<?php echo $res->birthday?></p>
					               <p>身份：<?php echo $res->role_id==1?'采购商用户':($res->role_id==2?'供应商用户':'平台服务商')?></p>
					               <p>企业：<a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$res->companyid)?>"><?php echo $res->company?></a></p>
					               <p>职务：<?php echo $res->positions?></p>
					            </div>
					            <div class="panel-heading">
			                        <h3 class="panel-title">我的二维码</h3>
		                        </div>
					            <div class="pad-hor mar-btm">
					               <?php if(!empty($res->qr_img)):?>
					               <img width=150 src="<?php echo $this->config->image_url.$res->qr_img?>">
					               <?php endif;?>
					            </div>
					        </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel">
                                <div class="row text-center mar-btm" style="margin-top: 15px;">
				                    <div class="col-xs-3">
				                        <p class="h4 mar-no"><a class="btn-link" href="javascript:get_html('<?php echo base_url('Cuser_enshrine/user_grid/'.$res->id)?>');"><i class="ion-star"></i></a></p>
				                        <small class="text-muted">收藏</small>
				                    </div>
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
                            <div class="panel">
			                    <div class="panel-heading">
			                        <h3 class="panel-title"><i class="demo-pli-file-jpg icon-fw"></i>我的模特库(<?php echo count($models)?>)</h3>
			                    </div>
			                    <div class="panel-body">
			                        <ul class="list-unstyled list-inline text-justify">
			                            <?php foreach ($models as $m) :?>
			                            <li class="pad-btm">
			                                <img src="<?php echo $this->config->image_url.$m->correct_img?>">
			                            </li>
			                            <?php endforeach;?>
			                        </ul>
			                        <a class="btn-link" href="<?php echo base_url('Ccorrect_img/grid')?>" class="btn btn-sm btn-block btn-default">进入标准图库</a>
			                    </div>
			                </div>
			                <div class="panel">
				                    <div class="panel-heading">
				                        <h3 class="panel-title">企业同事(<?php echo count($workers)?>)</h3>
				                    </div>
				                    <div class="list-group">
				                        <?php foreach ($workers as $w) :?>
				                        <?php if ($res->id != $w->id) :?>
				                        <a class="list-group-item" href="###">
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
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel">
                                <div class="panel-heading">
			                        <h3 class="panel-title">我的收货地址</h3>
			                    </div>
			                    <div class="list-group">
			                        <?php foreach($deliver_address as $a):?>
			                        <a class="list-group-item" href="###">
			                            <h4 class="list-group-item-heading"><?php echo $a->receiver_name.' '.$a->tel?><?php if($a->if_default==2)echo '(默认)';?></h4>
			                            <p class="list-group-item-text"><?php echo $a->province_name.$a->city_name.$a->district_name.$a->ads_des?></p>
			                        </a>
			                        <?php endforeach;?> 
			                    </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel">
                                <div class="panel-heading">
			                        <h3 class="panel-title">我的通讯录</h3>
			                    </div>
			                    <div class="list-group">
			                        <?php foreach($mail_list as $m):?>
			                        <a class="list-group-item" href="###">
			                            <h4 class="list-group-item-heading"><?php echo $m->company.' '.$m->position?></h4>
			                            <p class="list-group-item-text"><?php echo $m->full_name.' '.$m->telphone?></p>
			                            <p class="list-group-item-text"><?php echo $m->e_mail?></p>
			                            <p class="list-group-item-text"><?php echo $m->address?></p>
			                        </a>
			                        <?php endforeach;?> 
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