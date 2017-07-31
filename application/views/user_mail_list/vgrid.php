<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="demo-psi-repeat-2 icon-fw"></i>刷新</button></a>
					        </h3>
					        
					        
					    </div>
					    <div class="panel-body">
					
					        <form class="form-inline" action="<?php echo base_url('Chelp_category/grid');?>" method="get">
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="sta_time" value="<?php echo $this->input->get('sta_time');?>" placeholder="开始时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="end_time" value="<?php echo $this->input->get('end_time');?>" placeholder="截至时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" style="width:350px;" value="<?php echo $this->input->get('item');?>" placeholder="企业/姓名/电话/职位/邮箱/地址">
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
            					                    <th><div class="th-inner">用户ID</div></th>
                                                    <th><div class="th-inner">企业</div></th>
                                                    <th><div class="th-inner">姓名</div></th>
                                                    <th><div class="th-inner">电话</div></th>
                                                    <th><div class="th-inner">职位</div></th>
                                                    <th><div class="th-inner">邮箱</div></th>
                                                    <th><div class="th-inner">地址</div></th>
                                                    <th><div class="th-inner">时间</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><?php echo $r->id?></td>
            					                    <td><?php echo $r->uid?></td>
                                                    <td><?php echo $r->company?></td>
                                                    <td><?php echo $r->full_name?></td>
                                                    <td><?php echo $r->telphone?></td>
                                                    <td><?php echo $r->position?></td>
                                                    <td><?php echo $r->e_mail?></td>
                                                    <td><?php echo $r->address?></td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->time)?></td>
            					                    <td>
            					                        <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Cuser_mail_list/delete/'.$r->id);?>');">删除</a>
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