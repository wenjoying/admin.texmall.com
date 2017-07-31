<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
                    <?php if($res->status==1):?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel">
    		                    <form class="form-horizontal" action="<?php echo base_url('Cplatform_service/up_status');?>" method="post">
    					            <div class="alert alert-danger">
					                   <strong>注意！</strong>提交审核后不能恢复，请谨慎操作！
					                </div>
					                <input type="hidden" name="id" value="<?php echo $res->id?>">
					                <div class="form-group pad-ver">
					                    <label class="col-md-3 control-label">审核状态*</label>
					                    <div class="col-md-6">
				                            <select class="selectpicker" required="required" name="status">
                                                <option value="2">通过</option>
                                                <option value="3">不通过</option>
                                            </select>
					                    </div>
					                </div>
				                    <div class="panel-footer">
					                    <div class="row">
					                        <div class="col-sm-9 col-sm-offset-3">
					                            <button class="btn btn-mint" type="submit">审核</button>
					                        </div>
					                    </div>
					                </div>
					            </form>
			                </div>
		                </div>
	                </div>
	                <?php endif;?>
	                
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel">
					            <p class="text-semibold text-main pad-all mar-no">认证详情</p>
					            <div class="pad-hor mar-btm">
					               <p>用户：<a class="btn-link" href="<?php echo base_url('Cuser/page/'.$res->uid)?>"><?php echo $res->username?></a></p>
					               <p>联系电话：<?php echo $res->link_phone?></p>
					               <p>地址：<?php echo $res->province_name.$res->city_name.$res->district_name.$res->ads_des?></p>
					               <p>申请理由：<?php echo $res->apply_des?></p>
					               <p>申请时间：<?php echo date('Y-m-d H:i:s', $res->time)?></p>
					            </div>
					            
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            