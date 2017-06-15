<?php $this->load->view('layout/header');?>
                                
                <hr class="whiter" />
                
                <div class="block-area" id="horizontal">
                    <h3 class="block-title">新增广告图&轮播图</h3>
                    <form class="form-horizontal" action="<?php echo base_url('Cad_img/addPost');?>" method="post" enctype="multipart/form-data" role="form">
                        
                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-2 control-label">广告图*</label>
                            <div class="col-md-4">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-preview thumbnail form-control"></div>
                                    
                                    <div>
                                        <span class="btn btn-file btn-alt btn-sm">
                                            <span class="fileupload-new">选择</span>
                                            <span class="fileupload-exists">更换</span>
                                            <input type="file" name="ad_img" required="required" />
                                        </span>
                                        <a href="#" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">移除</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">名称*</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-sm" name="ad_name" required="required" maxlength="20" value="" placeholder="...">
                                <p>仅英文和数字</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">简介</label>
                            <div class="col-md-4">
                                <textarea class="form-control m-b-10" name="ad_info" maxlength="100" placeholder="..."></textarea>
                                <p>限100字</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">跳转地址</label>
                            <div class="col-md-4">
                                <input type="url" class="form-control input-sm" name="ad_url" maxlength="100" value="" placeholder="...">
                                <p>完整地址，如http://texmall.com</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">排序*</label>
                            <div class="col-md-4">
                                <input type="number" class="form-control input-sm" name="reorder" required="required" maxlength="1" value="9" placeholder="...">
                                <p>数值越大排序越后</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">上线状态*</label>
                            <div class="col-md-4">
                                <label class="radio-inline">
                                    <span class="checkableBox checkableBox-radio">    
                                        <input type="radio" class="validate[required]" name="status" checked="checked" value="1">
                                    </span>
                                                                                            上线
                                </label>
                                <label class="radio-inline">
                                    <span class="checkableBox checkableBox-radio"> 
                                        <input type="radio" class="validate[required]" name="status" value="2">
                                    </span>
                                                                                             下线
                                </label>
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
					//只能输入英文与数字
					var ad_name = $('input[name="ad_name"]');
					var eng = /^[0-9a-zA-Z]*$/;
					ad_name.blur(function(){
						if(($(this).val().trim()).length > 0) { 
							if(eng.test($(this).val().trim())) {
								$(this).val('');
							}
						}
					});


					
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