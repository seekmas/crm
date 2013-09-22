<div class="alert alert-info">
	<i class="icon-edit"></i> 编辑/浏览 联系人资料
</div>

<div class="container">
<div class="span8">
<form action="" method="post">
<input type="hidden" name="contactId" value="<?php echo $profile['contactId'];?>" />
<table class="table table-bordered table-hover table-condensed table-striped">
	<tr>
		<td>姓氏</td> <td><input name="fname" value="<?php echo $profile['fname'];?>" type="text" /></td>
		<td>名字</td> <td><input name="lname" value="<?php echo $profile['lname'];?>" type="text" /></td>
	</tr>

	<tr>
		<td>公司</td> <td><a href="<?php echo site_url('company/parse_name/'.$profile['companyname']);?>"><?php echo $profile['companyname']?></td>
		<td>position</td> <td><input name="position" value="<?php echo $profile['position'];?>" type="text" /></td>
	</tr>


	<tr>
		<td>部门</td> <td><input name="department" value="<?php echo $profile['department'];?>" type="text" /></td>
		<td>性别</td> 
		<td>
			<select name="sex">
				<option value="">保密</option>
				<option <?php if($profile['sex'] == '男') {?>selected="selected"<?php }?> value="男">男</option>
				<option <?php if($profile['sex'] == '女') {?>selected="selected"<?php }?> value="女">女</option>
			</select>
		</td>
	</tr>


	<tr>
		<td>背景信息</td> <td><textarea name="background"><?php echo $profile['background'];?></textarea></td>
		<td>电话号码</td> <td><input name="phone" value="<?php echo $profile['phone'];?>" type="text" /></td>
	</tr>


	<tr>
		<td>工作电话</td> <td><input name="businessphone" value="<?php echo $profile['businessphone'];?>" type="text" /></td>
		<td>手机号</td> <td><input name="mobile" value="<?php echo $profile['mobile'];?>" type="text" /></td>
	</tr>


	<tr>
		<td>传真</td> <td><input name="fax" value="<?php echo $profile['fax'];?>" type="text" /></td>
		<td>email</td> <td><input name="email" value="<?php echo $profile['email'];?>" type="text" /></td>
	</tr>


	<tr>
		<td>微博</td> <td><input name="weibo" value="<?php echo $profile['weibo'];?>" type="text" /></td>
		<td>comtool</td> <td><input name="comtool" value="<?php echo $profile['comtool'];?>" type="text" /></td>
	</tr>

	<tr>
		<td>助手</td> <td><input name="assistance" value="<?php echo $profile['assistance'];?>" type="text" /></td>
		<td>秘书名称</td> <td><input name="secretary" value="<?php echo $profile['secretary'];?>" type="text" /></td>
	</tr>

	<tr>
		<td>地址</td> <td><input name="address" value="<?php echo $profile['address'];?>" type="text" /></td>
		<td>邮编</td> <td><input name="zip" value="<?php echo $profile['zip'];?>" type="text" /></td>
	</tr>

	<tr>
		<td>级别</td> 
		<td>
			<select name="level">
				<option <?php if( $profile['level'] === 'A'){?>selected="selected"<?php }?> value="A">A</option>
				<option <?php if( $profile['level'] === 'B'){?>selected="selected"<?php }?> value="B">B</option>
				<option <?php if( $profile['level'] === 'C'){?>selected="selected"<?php }?> value="C">C</option>
				<option <?php if( $profile['level'] === 'D'){?>selected="selected"<?php }?> value="D">D</option>
				<option <?php if( $profile['level'] === 'E'){?>selected="selected"<?php }?> value="E">E</option>
			</select>
		</td>
		<td>身份证号</td> <td><input name="IDcard" value="<?php echo $profile['IDcard'];?>" type="text" /></td>
	</tr>

	<tr>
		<td>沟通历史记录</td>
		<td><textarea name="history"><?php echo $profile['history'];?></textarea></td>
		<td></td>
		<td><button name="save_contact" value="1" type="submit" class="btn btn-primary">保存</button></td>
	</tr>
</table>
</form>
</div>

<div class="span4">
</div>

</div>