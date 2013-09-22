<?php 
$ci =& get_instance();

$user = $ci->get_my();
?>

<!--
<div class="alert alert-info">
	<i class="icon-search"></i> 搜索销售机会 
</div>

<form class="form-search" name="__search" action="" method="post">
	<div class="input-prepend">
		<span class="add-on">销售机会名称</span>
		<input name="oppname" class="span2" id="prependedInput" type="text" placeholder="">
	</div>

	<div class="input-prepend">
		<span class="add-on">等级</span>
		<select name="level" class="span2">
			<?php foreach ($search['level'] as $level) { ?>
				<option value="<?php echo $level['level'];?>"><?php echo $level['level'];?></option>
			<?php }?>
		</select>
	</div>

	<div class="input-prepend">
		<span class="add-on">销售阶段</span>
		<select name="stage" class="span2">
			<?php foreach ($search['stage'] as $stage) { ?>
				<option value="<?php echo $stage['sid'];?>"><?php echo $stage['stage'];?></option>
			<?php }?>
		</select>
	</div>


	<div class="input-append">
		<button class="btn btn-primary" name="search" value="1" type="submit">搜索</button>
	</div>	
</form>
-->
<form action="" method="">
	
</form>

<div class="alert alert-info"><i class="icon-list"></i> 销售机会列表 ( 负责人绿色标记的项目为自己的项目 )</div>

<table class="table">
	<tr>
		<td>等级</td> <td>销售机会名称</td> <td>产品类型</td> <td>公司名称</td> <td>创建日期</td> <td>截止日期</td> <td>更新日期</td> <td>负责人</td>
		<td>状态</td> <td>销售阶段</td> <td>操作</td>
	</tr>
	
	<?php foreach ($opportunity as $o) :?>
	<tr>
		<td><span class="badge badge-info"><?php echo $o['level'];?></span></td>
		<td><a href="<?php echo site_url('project/edit_opportunity/'.$o['oppId']);?>"><?php echo $o['oppname'];?></a></td>
		<td><?php echo $o['productname'];?></td>
		
		<td><a href="<?php echo site_url('company/edit_company/'.$o['companyId']);?>"><?php echo $o['companyName'];?></a></td>

		<td><?php echo date('Y/m/d', strtotime( $o['createdate']));?></td>
		<td><?php echo $o['expectDate'];?></td>
		<td><?php echo date('Y/m/d', strtotime( $o['updatedate']));?></td>
		<td>
			<?php if( $user['userName'] === $o['userName']){?><span class="label label-success"><?php echo $o['userName'];?></span><?php }else{?>
				<?php echo $o['userName'];?>
			<?php }?>
		</td>
		<td><?php echo $o['status'];?></td>
		<td><span class="badge badge-success"><?php echo $o['stage'];?></span></td>
		<td><?php if( $user['groupId'] === 1){?><a href="<?php echo site_url('project/del_opportunity/'.$o['oppId']);?>">删除</a><?php }?></td>
	</tr>
	<?php endforeach;?>
</table>

<?php $this->load->module('pagination/pagination/index' ,  array('total' => $total , 'page' => $page , 'offset' => $offset ));?>