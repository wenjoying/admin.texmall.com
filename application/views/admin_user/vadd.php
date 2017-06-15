<?php $this->load->view('layout/header');?>
                                
                <hr class="whiter" />
                
                <div class="block-area" id="horizontal">
                    <h3 class="block-title">新增后台管理员</h3>
                    <form class="form-horizontal" action="<?php echo base_url('Cadmin_user/addPost');?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="form-group">
                            <label for="inputName1" class="col-md-2 control-label">用户名*</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-sm" name="username" required="required" maxlength="20" value="" placeholder="...">
                                <p>不能与已存在的用户名重复</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-2 control-label">手机号*</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-sm" name="mobile" required="required" maxlength="11" value="" placeholder="...">
                                <p>不能与已存在的手机号重复</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-2 control-label">密码*</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control input-sm" name="password" required="required" maxlength="15" value="texmall@2017" placeholder="...">
                                <p>6-15位，默认为 texmall@2017</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-2 control-label">头像</label>
                            <div class="col-md-4">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-preview thumbnail form-control"></div>
                                    
                                    <div>
                                        <span class="btn btn-file btn-alt btn-sm">
                                            <span class="fileupload-new">选择</span>
                                            <span class="fileupload-exists">更换</span>
                                            <input type="file" name="userimg" />
                                        </span>
                                        <a href="#" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">移除</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" class="btn btn-info btn-sm m-t-10">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <script>
				$(function(){
					//验证用户名及手机号码
					var check_admin_user = function(obj, field) {
						if (!field) field = 'mobile';
						obj.blur(function(){
			                if (obj.val().trim().length > 0) {
				                var data = {};
				                data[field] = obj.val().trim();
			                	$.post(base_url+'Cadmin_user/check_admin_user', data, function(json){
			                        if(json) {
			                        	obj.val('');
			                        	layer.msg('管理员已存在',{icon:8,time:1000});
			                        }
			                    },'json');
			                }
			            });
					}
					check_admin_user($('input[name="username"]'), 'username');
					check_admin_user($('input[name="mobile"]'));
				});
                </script>
            
<?php $this->load->view('layout/footer');?>