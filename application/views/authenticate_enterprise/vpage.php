<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
                    <?php if($res->is_check==1):?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel">
    		                    <form class="form-horizontal" action="<?php echo base_url('Cauthenticate_enterprise/up_status');?>" method="post">
    					               <div class="alert alert-danger">
					                    <strong>注意！</strong>提交审核后不能恢复，请谨慎操作！
					                </div>
					                <input type="hidden" name="id" value="<?php echo $res->id?>">
					                <div class="form-group pad-ver">
					                    <label class="col-md-3 control-label">审核状态*</label>
					                    <div class="col-md-6">
				                            <select class="selectpicker" required="required" name="is_check">
                                                <option value="2">打款</option>
                                                <option value="6">审核不通过</option>
                                            </select>
                                            <small class="help-block">如果选择‘打款’，请按列表中显示的金额打款；如果选择‘审核不通过’，请详细填写驳回原因</small>
					                    </div>
					                </div>
					                
					                <div class="form-group">
					                    <label class="col-md-3 control-label" for="demo-textarea-input">审核不通过原因*</label>
					                    <div class="col-md-6">
					                        <textarea rows="5" class="form-control" name="reject_des" maxlength="100" placeholder="后台审核通过，准备打款" ></textarea>
					                        <small class="help-block">详细填写驳回原因</small>
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
					               <p>企业名称：<a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$res->id)?>"><?php echo $res->enterprise_name?></a></p>
					               <p>企业性质：<?php echo $nature_arr[$res->enterprise_nature]?></p>
					               <p>法人：<?php echo $res->enterprise_legal?></p>
					               <p>法人身份证：<?php echo $res->legal_id_card?></p>
					               <p>接收结果手机：<?php echo $res->link_phone?></p>
					               <p>开户名：<?php echo $res->account_name?></p>
					               <p>开户行：<?php echo $res->bank_name?></p>
					               <p>开户地址：<?php echo $res->bank_address?></p>
					               <p>开户支行：<?php echo $res->bank_branch?></p>
					               <p>银行卡：<strong><?php echo $res->bank_card?></strong></p>
					               <p>打款金额：<strong><?php if($res->validate_money) echo $res->validate_money*0.01?></strong>元</p>
					               <p>审核状态：<span style="color:red;"><?php echo $status_arr[$res->is_check]?></span></p>
					               <p>说明：<?php echo $res->reject_des?></p>
					               <p>申请时间：<?php echo date('Y-m-d H:i:s', $res->time)?></p>
					               <p>更新时间：<?php if(!empty($res->update_time)) echo date('Y-m-d H:i:s', $res->update_time)?></p>
					            </div>
					            
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel">
                                <div class="panel-body">
                                    <p class="text-semibold text-main pad-all mar-no">认证图片</p>
			                        <ul class="list-unstyled text-justify">
			                            <li>
				                            <div class="col-sm-4">
				                                <a target="_blank" href="<?php echo $this->config->image_url.$res->certificate_img?>"><img width=100% src="<?php echo $this->config->image_url.$res->certificate_img?>"></a>
				                                <p style="text-align:center;"><?php echo $res->certificate_type;?></p>
				                            </div>
			                            </li>
			                        </ul>
			                        <ul class="list-unstyled text-justify">
			                            <?php foreach(explode('|', $res->legal_img) as $img):?>
        					            <?php if(!empty($img)):?>
			                            <li>
				                            <div class="col-sm-4">
				                                <a target="_blank" href="<?php echo $this->config->image_url.$img?>"><img width=100% src="<?php echo $this->config->image_url.$img?>"></a>
				                                <p style="text-align:center;">法人证件照</p>
				                            </div>
			                            </li>
			                            <?php endif;?>
    					                <?php endforeach;?>
			                        </ul>
			                    </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            