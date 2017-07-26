<?php $this->load->view('layout/header');?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">
    					        <?php echo $two_level?>
					            <a style="margin-left:50px;" href="<?php echo base_url('Cfonts/add');?>"><button class="btn btn-success"><i class="ion-plus-round"></i>添加</button></a>
					            <a class="btn-link" href="javascript:;" onClick="window.location.reload();"><button class="btn btn-default"><i class="demo-psi-repeat-2 icon-fw"></i>刷新</button></a>
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
            					                    <th><div class="th-inner">ID</div></th>
                                                    <th><div class="th-inner">图片</div></th>
                                                    <th><div class="th-inner">名称</div></th>
                                                    <th><div class="th-inner">点击下载</div></th>
                                                    <th><div class="th-inner">上架</div></th>
                                                    <th width="120px"><div class="th-inner">操作</div></th>
        					                    </tr>
    					                    </thead>
        					                <tbody>
        					                    <?php foreach($res as $r):?>
        					                    <tr>
            					                    <td><?php echo $r->id?></td>
                                                    <td><img height=100 src="<?php echo $this->config->image_url.$r->fonts_img?>"></td>
                                                    <td><?php echo $r->fonts_name?></td>
                                                    <td><a class="btn-link" href="<?php echo $this->config->image_url.$r->fonts_path?>"><?php echo $r->fonts_path?></a></td>
                                                    <td>
                                                        <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Cfonts/up_status/'.$r->id.'?status='.$r->status);?>',1);">
                                                        <?php echo $r->status==1 ? '<i class="ion-checkmark"></i>' : '<i class="ion-close"></i>'?>
                                                        </a>
                                                    </td>
            					                    <td>
                					                    <a class="btn-link" href="###" onclick="layer_ask('<?php echo base_url('Cfonts/delete/'.$r->id);?>');">删除</a>
                                                    </td>
        					                    </tr>
        					                    <?php endforeach;?>
        					                </tbody>
    					                </table>
    					            </div>
    					        </div>
					        </div>
				        </div>
					</div>
                </div>
                <!--===================================================-->
                <!--End page content-->

<?php $this->load->view('layout/footer');?>            