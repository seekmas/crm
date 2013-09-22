<div class="alert alert-info"><i class="icon-edit"></i> Expense Report List</div>

<?php $this->load->module('pagination/pagination/index' , array( $total_number,$page ,$offset));?>

<table class="table table-bordered table-striped">
<tr>
	<td>ID</td> <td>报销单名称</td> <td>备注</td> <td>总金额</td> <td>是否报销</td> <td>状态</td>

</tr>

<?php foreach ($reimburse_list as $re) {?>
<tr>
	<td><?php echo $re['epid'];?></td>
	<td><a href="<?php echo site_url('reimburse/edit/'.$re['epid']);?>"><i class="icon-edit"></i> <?php echo $re['ename'];?></a></td>
	<td><?php echo $re['explanation'];?></td>
	<td><?php echo $re['total'];?></td>
	<td><strong><?php echo $re['isExpense'] == 0 ? '<span class="badge badge-warning">否</span>' : '<span class="badge badge-success">是</span>';?></strong></td>
	<td>
	
	<?php if( $re['isExpense'] == 0){?>
	<ul>
		<li>等待部门/项目经理批准</li>
		<li>等待财务批准 </li>
	</ul>
	<?php }?>
	</td>
</tr>
<?php }?>