<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
    					        <a style="margin-left:50px;" href="<?php echo base_url('Cad_img/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="ion-load-d"></i>刷新</button></a>
					        </h3>
					        
					        
					    </div>
					    <div class="panel-body">
					
					        <form class="form-inline" action="<?php echo base_url('Cad_img/grid');?>" method="get">
					            <div class="form-group">
    					            <select class="selectpicker" name="status">
    	                                <option value="">请选择状态</option>
                                        <option <?php if(1==$this->input->get('status'))echo 'selected="selected"'?> value="1">上线</option>
                                        <option <?php if(2==$this->input->get('status'))echo 'selected="selected"'?> value="2">下线</option>
                                    </select>
					            </div>
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" value="<?php echo $this->input->get('item');?>" placeholder="名称/简介">
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
                                                    <th width="10%"><div class="th-inner">广告图</div></th>
                                                    <th width="10%"><div class="th-inner">名称</div></th>
                                                    <th width="20%"><div class="th-inner">简介</div></th>
                                                    <th width="10%"><div class="th-inner">跳转地址</div></th>
                                                    <th width="5%"><div class="th-inner">排序</div></th>
                                                    <th width="10%"><div class="th-inner">状态</div></th>
                                                    <th width="5%"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><div class="th-inner"><input class="list-check" type="checkbox" name="checkid[]" value="<?php echo $r->id?>"></div></td>
            					                    <td><?php echo $r->id?></td>
                                                    <td><img style="height:80px;width:80px;" src="<?php echo $this->config->image_url.$r->ad_img?>"></td>
                                                    <td><?php echo $r->ad_name?></td>
                                                    <td><?php echo $r->ad_info?></td>
                                                    <td><?php echo $r->ad_url?></td>
                                                    <td><?php echo $r->reorder?></td>
                                                    <td><?php echo $r->status==1 ? '<span class="label label-success">上线</span>' : '<span class="label label-danger">下线</span>'?></td>
                                                    <td>
                                                        <div class="btn-group m-b-5">
                                                            <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu animated fadeIn">
                                                                <li><a href="<?php echo base_url('Cad_img/edit/'.$r->id);?>"><i class="ion-eye"></i>查看</a></li>
                                                                <li><a href="javascript:layer_conf('<?php echo base_url('Cad_img/delete/'.$r->id);?>');"><i class="ion-trash-a"></i>删除</a></li>
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
					        </div>
				        </div>
					</div>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            