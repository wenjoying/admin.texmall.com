<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="<?php echo base_url('Chelp_center/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a  href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="ion-load-d"></i>刷新</button></a>
					        </h3>
					        
					        
					    </div>
					    <div class="panel-body">
					
					        <form class="form-inline" action="<?php echo base_url('Chelp_center/grid');?>" method="get">
					            <div class="form-group">
    					            <select class="selectpicker" name="category_id">
    	                                <option value="">请选择分类</option>
    	                                <?php foreach($cat_arr as $k=>$v) :?>
                                        <option <?php if($this->input->get('category_id')==$k)echo 'selected="selected"'?> value="<?php echo $k?>"><?php echo $v?></option>
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
					                <input type="text" class="form-control" name="item" value="<?php echo $this->input->get('item');?>" placeholder="标题/作者">
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
                                                    <th><div class="th-inner">标题</div></th>
                                                    <th><div class="th-inner">作者</div></th>
                                                    <th><div class="th-inner">排序</div></th>
                                                    <th><div class="th-inner">状态</div></th>
                                                    <th><div class="th-inner">时间</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><?php echo $r->id?></td>
                                                    <td><?php echo $cat_arr[$r->category_id]?></td>
                                                    <td><?php echo $r->title?></td>
                                                    <td><?php echo $r->author?></td>
                                                    <td><?php echo $r->reorder?></td>
                                                    <td>
                                                        <a class="btn-link" href="javascript:up_status('<?php echo base_url('Chelp_center/up_status/'.$r->id.'?status='.$r->status);?>');">
                                                        <?php echo $r->status==1 ? '<i class="ion-checkmark"></i>' : '<i class="ion-close"></i>'?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->time);?></td>
            					                    <td>
                					                    <a class="btn-link" href="<?php echo base_url('Chelp_center/edit/'.$r->id);?>">编辑</a>|
                					                    <a class="btn-link" href="###" onclick="layer_conf('<?php echo base_url('Chelp_center/delete/'.$r->id);?>');">删除</a>
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
    					                
    					                //时间
    					                $('input.date-select').datepicker({
					                		format: "yyyy-mm-dd",
					                        todayBtn: "linked",
					                        autoclose: true,
					                        todayHighlight: true
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