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
					            <form class="form-horizontal" action="<?php echo base_url('Cthird_manage/addPost');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="name" required="required" maxlength="20" value="" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">地址*</label>
    					                    <div class="col-md-6">
    					                        <input type="url" class="form-control" name="third_url" required="required" maxlength="100" value="" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">用户名*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="username" required="required" maxlength="20" value="" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">密码*</label>
    					                    <div class="col-md-6">
    					                        <input type="password" class="form-control" autocomplete="off" name="password" required="required" maxlength="20" value="" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-textarea-input">备注</label>
    					                    <div class="col-md-6">
    					                        <textarea rows="5" class="form-control" placeholder="..." name="note" maxlength="100"></textarea>
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