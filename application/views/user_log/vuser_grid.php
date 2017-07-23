<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php inc_css('bootstrap.min');?>
    <link href="<?php inc_file('bootstrap-table/bootstrap-table.min.css', 'plugins')?>" rel="stylesheet">
    <?php inc_js('jquery-2.2.4.min');?>
</head>
<body>
    <div class="col-sm-12" style="margin-top:15px;">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">我的浏览</h3>
            </div>

            <!--Bordered Table-->
            <!--===================================================-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">id</th>
                                <th>浏览</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($res as $r):?>
                            <tr>
                                <td class="text-center"><?php echo $r->id?></td>
                                <td><?php echo $r->log?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--===================================================-->
            <!--End Bordered Table-->

        </div>
    </div>
</body>
</html>