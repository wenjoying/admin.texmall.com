<?php $this->load->view('layout/header');?>
                                
                <hr class="whiter" />
                <div class="listview list-container">
                    <header class="listview-header media">
                        <ul class="list-inline list-mass-actions pull-left">
                            <li>
                                <a data-toggle="modal" href="<?php echo base_url('Cthird_manage/add');?>" title="新增" class="tooltips">
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
                            <form action="<?php echo base_url('Cthird_manage/delete')?>" method="post">
                                <table class="table table-bordered table-hover tile" style="margin: 15px 0 50px 0;">
                                    <thead>
                                        <tr>
                                            <th width="2%"><input type="checkbox" class="pull-left list-parent-check" value=""></th>
                                            <th width="5%">ID</th>
                                            <th width="10%">名称</th>
                                            <th width="20%">地址</th>
                                            <th width="10%">用户名</th>
                                            <th width="10%">密码</th>
                                            <th width="10%">备注</th>
                                            <th width="5%">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($res as $r):?>
                                        <tr>
                                            <td><input type="checkbox" class="pull-left list-check" value="<?php echo $r->id?>"></td>
                                            <td><?php echo $r->id?></td>
                                            <td><?php echo $r->name?></td>
                                            <td><a target="_blank" href="<?php echo $r->third_url?>"><?php echo $r->third_url?></a></td>
                                            <td><?php echo $r->username?></td>
                                            <td><?php echo $this->admin->id==1?$r->password:'****'?></td>
                                            <td><?php echo $r->note?></td>
                                            <td>
                                                <div class="btn-group m-b-5">
                                                    <button type="button" class="btn btn-sm">操作</button>
                                                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu animated fadeIn">
                                                        <li><a href="<?php echo base_url('Cthird_manage/delete/'.$r->id);?>"><span class="icon">&#61918;</span>删除</a></li>
                                                    </ul>
                                                </div>
                                            
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                        <tr>
                                            <td width="2%"><input type="checkbox" class="pull-left list-parent-check" value=""></td>
                                            <td width="5%">ID</td>
                                            <td width="10%">名称</td>
                                            <td width="20%">地址</td>
                                            <td width="10%">用户名</td>
                                            <td width="10%">密码</td>
                                            <td width="10%">备注</td>
                                            <td width="5%">操作</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            
<?php $this->load->view('layout/footer');?>