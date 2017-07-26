<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
    					        <a style="margin-left:50px;" href="<?php echo base_url('Cadmin_role/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
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
                                                    <th><div class="th-inner">角色名</div></th>
                                                    <th><div class="th-inner">权限</div></th>
                                                    <th><div class="th-inner">菜单</div></th>
                                                    <th><div class="th-inner">简介</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><?php echo $r->id?></td>
                                                    <td><?php echo $r->role_name?></td>
                                                    <td><textarea class="form-control" readonly><?php echo $r->action_list?></textarea></td>
                                                    <td><?php echo $r->menu_list?></td>
                                                    <td><?php echo $r->des?></td>
            					                    <td>
                					                    <a class="btn-link" href="<?php echo base_url('Cadmin_role/edit/'.$r->id);?>">编辑</a>|
                					                    <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Cadmin_role/delete/'.$r->id);?>');">删除</a>
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