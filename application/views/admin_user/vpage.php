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
					            <form class="form-horizontal" action="<?php echo base_url('Cadmin_user/editPost');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
					                    <input type="hidden" name="id" value="<?php echo $res->id?>">
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label">头像</label>
    					                    <div class="col-md-6">
    					                        <input type="file" class="form-control" style="height: 100px;opacity: 0;width: 100px;" name="userimg">
    					                        <div style="float:left;margin-top: -100px;height: 100px;width: 100px;border:1px solid #e9e9e9;"><img height=100 width=100 src="<?php echo $this->config->image_url.$res->userimg;?>"></div>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">用户名*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="username" required="required" maxlength="20" value="<?php echo $res->username;?>" placeholder="...">
    					                        <small class="help-block">不能与已存在的用户名重复</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">手机号*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="mobile" required="required" maxlength="11" value="<?php echo $res->mobile;?>" placeholder="...">
    					                        <small class="help-block">不能与已存在的手机号重复</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">密码*</label>
    					                    <div class="col-md-6">
    					                        <input type="password" class="form-control" name="password" required="required" maxlength="15" value="" placeholder="...">
    					                        <small class="help-block">6-15位，不填写则不修改</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">角色*</label>
    					                    <div class="col-md-6">
    					                        <div class="radio">
    					                            <?php if(isset($user_role_name)):?>
    					                            <?php echo $user_role_name?>
    					                            <?php else :?>
    					                            <select class="selectpicker" name="role_id">
                    	                                <option value="">请选择角色</option>
                    	                                <?php foreach($role as $r) :?>
                                                        <option <?php if($r->id==$res->role_id) echo 'selected="selected"';?> value="<?php echo $r->id?>"><?php echo $r->role_name?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <?php endif;?>
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
					<script>
					$(function(){
    					//图片预览
    					$('.form-group').find('input[type="file"]').change(function(){
    						var img = '<img height=100 width=100 src="'+window.URL.createObjectURL(this.files[0])+'">';
    						$(this).siblings('div').html(img);
    					}); 
    
    					//验证用户名及手机号码
    					var check_exists = function(obj, field) {
    						if (!field) field = 'mobile';
    						obj.blur(function(){
    			                if (obj.val().trim().length > 0) {
    				                var data = {};
    				                data[field] = obj.val().trim();
    			                	$.post(base_url+'Cadmin_user/check_exists', data, function(json){
    			                        if(json) {
    			                        	obj.val('');
    			                        	layer.msg('管理员已存在',{icon:8,time:1000});
    			                        }
    			                    },'json');
    			                }
    			            });
    					}
    					check_exists($('input[name="username"]'), 'username');
    					check_exists($('input[name="mobile"]'));
					});
					</script>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            