<?php $this->load->view('layout/header');?>
                                
                <hr class="whiter" />
                <div class="listview list-container">
                    <header class="listview-header media">
                        <ul class="list-inline pull-right m-t-5 m-b-0">
                            <li class="pagin-value hidden-xs">每页<?php echo $per_page?>条</li>
                            <li class="pagin-value hidden-xs">第<?php echo empty($this->uri->segment(3)) ? 1 : $this->uri->segment(3)?>页</li>
                            <li class="pagin-value hidden-xs">共<?php echo $sum?>条</li>
                        </ul>
                        
                        <ul class="list-inline list-mass-actions pull-left">
                            <li>
                                <a data-toggle="modal" href="<?php echo base_url('Cadmin_action/add');?>" title="新增" class="tooltips">
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
                        <form class="form-inline" action="<?php echo base_url('Cadmin_action/grid');?>" method="get" role="form" >
                            <div class="row">
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" id="exampleInputPassword2" name="item" value="<?php echo $this->input->get('item');?>" placeholder="权限/简介">
                                </div>
                                <button type="submit" class="btn btn-sm">查找</button>
                                <a href="javascript:;" onClick="window.location.reload();"><button type="reset" class="btn btn-sm">重置</button></a>
                            </div> 
                        </form>
                        
                        <div class="table-responsive overflow">
                            <form action="<?php echo base_url('Cadmin_action/delete')?>" method="post">
                                <table class="table table-bordered table-hover tile" style="margin: 15px 0 50px 0;">
                                    <thead>
                                        <tr>
                                            <th width="2%"><input type="checkbox" class="pull-left list-parent-check" value=""></th>
                                            <th width="5%">ID</th>
                                            <th width="5%">父级ID</th>
                                            <th width="10%">权限</th>
                                            <th width="30%">简介</th>
                                            <th width="5%">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($res as $r):?>
                                        <tr>
                                            <td><input type="checkbox" class="pull-left list-check" value="<?php echo $r->id?>"></td>
                                            <td><?php echo $r->id?></td>
                                            <td><?php echo $r->pid?></td>
                                            <td><?php echo $r->action?></td>
                                            <td><?php echo $r->des?></td>
                                            <td>
                                                <div class="btn-group m-b-5">
                                                    <button type="button" class="btn btn-sm">操作</button>
                                                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu animated fadeIn">
                                                        <li><a href="<?php echo base_url('Cadmin_action/delete/'.$r->id);?>"><span class="icon">&#61918;</span>删除</a></li>
                                                    </ul>
                                                </div>
                                            
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                        <tr>
                                            <td width="2%"><input type="checkbox" class="pull-left list-parent-check" value=""></td>
                                            <td width="5%">ID</td>
                                            <td width="5%">父级ID</td>
                                            <td width="10%">权限</td>
                                            <td width="30%">简介</td>
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
                    <div class="media text-center"><?php echo $link;?></div>
                </div>
            
<?php $this->load->view('layout/footer');?>