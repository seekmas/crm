<h3>级别-Level</h3>
添加
<form class="form-inline" action="" method="post">
<div class="input-prepend"><span class="add-on">级别</span><input name="level" class="span4" type="text" placeholder="Type something…"></div>
<div class="input-prepend"><span class="add-on">描述</span><input name="description" class="span4" type="text" placeholder="Type something…"></div>
<button name="create_item" class="btn btn-primary" type="submit" value="1">确定</button>
</form>

      	<table class="table table-striped">
        <tbody>
        	<tr>
            	<th>ID</th>
            	<th>级别</th>
                <th>描述</th>
                <th>操作</th>
            </tr>
            <?php foreach ($list as $level) {?>
            <tr>
                <td><?php echo $level['lid'];?></td>
                <td><?php echo $level['level'];?></td>
                <td><?php echo $level['description'];?></td>
                <td><a class="btn btn-mini" href="<?php echo site_url('setting/'.$action.'/del_item/'.$level['lid']);?>">删除 Remove</a></td>
            </tr>              
            <?php }?>
         

        </tbody>
   		</table>