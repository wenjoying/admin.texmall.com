<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                <link href="<?php inc_file('bootstrap-tagsinput/bootstrap-tagsinput.min.css', 'plugins')?>" rel="stylesheet">
                <script src="<?php inc_file('bootstrap-tagsinput/bootstrap-tagsinput.min.js', 'plugins')?>"></script>
                    <div class="row">
					    <div class="col-lg-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title"><?php echo $two_level.'- 添加'?></h3>
					            </div>
					            <form class="form-horizontal" action="<?php echo base_url('Cgoods_recom/editPost');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
					                    <input type="hidden" name="id" value="<?php echo $res->id?>">
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="en_name" required="required" maxlength="20" value="<?php echo $res->en_name?>" placeholder="...">
    					                        <small class="help-block">不能重复，仅能输入英文</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">中文名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="zh_name" required="required" maxlength="20" value="<?php echo $res->zh_name?>" placeholder="...">
    					                        <small class="help-block">不能重复，中文</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-textarea-input">产品id串*</label>
    					                    <div class="col-md-6">
        					                    <input class="form-control" style="display: none;" type="text" name="des" placeholder="产品id" value="<?php echo $res->des?>" data-role="tagsinput">
    					                        <small class="help-block">产品id，按“Enter”键增加</small>
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
    					//数字验证
    					$('input[name="en_name"]').blur(function(){
        					if($(this).val().trim().length > 0){
            					if(/^[_a-zA-Z]+$/.test($(this).val().trim()) == false){
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