<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                
                <!-- kindeditor -->
                <link href="<?php echo inc_file('chosen/chosen.min.css', 'plugins')?>" rel="stylesheet">
                <script src="<?php echo inc_file('chosen/chosen.jquery.min.js', 'plugins')?>"></script>
                <div id="page-content">
                    <div class="row">
					    <div class="col-lg-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title"><?php echo $two_level.'- 添加'?></h3>
					            </div>
					            <form class="form-horizontal" action="<?php echo base_url('Corder/addPost');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
    					                <table class="demo-add-niftycheck table table-hover">
    					                    <thead>
        					                    <tr>
        					                        <th><div class="th-inner">选择</div></th>
            					                    <th><div class="th-inner">ID</div></th>
                                                    <th><div class="th-inner">用户</div></th>
                                                    <th><div class="th-inner">产品</div></th>
                                                    <th><div class="th-inner">供应商</div></th>
                                                    <th><div class="th-inner">编码</div></th>
                                                    <th><div class="th-inner">价格</div></th>
                                                    <th><div class="th-inner">数量</div></th>
                                                    <th><div class="th-inner">时间</div></th>
                                                    
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
        					                        <td><input type="checkbox" name="cart_id[]" value="<?php echo $r->id?>"></td>
            					                    <td><?php echo $r->id?></td>
            					                    <td><a class="btn-link" href="<?php echo base_url('Cuser/page/'.$r->uid)?>"><?php echo $r->username?></a></td>
                                                    <td><a class="btn-link" href="<?php echo base_url('Cgoods/page/'.$r->goods_id)?>"><?php echo $r->supplier_code?></a></td>
                                                    <td><a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$r->supplier_id)?>"><?php echo $r->supplier_name?></a></td>
                                                    <td><?php echo $r->supplier_code?></td>
                                                    <td><?php echo $r->price?></td>
                                                    <td><?php echo $r->number?></td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->time)?></td>
        					                    </tr>
        					                    <?php endforeach;?>
        					                </tbody>
    					                </table>
					                </div>
					                
					                <div class="panel-footer">
					                    <div class="row">
					                        <div class="col-sm-9 col-sm-offset-3">
					                            <button class="btn btn-mint" type="submit">提交</button>
					                        </div>
					                    </div>
					                </div>
					            </form>
					        </div>
					    </div>
					</div>
					<script>
					$(function(){
    
					});
					</script>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            