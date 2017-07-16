<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="<?php echo base_url('Cthird_manage/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="ion-load-d"></i>刷新</button></a>
					        </h3>
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
                                                    <th width="10%"><div class="th-inner">名称</div></th>
                                                    <th width="20%"><div class="th-inner">地址</div></th>
                                                    <th width="10%"><div class="th-inner">用户名</div></th>
                                                    <th width="10%"><div class="th-inner">密码</div></th>
                                                    <th width="10%"><div class="th-inner">备注</div></th>
                                                    <th width="5%"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><div class="th-inner"><input class="list-check" type="checkbox" name="checkid[]" value="<?php echo $r->id?>"></div></td>
            					                    <td><?php echo $r->id?></td>
                                                    <td><?php echo $r->name?></td>
                                                    <td><a target="_blank" href="<?php echo $r->third_url?>"><?php echo $r->third_url?></a></td>
                                                    <td><?php echo $r->username?></td>
                                                    <td><?php echo $this->admin->id==1?$r->password:'****'?></td>
                                                    <td><?php echo $r->note?></td>
            					                    <td>
                                                        <div class="btn-group m-b-5">
                                                            <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu animated fadeIn">
                                                                <li><a href="javascript:layer_conf('<?php echo base_url('Cthird_manage/delete/'.$r->id);?>');"><i class="ion-trash-a"></i>删除</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
        					                    </tr>
        					                    <?php endforeach;?>
        					                </tbody>
    					                </table>
    					                <script>
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