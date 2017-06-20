<?php $this->load->view('layout/header');?>
                                
                <hr class="whiter" />
                
                <div class="block-area" id="horizontal">
                    <h3 class="block-title">修改管理员角色</h3>
                    <form class="form-horizontal" action="<?php echo base_url('Cadmin_role/editPost');?>" method="post" enctype="multipart/form-data" role="form">
                        <input type="hidden" name="id" value="<?php echo $res->id?>">
                        
                        <div class="form-group">
                            <label for="inputName1" class="col-md-2 control-label">角色名称*</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-sm" name="role_name" required="required" maxlength="50" value="<?php echo $res->role_name?>" placeholder="...">
                                <p>不能重复，超级管理员禁止修改和删除</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputName1" class="col-md-2 control-label">权限*</label>
                            <div class="col-md-8">
                                <?php $act_arr=explode('|', $res->action_list);?>
                                <?php foreach($action as $a):?>
                                    <?php if($a->pid == 0) :?>
                                        <p class="action_list">
                                        <label class="checkbox-inline"><input type="checkbox" name="action_list[]" <?php if(in_array($a->action, $act_arr)) echo 'checked="checked"';?> value="<?php echo $a->action?>"><?php echo $a->action?></label>
                                        <?php foreach($action as $a1):?>
                                            <?php if($a->id == $a1->pid) :?>
                                            <label class="checkbox-inline"><input type="checkbox" name="action_list[]" <?php if(in_array($a->action, $act_arr)) echo 'checked="checked"';?> value="<?php echo $a1->action?>"><?php echo $a1->action?></label>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                        </p>
                                    <?php endif;?>
                                <?php endforeach;?>
                                <p>如果赋予add(新增)/edit(修改)/page(查看)/delete(删除)等权限方法，请先赋予grid(列表)</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputName1" class="col-md-2 control-label">菜单*</label>
                            <div class="col-md-4">
                                <input type="number" class="form-control input-sm" name="menu_list" required="required" maxlength="1" value="<?php echo $res->menu_list?>" placeholder="1">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">简介</label>
                            <div class="col-md-4">
                                <textarea class="form-control m-b-10" name="des" maxlength="100" placeholder="..."><?php echo $res->des?></textarea>
                                <p>限100字</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" class="btn btn-info btn-sm m-t-10">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            
<?php $this->load->view('layout/footer');?>