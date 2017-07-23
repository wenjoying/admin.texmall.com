<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					<div class="fixed-fluid">
					    <div class="fixed-sm-200 fixed-lg-250 pull-sm-left">
					        <div class="panel">
					            <!-- Simple profile -->
					            <div class="text-center pad-all bord-btm">
					                <div class="pad-ver">
					                    <img src="<?php echo $this->config->image_url.$res->userimg?>" class="img-lg img-border img-circle" alt="Profile Picture">
					                </div>
					                <h4 class="text-lg text-overflow mar-no"><?php echo $res->username?></h4>
					                <p class="text-sm text-muted"><?php echo $res->mobile?></p>
					            </div>
					            <p class="text-semibold text-main pad-all mar-no">我的资料</p>
					            <div class="pad-hor mar-btm">
					               <p>身份证：<?php echo $res->id_card?></p>
					               <p>性别：<?php echo $sex_arr[$res->sex]?></p>
					               <p>生日：<?php echo $res->birthday?></p>
					               <p>身份：<?php echo $res->role_id==1?'采购商用户':($res->role_id==2?'供应商用户':'平台服务商')?></p>
					               <p>公司：<a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$res->companyid)?>"><?php echo $res->company?></a></p>
					               <p>职务：<?php echo $res->positions?></p>
					            </div>
					            
					            <p class="text-semibold text-main pad-all mar-no">我的二维码</p>
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
					        </div>
					
					        <div class="fixed-fluid">
					            <div class="fixed-lg-300 pull-lg-right">
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
					                        <h3 class="panel-title">我的同事(<?php echo count($workers)?>)</h3>
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
					                
					                <div class="panel">
					                    <div class="panel-heading">
					                        <h3 class="panel-title">我的收货地址</h3>
					                    </div>
					                    <div class="list-group bg-trans">
					                        <?php foreach ($deliver_address as $a) :?>
					                        <a class="btn-link" href="###" class="list-group-item">
					                            <div class="media-body">
					                                <p class="mar-no"><?php echo $a->receiver_name.' '.$a->tel?><?php if($a->if_default==2)echo '(默认)';?></p>
					                                <small class="text-muted"><?php echo $a->province_name.$a->city_name.$a->district_name.$a->ads_des?></small>
					                            </div>
					                        </a>
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
					                                    <h3 class="panel-title">我的通讯录</h3>
					                                </div>
					                                <?php foreach($mail_list as $m):?>
					                                <div class="media-body">
    					                                <p class="mar-no"><?php echo $w->company.' '.$w->position?></p>
    					                                <small class="text-muted"><?php echo $w->full_name.' '.$w->telphone?></small>
    					                                <small class="text-muted"><?php echo $w->e_mail?></small>
    					                                <small class="text-muted"><?php echo $w->address?></small>
    					                            </div>
					                                <?php endforeach;?>
					                                <a class="btn-link" href="<?php echo base_url('Cuser_mail_list/grid?uid='.$res->id)?>">
					                                   <button class="btn btn-sm btn-primary pull-right" type="button"><i class="demo-psi-right-4 icon-fw"></i>更多</button>
					                                </a>
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