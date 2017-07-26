<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
    					        <a style="margin-left:50px;" href="<?php echo base_url('Cuser/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a class="btn-link" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="demo-psi-repeat-2 icon-fw"></i>刷新</button></a>
					        </h3>
					        
					        
					    </div>
					    <div class="panel-body">
					
					        <form class="form-inline" action="<?php echo base_url('Cuser/grid');?>" method="get">
					            <div class="form-group">
    					            <select class="selectpicker" name="reg_come">
    	                                <option value="">请选择注册来源</option>
    	                                <?php foreach ($reg_come=get_reg_come() as $k=>$g) {?>
                                        <option <?php if($k==$this->input->get('reg_come'))echo 'selected="selected"'?> value="<?php echo $k?>"><?php echo $g?></option>
                                        <?php }?>
                                    </select>
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="sta_time" value="<?php echo $this->input->get('sta_time');?>" placeholder="开始时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control date-select" name="end_time" value="<?php echo $this->input->get('end_time');?>" placeholder="截至时间">
					            </div>
					            
					            <div class="form-group">
					                <input type="text" class="form-control" name="item" value="<?php echo $this->input->get('item');?>" placeholder="用户名/手机号/身份证号">
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
                                                    <th><div class="th-inner">用户名</div></th>
                                                    <th><div class="th-inner">电话</div></th>
                                                    <th><div class="th-inner">角色</div></th>
                                                    <th><div class="th-inner">公司</div></th>
                                                    <th><div class="th-inner">身份证</div></th>
                                                    <th><div class="th-inner">来源</div></th>
                                                    <th><div class="th-inner">注册时间</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><?php echo $r->id?></td>
                                                    <td><?php echo $r->username?></td>
                                                    <td><?php echo $r->mobile?></td>
                                                    <td><?php echo $r->role_id==1?'采购商用户':($r->role_id==2?'供应商用户':'平台服务商')?></td>
                                                    <td>
                                                        <?php if(!empty($r->company)):?>
                                                        <a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$r->companyid)?>"><?php echo $r->company?></a>
                                                        <?php endif;?>
                                                    </td>
                                                    <td><?php echo $r->id_card?></td>
                                                    <td><?php echo $reg_come[$r->reg_come]?></td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->reg_time)?></td>
                                                    <td>
                                                        <a class="btn-link" href="<?php echo base_url('Cuser/page/'.$r->id);?>">查看</a>|
                					                    <a class="btn-link" href="<?php echo base_url('Cuser/edit/'.$r->id);?>">编辑</a>|
                					                    <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Cuser/delete/'.$r->id);?>');">删除</a>
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