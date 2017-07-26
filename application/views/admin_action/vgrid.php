<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
    					        <a style="margin-left:50px;" href="<?php echo base_url('Cadmin_action/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a class="btn-link" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="demo-psi-repeat-2 icon-fw"></i>刷新</button></a>
					        </h3>
					        
					        
					    </div>
					    <div class="panel-body">
					
					        <form class="form-inline" action="<?php echo base_url('Cadmin_action/grid');?>" method="get">
					            
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" value="<?php echo $this->input->get('item');?>" placeholder="权限/简介">
					            </div>
					            
					            <button class="btn btn-primary" type="submit">搜索</button>
					        </form>
					
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
                                                    <th><div class="th-inner">父级ID</div></th>
                                                    <th><div class="th-inner">权限</div></th>
                                                    <th><div class="th-inner">简介</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><?php echo $r->id?></td>
                                                    <td><?php echo $r->pid?></td>
                                                    <td><?php echo $r->action?></td>
                                                    <td><?php echo $r->des?></td>
            					                    <td>
            					                        <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Cadmin_action/delete/'.$r->id);?>');">删除</a>
                                                    </td>
        					                    </tr>
        					                    <?php endforeach;?>
        					                </tbody>
    					                </table>
    					            </div>
    					        </div>
    					        <div class="pull-right pagination">
    					        <ul class="pagination">
    					            <li><a>每页<?php echo $per_page?>条/共<?php echo $sum?>条</a></li>
    					            <li><a>第<?php echo empty($this->uri->segment(3)) ? 1 : $this->uri->segment(3)?>页</a></li>
    					        </ul>
    					        <?php echo $link;?> 
    					        </div>
					        </div>
				        </div>
					</div>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            