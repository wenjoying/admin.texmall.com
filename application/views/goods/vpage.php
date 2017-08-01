<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
                    <?php if($res->status==1):?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel">
    		                    <form class="form-horizontal" action="<?php echo base_url('Csupplier_buyer/up_status');?>" method="post">
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
			                    <div class="panel-heading">
			                        <h3 class="panel-title">产品详情</h3>
			                        <a style="float: right;margin: -40px 10px;" href="<?php echo base_url('Cgoods/next/'.$res->id)?>"><button class="btn btn-sm btn-primary">下一个</button></a>
				                    <?php if($this->admin->id==1):?>
    					               <!-- 后台测试 -->
    					               <?php if($res->status==1 && $res->status==2):?>
    					               <a style="float: right;margin: -40px 100px;" href="<?php echo base_url('Cgoods_cart/add?goods_id='.$res->id)?>"><button class="btn btn-sm btn-success">加入购物车</button></a>
    					               <?php endif;?>
					                <?php endif;?>
				                </div>
			                    <div class="pad-hor mar-btm">
			                       <p>平台编码：<?php echo $res->platform_code?></p>
			                       <p>标准图：<?php echo $res->platform_name?></p>
			                       <p>供应商型号：<?php echo $res->supplier_code?></p>
					               <p>供应商：<a class="btn-link" href="<?php echo base_url('Csupplier_buyer/page/'.$res->supplier_id)?>"><?php echo $res->supplier_name?></a></p>
					               <p>上传用户：<a class="btn-link" href="<?php echo base_url('Cuser/page/'.$res->uid)?>"><?php echo $res->username?></a></p>
					               <p>价格：<strong style="color:red;"><?php echo $res->price?></strong>元/米</p>
					               <p>上架状态：<?php echo $sale_arr[$res->is_sale]?></p>
					               <p>审核状态：<?php echo $status_arr[$res->status]?></p>
					               <p>平台等级：<?php echo $grade_arr[$res->platform_grade]?></p>
					               <p>库存：<?php echo $res->in_stock?>米</p>
					               <p>成分：<?php echo $res->component?></p>
					               <p>门幅：<?php echo $res->width?></p>
					               <p>平方克重：<?php echo $res->square_weight?></p>
					               <p>缩水率：<?php echo $res->shrinkage?></p>
					               <p>格型：<?php echo $res->lattice?></p>
					               <p>颜色：<?php echo $res->color?></p>
					               <p>潘通色号：<?php echo $res->pantone_color?></p>
					               <p>格子：<?php echo $res->tex_grid?></p>
					               <p>纱织密度：<?php echo $res->yarn_density?></p>
					               <p>花回尺寸：<?php echo $res->back_size?></p>
					               <p>厚薄：<?php echo $res->thickness?></p>
					               <p>工艺组成：<?php echo $res->tech_composed?></p>
					               <p>风格：<?php echo $res->style?></p>
					               <p>类目：<?php echo $res->category?></p>
					               <p>来源：<?php echo $res->source?></p>
					               <p>总销量：<?php echo $res->sum_sale?></p>
					               <p>总评价：<?php echo $res->sum_review?></p>
					               <p>收藏量：<?php echo $res->enshrine_num?></p>
					               <p>创建时间：<?php echo date('Y-m-d H:i:s', $res->time)?></p>
					               <p>更新时间：<?php if(!empty($res->update_time)) echo date('Y-m-d H:i:s', $res->update_time)?></p>
					               
			                    </div>
		                    </div>
		                </div>
		                <div class="col-sm-6">
                            <div class="panel">
                                <div class="panel-heading">
			                        <h3 class="panel-title">主图</h3>
			                    </div>
		                        <ul class="list-unstyled text-justify">
		                            <li>
			                            <div class="col-sm-4">
			                                <a target="_blank" href="<?php echo $this->config->image_url.$res->cover_img?>"><img width=100% src="<?php echo $this->config->image_url.$res->cover_img?>"></a>
			                            </div>
		                            </li>
		                        </ul>
		                        <div class="panel-heading">
			                        <h3 class="panel-title">原图</h3>
			                    </div>
		                        <ul class="list-unstyled text-justify">
		                            <?php foreach(explode('|', $res->original_img) as $o):?>
		                            <?php if(!empty($o)):?>
		                            <li>
			                            <div class="col-sm-4">
			                                <a target="_blank" href="<?php echo $this->config->image_url.$o?>"><img width=100% src="<?php echo $this->config->image_url.$o?>"></a>
			                            </div>
		                            </li>
		                            <?php endif;?>
		                            <?php endforeach;?>
		                        </ul>
		                    </div>
                        </div>
	                </div>
	                <div class="row">
                        <div class="col-sm-12">
                            <div class="panel">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">产品简介</h3>
			                    </div>
			                    <div class="media-body"><?php echo $res->des?></div>
                            </div>
                        </div>
	                </div>
				
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            