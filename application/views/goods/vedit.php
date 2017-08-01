<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                
                <!-- kindeditor -->
                <link href="<?php echo inc_file('chosen/chosen.min.css', 'plugins')?>" rel="stylesheet">
                <script src="<?php echo inc_file('chosen/chosen.jquery.min.js', 'plugins')?>"></script>
                <script charset="utf-8" src="<?php echo inc_file('kindeditor-min.js', 'kindeditor')?>"></script>
                <script charset="utf-8" src="<?php echo inc_file('lang/zh_CN.js', 'kindeditor')?>"></script>
                <script charset="utf-8" src="<?php echo inc_file('ready.js', 'kindeditor')?>"></script>
                <div id="page-content">
                    <div class="row">
					    <div class="col-lg-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title"><?php echo $two_level.'- 修改'?></h3>
					            </div>
					            <form class="form-horizontal" action="<?php echo base_url('Cgoods/editPost');?>" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
					                    <input type="hidden" name="id" value="<?php echo $res->id?>">
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label">主图</label>
    					                    <div class="col-md-6">
    					                        <div style="float:left;height: 100px;width: 100px;border:1px solid #e9e9e9;"><img height=100 width=100 src="<?php echo $this->config->image_url.$res->cover_img?>"></div>
    					                    </div>
    					                </div>
    					                  
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label">原图</label>
    					                    <div class="col-md-6">
    					                        <div style="float:left;height: 100px;width: 100px;border:1px solid #e9e9e9;"><img height=100 width=100 src="<?php echo $this->config->image_url.$res->original_img?>"></div>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">供应商</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" readonly value="<?php echo $res->supplier_name;?>">
    					                    </div>
    					                    <small class="help-block">填写已通过审核的供应商名称</small>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">供应商型号*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="supplier_code" required="required" maxlength="20" value="<?php echo $res->supplier_code?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">价格*</label>
    					                    <div class="col-md-6">
    					                        <input type="number" class="form-control" name="price" required="required" maxlength="10" value="<?php echo $res->price?>" placeholder="...">
    					                        <small class="help-block">仅填数字，单位：元/米</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">库存*</label>
    					                    <div class="col-md-6">
    					                        <input type="number" class="form-control" name="in_stock" required="required" maxlength="10" value="<?php echo $res->in_stock?>" placeholder="...">
    					                        <small class="help-block">仅填数字，单位：米</small>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">门幅*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="width" required="required" maxlength="20" value="<?php echo $res->width?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">平方克重*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="square_weight" required="required" maxlength="20" value="<?php echo $res->square_weight?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">缩水率*</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="shrinkage" required="required" maxlength="20" value="<?php echo $res->shrinkage?>" placeholder="...">
    					                    </div>	
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">磨毛</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="sanding" maxlength="20" value="<?php echo $res->sanding?>" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">厚薄</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="thickness" maxlength="20" value="<?php echo $res->thickness?>" placeholder="...">
    					                    </div>
    					                </div>
    					                	
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">工艺组成</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" name="tech_composed" maxlength="20" value="" placeholder="...">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">成分*</label>
    					                    <div class="col-md-6">
    					                    <?php if(isset($attr['component'])):?>
        					                    <?php if($attr['component']->is_multi==2):?>
    					                            <select class="selectpicker" required="required" name="component">
                    	                                <option value="">请选择成分</option>
                    	                                <?php foreach(explode(',', $attr['component']->attr_val) as $c) :?>
                                                        <option <?php if($res->component == $c) echo 'selected="selected"'?> value="<?php echo $c?>"><?php echo $c?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                <?php else :?>
                                                    <?php $arr = explode(',', $res->component);?>
                                                    <select id="multi-component" name="component[]" data-placeholder="请选择" multiple="" tabindex="-1" style="display: none;">
                    	                                <?php foreach(explode(',', $attr['component']->attr_val) as $c) :?>
                                                        <option <?php if(in_array($c, $arr)) echo 'selected="selected"'?> value="<?php echo $c?>"><?php echo $c?></option>
                                                        <?php endforeach;?>
    					                            </select>
                                                <?php endif;?>
                                            <?php endif;?>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">类目</label>
    					                    <div class="col-md-6">
				                            <?php if(isset($attr['category'])):?>
        					                    <?php if($attr['category']->is_multi==2):?>
    					                            <select class="selectpicker" name="category">
                    	                                <option value="">请选择类目</option>
                    	                                <?php foreach(explode(',', $attr['category']->attr_val) as $c) :?>
                                                        <option <?php if($res->component == $c) echo 'selected="selected"'?> value="<?php echo $c?>"><?php echo $c?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                <?php else :?>
                                                    <?php $arr = explode(',', $res->category);?>
                                                    <select id="multi-component" name="category[]" data-placeholder="请选择" multiple="" tabindex="-1" style="display: none;">
                    	                                <?php foreach(explode(',', $attr['category']->attr_val) as $c) :?>
                                                        <option <?php if(in_array($c, $arr)) echo 'selected="selected"'?> value="<?php echo $c?>"><?php echo $c?></option>
                                                        <?php endforeach;?>
    					                            </select>
                                                <?php endif;?>
                                            <?php endif;?>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">风格</label>
    					                    <div class="col-md-6">
					                        <?php if(isset($attr['style'])):?>
        					                    <?php if($attr['style']->is_multi==2):?>
    					                            <select class="selectpicker" name="style">
                    	                                <option value="">请选择类目</option>
                    	                                <?php foreach(explode(',', $attr['style']->attr_val) as $c) :?>
                                                        <option <?php if($res->component == $c) echo 'selected="selected"'?> value="<?php echo $c?>"><?php echo $c?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                <?php else :?>
                                                    <?php $arr = explode(',', $res->style);?>
                                                    <select id="multi-style" name="style[]" data-placeholder="请选择" multiple="" tabindex="-1" style="display: none;">
                    	                                <?php foreach(explode(',', $attr['style']->attr_val) as $c) :?>
                                                        <option <?php if(in_array($c, $arr)) echo 'selected="selected"'?> value="<?php echo $c?>"><?php echo $c?></option>
                                                        <?php endforeach;?>
    					                            </select>
                                                <?php endif;?>
                                            <?php endif;?>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">来源</label>
    					                    <div class="col-md-6">
					                        <?php if(isset($attr['source'])):?>
        					                    <?php if($attr['source']->is_multi==2):?>
    					                            <select class="selectpicker" name="source">
                    	                                <option value="">请选择来源</option>
                    	                                <?php foreach(explode(',', $attr['source']->attr_val) as $c) :?>
                                                        <option <?php if($res->component == $c) echo 'selected="selected"'?> value="<?php echo $c?>"><?php echo $c?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                <?php else :?>
                                                    <?php $arr = explode(',', $res->source);?>
                                                    <select id="multi-source" name="source[]" data-placeholder="请选择" multiple="" tabindex="-1" style="display: none;">
                    	                                <?php foreach(explode(',', $attr['source']->attr_val) as $c) :?>
                                                        <option <?php if(in_array($c, $arr)) echo 'selected="selected"'?> value="<?php echo $c?>"><?php echo $c?></option>
                                                        <?php endforeach;?>
    					                            </select>
                                                <?php endif;?>
                                            <?php endif;?>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-textarea-input">简介</label>
    					                    <div class="col-md-6">
    					                        <textarea rows="5" class="form-control edit" placeholder="..." name="des"><?php echo $res->des?></textarea>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group pad-ver">
    					                    <label class="col-md-3 control-label">上架状态*</label>
    					                    <div class="col-md-6">
    					                        <div class="radio">
    					                            <select class="selectpicker" required="required" name="is_sale">
                    	                                <option value="">请选择</option>
                                                        <option <?php if($res->is_sale==1)echo 'selected="selected"'?> value="1">上架</option>
                                                        <option <?php if($res->is_sale==2)echo 'selected="selected"'?> value="2">待售</option>
                                                        <option <?php if($res->is_sale==3)echo 'selected="selected"'?> value="3">下架</option>
                                                    </select>
    					                        </div>
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">销量</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" readonly value="<?php echo $res->sum_sale;?>">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">评价</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" readonly value="<?php echo $res->sum_review;?>">
    					                    </div>
    					                </div>
    					                
    					                <div class="form-group">
    					                    <label class="col-md-3 control-label" for="demo-text-input">收藏</label>
    					                    <div class="col-md-6">
    					                        <input type="text" class="form-control" readonly value="<?php echo $res->enshrine_num;?>">
    					                    </div>
    					                </div>
    					
					                </div>
					                
					                <div class="panel-footer">
					                    <div class="row">
					                        <div class="col-sm-9 col-sm-offset-3">
					                            <button class="btn btn-mint" type="submit">提交</button>
					                        </div>
					                    </div>
					                </div>
					            </form>
					        </div>
					    </div>
					</div>
					<script>
					$(function(){
    					//图片预览
    					$('.form-group').find('input[type="file"]').change(function(){
    						var img = '<img height=100 width=100 src="'+window.URL.createObjectURL(this.files[0])+'">';
    						$(this).siblings('div').html(img);
    					}); 

    					//多选
    					if($('#multi-component').size() > 0){
    						$('#multi-component').chosen({width:'100%'});
    					}
    					if($('#multi-style').size() > 0){
    						$('#multi-style').chosen({width:'100%'});
    					}
    					if($('#multi-category').size() > 0){
    						$('#multi-category').chosen({width:'100%'});
    					}
    					if($('#multi-source').size() > 0){
    						$('#multi-source').chosen({width:'100%'});
    					}
    
					});
					</script>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            