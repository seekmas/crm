	<h3>行业名称 - Industry Name</h3>
	<form class="form-inline" action="" method="post">
	添加
		<input class="span8" name="<?php echo $action;?>" type="text" placeholder="添加你想要的条目 some item's name you want"></td>
		<button name="create_item" class="btn btn-primary" type="submit" value="1">添加 Add Item</button>
	</form>
	<table class="table table-striped">
		<tbody>
			<tr>

			</tr>
			<tr>
				<th>ID</th>
				<th>行业名称-Industry Name</th>
				<th>操作-Action</th>
			</tr>
			<?php foreach ($list as $industry) {?>
			<tr>
				<td><?php echo $industry['iid']?></td>
				<td><?php echo $industry['industry'];?></td>
				<td><a class="btn btn-mini" href="<?php echo site_url('setting/industry/del_item/'.$industry['iid']);?>">删除 Remove</a></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
