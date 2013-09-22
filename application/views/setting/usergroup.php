<h3>用户组 - Usergroup</h3>

添加/编辑
<form class="form-inline" action="" method="post">
<div class="input-prepend"><span class="add-on">用户组名</span><input name="gname" type="text" placeholder="Type something…"></div>
<div class="input-prepend"><span class="add-on">描述</span><input name="description" type="text" placeholder="Type something…"></div>

<div class="input-prepend"><span class="add-on">分组负责人</span>                   
<select name="gleader">
    <?php foreach ($users as $user) {?>
        <option value="<?php echo $user['userId'];?>"><?php echo $user['userName']?> - <?php echo $user['othername'];?></option>
    <?php }?>
</select>
</div>
<button name="create_item" class="btn btn-primary" type="submit" value="1">确定</button>
</form>
<?php
$user_list = array();
foreach ($users as $u) {
    $user_list[$u['userId']] = $u['userName'];
}
?>

      	<table class="table table-striped">
        <tbody>
        	<tr>
            	<th>ID</th>
            	<th>用户组</th>
                <th>用户组负责人</th>
                <th>描述</th>
                <th>操作</th>
            </tr>
            <?php foreach ($list as $group) {?>
            <tr>
                <td><?php echo $group['gid'];?></td>
                <td><?php echo $group['gname']?></td>
                <td><?php echo isset( $user_list[$group['gleader']] ) ? $user_list[$group['gleader']] : '未分配';?></td>
                <td><?php echo $group['description']?></td>
                <td><a href="<?php echo site_url('setting/'.$action.'/del_item/'.$group['gid'])?>" class="btn btn-mini">删除 Remove</a></td>
            </tr>            
            <?php }?>
        </tbody>
   		</table>