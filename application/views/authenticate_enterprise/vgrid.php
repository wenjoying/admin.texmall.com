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
    					            <select class="selectpicker" name="is_check">
    	                                <option value="">请选择状态</option>
    	                                <?php foreach($check_arr as $k=>$c):?>
                                        <option <?php if($this->input->get('status')==$k)echo 'selected="selected"'?> value="<?php echo $k?>"><?php echo $c?></option>
                                        <?php endforeach;?>
                                    </select>
					            </div>
					            
					            <div class="form-group">
    					            <select class="selectpicker" name="enterprise_nature">
    	                                <option value="">请选择性质</option>
    	                                <?php foreach($nature_arr as $n):?>
                                        <option <?php if($this->input->get('enterprise_nature')==$n)echo 'selected="selected"'?> value="<?php echo $n?>"><?php $n?></option>
                                        <?php endforeach;?>
                                    </select>
					            </div>
					            
					            <div class="form-group" style="margin-bottom: 15px;">
					                <input type="text" class="form-control date-select" style="margin-top: 15px;" name="sta_time" value="<?php echo $this->input->get('sta_time');?>" placeholder="开始时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="end_time" value="<?php echo $this->input->get('end_time');?>" placeholder="截至时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" value="<?php echo $this->input->get('item');?>" placeholder="名称/法人/身份证/电话/银行/银行卡">
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
                                                    <th><div class="th-inner">认证企业</div></th>
                                                    <th><div class="th-inner">申请人</div></th>
                                                    <th><div class="th-inner">申请理由</div></th>
                                                    <th><div class="th-inner">银行</div></th>
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