<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="row">
                        <div class="col-lg-12">
    				        <div class="panel">
    				            <div class="panel-heading">
    				                <h3 class="panel-title"><?php echo $two_level.' - 修改'?></h3>
    				            </div>
    				
    				            <form class="form-horizontal" action="<?php echo base_url('Cad_img/editPost');?>" method="post" enctype="multipart/form-data">
    				                <div class="panel-body">
    					                <input type="hidden" name="id" value="<?php echo $res->id?>">
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label">图片*</label>
    					                    <div class="col-md-6">
    					                        <input type="file" class="form-control" style="height: 100px;opacity: 0;width: 100px;" name="ad_img">
    					                        <div style="float:left;margin-top: -100px;height: 100px;width: 100px;border:1px solid #e9e9e9;"><img height=100 width=100 src="<?php echo $this->config->image_url.$res->ad_img?>"></div>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="ad_name" required="required" maxlength="20" value="<?php echo$res->ad_name?>" placeholder="...">
    					                        <small class="help-block">仅英文和数字</small>
    					                    </div>
    					                </div>
    					
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-email-input">跳转地址</label>
    					                    <div class="col-md-6">
    					                        <input type="url" class="form-control" name="ad_url" maxlength="100" value="<?php echo $res->ad_url=='javascript:;' ? '' : $res->ad_url;?>" placeholder="...">
    					                        <small class="help-block">完整地址，如http://texmall.com</small>
    					                    </div>
    					                </div>
    					
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-textarea-input">简介</label>
    					                    <div class="col-md-6">
    					                        <textarea rows="5" class="form-control" placeholder="..." name="ad_info" maxlength="100"><?php echo $res->ad_info?></textarea>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="reorder" required="required" maxlength="1" value="<?php echo $res->reorder?>" placeholder="...">
    					                        <small class="help-block">数值越大排序越后</small>
    					                    </div>
    					                </div>
    					
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">上线状态*</label>
    					                    <div class="col-md-6">
    					                        <select class="selectpicker" name="status">
                	                                <option value="">请选择状态</option>
                                                    <option <?php if($res->status==1)echo 'selected="selected"'?> value="1">上线</option>
                                                    <option <?php if($res->status==2)echo 'selected="selected"'?> value="2">下线</option>
                                                </select>
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
    					
    				});
                    </script>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            