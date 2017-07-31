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
					
					        <form class="form-inline" action="<?php echo base_url('Cfeedback/grid');?>" method="get">
					            <div class="form-group">
    					            <select class="selectpicker" name="type">
    	                                <option value="">请选择类型</option>
    	                                <?php foreach($type_arr as $t):?>
                                        <option <?php if($this->input->get('type')==$t)echo 'selected="selected"'?> value="<?php echo $t?>"><?php echo $t?></option>
                                        <?php endforeach;?>
                                    </select>
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="sta_time" value="<?php echo $this->input->get('sta_time');?>" placeholder="开始时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="end_time" value="<?php echo $this->input->get('end_time');?>" placeholder="截至时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" style="width:350px;" value="<?php echo $this->input->get('item');?>" placeholder="用户名/电话">
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
                                                    <th><div class="th-inner">分类</div></th>
                                                    <th><div class="th-inner">用户</div></th>
                                                    <th><div class="th-inner">电话</div></th>
                                                    <th><div class="th-inner">内容</div></th>
                                                    <th><div class="th-inner">时间</div></th>
                                                    <th><div class="th-inner">回复</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><?php echo $r->id?></td>
            					                    <td><?php echo $r->type?></td>
            					                    <td><?php echo $r->username?></td>
            					                    <td><?php echo $r->mobile?></td>
                                                    <td><?php echo $r->des?></td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->time);?></td>
                                                    <td>
                                                    <?php 
                                                    if($r->reply_time) echo date('Y-m-d H:i:s', $r->reply_time);
                                                    echo '</br>'.$r->reply;
                                                    ?>
                                                    </td>
            					                    <td>
                					                    <?php if(empty($r->reply_time)):?>
                					                    <a class="btn-link" href="<?php echo base_url('Cfeedback/edit/'.$r->id);?>">编辑</a>|
                					                    <?php endif;?>
                					                    <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Cfeedback/delete/'.$r->id);?>');">删除</a>
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