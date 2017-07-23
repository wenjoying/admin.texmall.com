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
					            <form class="form-horizontal" action="<?php echo base_url('Corder/add');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">采购商用户id*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="uid" required="required" maxlength="10" value="" placeholder="...">
    					                        <small class="help-block">仅填数字</small>
    					                    </div>
    					                </div>
					                </div>
					                
					                <div class="panel-footer">
					                    <div class="row">
					                        <div class="col-sm-9 col-sm-offset-3">
					                            <button class="btn btn-mint" type="submit">提交订单</button>
					                        </div>
					                    </div>
					                </div>
					            </form>
					            <form class="form-horizontal" action="<?php echo base_url('Cgoods_cart/addPost');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label">主图</label>
    					                    <div class="col-md-6">
    					                        <input type="hidden" name="goods_id" value="<?php echo $res->id?>">
    					                        <input type="hidden" name="cover_img" value="<?php echo $res->cover_img?>">
    					                        <div style="height: 100px;width: 100px;border:1px solid #e9e9e9;"><img height=100 width=100 src="<?php echo $this->config->image_url.$res->cover_img?>"></div>
    					                    </div>
    					                </div>
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">供应商</label>
    					                    <div class="col-md-6">
    					                        <input type="hidden" name="supplier_id" value="<?php echo $res->supplier_id;?>">
    					                        <input type="text" class="form-control" name="supplier_name" readonly maxlength="100" value="<?php echo $res->supplier_name;?>" placeholder="...">
    					                        <small class="help-block">填写供应商名称</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">供应商型号</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="supplier_code" readonly maxlength="20" value="<?php echo $res->supplier_code?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">价格</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="price" readonly maxlength="10" value="<?php echo $res->price?>" placeholder="...">
    					                        <small class="help-block">仅填数字，单位：元/米</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">采购商用户id*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="uid" required="required" maxlength="10" value="" placeholder="...">
    					                        <small class="help-block">仅填数字</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">数量*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="number" required="required" maxlength="10" value="" placeholder="...">
    					                        <small class="help-block">仅填数字，单位：米</small>
    					                    </div>
    					                </div>
    					
					                </div>
					                
					                <div class="panel-footer">
					                    <div class="row">
					                        <div class="col-sm-9 col-sm-offset-3">
					                            <button class="btn btn-mint" type="submit">添加购物车</button>
					                        </div>
					                    </div>
					                </div>
					            </form>
					        </div>
					    </div>
					</div>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            