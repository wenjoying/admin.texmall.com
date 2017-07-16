<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
    					        <a style="margin-left:50px;" href="<?php echo base_url('Cuser/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="ion-load-d"></i>刷新</button></a>
					        </h3>
					        
					        
					    </div>
					    <div class="panel-body">
					
					        <form class="form-inline" action="<?php echo base_url('Cuser/grid');?>" method="get">
					            <div class="form-group">
    					            <select class="selectpicker" name="reg_come">
    	                                <option value="">请选择状态</option>
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
            					                    <th width="2%"><div class="th-inner"><input class="select-all" type="checkbox"></div></th>
            					                    <th width="5%"><div class="th-inner">ID</div></th>
                                                    <th width="5%"><div class="th-inner">头像</div></th>
                                                    <th width="5%"><div class="th-inner">二维码</div></th>
                                                    <th width="10%"><div class="th-inner">用户名</div></th>
                                                    <th width="10%"><div class="th-inner">身份证</div></th>
                                                    <th width="10%"><div class="th-inner">注册时间</div></th>
                                                    <th width="5%"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><div class="th-inner"><input class="list-check" type="checkbox" name="checkid[]" value="<?php echo $r->id?>"></div></td>
            					                    <td><?php echo $r->id?></td>
                                                    <td><img style="height:80px;width:80px;" src="<?php echo $this->config->image_url.$r->userimg?>"></td>
                                                    <td>
                                                    <?php if(empty($r->qr_img)):?>
                                                    <a href="<?php echo base_url('Cuser/create_qr/'.$r->id);?>"><i class="ion-qr-scanner"></i>生成二维码</a>
                                                    <?php else :?>
                                                    <img style="height:80px;width:80px;" src="<?php echo $this->config->image_url.$r->qr_img?>">
                                                    <?php endif;?>
                                                    
                                                    </td>
                                                    <td>
                                                        <?php echo $r->username.'</br>'.$r->mobile?>
                                                        <?php if(!empty($r->company)):?>
                                                        </br><a href="<?php echo base_url('Csupplier_buyer/edit/'.$r->companyid)?>"><?php echo $r->company?></a>
                                                        <?php endif;?>
                                                    </td>
                                                    <td><?php echo $r->id_card?></td>
                                                    <td><?php echo date('Y-m-d H:i:s', $r->reg_time).' '.$reg_come[$r->reg_come];?></td>
                                                    <td>
                                                        <div class="btn-group m-b-5">
                                                            <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu animated fadeIn">
                                                                <li><a href="<?php echo base_url('Cuser/page/'.$r->id);?>"><i class="ion-eye"></i>查看</a></li>
                                                                <li><a href="<?php echo base_url('Cuser/edit/'.$r->id);?>"><i class="ion-compose"></i>编辑</a></li>
                                                                <li><a href="javascript:layer_conf('<?php echo base_url('Cuser/delete/'.$r->id);?>');"><i class="ion-trash-a"></i>删除</a></li>
                                                            </ul>
                                                        </div>
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
    					                
          					            // 全选、全不选、反选
          					            $('.demo-add-niftycheck').on('click','.select-all',function(){     
    										$('input[name="checkid[]"]').each(function(){
    											if(this.checked){
    												this.checked = false;
    											}else{
    												this.checked = true;
    											}
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