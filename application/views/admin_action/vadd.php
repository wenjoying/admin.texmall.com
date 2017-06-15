<?php $this->load->view('layout/header');?>
                                
                <hr class="whiter" />
                
                <div class="block-area" id="horizontal">
                    <h3 class="block-title">新增权限方法</h3>
                    <form class="form-horizontal" action="<?php echo base_url('Cadmin_action/addPost');?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="form-group">
                            <label for="inputName1" class="col-md-2 control-label">权限方法*</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-sm" name="action" required="required" maxlength="50" value="" placeholder="...">
                                <p>不能重复，格式：Cuser::index</p>
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