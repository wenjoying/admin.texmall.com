<?php $this->load->view('layout/header');?>
                                
                <hr class="whiter" />
                
                <div class="block-area" id="horizontal">
                    <h3 class="block-title">新增标准图片</h3>
                    <form class="form-horizontal" action="<?php echo base_url('Ccorrect_img/addPost');?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="form-group">
                            <label for="inputEmail1" class="col-md-2 control-label">标准图片*</label>
                            <div class="col-md-4">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-preview thumbnail form-control"></div>
                                    
                                    <div>
                                        <span class="btn btn-file btn-alt btn-sm">
                                            <span class="fileupload-new">选择</span>
                                            <span class="fileupload-exists">更换</span>
                                            <input type="file" name="correct_img" />
                                        </span>
                                        <a href="#" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">移除</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">类型*</label>
                            <div class="col-md-4">
                                <label class="radio-inline">
                                    <span class="checkableBox checkableBox-radio">    
                                        <input type="radio" class="validate[required]" name="type" checked="checked" value="model">
                                    </span>
                                                                                            模特
                                </label>
                                <label class="radio-inline">
                                    <span class="checkableBox checkableBox-radio"> 
                                        <input type="radio" class="validate[required]" name="type" value="tex">
                                    </span>
                                                                                             布料
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">简介</label>
                            <div class="col-md-4">
                                <textarea class="form-control m-b-10" name="des" maxlength="100" placeholder="..."></textarea>
                                <p>限100字</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" class="btn btn-info btn-sm m-t-10">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
                
            
<?php $this->load->view('layout/footer');?>