<?php $this->load->view('layout/header');?>
                                
                <hr class="whiter" />
                <div class="listview list-container">
                    <header class="listview-header media">
                        <ul class="list-inline list-mass-actions pull-left">
                            <li>
                                <a data-toggle="modal" href="<?php echo base_url('Cadmin_user/add');?>" title="新增" class="tooltips">
                                    <i class="sa-list-add"></i>
                                </a>
                            </li>
                            <li>
                                <a href="" title="刷新" class="tooltips">
                                    <i class="sa-list-refresh"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </header>
                    
                    <div class="block-area" id="tableHover">
                        <div class="table-responsive overflow">
                            <form class="form-horizontal" action="<?php echo base_url('Cadmin_user/delete');?>" method="post" role="form">
                                <table class="table table-bordered table-hover tile" style="margin-bottom: 50px;">
                                    <thead>
                                        <tr>
                                            <th width="2%"><input type="checkbox" class="pull-left list-parent-check" value=""></th>
                                            <th width="5%">ID</th>
                                            <th width="10%">头像</th>
                                            <th width="10%">用户名</th>
                                            <th width="10%">添加时间</th>
                                            <th width="5%">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($res as $r):?>
                                        <tr>
                                            <td><input type="checkbox" class="pull-left list-check" name="checkid[]" value="<?php echo $r->id?>"></td>
                                            <td><?php echo $r->id?></td>
                                            <td><img style="height:80px;width:80px;" src="<?php echo $this->config->image_url.$r->userimg?>"></td>
                                            <td>
                                                <?php echo $r->username.'</br>'.$r->mobile?>
                                            </td>
                                            <td><?php echo date('Y-m-d H:i:s', $r->reg_time);?></td>
                                            <td>
                                                <div class="btn-group m-b-5">
                                                    <button type="button" class="btn btn-sm">操作</button>
                                                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu animated fadeIn">
                                                        <li><a href="<?php echo base_url('Cadmin_user/page/'.$r->id);?>"><span class="icon">&#61786;</span>查看</a></li>
                                                        <li><a href="<?php echo base_url('Cadmin_user/reset_pwd/'.$r->id);?>"><span class="icon">&#61714;</span>重置密码</a></li>
                                                        <li><a href="<?php echo base_url('Cadmin_user/delete/'.$r->id);?>"><span class="icon">&#61918;</span>删除</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                        <tr>
                                            <td width="2%"><input type="checkbox" class="pull-left list-parent-check" value=""></td>
                                            <th width="5%">ID</th>
                                            <td width="10%">头像</td>
                                            <td width="10%">用户名</td>
                                            <td width="10%">添加时间</td>
                                            <td width="5%">操作</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="show-on" style="display: none;">
                                    <a href="javascript:;" onclick="$('form').submit();" title="删除" class="tooltips">
                                        <i class="sa-list-delete"></i>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            
<?php $this->load->view('layout/footer');?>