<div class="alert alert-info">[部门/项目经理] Confirm Expense Report List</div>
	
	<table class="table table-bordered">
		<tr>
			<td>ID</td>
			<td>Expense Name</td>
			<td>Explanation</td>
			<td>Value</td>
			<td>Reimbursement</td>
			<td>CreatedDate</td>
			<td>Action</td>
		</tr>
		<?php foreach ($department as $option): ?>
		<tr>
			<td><?php echo $option['epid'];?></td>
			<td><a href="<?php echo site_url('reimburse/edit/'.$option['epid']);?>"><?php echo $option['ename'];?></a></td>
			<td><?php echo $option['explanation'];?></td>
			<td><?php echo $option['total'];?></td>
			<td><?php echo $option['isExpense'];?></td>
			<td><?php echo $option['createdate'];?></td>
			<td><a href="<?php echo site_url('reimburse/comfirm_reimburse/depart/'.$option['epid'].'/department');?>" class="btn btn-primary btn-small">Confirm</a></td>
		</tr>	
		<?php endforeach ?>
	</table>

<div class="alert alert-info">[财务] Confirm Expense Report List</div>

	<table class="table table-bordered">
		<tr>
			<td>ID</td>
			<td>Expense Name</td>
			<td>Explanation</td>
			<td>Value</td>
			<td>Reimbursement</td>
			<td>CreatedDate</td>
			<td>Action</td>
		</tr>
		<?php foreach ($financial as $option): ?>
		<tr>
			<td><?php echo $option['epid'];?></td>
			<td><a href="<?php echo site_url('reimburse/edit/'.$option['epid']);?>"><?php echo $option['ename'];?></a></td>
			<td><?php echo $option['explanation'];?></td>
			<td><?php echo $option['total'];?></td>
			<td><?php echo $option['isExpense'];?></td>
			<td><?php echo $option['createdate'];?></td>
			<td><a href="<?php echo site_url('reimburse/comfirm_reimburse/financial/'.$option['epid'].'/financial');?>" class="btn btn-primary btn-small">Confirm</a></td>
		</tr>	
		<?php endforeach ?>
	</table>

<div class="alert alert-info">[管理总监]Confirm Expense Report List</div>

	<table class="table table-bordered">
		<tr>
			<td>ID</td>
			<td>Expense Name</td>
			<td>Explanation</td>
			<td>Value</td>
			<td>Reimbursement</td>
			<td>CreatedDate</td>
			<td>Action</td>
		</tr>
		<?php foreach ($general as $option): ?>
		<tr>
			<td><?php echo $option['epid'];?></td>
			<td><a href="<?php echo site_url('reimburse/edit/'.$option['epid']);?>"><?php echo $option['ename'];?></a></td>
			<td><?php echo $option['explanation'];?></td>
			<td><?php echo $option['total'];?></td>
			<td><?php echo $option['isExpense'];?></td>
			<td><?php echo $option['createdate'];?></td>
			<td><a href="<?php echo site_url('reimburse/comfirm_reimburse/general/'.$option['epid'].'/financial');?>" class="btn btn-primary btn-small">Confirm</a></td>
		</tr>	
		<?php endforeach ?>
	</table>