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
					
					        <form class="form-inline" action="<?php echo base_url('Csearch_log/grid');?>" method="get">
					            <div class="form-group">
    					            <select class="selectpicker" name="type">
    	                                <option value="">请选择类型</option>
                                        <option <?php if($this->input->get('type')=='1')echo 'selected="selected"'?> value="1">文字</option>
                                        <option <?php if($this->input->get('type')=='2')echo 'selected="selected"'?> value="2">图片(产品)</option>
                                        <option <?php if($this->input->get('type')=='3')echo 'selected="selected"'?> value="3">供应商店铺</option>
                                    </select>
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="sta_time" value="<?php echo $this->input->get('sta_time');?>" placeholder="开始时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="end_time" value="<?php echo $this->input->get('end_time');?>" placeholder="截至时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="number" class="form-control" name="uid" value="<?php echo $this->input->get('uid');?>" placeholder="用户id">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" style="width:350px;" value="<?php echo $this->input->get('item');?>" placeholder="用户名/搜索内容">
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
                                                    <th><div class="th-inner">用户名</div></th>
                                                    <th><div class="th-inner">类型</div></th>
                                                    <th><div class="th-inner">内容</div></th>
                                                    <th><div class="th-inner">次数</div></th>
                                                    <th><div class="th-inner">时间</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><?php echo $r->id?></td>
            					                    <td><?php echo $r->username?></td>
                                                    <td><?php echo $r->type?></td>
                                                    <td><?php echo $r->note?></td>
                                                    <td><?php echo $r->num?></td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->time);?></td>
            					                    <td>
            					                        <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Csearch_log/delete/'.$r->id);?>');">删除</a>
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
					<div class="panel">
		                <div class="panel-heading">
		                    <h3 class="panel-title">使用说明</h3>
		                </div>
		                <div class="panel-body">
		                    <p>所有用户的搜索记录，可以按用户id搜索。</p>
		                </div>
		            </div>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            