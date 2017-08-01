<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title" id="demo-bootbox-custom-h-content">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="<?php echo base_url('Csupplier_buyer/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a class="btn-link" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="demo-psi-repeat-2 icon-fw"></i>刷新</button></a>
					        </h3>
					    </div>
					    <div class="panel-body">
					        <form class="form-inline" action="<?php echo base_url('Csupplier_buyer/grid');?>" method="get">
					            <div class="form-group">
    					            <select class="selectpicker" name="type">
    	                                <option value="">请选择类型</option>
                                        <option <?php if($this->input->get('type')==1)echo 'selected="selected"'?> value="1">采购商</option>
                                        <option <?php if($this->input->get('type')==2)echo 'selected="selected"'?> value="2">供应商</option>
                                    </select>
					            </div>
					            
					            <div class="form-group">
    					            <select class="selectpicker" name="status">
    	                                <option value="">请选择企业状态</option>
    	                                <?php foreach($status_arr as $k=>$v):?>
                                        <option <?php if($this->input->get('status')==$k)echo 'selected="selected"'?> value="<?php echo $k?>"><?php echo $v?></option>
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
					                <input type="text" class="form-control" name="item" style="width:350px;" value="<?php echo $this->input->get('item');?>" placeholder="名称/电话/主营/地址/简介">
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
            					                    <th><div class="th-inner">类型</div></th>
                                                    <th><div class="th-inner">企业名称</div></th>
                                                    <th><div class="th-inner">电话</div></th>
                                                    <th><div class="th-inner">地址</div></th>
                                                    <th><div class="th-inner">主营</div></th>
                                                    <th><div class="th-inner">平台等级</div></th>
                                                    <th><div class="th-inner">状态</div></th>
                                                    <th><div class="th-inner">时间</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr data-checkid="<?php echo $r->id?>" data-company_name="<?php echo $r->company_name?>">
            					                    <td><?php echo $r->id?></td>
            					                    <td><?php echo $r->type==1?'采购商':'供应商'?></td>
            					                    <td><?php echo $r->company_name?></td>
            					                    <td><?php echo $r->office_tel?></td>
                                                    <td>
                                                        <?php 
                                                        echo $r->province_name.$r->city_name.$r->district_name.'</br>';
                                                        echo $r->ads_des;
                                                        ?>
                                                    </td>
                                                    <td><?php echo $r->main_business?></td>
                                                    <td>
                                                        <?php if($r->platform_grade):?><button class="btn btn-default grade"><?php echo $grade_arr[$r->platform_grade]?></button><?php endif;?>
                                                    </td>
                                                    <td style="color:red;"><?php echo $status_arr[$r->status]?></td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->time);?></td>
            					                    <td>
            					                        <a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$r->id);?>">查看</a>|
                					                    <a class="btn-link" href="<?php echo base_url('Csupplier_buyer/edit/'.$r->id);?>">编辑</a>|
                					                    <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Csupplier_buyer/delete/'.$r->id);?>');">删除</a>
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

            					        //平台等级
        					            $('.table tr').on('click', '.grade', function(){
            					            var scode = $(this).parents('tr').data('company_name');
        					            	var checkid = $(this).parents('tr').data('checkid');
            					          	var	html =  '<div class="panel-body demo-nifty-btn">';
            					          		html += '<a class="btn-link" href="'+base_url+'Csupplier_buyer/up_grade/'+checkid+'?grade=1"><button class="btn btn-info">一般</button></a>';
            					          		html += '<a class="btn-link" href="'+base_url+'Csupplier_buyer/up_grade/'+checkid+'?grade=2"><button class="btn btn-info" style="margin-left: 15px;">推荐</button></a>';
            					          		html += '<a class="btn-link" href="'+base_url+'Csupplier_buyer/up_grade/'+checkid+'?grade=3"><button class="btn btn-info" style="margin-left: 15px;">严选</button></a>';
                    					        html += '</div>',
        					            	layer.open({
        					            	  type: 1,
        					            	  title: '平台等级 （id：' + checkid + '；企业名称：' + scode + '）',
        					            	  skin: 'layui-layer-rim', //加上边框
        					            	  area: ['420px', '240px'], //宽高
        					            	  content: html
        					            	});
            					        });

    					                </script>
    					            </div>
    					        </div>
    					        <div class="pull-right pagination">
        					        <ul class="pagination">
        					            <li><a>每页<?php echo $per_page?>条/共<?php echo $sum?>条</a></li>
        					            <li><a>第<?php echo empty($this->uri->segment(3)) ? 1 : $this->uri->segment(3)?>页</a></li>
        					        </ul>
        					        <?php echo $link;?> 
    					        </div>
					        </div>
				        </div>
					</div>
					<div class="panel">
		                <div class="panel-heading">
		                    <h3 class="panel-title">使用说明</h3>
		                </div>
		                <div class="panel-body">
		                    <p>平台等级仅对于供应商。“正在审核”的状态下可以在点击 “查看” 时审核。</p>
		                </div>
		            </div>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            