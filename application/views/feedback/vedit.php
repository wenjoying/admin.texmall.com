<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="row">
					    <div class="col-lg-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title"><?php echo $two_level.'- 修改'?></h3>
					            </div>
					            <form class="form-horizontal" action="<?php echo base_url('Cfeedback/editPost');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
					                    <input type="hidden" name="id" value="<?php echo $res->id?>">
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">类型</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" maxlength="20" readonly value="<?php echo $res->type;?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">用户名</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" maxlength="20" readonly value="<?php echo $res->username;?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">电话</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" maxlength="20" readonly value="<?php echo $res->mobile;?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-textarea-input">反馈意见</label>
    					                    <div class="col-md-6">
    					                        <textarea rows="5" class="form-control" placeholder="..." readonly><?php echo $res->des?></textarea>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-textarea-input">回复</label>
    					                    <div class="col-md-6">
    					                        <textarea rows="5" class="form-control" name="reply" maxlength="250" placeholder="..." ></textarea>
    					                        <small class="help-block">请电话回复之后填写相关信息</small>
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