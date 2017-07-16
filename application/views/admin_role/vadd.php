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
					            <form class="form-horizontal" action="<?php echo base_url('Cadmin_role/addPost');?>" method="post" >
					                <div class="panel-body">
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-email-input">角色名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="role_name" required="required" maxlength="50" value="" placeholder="...">
    					                        <small class="help-block">不能重复，格式：Cuser::index</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">权限*</label>
    					                    <div class="col-md-6">
    					                        <?php foreach($action as $a):?>
                                                    <?php if($a->pid == 0) :?>
                                                        <p class="action_list">
                                                        <label class="checkbox-inline"><input type="checkbox" name="action_list[]" value="<?php echo $a->action?>"><?php echo $a->action?></label>
                                                        <?php foreach($action as $a1):?>
                                                            <?php if($a->id == $a1->pid) :?>
                                                            <label class="checkbox-inline"><input type="checkbox" name="action_list[]" value="<?php echo $a1->action?>"><?php echo $a1->action?></label>
                                                            <?php endif;?>
                                                        <?php endforeach;?>
                                                        </p>
                                                    <?php endif;?>
                                                <?php endforeach;?>
    					                        <small class="help-block">如果赋予add(新增)/edit(修改)/page(查看)/delete(删除)等权限方法，请先赋予grid(列表)</small>
    					                    </div>
    					                </div>
    					
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-email-input">菜单*</label>
    					                    <div class="col-md-6">
    					                        <input type="url" class="form-control" name="menu_list" required="required" maxlength="1" value="" placeholder="1">
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