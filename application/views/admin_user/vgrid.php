<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="<?php echo base_url('Cadmin_user/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a class="btn-link" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="demo-psi-repeat-2 icon-fw"></i>刷新</button></a>
					        </h3>
					    </div>
					</div>
                    <div class="row">
				        <div class="panel">
				            <div class="panel-body">
				                <div class="bootstrap-table">
					                <div class="fixed-table-container" >
    					                <table class="demo-add-niftycheck table table-hover">
    					                    <thead>
        					                    <tr>
            					                    <th><div class="th-inner">ID</div></th>
                                                    <th><div class="th-inner">头像</div></th>
                                                    <th><div class="th-inner">管理员</div></th>
                                                    <th><div class="th-inner">电话</div></th>
                                                    <th><div class="th-inner">注册时间</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><?php echo $r->id?></td>
                                                    <td><img style="height:80px;width:80px;" src="<?php echo $this->config->image_url.$r->userimg?>"></td>
                                                    <td><?php echo $r->username?></td>
                                                    <td><?php echo $r->mobile?></td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->reg_time);?></td>
            					                    <td>
            					                        <a class="btn-link" href="<?php echo base_url('Cadmin_user/page/'.$r->id);?>">查看</a>|
                					                    <a class="btn-link" href="<?php echo base_url('Cadmin_user/reset_pwd/'.$r->id);?>">重置密码</button></a>
                					                    <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Cadmin_user/delete/'.$r->id);?>');">删除</a>
                                                    </td>
        					                    </tr>
        					                    <?php endforeach;?>
        					                </tbody>
    					                </table>
    					            </div>
    					        </div>
					        </div>
				        </div>
					</div>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            