<h3>级别-Level</h3>
添加
<form class="form-inline" action="" method="post">
<div class="input-prepend"><span class="add-on">阶段名称</span><input class="span4" name="stage" type="text" placeholder="Type something…"></td></div>
<div class="input-prepend"><span class="add-on">描述</span><input class="span4" name="description" type="text" placeholder="Type something…"></div>
<button name="create_item" class="btn btn-primary" type="submit" value="1">确定</button>
</form>

<table class="table table-striped">
    <tbody>
        <tr>
            <th>ID</th>
            <th>阶段名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        
        <?php foreach ($list as $stage) {?>
        <tr>
            <td><?php echo $stage['sid'];?></td>
            <td><?php echo $stage['stage'];?></td>
            <td><?php echo $stage['description'];?></td>
            <td><a href="<?php echo site_url('setting/'.$action.'/del_item/'.$stage['sid'])?>" class="btn btn-mini">删除 Remove</a></td>
        </tr>           
        <?php }?>
        </tbody>
   		</table>