<form action="" method="post">
<input type="hidden" name="userId" value="<?php echo $user['userId'];?>"/>
	<fieldset>
		<legend>
			<h3>编辑用户-Edit user</h3>
		</legend>

		<div class="group-control">
			<div class="controls">
				<label><h4>账户-UserName</h4></label>
				<input name="userName" class="span4" type="text" placeholder="Type something…" readonly value="<?php echo $user['userName'];?>">
				<span class="help-block"><span class="label">Username to signin</span></span>
			</div>
		</div>

		<div class="group-control">
			<div class="controls">
				<label><h4>密码-Password</h4></label>
				<input name="passWord" class="span4" type="text" placeholder="Type something…" value="<?php echo $user['passWord'];?>">
				<span class="help-block"><span class="label">Password to signin</span></span>
			</div>
		</div>

		<div class="group-control">
			<div class="controls">
				<label><h4>真实姓名-Othername</h4></label>
				<input name="othername" class="span4" type="text" placeholder="Type something…" value="<?php echo $user['othername'];?>">
				<span class="help-block"><span class="label">Realname</span></span>
			</div>
		</div>

		<div class="group-control">
			<div class="controls">
				<label><h4>邮件-Email</h4></label>
				<input name="email" class="span4" type="text" placeholder="Type something…" value="<?php echo $user['email'];?>">
				<span class="help-block"><span class="label">Email address in using</span></span>
			</div>
		</div>

		<div class="group-control">
			<div class="controls">
				<label><h4>分组-Group</h4></label>
				<select class="span4" name="groupId">
					<?php foreach ($groups as $g) {?>
						<option <?php if($now_group[0]['gname']===$g['gname']){?>selected="selected"<?php }?> value="<?php echo $g['gid'];?>"><?php echo $g['gname'];?></option>
					<?php }?>
				</select>
				<span class="help-block"><span class="label label-info">当前分组-CurrentGroup : <?php echo $now_group[0]['gname'];?></span></span>
			</div>
		</div>

		<button name="save" type="submit" class="btn btn-success" value="1">保存-Save</button>
	</fieldset>
</form>