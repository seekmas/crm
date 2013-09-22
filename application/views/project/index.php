<?php
$ci = & get_instance();
$user = $ci->get_my();
?>
<div class="alert alert-info">
	<i class="icon-search"></i> 搜索项目
</div>

<form class="form-search" name="__search" action="" method="post">
	<div class="input-prepend">
		<span class="add-on">项目名称</span>
		<input name="projectname" class="span2" id="prependedInput" type="text" placeholder="">
	</div>

	<div class="input-prepend">
		<span class="add-on">项目负责人</span>
		<select name="userName">
			<option value="">选择项目负责人</option>
			<?php foreach ($user_list as $u) : ?>
				<option value="<?php echo $u['userId'];?>"><?php echo $u['userName'];?></option>
			<?php endforeach ?>
		</select>
	</div>


	<div class="input-append">
		<button class="btn btn-primary" name="search_project" value="1" type="submit">搜索</button>
	</div>	
</form>

<div class="alert alert-info"><i class="icon-info-sign"></i>项目列表 ( 加有绿色标记的项目为自己的项目 )</div>

<table class="table table-condensed table-striped table-bordered">
<thead>
	<tr>
		<td>ID</td>
		<td>项目名称[公司名称]</td>
		<td>类型</td>
		<td>开始日期</td>
		<td>结束日期</td>
		<td>已做天数(财务)</td>
		<td>已做天数(销售)</td>
		<td>总服务天数</td>
		<td>合同金额</td>
		<td>收入金额</td>
		<td>税金总额</td>
		<td>利润总额</td>
		<td>利润率</td>
		<td>创建日期</td>
		<td>项目负责人</td>
	</tr>
</thead>

<tbody>
	<?php foreach ($projects as $p) {?>
		<tr>
			<td><?php if( $user['userName'] === $p['userName']){?><span class="label label-success"><?php echo $p['projectId'];?></span><?php }else{?><?php echo $p['projectId'];?><?php }?></td>
			<td><a href="<?php echo site_url('project/edit_project/'.$p['projectId']);?>"><?php echo $p['projectName'];?></a></td>
			<td><?php echo $p['categoryname'];?></td>
			<td><?php echo $p['startDate'];?></td>
			<td><?php echo $p['endDate'];?></td>
			<td><?php echo $p['TotalUsedDays'];?></td>
			<td><?php echo $p['Usedays_sales'];?></td>
			<td><?php echo $p['days'];?></td>
			<td><?php echo $p['totalPrice'];?></td>
			<td><?php echo $p['TotalIncome'];?></td>
			<td><?php echo $p['TotalTax'];?></td>
			<td><?php echo $p['TotalProfit'];?></td>
			<td><?php echo $p['totalPrice'] > 0 ? sprintf('%.2f%%' , $p['TotalProfit']/$p['totalPrice'] * 100) : '0%';?></td>
			<td><?php echo date('Y-m-d' , strtotime($p['createDate']));?></td>
			<td>
				<?php if( $user['userName'] === $p['userName']){?><span class="label label-success"><?php echo $p['userName'];?></span><?php }else{?>
				<?php echo $p['userName'];?>
				<?php }?>
			</td>
		</tr>
	<?php }?>
</tbody>
</table>

<?php $this->load->module('pagination/pagination/index' ,  array('total' => $total , 'page' => $page , 'offset' => $offset ));?>