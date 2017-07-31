<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="<?php echo base_url('Cgoods_attr_set/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a  href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="demo-psi-repeat-2 icon-fw"></i>刷新</button></a>
					        </h3>
					        
					        
					    </div>
					    <div class="panel-body">
					
					        <form class="form-inline" action="<?php echo base_url('Cgoods_attr_set/grid');?>" method="get">
					            <div class="form-group">
    					            <select class="selectpicker" name="is_multi">
    	                                <option value="">请选择是否多选</option>
                                        <option <?php if($this->input->get('is_multi')==1)echo 'selected="selected"'?> value="1">多选</option>
                                        <option <?php if($this->input->get('is_multi')==2)echo 'selected="selected"'?> value="2">单选</option>
                                    </select>
					            </div>
					            
					            <div class="form-group">
    					            <select class="selectpicker" name="is_show">
    	                                <option value="">请选择是否多选</option>
                                        <option <?php if($this->input->get('is_show')==1)echo 'selected="selected"'?> value="1">显示</option>
                                        <option <?php if($this->input->get('is_show')==2)echo 'selected="selected"'?> value="2">隐藏</option>
                                    </select>
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" style="width:350px;" value="<?php echo $this->input->get('item');?>" placeholder="名称/属性值">
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
                                                    <th><div class="th-inner">英文名称</div></th>
                                                    <th><div class="th-inner">名称</div></th>
                                                    <th><div class="th-inner">属性值</div></th>
                                                    <th><div class="th-inner">多选</div></th>
                                                    <th><div class="th-inner">显示</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><?php echo $r->id?></td>
                                                    <td><?php echo $r->attr_en_name?></td>
                                                    <td><?php echo $r->attr_name?></td>
                                                    <td><?php echo $r->attr_val?></td>
                                                    <td><?php echo $r->is_multi==1 ? '<span class="label label-table label-success">多选</span>' : '<span class="label label-table label-info">单选</span>';?></td>
                                                    <td><?php echo $r->is_show==1 ? '<span class="label label-table label-success">显示</span>' : '<span class="label label-table label-danger"> Refunded</span>'?></td>
            					                    <td>
                					                    <a class="btn-link" href="<?php echo base_url('Cgoods_attr_set/edit/'.$r->id);?>">编辑</a>|
                					                    <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Cgoods_attr_set/delete/'.$r->id);?>');">删除</a>
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