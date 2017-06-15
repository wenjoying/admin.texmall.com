<?php $this->load->view('layout/header');?>
                   
                <hr class="whiter" />
                <div class="listview list-container">
                    <header class="listview-header media">
                        <ul class="list-inline list-mass-actions pull-left">
                            <li>
                                <a data-toggle="modal" href="<?php echo base_url('Cad_img/add');?>" title="新增" class="tooltips">
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
                        <form class="form-inline" action="<?php echo base_url('Cad_img/grid');?>" method="get" role="form" >
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <select class="select" name="status" >
                                        <option value="">请选择状态</option>
                                        <option <?php if(1==$this->input->get('status'))echo 'selected="selected"'?> value="1">上线</option>
                                        <option <?php if(2==$this->input->get('status'))echo 'selected="selected"'?> value="2">下线</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" id="exampleInputPassword2" name="item" value="<?php echo $this->input->get('item');?>" placeholder="名称/简介">
                                </div>
                                <button type="submit" class="btn btn-sm">查找</button>
                                <a href="javascript:;" onClick="window.location.reload();"><button type="reset" class="btn btn-sm">重置</button></a>
                            </div> 
                        </form>
                        
                        <div class="table-responsive overflow">
                            <form class="form-horizontal" action="<?php echo base_url('Cad_img/delete');?>" method="post" role="form">
                                <table class="table table-bordered table-hover tile" style="margin:15px 0 50px 0;">
                                    <thead>
                                        <tr>
                                            <th width="2%"><input type="checkbox" class="pull-left list-parent-check" value=""></th>
                                            <th width="5%">ID</th>
                                            <th width="10%">广告图</th>
                                            <th width="10%">名称</th>
                                            <th width="20%">简介</th>
                                            <th width="10%">跳转地址</th>
                                            <th width="5%">排序</th>
                                            <th width="10%">状态</th>
                                            <th width="5%">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($res as $r):?>
                                        <tr>
                                            <td><input type="checkbox" class="pull-left list-check" name="checkid[]" value="<?php echo $r->id?>"></td>
                                            <td><?php echo $r->id?></td>
                                            <td><img style="height:80px;width:80px;" src="<?php echo $this->config->image_url.$r->ad_img?>"></td>
                                            <td><?php echo $r->ad_name?></td>
                                            <td><?php echo $r->ad_info?></td>
                                            <td><?php echo $r->ad_url?></td>
                                            <td><?php echo $r->reorder?></td>
                                            <td><?php echo $r->status==1 ? '<span class="label label-success">上线</span>' : '<span class="label label-danger">下线</span>'?></td>
                                            <td>
                                                <div class="btn-group m-b-5">
                                                    <button type="button" class="btn btn-sm">操作</button>
                                                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu animated fadeIn">
                                                        <li><a href="<?php echo base_url('Cad_img/edit/'.$r->id);?>"><span class="icon">&#61786;</span>查看</a></li>
                                                        <li><a href="<?php echo base_url('Cad_img/delete/'.$r->id);?>"><span class="icon">&#61918;</span>删除</a></li>
                                                    </ul>
                                                </div>
                                            
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                        <tr>
                                            <td width="2%"><input type="checkbox" class="pull-left list-parent-check" value=""></td>
                                            <th width="5%">ID</th>
                                            <td width="10%">广告图</td>
                                            <td width="10%">名称</td>
                                            <td width="20%">简介</td>
                                            <td width="10%">跳转地址</td>
                                            <td width="5%">排序</td>
                                            <td width="10%">状态</td>
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