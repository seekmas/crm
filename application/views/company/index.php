<div class="page-header">
	<h3>公司搜索 <small>搜索的结果全部显示在本页</small></h3>
</div>
<form class="form-inline" action="" method="get">
<div class="input-prepend">
	<span class="add-on">公司名字</span><input name="companyname" class="span3" type="text" placeholder="输入公司名字" />
</div>

<div class="input-prepend">
	<span class="add-on">负责人</span>
	<select name="createUser">
	<option value="">未知</option>
	<?php foreach ($users as $user) {?>
		<option value="<?php echo $user['userId'];?>"><?php echo $user['userName'];?> - <?php echo $user['othername'];?></option>
	<?php }?>
	</select>
</div>

<div class="input-prepend">
	<span class="add-on">级别</span>
	<select name="level">
	<option value="">未知</option>
	<?php foreach ($levels as $level) {?>
		<option value="<?php echo $level['level'];?>"><?php echo $level['level'];?></option>
	<?php }?>
	</select>	
</div>
<button name="search_company" class="btn btn-primary" type="submit" value="1">搜索</button>
</form>

<table class="table table-striped table-condensed">
	<tr>
		<td>ID</td>
		<td>级别</td>
		<td>公司名称</td>
		<td>Email</td>
		<td>公司电话</td>
		<td>创建日期</td>
		<td>负责人</td>
		<td>操作</td>
	</tr>


	<?php foreach ($companies as $c) {?>
	<tr>
		<td><?php echo $c['id'];?></td>
		<td><span class="label label-success">[ <?php echo $c['level'];?> ]</span></td>
		<td><a href="<?php echo site_url('company/edit_company/'.$c['companyId']);?>"><?php echo $c['companyname'];?></td>
		<td><?php echo $c['email'];?></td>
		<td><?php echo $c['phone'];?></td>
		<td><?php echo date('Y-m-d h:i' , strtotime( $c['createDate']));?></td>
		<td><?php echo $c['userName'];?></td>
		<td><a class="btn btn-mini btn-primary" href="<?php echo site_url('company/del_company/'.$c['companyId']);?>">Delete</a></td>
	</tr>
	<?php }?>
</table>


<?php $this->load->module('pagination/pagination' , array( 'total' => $flip['total'] , 'page' => $flip['page'] , 'offset' => $flip['offset']));?>