<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title" id="demo-bootbox-custom-h-content">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="<?php echo base_url('Csupplier_buyer/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a class="btn-link" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="ion-load-d"></i>刷新</button></a>
					        </h3>
					    </div>
					    <div class="panel-body">
					        <form class="form-inline" action="<?php echo base_url('Csupplier_buyer/grid');?>" method="get">
					            <div class="form-group">
    					            <select class="selectpicker" name="status">
    	                                <option value="">请选择状态</option>
                                        <option <?php if($this->input->get('status')==1)echo 'selected="selected"'?> value="1">正在审核</option>
                                        <option <?php if($this->input->get('status')==2)echo 'selected="selected"'?> value="2">审核通过</option>
                                        <option <?php if($this->input->get('status')==3)echo 'selected="selected"'?> value="3">审核不通过</option>
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
					                <input type="text" class="form-control" name="item" value="<?php echo $this->input->get('item');?>" placeholder="用户名/电话/地址">
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
                                                    <th><div class="th-inner">地址</div></th>
                                                    <th><div class="th-inner">申请理由</div></th>
                                                    <th><div class="th-inner">状态</div></th>
                                                    <th><div class="th-inner">时间</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr data-checkid="<?php echo $r->id?>" data-username="<?php echo $r->username?>">
            					                    <td><?php echo $r->id?></td>
                                                    <td>
                                                        <?php 
                                                        echo '<a class="btn-link" href="'.base_url('Cuser/page/'.$r->uid).'">'.$r->username.'</a>';
                                                        echo '</br>'.$r->link_phone;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        echo $r->province_name.$r->city_name.$r->district_name.'</br>';
                                                        echo $r->ads_des;
                                                        ?>
                                                    </td>
                                                    <td><?php echo $status_arr[$r->status]?></td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->time);?></td>
            					                    <td>
            					                        <a class="btn-link" href="###" onclick="layer_conf('<?php echo base_url('Csupplier_buyer/delete/'.$r->id);?>');">删除</a>
                                                    </td>
        					                    </tr>
        					                    <?php endforeach;?>
        					                </tbody>
    					                </table>
    					                <script>
    					                //时间
    					                $('input.date-select').datepicker({
					                		format: "yyyy-mm-dd",
					                        todayBtn: "linked",
					                        autoclose: true,
					                        todayHighlight: true
    					                });

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


          					            //审核
        					            $('.table tr').on('click', '.label-info', function(){
            					            var scode = $(this).parents('tr').data('username');
        					            	var checkid = $(this).parents('tr').data('checkid');
            					          	var	html =  '<div class="panel-body demo-nifty-btn">';
            					          		html += '<a class="btn-link" href="'+base_url+'Csupplier_buyer/check_out/'+checkid+'?is_check=2"><button class="btn btn-info">通过</button></a>';
            					          		html += '<a class="btn-link" href="'+base_url+'Csupplier_buyer/check_out/'+checkid+'?is_check=3"><button class="btn btn-danger" style="margin-left: 15px;">不通过</button></a>';
                    					        html += '</div>',
        					            	layer.open({
        					            	  type: 1,
        					            	  title: '审核 （id：' + checkid + '；申请人：' + scode + '）',
        					            	  skin: 'layui-layer-rim', //加上边框
        					            	  area: ['420px', '240px'], //宽高
        					            	  content: html
        					            	});
            					        });

    					                </script>
    					            </div>
    					        </div>
					        </div>
				        </div>
					</div>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            