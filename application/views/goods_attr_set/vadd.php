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
					            <form class="form-horizontal" action="<?php echo base_url('Cgoods_attr_set/addPost');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">英文属性名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="attr_en_name" required="required" maxlength="20" value="" placeholder="...">
    					                        <small class="help-block">不能重复，仅能输入英文</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">属性名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="attr_name" required="required" maxlength="20" value="" placeholder="...">
    					                        <small class="help-block">不能重复，中文</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-textarea-input">属性值*</label>
    					                    <div class="col-md-6">
    					                        <textarea rows="5" class="form-control" placeholder="..." name="attr_val" required="required" maxlength="500"></textarea>
    					                        <small class="help-block">请用英文逗号（,）隔开</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">是否多选*</label>
    					                    <div class="col-md-6">
					                            <select class="selectpicker" name="is_multi" required="required">
                	                                <option value="">请选择</option>
                                                    <option value="1">多选</option>
                                                    <option value="2">单选</option>
                                                </select>
    					                    </div>
    					                </div>
    					
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">是否显示*</label>
    					                    <div class="col-md-6">
					                            <select class="selectpicker" name="is_show" required="required">
                	                                <option value="">请选择</option>
                                                    <option value="1">显示</option>
                                                    <option value="2">隐藏</option>
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
    					//英文验证
    					$('input[name="attr_en_name"]').blur(function(){
        					if($(this).val().trim().length > 0){
            					if(/^[a-zA-Z]+$/.test($(this).val().trim()) == false){
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