<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                
                    <?php if($res->is_check==1):?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel">
    		                    <form class="form-horizontal" action="<?php echo base_url('Cauthenticate_personal/up_status');?>" method="post">
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
					            <div class="panel-heading">
			                        <h3 class="panel-title">认证详情</h3>
			                    </div>
					            <div class="pad-hor mar-btm">
					               <p>真实姓名：<a class="btn-link" href="<?php echo base_url('Cuser/page/'.$res->id)?>"><?php echo $res->realname?></a></p>
					               <p>身份证：<?php echo $res->id_card?></p>
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
                                    <div class="panel-heading">
    			                        <h3 class="panel-title">认证图片</h3>
    			                    </div>
			                        <ul class="list-unstyled text-justify">
			                            <li>
				                            <div class="col-sm-4">
				                                <a target="_blank" href="<?php echo $this->config->image_url.$res->handheld_id_card?>"><img width=100% src="<?php echo $this->config->image_url.$res->handheld_id_card?>"></a>
				                                <p style="text-align:center;">手持身份证</p>
				                            </div>
			                            </li>
			                            <li>
				                            <div class="col-sm-4">
				                                <a target="_blank" href="<?php echo $this->config->image_url.$res->id_card_front?>"><img width=100% src="<?php echo $this->config->image_url.$res->id_card_front?>"></a>
				                                <p style="text-align:center;">身份证正面</p>
				                            </div>
			                            </li>
			                            <li>
				                            <div class="col-sm-4">
				                                <a target="_blank" href="<?php echo $this->config->image_url.$res->id_card_back?>"><img width=100%  src="<?php echo $this->config->image_url.$res->id_card_back?>"></a>
				                                <p style="text-align:center;">身份证反面</p>
				                            </div>
			                            </li>
			                        </ul>
			                    </div>
                            </div>
                        </div>
                    </div>
					
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            