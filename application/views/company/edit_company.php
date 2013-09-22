<div class="page-header">
    <h4>公司资料</h4>
</div>
<form class="form-inline" action="" method="post">
<input name="companyId" type="hidden" value="<?php echo $info['companyId'];?>" />

<div class="alert alert-info"><i class="icon-edit"></i> Edit Account - [A] (Blue around-line textbox is required)</div>
<table class="table table-striped table-bordered table-condensed">
	
	<tr>
		<td class="span2"><p class="text-info">Account name (required)</p></td> <td class="span4"><input name="companyname" value="<?php echo $info['companyname'];?>" type="text" required/></td>
		<td class="span2"><p class="text-info">Industry (required)</p></td> 
		<td class="span4">
			<select name="industry" required>
			<option value="0">Distribution</option>
			<?php foreach ($properties['industry'] as $option) {?>
				<option <?php if( $option['industry'] === $info['industry']){?>selected="selected"<?php }?> value="<?php echo $option['industry'];?>"><?php echo $option['industry'];?></option>
			<?php }?>
			</select>
		</td>
	</tr>
	

	<tr>
		<td class="span3"><p class="text-info">Source (required)</p></td> 
		<td class="span3" required>
			<select name="source">
			<option value="0">None</option>
			<?php foreach ($properties['source'] as $option) {?>
				<option <?php if( $option['source'] === $info['source']){?>selected="selected"<?php }?> value="<?php echo $option['source'];?>"><?php echo $option['source'];?></option>
			<?php }?>
			</select>
			<div class="input-prepend">
				<span class="add-on">Other其他</span><input name="other" type="text" />
			</div>
		</td>


		<td class="span3"><p class="text-info">Phone (required)</p></td> 
		<td class="span3"><input name="phone" value="<?php echo $info['phone'];?>" type="text" required /></td>
	</tr>


	<tr>
		<td class="span2"><p class="text-info">Country (required)</p></td> 
		<td class="span4">
			<select name="country">
			<option value="0">None</option>
			<?php foreach ($properties['country'] as $option) {?>
				<option <?php if( $option['cid'] == $info['country']) {?>selected="selected"<?php }?> value="<?php echo $option['cid'];?>"><?php echo $option['country'];?></option>
			<?php }?>
			</select>
		</td>

		<td class="span2"><p class="text-info">Province / State (required)</p></td> 
		<td class="span4">
			<select name="province">
			<option value="0">None</option>
			<?php foreach ($properties['province'] as $option) {?>
				<option <?php if( $option['id'] == $info['province']) {?>selected="selected"<?php }?> value="<?php echo $option['id'];?>"><?php echo $option['province'];?></option>
			<?php }?>
			</select>
		</td>
	</tr>

	<tr>
		<td class="span2"><p class="text-info">City (required)</p></td> <td class="span4"><input name="city" value="<?php echo $info['city'];?>" type="text" required /></td>
		<td class="span2"><p class="text-info">Level (required)</p></td> 
		<td class="span4">
			<select>
			<?php foreach ($properties['level'] as $option) {?>
				<option <?php if( $option['level'] === $info['level']){?>selected="selected"<?php }?> value="<?php echo $option['level'];?>"><?php echo $option['level'];?> - <?php echo $option['description'];?></option>
			<?php }?>
				
			</select>
		</td>
	</tr>


	<tr>
		<td class="span2"><p class="text-info">Address (required)</p></td> <td class="span4"><input name="address" value="<?php echo $info['address'];?>" type="text" required /></td>
		<td class="span2"><p class="text-info">Background (required)</p></td> <td class="span4"><input name="background" value="<?php echo $info['background'];?>" type="text" required /></td>
	</tr>


	<tr>
		<td class="span2">Website</td> 
		<td class="span4"><input name="url" value="<?php echo $info['url'];?>" type="text" /> <span class="add-on">
			<?php if( $info['url']){?><a class="btn btn-primary" href="<?php if( preg_match('/^http:\/\//', $info['url'])) echo $info['url'];else echo 'http://'.$info['url'];?>" target="blank"><i class="icon-hand-right"></i> Go To Website</a><?php }?></span>
		</td>

		<td class="span2">Zip / postal code</td> <td class="span4"><input name="zip" value="<?php echo $info['zip'];?>" type="text" /></td>
	</tr>


	<tr>
		<td class="span2">Fax</td> <td class="span4"><input name="fax" value="<?php echo $info['fax'];?>" type="text" /></td>
		<td class="span2">Revenue</td> <td class="span4"><input name="revenue" value="<?php echo $info['revenue'];?>" type="text" /></td>
	</tr>

	<tr>
		<td class="span2">Employees</td> <td class="span4"><input name="employees" value="<?php echo $info['employees'];?>" type="text" /></td>
		<td class="span2">Active</td> 
		<td class="span4">
			<input <?php if( $info['Active'] == 1){?>checked="checked"<?php }?> type="radio" name="Active" value="1"> 	正常 <input <?php if( $info['Active'] == 0){?>checked="checked"<?php }?> type="radio" name="Active" value="0"> 	锁定 
		</td>
	</tr>

