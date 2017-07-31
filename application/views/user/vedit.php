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
					            <form class="form-horizontal" action="<?php echo base_url('Cuser/editPost');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
    					                <input type="hidden" name="id" value="<?php echo $res->id?>">
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label">头像</label>
    					                    <div class="col-md-6">
    					                        <input type="file" class="form-control" style="height: 100px;opacity: 0;width: 100px;" name="userimg">
    					                        <div style="float:left;margin-top: -100px;height: 100px;width: 100px;border:1px solid #e9e9e9;"><img height=100 width=100 src="<?php echo $this->config->image_url.$res->userimg?>"></div>
    					                        <small class="help-block">2M以内</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">昵称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="username" required="required" maxlength="20" value="<?php echo $res->username?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">手机号*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="mobile" readonly maxlength="11" value="<?php echo $res->mobile?>" placeholder="...">
					                            <small class="help-block">不能重复</small>   
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">密码</label>
    					                    <div class="col-md-6">
    					                        <input type="password" class="form-control" name="password"  maxlength="20" value="" placeholder="...">
    					                        <small class="help-block">留空则不修改</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">身份证</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="id_card" maxlength="18" value="<?php echo $res->id_card?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">角色*</label>
					                        <div class="col-md-6">
    					                        <input type="text" class="form-control" name="role_id" readonly value="<?php foreach($role as $r){if($res->role_id==$r->role_id)echo $r->role_name.' ';}?>" placeholder="...">
    					                    </div>
    					                </div>
    					                <?php if(empty($res->companyid)):?>
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">企业名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="hidden" name="companyid" value="">
    					                        <input type="text" class="form-control" name="company" maxlength="100" required="required" value="" placeholder="...">
    					                    </div>
    					                </div>
    					                <?php endif;?>
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">职位</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="positions" maxlength="20" value="" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">性别</label>
    					                    <div class="col-md-6">
					                            <select class="selectpicker" name="sex">
                	                                <option <?php if($res->sex==3)echo 'selected="selected"'?> value="3">保密</option>
                                                    <option <?php if($res->sex==1)echo 'selected="selected"'?> value="1">男</option>
                                                    <option <?php if($res->sex==2)echo 'selected="selected"'?> value="2">女</option>
                                                </select>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">生日</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control date-select" name="birthday" maxlength="20" value="<?php echo $res->birthday?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">管理员</label>
    					                    <div class="col-md-6">
					                            <select class="selectpicker" name="set_manager">
                                                    <option value="0">否</option>
                                                    <option value="1">是</option>
                                                </select>
                                                <small class="help-block">一个企业仅有一个管理员</small> 
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
    
    					//验证用户企业名称
    					var check_exists = function(obj) {
    						obj.blur(function(){
    			                if (obj.val().trim().length > 0) {
        			                var type = '<?php echo $res->role_id?>';
    			                	$.post(base_url+'Csupplier_buyer/check_exists', {company_name:obj.val().trim(), type:type}, function(json){
    			                        if(json.status) {
    			                        	obj.val(json.company_name);
    			                        	$('input[name="companyid"]').val(json.companyid);
    			                        }else{
    			                        	layer.msg('企业名称不存在',{icon:8,time:1000});
        			                    }
    			                    },'json');
    			                }
    			            });
    					}
    					check_exists($('input[name="company"]'));
					});
					</script>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            