<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                
                <!-- kindeditor -->
                <div id="page-content">
                    <div class="row">
					    <div class="col-lg-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title"><?php echo $two_level.'- 添加'?></h3>
					            </div>
					            <form class="form-horizontal" action="<?php echo base_url('Csupplier_buyer/addPost');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">公司类型*</label>
    					                    <div class="col-md-6">
    					                        <div class="radio">
    					                            <select class="selectpicker" required="required" name="type">
                                                        <option value="1">采购商</option>
                                                        <option value="2">供应商</option>
                                                    </select>
    					                        </div>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">公司名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="company_name" required="required" maxlength="100" value="" placeholder="...">
    					                        <small class="help-block">不能重复</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">地址*</label>
    					                    <div class="col-md-6">
    					                        <select required="required" name="province_id" style="height: 32px;width: 200px;background-color: #fafafa;border-color: #d1d9de;color: #758697;">
                	                                <option value="">请选择</option>
                                                </select>
                                                <select required="required" name="city_id" style="height: 32px;width: 200px;background-color: #fafafa;border-color: #d1d9de;color: #758697;">
                	                                <option value="">请选择</option>
                                                </select>
                                                <select required="required" name="district_id" style="height: 32px;width: 200px;background-color: #fafafa;border-color: #d1d9de;color: #758697;">
                	                                <option value="">请选择</option>
                                                </select>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">详细地址*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="ads_des" required="required" maxlength="100" value="" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">联系电话*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="office_tel" required="required" maxlength="20" value="" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">主营产品*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="main_business" required="required" maxlength="20" value="" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-textarea-input">简介</label>
    					                    <div class="col-md-6">
    					                        <textarea rows="5" class="form-control" placeholder="..." name="des"></textarea>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">审核状态*</label>
    					                    <div class="col-md-6">
    					                        <div class="radio">
    					                            <select class="selectpicker" required="required" name="status">
                    	                                <option value="">请选择</option>
                                                        <option value="1">正在审核</option>
                                                        <option value="2">审核通过</option>
                                                        <option value="3">审核不通过</option>
                                                    </select>
    					                        </div>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">等级*</label>
    					                    <div class="col-md-6">
    					                        <div class="radio">
    					                            <select class="selectpicker" required="required" name="platform_grade">
                    	                                <option value="">请选择</option>
                                                        <option value="1">正常</option>
                                                        <option value="2">推荐</option>
                                                        <option value="3">严选</option>
                                                    </select>
    					                        </div>
    					                        <small class="help-block">此公司下的所有产品为选择的等级</small>
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
						var dis = new Array();
						var get_dis = function(pid, obj){
							if(dis[pid]==undefined){console.log(dis[pid]);
								$.post(base_url+'Csupplier_buyer/get_dis', {pid:pid}, function(json){
									dis[pid] = '<option value="">请选择</option>';
									for(var i=0;i<json.length;i++){
										dis[pid] += '<option value="'+json[i].id+'">'+json[i].district_name+'</option>';
									}
									obj.html(dis[pid]);
								}, 'json');
							}else{
								obj.html(dis[pid]);
							}
						}

						var p_id = $('select[name="province_id"]');
						var c_id = $('select[name="city_id"]');
						var d_id = $('select[name="district_id"]');
						
						get_dis(0, p_id);
						p_id.on('change', function(){
							d_id.html('<option value="">请选择</option>');
							get_dis($(this).val(), c_id);
						});
						c_id.on('change', function(){
							get_dis($(this).val(), d_id);
						});

						
    					//获取供应商名称
    					var check_exists = function(obj) {
    						obj.blur(function(){
    			                if (obj.val().trim().length > 0) {
    			                	$.post(base_url+'Csupplier_buyer/check_exists', {company_name:obj.val().trim()}, function(json){
    			                        if(json.status) {
    			                        	obj.val('');
    			                        	layer.msg('公司名称已存在',{icon:8,time:1000});
        			                    }
    			                    },'json');
    			                }
    			            });
    					}
    					check_exists($('input[name="company_name"]'));
					});
					</script>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            