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
					            <form class="form-horizontal" action="<?php echo base_url('Cadmin_action/addPost');?>" method="post" >
					                <div class="panel-body">
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">父级方法</label>
    					                    <div class="col-md-6">
    					                        <select class="selectpicker" name="pid">
                	                                <option value="">请选择父级</option>
                	                                <?php foreach ($p_action as $p) :?>
                                                    <option value="<?php echo $p->id?>"><?php echo $p->action.'('.$p->des.')'?></option>
                                                    <?php endforeach;?>
                                                </select>
    					                        <small class="help-block">不选择即为顶级，格式：Cuser::index</small>
    					                    </div>
    					                </div>
    					
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-email-input">权限方法*</label>
    					                    <div class="col-md-6">
    					                        <input type="url" class="form-control" name="action" required="required" maxlength="50" value="" placeholder="...">
    					                        <small class="help-block">不能重复，格式：Cuser::index</small>
    					                    </div>
    					                </div>
    					
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-textarea-input">简介</label>
    					                    <div class="col-md-6">
    					                        <textarea rows="5" class="form-control" placeholder="..." name="des" maxlength="100"></textarea>
    					                        <small class="help-block">限100字</small>
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