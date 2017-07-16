<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="ion-load-d"></i>刷新</button></a>
					        </h3>
					        
					        
					    </div>
					    <div class="panel-body">
					
					        <form class="form-inline" action="<?php echo base_url('Chelp_category/grid');?>" method="get">
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" value="<?php echo $this->input->get('item');?>" placeholder="类名">
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
            					                    <th width="5%"><div class="th-inner">用户ID</div></th>
                                                    <th width="10%"><div class="th-inner">公司</div></th>
                                                    <th width="10%"><div class="th-inner">姓名</div></th>
                                                    <th width="10%"><div class="th-inner">电话</div></th>
                                                    <th width="10%"><div class="th-inner">职位</div></th>
                                                    <th width="10%"><div class="th-inner">邮箱</div></th>
                                                    <th width="10%"><div class="th-inner">地址</div></th>
                                                    <th width="5%"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><div class="th-inner"><input class="list-check" type="checkbox" name="checkid[]" value="<?php echo $r->id?>"></div></td>
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
                                                        <a href="javascript:up_status('<?php echo base_url('Chelp_category/up_status/'.$r->id.'?status='.$r->status);?>');">
                                                        <?php echo $r->status==1 ? '<i class="ion-checkmark"></i>' : '<i class="ion-close"></i>'?>
                                                        </a>
                                                    </td>
            					                    <td>
                                                        <div class="btn-group m-b-5">
                                                            <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu animated fadeIn">
                                                                <li><a href="javascript:layer_conf('<?php echo base_url('Chelp_category/delete/'.$r->id);?>');"><i class="ion-trash-a"></i>删除</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
        					                    </tr>
        					                    <?php endforeach;?>
        					                </tbody>
    					                </table>
    					                <script>
    					                var up_status = function(url){
    					                	layer.confirm('是否确认修改上架状态？', function(index){
    					                    	window.location.href = url;
    					                    });
    					                }
    					                
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