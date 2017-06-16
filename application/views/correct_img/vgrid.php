<?php $this->load->view('layout/header');?>
                                
                <hr class="whiter" />
                <div class="listview list-container">
                    <header class="listview-header media">
                        <ul class="list-inline list-mass-actions pull-left">
                            <li>
                                <a data-toggle="modal" href="<?php echo base_url('Ccorrect_img/add');?>" title="新增" class="tooltips">
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
                        <form class="form-inline" action="<?php echo base_url('Ccorrect_img/grid');?>" method="get" role="form" >
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <select class="select" name="type">
                                        <option value="">类型</option>
                                        <option <?php if($this->input->get('type')=='model')echo 'selected="selected"'?> value="model">模特</option>
                                        <option <?php if($this->input->get('type')=='tex')echo 'selected="selected"'?> value="tex">布料</option>
                                    </select>
                                </div>
                                <div class="form-group input-icon datetime-pick date-only">
                                    <input data-format="yyyy/MM/dd" type="text" class="form-control input-sm" name="sta_time" value="<?php echo $this->input->get('sta_time');?>" placeholder="起始时间" />
                                    <span class="add-on">
                                        <i class="sa-plus"></i>
                                    </span>
                                </div>
                                <div class="form-group input-icon datetime-pick date-only">
                                    <input data-format="yyyy/MM/dd" type="text" class="form-control input-sm" name="end_time" value="<?php echo $this->input->get('end_time');?>" placeholder="截止时间" />
                                    <span class="add-on">
                                        <i class="sa-plus"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" id="exampleInputPassword2" name="item" value="<?php echo $this->input->get('item');?>" placeholder="简介">
                                </div>
                                <button type="submit" class="btn btn-sm">查找</button>
                                <a href="javascript:;" onClick="window.location.reload();"><button type="reset" class="btn btn-sm">重置</button></a>
                            </div> 
                        </form>
                        <div class="table-responsive overflow">
                            <form class="form-horizontal" action="<?php echo base_url('Ccorrect_img/delete');?>" method="post" role="form">
                                <table class="table table-bordered table-hover tile" style="margin: 15px 0 50px 0;">
                                    <thead>
                                        <tr>
                                            <th width="2%"><input type="checkbox" class="pull-left list-parent-check" value=""></th>
                                            <th width="5%">ID</th>
                                            <th width="10%">图片</th>
                                            <th width="10%">类型</th>
                                            <th width="10%">简介</th>
                                            <th width="10%">时间</th>
                                            <th width="5%">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($res as $r):?>
                                        <tr>
                                            <td><input type="checkbox" class="pull-left list-check" name="checkid[]" value="<?php echo $r->id?>"></td>
                                            <td><?php echo $r->id?></td>
                                            <td><a target="_blank" href="<?php echo $this->config->image_url.$r->correct_img?>"><img style="height:80px;width:80px;" src="<?php echo $this->config->image_url.$r->correct_img?>"></a></td>
                                            <td><?php echo $r->type?></td>
                                            <td><?php echo $r->des?></td>
                                            <td><?php echo date('Y-m-d H:i:s', $r->time);?></td>
                                            <td>
                                                <div class="btn-group m-b-5">
                                                    <button type="button" class="btn btn-sm">操作</button>
                                                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu animated fadeIn">
                                                        <li><a href="<?php echo base_url('Ccorrect_img/delete/'.$r->id);?>"><span class="icon">&#61918;</span>删除</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                        <tr>
                                            <td width="2%"><input type="checkbox" class="pull-left list-parent-check" value=""></td>
                                            <td width="5%">ID</td>
                                            <td width="10%">图片</td>
                                            <td width="10%">类型</td>
                                            <td width="10%">简介</td>
                                            <td width="10%">时间</td>
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