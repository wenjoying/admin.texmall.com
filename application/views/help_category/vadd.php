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
					            <form class="form-horizontal" action="<?php echo base_url('Chelp_category/addPost');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">类型*</label>
    					                    <div class="col-md-6">
					                            <select class="selectpicker" name="type" required="required">
                	                                <option value="">请选择类型</option>
                                                    <option value="news">资讯</option>
                                                    <option value="help">帮助</option>
                                                </select>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-email-input">类名*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="category_name" required="required" maxlength="20" value="" placeholder="...">
    					                        <small class="help-block">不能重复</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-email-input">排序*</label>
    					                    <div class="col-md-6">
    					                        <input type="number" class="form-control" name="reorder" required="required" maxlength="8" value="9" placeholder="...">
    					                        <small class="help-block">数字越大，排序越后</small>
    					                    </div>
    					                </div>
    					
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">状态*</label>
    					                    <div class="col-md-6">
					                            <select class="selectpicker" name="status" required="required">
                                                    <option value="1">上架</option>
                                                    <option value="2">下架</option>
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
    					
					});
					</script>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            