<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title" id="demo-bootbox-custom-h-content">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="<?php echo base_url('Cgoods/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a class="btn-link" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="demo-psi-repeat-2 icon-fw"></i>刷新</button></a>
					        </h3>
					    </div>
					    <div class="panel-body">
					        <form class="form-inline" action="<?php echo base_url('Cgoods/grid');?>" method="get">
					            <div class="form-group">
    					            <select class="selectpicker" name="is_sale">
    	                                <option value="">请选择上架状态</option>
                                        <option <?php if($this->input->get('is_sale')==1)echo 'selected="selected"'?> value="1">上架</option>
                                        <option <?php if($this->input->get('is_sale')==2)echo 'selected="selected"'?> value="2">待售</option>
                                        <option <?php if($this->input->get('is_sale')==3)echo 'selected="selected"'?> value="3">下架</option>
                                    </select>
					            </div>
					            
					            <div class="form-group">
    					            <select class="selectpicker" name="is_check">
    	                                <option value="">请选择审核状态</option>
                                        <option <?php if($this->input->get('is_check')==1)echo 'selected="selected"'?> value="1">正在审核</option>
                                        <option <?php if($this->input->get('is_check')==2)echo 'selected="selected"'?> value="2">审核通过</option>
                                        <option <?php if($this->input->get('is_check')==3)echo 'selected="selected"'?> value="3">审核不通过</option>
                                    </select>
					            </div>
					            
					            <div class="form-group">
    					            <select class="selectpicker" name="platform_grade">
    	                                <option value="">请选择平台等级</option>
                                        <option <?php if($this->input->get('platform_grade')==1)echo 'selected="selected"'?> value="1">正常</option>
                                        <option <?php if($this->input->get('platform_grade')==2)echo 'selected="selected"'?> value="2">推荐</option>
                                        <option <?php if($this->input->get('platform_grade')==3)echo 'selected="selected"'?> value="3">严选</option>
                                    </select>
					            </div>
					            
					            <div class="form-group" style="margin-bottom: 15px;">
					                <input type="text" class="form-control" style="margin-top: 15px;" name="platform_name" value="<?php echo $this->input->get('platform_name');?>" placeholder="平台名称">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="sta_time" value="<?php echo $this->input->get('sta_time');?>" placeholder="开始时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="end_time" value="<?php echo $this->input->get('end_time');?>" placeholder="截至时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" style="width:350px;" value="<?php echo $this->input->get('item');?>" placeholder="编码/供应商/用户名/工艺组成/风格/类目">
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
                                                    <th><div class="th-inner">平台名称</div></th>
                                                    <th><div class="th-inner">供应商</div></th>
                                                    <th><div class="th-inner">型号</div></th>
                                                    <th><div class="th-inner">上传用户</div></th>
                                                    <th><div class="th-inner">价格</div></th>
                                                    <th><div class="th-inner">上架状态</div></th>
                                                    <th><div class="th-inner">审核状态</div></th>
                                                    <th><div class="th-inner">平台等级</div></th>
                                                    <th><div class="th-inner">销量</div></th>
                                                    <th><div class="th-inner">时间</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr data-checkid="<?php echo $r->id?>" data-scode="<?php echo $r->supplier_code?>">
            					                    <td><?php echo $r->id?></td>
                                                    <td><?php echo $r->platform_name?></td>
                                                    <td><a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$r->supplier_id)?>"><?php echo $r->supplier_name?></a></td>
                                                    <td><?php echo $r->supplier_code?></td>
                                                    <td><a class="btn-link" href="<?php echo base_url('Cuser/page/'.$r->uid)?>"><?php echo $r->username?></a></td>
                                                    <td><?php echo $r->price?></td>
                                                    <td><?php echo $r->is_sale==1 ? '<i class="ion-checkmark"></i>' : '<i class="ion-close"></i>'?></td>
                                                    <td style="color:red;"><?php echo $status_arr[$r->status]?></td>
                                                    <td><?php echo $grade_arr[$r->platform_grade]?></td>
                                                    <td><?php echo $r->sum_sale?>米</td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->time);?></td>
            					                    <td>
            					                        <a class="btn-link" href="<?php echo base_url('Cgoods/page/'.$r->id);?>">查看</a>|
                					                    <a class="btn-link" href="<?php echo base_url('Cgoods/edit/'.$r->id);?>">编辑</a>|
                					                    <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Cgoods/delete/'.$r->id);?>');">删除</a>
                                                    </td>
        					                    </tr>
        					                    <?php endforeach;?>
        					                </tbody>
    					                </table>
    					                <script>
    					                
          					            //审核
        					            $('.table tr').on('click', '.label-info', function(){
            					            var scode = $(this).parents('tr').data('scode');
        					            	var checkid = $(this).parents('tr').data('checkid');
            					          	var	html =  '<div class="panel-body demo-nifty-btn">';
            					          		html += '<a class="btn-link" href="'+base_url+'Cgoods/check_out/'+checkid+'?is_check=2"><button class="btn btn-info">通过</button></a>';
            					          		html += '<a class="btn-link" href="'+base_url+'Cgoods/check_out/'+checkid+'?is_check=3"><button class="btn btn-danger" style="margin-left: 15px;">不通过</button></a>';
                    					        html += '</div>',
        					            	layer.open({
        					            	  type: 1,
        					            	  title: '审核 （id：' + checkid + '；编码：' + scode + '）',
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
		                    <p>1.“<b>正在审核</b>”状态下可以点菜“<b>查看</b>”进行审核</p>
		                    <p>2.当审核不通过的时候，产品上架状态也会变为“<b>下架</b>”，前台产品列表页不会显示</p>
		                    <p>3.编辑提交后，审核状态会变为“<b>正在审核</b>”</p>
		                </div>
		            </div>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            