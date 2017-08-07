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
					            <form class="form-horizontal" action="<?php echo base_url('Cgoods_attr_set/editPost');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
    					                <input type="hidden" name="id" value="<?php echo $res->id?>">
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">英文属性名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" readonly name="attr_en_name" maxlength="20" value="<?php echo $res->attr_en_name?>" placeholder="...">
    					                        <small class="help-block">不能重复，仅能输入英文</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">属性名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" readonly name="attr_name" maxlength="20" value="<?php echo $res->attr_name?>" placeholder="...">
    					                        <small class="help-block">不能重复，中文</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-textarea-input">属性值*</label>
    					                    <div class="col-md-6">
    					                        <textarea rows="5" class="form-control" placeholder="..." name="attr_val" required="required" maxlength="500"><?php echo $res->attr_val?></textarea>
    					                        <small class="help-block">请用英文逗号（,）隔开</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">是否多选*</label>
    					                    <div class="col-md-6">
					                            <select class="selectpicker" name="is_multi" required="required">
                	                                <option value="">请选择</option>
                                                    <option <?php if($res->is_multi==1) echo 'selected="selected"'?> value="1">多选</option>
                                                    <option <?php if($res->is_multi==2) echo 'selected="selected"'?> value="2">单选</option>
                                                </select>
    					                    </div>
    					                </div>
    					
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">是否上架*</label>
    					                    <div class="col-md-6">
					                            <select class="selectpicker" name="status" required="required">
                	                                <option value="">请选择</option>
                                                    <option <?php if($res->status==1) echo 'selected="selected"'?> value="1">上架</option>
                                                    <option <?php if($res->status==2) echo 'selected="selected"'?> value="2">下架</option>
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