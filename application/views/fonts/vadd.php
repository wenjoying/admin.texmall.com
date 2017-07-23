<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="row">
					    <div class="col-lg-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title"><?php echo $two_level.'- 添加'?></h3>
					            </div>
					            <form class="form-horizontal" action="<?php echo base_url('Cfonts/addPost');?>" method="post">
					                <div class="panel-body">
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="fonts_name" required="required" maxlength="20" value="" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">上架状态*</label>
    					                    <div class="col-md-6">
    					                        <div class="radio">
    					                            <select class="selectpicker" required="required" name="status">
                    	                                <option value="">请选择</option>
                                                        <option value="1">上架</option>
                                                        <option value="2">下架</option>
                                                    </select>
    					                        </div>
    					                    </div>
    					                </div>
    					                
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
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            