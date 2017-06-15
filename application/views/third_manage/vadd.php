<?php $this->load->view('layout/header');?>
                                
                <hr class="whiter" />
                
                <div class="block-area" id="horizontal">
                    <h3 class="block-title">新增第三方接口</h3>
                    <form class="form-horizontal" action="<?php echo base_url('Cthird_manage/addPost');?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="form-group">
                            <label for="inputName1" class="col-md-2 control-label">名称*</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-sm" name="name" required="required" maxlength="20" value="" placeholder="...">
                                <p>不能重复</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputName1" class="col-md-2 control-label">地址*</label>
                            <div class="col-md-4">
                                <input type="url" class="form-control input-sm" name="third_url" required="required" maxlength="100" value="" placeholder="...">
                                <p>网址，如https://baidu.com</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputName1" class="col-md-2 control-label">用户名*</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-sm" name="username" required="required" maxlength="20" value="" placeholder="...">
                                <p>登陆第三方的用户名</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputName1" class="col-md-2 control-label">密码*</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-sm" autocomplete="off" name="password" required="required" maxlength="20" value="" placeholder="...">
                                <p>登陆第三方的密码</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">备注</label>
                            <div class="col-md-4">
                                <textarea class="form-control m-b-10" name="note" maxlength="100" placeholder="..."></textarea>
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