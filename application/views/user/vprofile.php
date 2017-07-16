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
					
					                <div class="pad-ver btn-groups">
					                    <a href="http://doc.layui.com/nifty/demo/pages-profile.html#" class="btn btn-hover-primary demo-pli-facebook icon-lg add-tooltip" data-original-title="Facebook" data-container="body"></a>
					                    <a href="http://doc.layui.com/nifty/demo/pages-profile.html#" class="btn btn-hover-info demo-pli-twitter icon-lg add-tooltip" data-original-title="Twitter" data-container="body"></a>
					                    <a href="http://doc.layui.com/nifty/demo/pages-profile.html#" class="btn btn-hover-danger demo-pli-google-plus icon-lg add-tooltip" data-original-title="Google+" data-container="body"></a>
					                    <a href="http://doc.layui.com/nifty/demo/pages-profile.html#" class="btn btn-hover-purple demo-pli-instagram icon-lg add-tooltip" data-original-title="Instagram" data-container="body"></a>
					                </div>
					            </div>
					            <p class="text-semibold text-main pad-all mar-no">我的资料</p>
					            <div class="pad-hor mar-btm">
					               <p>身份证：<?php echo $res->id_card?></p>
					               <p>性别：<?php echo $sex_arr[$res->sex]?></p>
					               <p>生日：<?php echo $res->birthday?></p>
					               <p>公司：<?php echo $res->company?></p>
					               <p>职务：<?php echo $res->positions?></p>
					            </div>
					            
					            <p class="text-semibold text-main pad-all mar-no">我的二维码</p>
					            <div class="pad-hor mar-btm">
					               <?php if(!empty($res->qr_img)):?>
					               <img width=150 src="<?php echo $this->config->image_url.$res->qr_img?>">
					               <?php endif;?>
					            </div>
					
					            <p class="text-semibold text-main pad-all mar-no">我的收藏(<?php echo count($enshrine)?>)</p>
					            <ul class="list-inline mar-hor">
					                <?php foreach($enshrine as $e):?>
					                <li class="tag tag-sm"><a href="<?php echo base_url('Cgoods/edit/'.$e->goods_id)?>"><?php echo $e->supplier_code?></a></li>
					                <?php endforeach;?>
					            </ul>
					        </div>
					    </div>
					    <div class="fluid">
					        <div class="bg-trans-light pad-all mar-btm clearfix">
					            <hr class="new-section-xs bord-no">
					            <div class="col-md-7">
					                <div class="row text-center mar-btm">
					                    <div class="col-xs-3">
					                        <p class="h4 mar-no">52K</p>
					                        <small class="text-muted">Followers</small>
					                    </div>
					                    <div class="col-xs-3">
					                        <p class="h4 mar-no">72K</p>
					                        <small class="text-muted">Following</small>
					                    </div>
					                    <div class="col-xs-3">
					                        <p class="h4 mar-no">5,343</p>
					                        <small class="text-muted">Photo</small>
					                    </div>
					                    <div class="col-xs-3">
					                        <p class="h4 mar-no"><i class="demo-psi-star icon-fw text-warning"></i>4.5</p>
					                        <small class="text-muted">Ranking</small>
					                    </div>
					                </div>
					            </div>
					            <div class="col-md-5 text-right mar-btm">
					                <button class="btn btn-sm btn-primary">Send Message</button>
					                <button class="btn btn-sm btn-success">Download CV</button>
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
					                        <a href="<?php echo base_url('Ccorrect_img/grid')?>" class="btn btn-sm btn-block btn-default">进入标准图库</a>
					                    </div>
					                </div>
					
					                <div class="panel">
					                    <div class="panel-heading">
					                        <h3 class="panel-title">我的同事(<?php echo count($workers)?>)</h3>
					                    </div>
					                    <div class="list-group bg-trans">
					                        <?php foreach ($workers as $w) :?>
					                        <?php if ($res->id != $w->id) :?>
					                        <a href="###" class="list-group-item">
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
					                <!-- Status Form -->
					                <!--===================================================-->
					                <div class="panel">
					                    <div class="panel-body">
					                        <textarea class="form-control" rows="2" placeholder="What are you thinking?"></textarea>
					                        <div class="mar-top clearfix">
					                            <button class="btn btn-sm btn-primary pull-right" type="submit"><i class="demo-psi-right-4 icon-fw"></i> Share</button>
					                            <a class="btn btn-trans btn-icon demo-pli-video icon-lg add-tooltip" href="http://doc.layui.com/nifty/demo/pages-profile.html#" data-original-title="Add Video" data-toggle="tooltip"></a>
					                            <a class="btn btn-trans btn-icon demo-pli-camera-2 icon-lg add-tooltip" href="http://doc.layui.com/nifty/demo/pages-profile.html#" data-original-title="Add Photo" data-toggle="tooltip"></a>
					                            <a class="btn btn-trans btn-icon demo-pli-file icon-lg add-tooltip" href="http://doc.layui.com/nifty/demo/pages-profile.html#" data-original-title="Add File" data-toggle="tooltip"></a>
					                        </div>
					                    </div>
					                </div>
					                <!--===================================================-->
					                <!-- End Status Form -->
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
					                                <a href="<?php echo base_url('Cuser_mail_list/grid?uid='.$res->id)?>">
					                                   <button class="btn btn-sm btn-primary pull-right" type="button"><i class="demo-psi-right-4 icon-fw"></i>更多</button>
					                                </a>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					                
					                <div class="panel">
					                    <div class="panel-body">
					                        <div class="media-block">
					                            <div class="media-body">
					                                <div class="pad-btm">
					                                    <h3 class="panel-title">我的浏览</h3>
					                                </div>
					                                <?php foreach($user_log as $u):?>
					                                <div class="media-body">
    					                                <small class="text-muted"><?php echo $u->log?></small>
    					                            </div>
					                                <?php endforeach;?>
					                                <a href="<?php echo base_url('Cuser_log/grid?uid='.$res->id)?>">
					                                   <button class="btn btn-sm btn-primary pull-right" type="button"><i class="demo-psi-right-4 icon-fw"></i>更多</button>
					                                </a>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					                
					                <div class="panel">
					                    <div class="panel-body">
					                        <div class="media-block">
					                            <div class="media-body">
					                                <div class="pad-btm">
					                                    <h3 class="panel-title">我的搜索</h3>
					                                </div>
					                                <?php foreach($search as $s):?>
					                                <div class="media-body">
    					                                <p class="mar-no"><?php echo date('Y-m-d H:i:s', $s->time)?></p>
    					                                <small class="text-muted">
    					                                <?php 
    					                                if($s->type==2) {
    					                                    echo '<img height=100 src="'.$this->config->image_url.$this->note.'">';
    					                                } else {
    					                                    echo $s->note;
    					                                }
    					                                ?>
    					                                </small>
    					                            </div>
					                                <?php endforeach;?>
					                                <a href="<?php echo base_url('Csearch/grid?uid='.$res->id)?>">
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
					
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            