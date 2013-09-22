<h3>用户列表-User List </h3>

<form class="form-inline" action="" method="post">
<input type="hidden" name="createDate" value="<?php echo date('Y-m-d h:m:d')?>">
添加
<div class="input-prepend"><span class="add-on">账户</span><input name="userName" type="text" placeholder="name to sign in"></div>
<div class="input-prepend"><span class="add-on">密码</span><input name="passWord" type="text" placeholder="yourbirthday"></div>
<div class="input-prepend"><span class="add-on">邮箱</span><input name="email" type="text" placeholder="foo@gmail.com"></div>
<div class="input-prepend"><span class="add-on">组别</span>
    <select name="groupId">
    <?php foreach ($groups as $group) { ?>
            <option value="<?php echo $group['gid'];?>"><?php echo $group['gname'];?></option>
    <?php }?>
        
    </select>
</div>
<button name="create_item" class=" btn btn-primary" type="submit" value="1">确定</button>
</form>
<?php
$user_group = array();
foreach ($groups as $g) {
    $user_group[$g['gid']] = $g['gname'];
}
?>



      	<table class="table table-striped">
        <tbody>
        	<tr>
            	<th>ID</th>
                <th>用户名-Username</th>
                <th>邮件-Email</th>
                <th>分组-Group</th>
                <th>操作</th>
            </tr>
            <?php foreach ($list as $user) { ?>
            <tr>
                <td><?php echo $user['userId']?></td>
                <td><a href="<?php echo site_url('setting/edit_user/'.$user['userId']);?>"><?php echo $user['userName'];?></a></td>
                <td><?php echo $user['email'];?></td>
                <td><?php echo $user_group[$user['groupId']];?></td>
                <td><a href="<?php echo site_url('setting/'.$action.'/del_item/'.$user['userId'])?>" class="btn btn-mini">删除 Remove</a></td>
            </tr>   
            <?php }?>
        

        </tbody>
   		</table>