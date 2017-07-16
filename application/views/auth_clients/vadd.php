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
					            <form class="form-horizontal" action="<?php echo base_url('Cauth2/addPost');?>" method="post" >
					                <div class="panel-body">
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">应用名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="appname" required="required" maxlength="20" value="" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">回调地址*</label>
    					                    <div class="col-md-6">
    					                        <input type="url" class="form-control" name="redirect_uri" required="required" maxlength="100" value="" placeholder="...">
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