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
					        <form class="form-inline" action="<?php echo base_url('Corder_goods/grid');?>" method="get">
					            <div class="form-group" style="margin-bottom: 15px;">
					                <input type="text" class="form-control date-select" style="margin-top: 15px;" name="sta_time" value="<?php echo $this->input->get('sta_time');?>" placeholder="开始时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="end_time" value="<?php echo $this->input->get('end_time');?>" placeholder="截至时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" style="width:350px;" value="<?php echo $this->input->get('item');?>" placeholder="订单号/供应商/型号/用户名">
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
                                                    <th><div class="th-inner">型号</div></th>
                                                    <th><div class="th-inner">供应商</div></th>
                                                    <th><div class="th-inner">原价</div></th>
                                                    <th><div class="th-inner">订单价</div></th>
                                                    <th><div class="th-inner">数量</div></th>
                                                    <th><div class="th-inner">总价</div></th>
                                                    <th><div class="th-inner">时间</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><?php echo $r->id?></td>
            					                    <td><a class="btn-link" href="<?php echo base_url('Corder/page/'.$r->order_id)?>"><?php echo $r->platform_code?></a></td>
                                                    <td><a class="btn-link" href="<?php echo base_url('Cgoods/page/'.$r->goods_id)?>"><?php echo $r->supplier_code?></a></td>
                                                    <td><a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$r->supplier_id)?>"><?php echo $r->supplier_name?></a></td>
                                                    <td><?php echo $r->price?>元/米</td>
                                                    <td><?php echo $r->order_price?>元/米</td>
                                                    <td><?php echo $r->number?>米</td>
                                                    <td><?php echo $r->sum_goods_price?>元</td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->time);?></td>
            					                    <td>
                					                    <a class="btn-link" href="<?php echo base_url('Corder_goods/page/'.$r->id)?>">查看</a>|
                					                    <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Corder_goods/delete/'.$r->id);?>');">删除</a>
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