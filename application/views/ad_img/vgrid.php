<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
    					        <a style="margin-left:50px;" href="<?php echo base_url('Cad_img/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a class="btn-link" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="demo-psi-repeat-2 icon-fw"></i>刷新</button></a>
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
					                <input type="text" class="form-control" name="item" style="width:350px;" value="<?php echo $this->input->get('item');?>" placeholder="名称/简介">
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
                                                    <th><div class="th-inner">广告图</div></th>
                                                    <th><div class="th-inner">名称</div></th>
                                                    <th><div class="th-inner">简介</div></th>
                                                    <th><div class="th-inner">跳转地址</div></th>
                                                    <th><div class="th-inner">排序</div></th>
                                                    <th><div class="th-inner">上架状态</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><?php echo $r->id?></td>
                                                    <td><img style="height:80px;width:80px;" src="<?php echo $this->config->image_url.$r->ad_img?>"></td>
                                                    <td><?php echo $r->ad_name?></td>
                                                    <td><?php echo $r->ad_info?></td>
                                                    <td><?php echo $r->ad_url?></td>
                                                    <td><?php echo $r->reorder?></td>
                                                    <td><?php echo $r->status==1 ? '<span class="label label-success">上架</span>' : '<span class="label label-danger">下架</span>'?></td>
                                                    <td>
                					                    <a class="btn-link" href="<?php echo base_url('Cad_img/edit/'.$r->id);?>">编辑</a>|
                					                    <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Cad_img/delete/'.$r->id);?>');">删除</a>
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