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
					            <form class="form-horizontal" action="<?php echo base_url('Csupplier_buyer/editPost');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
    					                <input type="hidden" name="id" value="<?php echo $res->id?>">
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">公司类型*</label>
    					                    <div class="col-md-6">
    					                        <div class="radio">
    					                            <select class="selectpicker" required="required" name="type">
                                                        <option <?php if($res->type==1) echo 'selected="selected"'?> value="1">采购商</option>
                                                        <option <?php if($res->type==2) echo 'selected="selected"'?> value="2">供应商</option>
                                                    </select>
    					                        </div>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">公司名称*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="company_name" required="required" maxlength="100" value="<?php echo $res->company_name?>" placeholder="...">
    					                        <small class="help-block">不能重复</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">地址</label>
    					                    <div class="col-md-6">
    					                        <select name="province_id" data-val="<?php echo $res->province_id?>" style="height: 32px;width: 200px;background-color: #fafafa;border-color: #d1d9de;color: #758697;">
                	                                <option value="">请选择</option>
                                                </select>
                                                <select name="city_id" data-val="<?php echo $res->city_id?>" style="height: 32px;width: 200px;background-color: #fafafa;border-color: #d1d9de;color: #758697;">
                	                                <option value="">请选择</option>
                                                </select>
                                                <select name="district_id" data-val="<?php echo $res->district_id?>" style="height: 32px;width: 200px;background-color: #fafafa;border-color: #d1d9de;color: #758697;">
                	                                <option value="">请选择</option>
                                                </select>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">详细地址*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="ads_des" required="required" maxlength="100" value="<?php echo $res->ads_des?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">联系电话*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="office_tel" required="required" maxlength="20" value="<?php echo $res->office_tel?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">主营产品*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="main_business" required="required" maxlength="20" value="<?php echo $res->main_business?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-textarea-input">简介</label>
    					                    <div class="col-md-6">
    					                        <textarea rows="5" class="form-control" placeholder="..." name="des"><?php echo $res->des?></textarea>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">审核状态*</label>
    					                    <div class="col-md-6">
    					                        <div class="radio">
    					                            <select class="selectpicker" required="required" name="status">
                    	                                <option value="">请选择</option>
                                                        <option <?php if($res->status==1)echo 'selected="selected"'?> value="1">正在审核</option>
                                                        <option <?php if($res->status==2)echo 'selected="selected"'?> value="2">审核通过</option>
                                                        <option <?php if($res->status==3)echo 'selected="selected"'?> value="3">审核不通过</option>
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
                                                        <option <?php if($res->platform_grade==1)echo 'selected="selected"'?> value="1">正常</option>
                                                        <option <?php if($res->platform_grade==2)echo 'selected="selected"'?> value="2">推荐</option>
                                                        <option <?php if($res->platform_grade==3)echo 'selected="selected"'?> value="3">严选</option>
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
								var val = obj.data('val');
								$.post(base_url+'Csupplier_buyer/get_dis', {pid:pid}, function(json){
									dis[pid] = '<option value="">请选择</option>';
									for(var i=0;i<json.length;i++){
										dis[pid] += '<option ';
										if(json[i].id==val){
											dis[pid] += 'selected="selected"'
										}
										dis[pid] += ' value="'+json[i].id+'">'+json[i].district_name+'</option>';
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
						get_dis(p_id.data('val'), c_id);
						get_dis(c_id.data('val'), d_id);
						
						p_id.on('change', function(){
							d_id.html('<option value="">请选择</option>');
							get_dis($(this).val(), c_id);
						});
						c_id.on('change', function(){
							get_dis($(this).val(), d_id);
						});

						
    					//获取供应商采购商名称
    					var check_exists = function(obj) {
    						obj.blur(function(){
    			                if (obj.val().trim().length > 0) {
    			                	$.post(base_url+'Csupplier_buyer/check_exists', {company_name:obj.val().trim()}, function(json){
    			                        if(json.status) {
        			                        if(json.companyid != $('input[name="id"]').val()){
        			                        	obj.val('');
        			                        	layer.msg('公司名称已存在',{icon:8,time:1000});
            			                    }
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