<?php $this->load->view('layout/header');?>
                                
                <hr class="whiter" />
                <div class="listview list-container">
                    <header class="listview-header media">
                        <ul class="list-inline list-mass-actions pull-left">
                            <li>
                                <a data-toggle="modal" href="<?php echo base_url('Cauth2/add');?>" title="新增" class="tooltips">
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
                            <form action="<?php echo base_url('Cauth2/delete')?>" method="post">
                                <table class="table table-bordered table-hover tile" style="margin: 15px 0 50px 0;">
                                    <thead>
                                        <tr>
                                            <th width="2%"><input type="checkbox" class="pull-left list-parent-check" value=""></th>
                                            <th width="5%">ID</th>
                                            <th width="10%">应用名称</th>
                                            <th width="10%">应用appid</th>
                                            <th width="10%">应用secret</th>
                                            <th width="20%">回调地址redirect_url</th>
                                            <th width="5%">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($res as $r):?>
                                        <tr>
                                            <td><input type="checkbox" class="pull-left list-check" value="<?php echo $r->id?>"></td>
                                            <td><?php echo $r->id?></td>
                                            <td><?php echo $r->appname?></td>
                                            <td><?php echo $r->client_id?></td>
                                            <td><?php echo $r->client_secret?></td>
                                            <td><?php echo $r->redirect_uri?></td>
                                            <td>
                                                <div class="btn-group m-b-5">
                                                    <button type="button" class="btn btn-sm">操作</button>
                                                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu animated fadeIn">
                                                        <li><a href="<?php echo base_url('Cauth2/delete/'.$r->id);?>"><span class="icon">&#61918;</span>删除</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                        <tr>
                                            <td width="2%"><input type="checkbox" class="pull-left list-parent-check" value=""></td>
                                            <td width="5%">ID</td>
                                            <td width="10%">应用名称</td>
                                            <td width="10%">应用appid</td>
                                            <td width="10%">应用secret</td>
                                            <td width="20%">回调地址redirect_url</td>
                                            <td width="5%">操作</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            
<?php $this->load->view('layout/footer');?>