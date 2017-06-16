<?php $this->load->view('layout/header');?>
                                
                <hr class="whiter" />
                
                <div class="block-area" id="horizontal">
                    <h3 class="block-title">新增应用</h3>
                    <form class="form-horizontal" action="<?php echo base_url('Cauth2/addPost');?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="form-group">
                            <label for="inputName1" class="col-md-2 control-label">应用名称*</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-sm" name="appname" required="required" maxlength="20" value="" placeholder="...">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputName1" class="col-md-2 control-label">回调地址*</label>
                            <div class="col-md-4">
                                <input type="url" class="form-control input-sm" name="redirect_uri" required="required" maxlength="100" value="" placeholder="...">
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