<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title" id="demo-bootbox-custom-h-content">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="<?php echo base_url('Cauthenticate_personal/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a class="btn-link" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="demo-psi-repeat-2 icon-fw"></i>刷新</button></a>
					        </h3>
					    </div>
					    <div class="panel-body">
					        <form class="form-inline" action="<?php echo base_url('Cauthenticate_personal/grid');?>" method="get">
					            <div class="form-group">
    					            <select class="selectpicker" name="is_check">
    	                                <option value="">请选择状态</option>
    	                                <?php foreach($status_arr as $k=>$v):?>
                                        <option <?php if($this->input->get('is_check')==$k)echo 'selected="selected"'?> value="<?php echo $k?>"><?php echo $v?></option>
                                        <?php endforeach;?>
                                        
                                    </select>
					            </div>
					            
					            <div class="form-group" id="get_province">
    					            <select name="province_id" data-selected="<?php echo $this->input->get('province_id')?>" style="height: 32px;width: 220px;background-color: #fafafa;border-color: #d1d9de;color: #758697;">
    	                                <option value="">请选择省份</option>
                                    </select>
					            </div>
					            
					            <div class="form-group" id="get_city">
    					            <select name="city_id" data-selected="<?php echo $this->input->get('city_id')?>" style="height: 32px;width: 220px;background-color: #fafafa;border-color: #d1d9de;color: #758697;">
    					               <option value="">请选择城市</option>
    					            </select>
					            </div>
					            
					            <div class="form-group" style="margin-bottom: 15px;">
					                <input type="text" class="form-control date-select" style="margin-top: 15px;" name="sta_time" value="<?php echo $this->input->get('sta_time');?>" placeholder="开始时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="end_time" value="<?php echo $this->input->get('end_time');?>" placeholder="截至时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" style="width:350px;" value="<?php echo $this->input->get('item');?>" placeholder="真名/身份证/开户行/卡号">
					            </div>
					            
					            <button class="btn btn-primary" type="submit">搜索</button>
					        </form>
					
					    </div>
					</div>
                    <div class="row">
				        <div class="panel">
				            <div class="panel-body">
				                <div class="bootstrap-table">
					                <div class="fixed-table-container" >
    					                <table class="demo-add-niftycheck table table-hover">
    					                    <thead>
        					                    <tr>
            					                    <th><div class="th-inner">ID</div></th>
                                                    <th><div class="th-inner">申请人</div></th>
                                                    <th><div class="th-inner">开户行</div></th>
                                                    <th><div class="th-inner">开户地址</div></th>
                                                    <th><div class="th-inner">银行卡</div></th>
                                                    <th><div class="th-inner">打款金额</div></th>
                                                    <th><div class="th-inner">状态</div></th>
                                                    <th><div class="th-inner">时间</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr data-checkid="<?php echo $r->id?>" data-username="<?php echo $r->realname?>">
            					                    <td><?php echo $r->id?></td>
                                                    <td><a class="btn-link" href="<?php echo base_url('Cuser/page/'.$r->uid)?>"><?php echo $r->realname?></a></td>
                                                    <td><?php echo $r->bank_name.$r->bank_branch?></td>
                                                    <td><?php echo $r->bank_address?></td>
                                                    <td><?php echo $r->bank_card?></td>
                                                    <td><?php if($r->validate_money) echo $r->validate_money*0.01?></td>
                                                    <td><span style="color:red;"><?php echo $status_arr[$r->is_check]?></span></td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->time);?></td>
            					                    <td>
            					                        <a class="btn-link" href="<?php echo base_url('Cauthenticate_personal/page/'.$r->id);?>">查看</a>|
            					                        <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Cauthenticate_personal/delete/'.$r->id);?>');">删除</a>
                                                    </td>
        					                    </tr>
        					                    <?php endforeach;?>
        					                </tbody>
    					                </table>
    					                <script>

    									var get_city = function(){
    										var p_select = $('select[name="province_id"]');
    										var city_id = $('select[name="city_id"]').data('selected');
        									var city = new Array();
        									p_select.on('change', function(){
            									var pid = $(this).val();
            									if(city[pid]==undefined){
            										$.ajax({
            											type:"POST",
            									        dataType:"json",
            									        async: false,
            							                url: base_url+"Csupplier_buyer/get_dis",
            							                data: {pid:pid},
            							                success: function(cit){
            							                	city[pid] = '<option value="">请选择城市</option>';
            							                	for(var i=0;i<cit.length;i++){
            							                		city[pid] += '<option ';
            							                		if(city_id == cit[i].id){
            							                			city[pid] += 'selected="selected"';
                							                	}
            							                		city[pid] += 'value="'+cit[i].id+'">'+cit[i].district_name+'</option>';
                            								}console.log(city[pid]);
                							            }
                									});
                								}
            									$('#get_city select').html(city[pid]);
            								});
        								}
    									
    									var get_province = function(){
        									var province_id = $('select[name="province_id"]').data('selected');
    										$.ajax({
    											type:"POST",
    									        dataType:"json",
    									        async: true,
    							                url: base_url+"Csupplier_buyer/get_dis",
    							                data: {pid:0},
    							                success: function(pro){
    							                	province = '<option value="">请选择省份</option>';
                									for(var i=0;i<pro.length;i++){
                										province += '<option ';
                										if(province_id==pro[i].id){
                    										province += 'selected="selected"';
                    									}
                										province += 'value="'+pro[i].id+'">'+pro[i].district_name+'</option>';
                    								}
                									$('#get_province select').html(province);
        							            }
        									});
        									if(province_id){
        										var city_id = $('select[name="city_id"]').data('selected');
        										$.ajax({
        											type:"POST",
        									        dataType:"json",
        									        async: true,
        							                url: base_url+"Csupplier_buyer/get_dis",
        							                data: {pid:province_id},
        							                success: function(cit){
        							                	city= '<option value="">请选择城市</option>';
        							                	for(var i=0;i<cit.length;i++){
        							                		city+= '<option ';
        							                		if(city_id == cit[i].id){
        							                			city+= 'selected="selected"';
            							                	}
        							                		city+= 'value="'+cit[i].id+'">'+cit[i].district_name+'</option>';
                        								}console.log(city);
                        								$('#get_city select').html(city);
            							            }
            									});
            								}
        								}
    									get_province();
    									get_city();

    					                </script>
    					            </div>
    					        </div>
					        </div>
				        </div>
					</div>
					<div class="panel">
		                <div class="panel-heading">
		                    <h3 class="panel-title">使用说明</h3>
		                </div>
		                <div class="panel-body">
		                    <p>在“<span style="color:red;">正在审核</span>”的状态下，可以点击“查看”进行审核。
		                      </br>1.如果用户的资料信息正确，选择“已打款”后提交，会生成一个“打款金额”，请按照此金额给用户账号打款，用户收到款项后在一个月内有三次机会输入金额：1>如果两个金额相等，则系统自动审核通过；2>如果都输入错误，则系统自动审核不通过。
		                      </br>2.如果用户的资料信息不正确，选择“审核不通过”，并填写不通过的原因后提交。
		                    </p>
		                </div>
		            </div>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            