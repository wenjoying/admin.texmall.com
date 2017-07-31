<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title" id="demo-bootbox-custom-h-content">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="demo-psi-repeat-2 icon-fw"></i>刷新</button></a>
					        </h3>
					    </div>
					    <div class="panel-body">
					        <form class="form-inline" action="<?php echo base_url('Corder_reviews/grid');?>" method="get">
					            <div class="form-group">
    					            <select class="selectpicker" name="status">
    	                                <option value="">请选择状态</option>
                                        <option <?php if($this->input->get('status')==1)echo 'selected="selected"'?> value="1">正在审核</option>
                                        <option <?php if($this->input->get('status')==2)echo 'selected="selected"'?> value="2">审核通过</option>
                                        <option <?php if($this->input->get('status')==3)echo 'selected="selected"'?> value="3">审核不通过</option>
                                    </select>
					            </div>
					            
					            <div class="form-group" style="margin-bottom: 15px;">
					                <input type="text" class="form-control date-select" style="margin-top: 15px;" name="sta_time" value="<?php echo $this->input->get('sta_time');?>" placeholder="开始时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="end_time" value="<?php echo $this->input->get('end_time');?>" placeholder="截至时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" style="width:350px;" value="<?php echo $this->input->get('item');?>" placeholder="型号/用户名/评价">
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
                                                    <th><div class="th-inner">产品</div></th>
                                                    <th><div class="th-inner">用户</div></th>
                                                    <th><div class="th-inner">评分</div></th>
                                                    <th><div class="th-inner">评价</div></th>
                                                    <th><div class="th-inner">晒图</div></th>
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
                					                    <a class="btn-link" href="<?php echo base_url('Corder/page/'.$r->order_id)?>">订单id：<?php echo $r->order_id?></a>
                					                    </br>型号：<a class="btn-link" href="<?php echo base_url('Corder_goods/page/'.$r->order_goods_id)?>"><?php echo $r->supplier_code?></a>
            					                    </td>
                                                    <td><a class="btn-link" href="<?php echo base_url('Cuser/page/'.$r->uid)?>"><?php echo $r->username?></a></td>
                                                    <td>
                                                        <p>描述：<?php echo $r->des_core?>分</p>
                                                        <p>服务：<?php echo $r->ser_core?>分</p>
                                                        <p>物流：<?php echo $r->del_core?>分</p>
                                                    </td>
                                                    <td><?php echo $r->des?></td>
                                                    <td><?php if(!empty($r->imgs)) echo '是'?></td>
                                                    <td><?php echo $status_arr[$r->status]?></td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->time);?></td>
            					                    <td>
                					                    <a class="btn-link" href="<?php echo base_url('Corder_reviews/page/'.$r->id)?>">查看</a>|
                					                    <a class="btn-link" href="###">编辑</a>|
                					                    <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Corder_reviews/delete/'.$r->id);?>');">删除</a>
                                                    </td>
        					                    </tr>
        					                    <?php endforeach;?>
        					                </tbody>
    					                </table>
    					                <script>
    					                
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
        					            	  title: '审核 （id：' + checkid + '；用户：' + scode + '）',
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