</table>
<br/>
<div class="alert alert-info"><i class="icon-edit"></i> 开票信息</div>

<table class="table table-striped table-bordered table-condensed">
	<tr>
		<td>纳税人识别号</td>
		<td><input name="taxnumber" type="text" value="<?php echo $info['taxnumber'];?>" /></td>

		<td>公司开票电话信息</td>
		<td><input name="invoicephone" type="text" value="<?php echo $info['invoicephone'];?>" /></td>
	</tr>

	<tr>
		<td>公司开票地址</td>
		<td><input name="invoiceaddress" type="text" value="<?php echo $info['invoiceaddress'];?>" /></td>

		<td></td>
		<td></td>
	</tr>

	<tr>
		<td>开户行</td>
		<td><input name="bank" type="text" value="<?php echo $info['bank'];?>" /></td>

		<td>开户行电话</td>
		<td><input name="bankphone" type="text" value="<?php echo $info['bankphone'];?>" /></td>
	</tr>

	<tr>
		<td>开户行地址</td>
		<td><input name="bankaddress" type="text" value="<?php echo $info['bankaddress'];?>" /></td>

		<td></td>
		<td></td>
	</tr>
</table>


<button name="save_company" type="submit" class="btn btn-success" value="1">保存 Save</button>

</form>

<div class="page-header">
    <h4>销售机会/项目</h4>
    <small><a class="btn btn-primary" href="<?php echo site_url('project/add_oppo/'.$info['companyId']);?>">添加销售机会</a></small>
</div>
<table class="table table-striped table-bordered table-condensed">
	<thead>
	<tr>
		<th>编号</th>
		<th>销售机会名称</th>
		<th>产品类型</th>
		<th>创建日期</th>
		<th>截止日期</th>
		<th>更新日期</th>
		<th>状态</th>
		<th>销售阶段</th>
		<th>操作</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($opportunity as $option) :?>
	<tr>
		<td><?php echo $option['oppId'];?></td>
		<td><a href="<?php echo site_url('project/edit_opportunity/'.$option['oppId']);?>" target="blank"><i class="icon-external-link"></i> <?php echo $option['oppname'] ? $option['oppname'] : '未命名的销售机会';?></td>
		<td><?php echo $option['productname'];?></td>
		<td><?php echo date( 'Y/m/d h:i:s' , strtotime( $option['createdate']));?></td>
		<td><?php echo $option['expectDate'];?></td>
		<td><?php echo $option['updatedate'] ? date( 'Y/m/d h:i:s' , strtotime(  $option['updatedate'])) : '';?></td>
		<td><span class="badge"><?php echo $option['status'];?></span></td>
		<td><span class="badge badge-success"><?php echo $option['stage'];?></span></td>
		<td><a href="<?php echo site_url('project/del_opportunity/'.$option['oppId']);?>">删除</a></td>
	</tr>
	<?php endforeach ?>
	</tbody>
</table>

<div class="page-header">
    <h4>联系人</h4>
    <small><a class="btn btn-primary" href="<?php echo site_url('company/add_contact/'.$info['companyId']);?>">添加联系人</a></small>
</div>

<table class="table table-striped table-bordered table-condensed">
	<thead>
	<tr>
		<th>Name</th>
		<th>Position</th>
		<th>email</th>
		<th>Phone</th>
		<th>background</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach ($contacts as $contact) : ?>
		<tr>
			<td><a href="<?php echo site_url('company/edit_contact/'.$contact['contactId']);?>"><?php echo $contact['fullname'];?></a></td>
			<td><?php echo $contact['position'];?></td>
			<td><?php echo $contact['email'];?></td>
			<td><?php echo $contact['mobile'];?></td>
			<td><?php echo $contact['background'];?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
