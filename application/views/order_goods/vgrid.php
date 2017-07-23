<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title" id="demo-bootbox-custom-h-content">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="ion-load-d"></i>刷新</button></a>
					        </h3>
					    </div>
					    <div class="panel-body">
					        <form class="form-inline" action="<?php echo base_url('Corder_goods/grid');?>" method="get">
					            <div class="form-group" style="margin-bottom: 15px;">
					                <input type="text" class="form-control date-select" style="margin-top: 15px;" name="sta_time" value="<?php echo $this->input->get('sta_time');?>" placeholder="开始时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="end_time" value="<?php echo $this->input->get('end_time');?>" placeholder="截至时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" value="<?php echo $this->input->get('item');?>" placeholder="订单号/供应商/型号/用户名">
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
            					                    <th><div class="th-inner">图片</div></th>
                                                    <th><div class="th-inner">订单号</div></th>
                                                    <th><div class="th-inner">产品</div></th>
                                                    <th><div class="th-inner">原价</div></th>
                                                    <th><div class="th-inner">详情</div></th>
                                                    <th><div class="th-inner">时间</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr data-checkid="<?php echo $r->id?>" data-username="<?php echo $r->username?>">
            					                    <td><?php echo $r->id?></td>
            					                    <td><img height=100 width=100 src="<?php echo $this->config->image_url.$r->cover_img?>"></td>
            					                    <td><a class="btn-link" href="<?php echo base_url('Corder/page/'.$r->order_id)?>"><?php echo $r->platform_code?></a></td>
                                                    <td>型号：<a class="btn-link" href="<?php echo base_url('Cgoods/page/'.$r->goods_id)?>"><?php echo $r->supplier_code?></a>
                                                        </br><a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$r->supplier_id)?>"><?php echo $r->supplier_name?></a>
                                                    </td>
                                                    <td><?php echo $r->price?>元/米</td>
                                                    <td>
                                                        <p>订单价：<?php echo $r->order_price?>元/米</p>
                                                        <p>数量：<?php echo $r->number?>米</p>
                                                        <p>总价：<?php echo $r->sum_goods_price?>元</p>
                                                    </td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->time);?></td>
            					                    <td>
                					                    <a class="btn-link" href="<?php echo base_url('Corder_goods/page/'.$r->id)?>">查看</a>|
                					                    <a class="btn-link" href="###">编辑</a>|
                					                    <a class="btn-link" href="###" onclick="layer_conf('<?php echo base_url('Corder_goods/delete/'.$r->id);?>');">删除</a>
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