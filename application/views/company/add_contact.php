<div class="container">
<div class="span8">
<div class="alert alert-info"><i class="icon-user"></i> 添加联系人 <?php if( isset( $co)){echo'到 <strong>'.$co['companyname'].'<strong>';}?>  (带蓝色标记的字段为必填项)</div>
<form action="" method="post" enctype="multipart/form-data">
<table class="table table-bordered">
		
	<tr>
		<td>姓</td>
		<td>
			<div class="control-group info"><div class="controls">
			<input name="fname" type="text"/>
			</div></div>
		</td>
		<td>名</td>
		<td>
			<div class="control-group info"><div class="controls">
			<input name="lname" type="text"/>
			</div></div>
		</td>
	</tr>


	<tr>
		<td>职位</td>
		<td><div class="control-group info"><div class="controls"><input name="position" type="text"/></div></div></td>
		<td>
		公司名称<input type="hidden" name="companyname" value="<?php echo $co['companyname'];?>"/>
		</td>
		<td>
		<?php if( isset( $co)){?>
		<?php echo $co['companyname'];?>
		<?php }else{?>
		<div class="control-group info"><div class="controls">
		<select name="companyname">
		<option value="未分类">无</option>>
		<?php foreach ($company_list as $option) :?>
			<option value="<?php echo $option['companyname'];?>"><?php echo $option['companyname'];?></option>
		<?php endforeach ?>
		</select>
		<?php }?>
		</div></div>
		</td>
	</tr>

	<tr>
		<td>性别</td>
		<td>
		<div class="control-group info"><div class="controls">
		<select name="sex">
			<option value="">Empty</option>
			<option value="Female">男</option>
			<option value="Female">女</option>

		</select>
		</div></div>
		</td>
		<td>联系人电话</td>
		<td><div class="control-group info"><div class="controls"><input name="businessphone" type="text"/></div></div></td>
	</tr>

	<tr>
		<td>邮件</td>
		<td><div class="control-group info"><div class="controls"><input name="email" type="text"/></div></div></td>
		<td>手机</td>
		<td><div class="control-group info"><div class="controls"><input name="email" type="text"/></div></div></td>
	</tr>

	<tr>
		<td>工作语言</td>
		<td><div class="control-group info"><div class="controls">
		<select name="worklang"  class="required" >                 
            <option value=86>中文</option>
            <option value=1033>英文</option> 
            <option value=82>日文</option>                
       </select>
       </div></div></td>
		<td>微博</td>
		<td><input name="weibo" type="text"/></td>
	</tr>

	<tr>
		<td>助手</td>
		<td><input name="assistance" type="text"/></td>
		<td>秘书名字</td>
		<td><input name="secretary" type="text"/></td>
	</tr>

	<tr>
		<td>身份证 </td>
		<td><input name="IDcard" type="text"/></td>
		<td>手机</td>
		<td><input name="phone" type="text"/></td>
	</tr>

	<tr>
		<td>联系人背景</td>
		<td><textarea class="background"></textarea></td>
		<td></td>
		<td></td>
	</tr>


	<tr>
		<td>上传身份证</td>
		<td><input name="idcard_photo" type="file"/></td>
		<td></td>
		<td></td>
	</tr>
</table>
<button class="btn btn-primary" type="submit" name="add_contact" value="1">添加联系人</button>
</div>
</div>