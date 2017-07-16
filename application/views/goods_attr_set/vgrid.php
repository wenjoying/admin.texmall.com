<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="<?php echo base_url('Cgoods_attr_set/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a  href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="ion-load-d"></i>刷新</button></a>
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
					                <input type="text" class="form-control" name="item" value="<?php echo $this->input->get('item');?>" placeholder="名称/属性值">
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
            					                    <th width="2%"><div class="th-inner"><input class="select-all" type="checkbox"></div></th>
            					                    <th width="5%"><div class="th-inner">ID</div></th>
                                                    <th width="10%"><div class="th-inner">英文名称</div></th>
                                                    <th width="10%"><div class="th-inner">名称</div></th>
                                                    <th width="20%"><div class="th-inner">属性值</div></th>
                                                    <th width="10%"><div class="th-inner">多选</div></th>
                                                    <th width="10%"><div class="th-inner">显示</div></th>
                                                    <th width="5%"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><div class="th-inner"><input class="list-check" type="checkbox" name="checkid[]" value="<?php echo $r->id?>"></div></td>
            					                    <td><?php echo $r->id?></td>
                                                    <td><?php echo $r->attr_en_name?></td>
                                                    <td><?php echo $r->attr_name?></td>
                                                    <td><?php echo $r->attr_val?></td>
                                                    <td><?php echo $r->is_multi==1 ? '<span class="label label-table label-success">多选</span>' : '<span class="label label-table label-info">单选</span>';?></td>
                                                    <td><?php echo $r->is_show==1 ? '<span class="label label-table label-success">显示</span>' : '<span class="label label-table label-danger"> Refunded</span>'?></td>
            					                    <td>
                                                        <div class="btn-group m-b-5">
                                                            <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu animated fadeIn">
                                                                <li><a href="<?php echo base_url('Cgoods_attr_set/edit/'.$r->id);?>"><i class="ion-eye"></i>查看</a></li>
                                                                <li><a href="javascript:layer_conf('<?php echo base_url('Cgoods_attr_set/delete/'.$r->id);?>');"><i class="ion-trash-a"></i>删除</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
        					                    </tr>
        					                    <?php endforeach;?>
        					                </tbody>
    					                </table>
    					                <script>
          					            // 全选、全不选、反选
          					            $('.demo-add-niftycheck').on('click','.select-all',function(){     
    										$('input[name="checkid[]"]').each(function(){
    											if(this.checked){
    												this.checked = false;
    											}else{
    												this.checked = true;
    											}
    										});
    									});
    					                </script>
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