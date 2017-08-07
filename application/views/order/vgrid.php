<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title" id="demo-bootbox-custom-h-content">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="demo-psi-repeat-2 icon-fw"></i>刷新</button></a>
					        </h3>
					    </div>
					    <div class="panel-body">
					        <form class="form-inline" action="<?php echo base_url('Corder/grid');?>" method="get">
					            <div class="form-group">
    					            <select class="selectpicker" name="state">
    	                                <option value="">请选择订单分类</option>
    	                                <?php foreach ($state_arr as $k=>$v):?>
                                        <option <?php if($this->input->get('state')==$k)echo 'selected="selected"'?> value="<?php echo $k?>"><?php echo $v?></option>
                                        <?php endforeach;?>
                                    </select>
					            </div>
					            
					            <div class="form-group">
    					            <select class="selectpicker" name="status">
    	                                <option value="">请选择订单状态</option>
    	                                <?php foreach ($status_arr as $k=>$v):?>
                                        <option <?php if($this->input->get('status')==$k)echo 'selected="selected"'?> value="<?php echo $k?>"><?php echo $v?></option>
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
					                <input type="text" class="form-control" name="item" style="width:350px;" value="<?php echo $this->input->get('item');?>" placeholder="订单号/采购商/用户">
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
                                                    <th><div class="th-inner">订单号</div></th>
                                                    <th><div class="th-inner">采购商</div></th>
                                                    <th><div class="th-inner">用户</div></th>
                                                    <th><div class="th-inner">购买种类</div></th>
                                                    <th><div class="th-inner">总价</div></th>
                                                    <th><div class="th-inner">分类</div></th>
                                                    <th><div class="th-inner">状态</div></th>
                                                    <th><div class="th-inner">时间</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr data-checkid="<?php echo $r->id?>">
            					                    <td><?php echo $r->id?></td>
                                                    <td><?php echo $r->platform_code;?></td>
                                                    <td><a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$r->buyer_id)?>"><?php echo $r->buyer_name?></a></td>
                                                    <td><a class="btn-link" href="<?php echo base_url('Cuser/page/'.$r->uid)?>"><?php echo $r->username?></a></td>
                                                    <td><?php echo $r->sum_goods?></td>
                                                    <td><?php echo $r->sum_order_price?></td>
                                                    <td><?php echo $state_arr[$r->order_state]?></td>
                                                    <td><?php echo $status_arr[$r->order_status]?></td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->time);?></td>
            					                    <td>
            					                        <a class="btn-link" href="<?php echo base_url('Corder/page/'.$r->id);?>">查看</a>|
                					                    <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Corder/delete/'.$r->id);?>');">删除</a>
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
					<div class="panel">
		                <div class="panel-heading">
		                    <h3 class="panel-title">使用说明</h3>
		                </div>
		                <div class="panel-body">
		                    <p>1.可以点击“查看”查看订单详情 </p>
		                </div>
		            </div>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            