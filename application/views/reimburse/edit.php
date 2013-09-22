<div class="alert alert-info"><i class="icon-edit"></i> 编辑费用报表/New Expense Report (蓝色标记框为必填/Blue underline is required) </div>
<?php 
$ci = & get_instance();
$user = $ci->get_my()
?>
<form  name="demo" action="" method="post">


<input name="epid" value="<?php echo $info['epid'];?>" type="hidden"/>
<input name="type" value="<?php echo $info['Expensetype'];?>" type="hidden"/>
<input name="oppid" value="<?php echo $info['oppid'];?>" type="hidden"/>
<input name="project" value="<?php echo $info['proid'];?>" type="hidden" />
<input name="costid" value="<?php echo $info['costid'];?>" type="hidden" type="hidden" />

<div class="container">
<table class="table table-bordered table-condensed">
	<tr>
		<td>Expense Name</td><td><span class="label label-success"><?php echo $info['ename'];?></span> <strong>[ <?php echo $info['explanation'];?> ]</strong></td>
		<td>Office</td>
		<td>
			<select name="location">
				<option value="Gemba_China_Shanghai">Gemba_China_Shanghai</option>
				<option value="Gemba_China_Dongguan">Gemba_China_Dongguan</option>
				<option value="Gemba_China_Chongqing">Gemba_China_Chongqing</option>
				<option value="Gemba_China_Beijing">Gemba_China_Beijing</option>
			</select>
		</td>
	</tr>

	<tr>
		<td>Project项目</td>
		<td><?php if($info['proid']){?> <a href="<?php echo site_url('project/edit_project/'.$info['proid']);?>">点击查看项目 <?php }?></td>
		<td>销售机会</td>
		<td><?php echo $info['oppid'];?></td>
	</tr>
</table>
</div>

<div class="container">

<table class="table table-bordered table-condensed">
	<tr>
		<td>Rec Date</td>
		<td>Airfare</td>
		<td>Hotels</td>
		<td>Meals / Ent</td>
		<td>Transport</td>
		<td>Misc</td>
		<td>Type</td>
		<td>支出类型(该项默认为空)</td>
		<td>Explanation</td>
		<td class="span2">Action</td>
	</tr>
	<?php foreach ($items as $item) {?>
	<tr>	
		<td><?php echo date( 'Y-m-d' ,  strtotime( $item['RecDate']));?></td>
		<td><?php echo $item['airfare'];?></td>
		<td><?php echo $item['hotels'];?></td>
		<td><?php echo $item['meals'];?></td>
		<td><?php echo $item['transport'];?></td>
		<td><?php echo $item['misc'];?></td>
		<td><?php echo $item['type'];?></td>
		<td><?php echo ($item['costid']) ? $cost_category[$item['costid']] :'';?></td>
		<td><?php echo $item['explanation'];?></td>
		<td>
		<?php if( $user['userId'] === $info['userId']) {?>
		<?php if( !$info['isExpense']){?>
				<a class="btn btn-primary btn-mini"  href="<?php echo site_url('reimburse/edit/'.$info['epid'].'/'.$item['eid']);?>">edit</a> 
				<a class="btn btn-primary btn-mini" href="<?php echo site_url('reimburse/del_item/'.$item['eid']);?>">del</a>
			<?php }}?>
		</td>
	</tr>	
	<?php }?>

	<?php if( !$edit_item){?>
	<tr class="success">
		<td><input name="RecDate" class="form_datetime span2" type="text" value="<?php echo date('Y/m/d');?>"></td>
		<td><input name="airfare" class="span1" type="text" value="0" /></td>
		<td><input name="hotels" class="span1" type="text" value="0" /></td>
		<td><input name="meals" class="span1" type="text" value="0" /></td>
		<td><input name="transport" class="span1" type="text" value="0" /></td>
		<td><input name="misc" class="span1" type="text" value="0" /></td>
		<td><?php echo $info['Expensetype'];?></td>
		<td><select class="span2" name="costid"><option>选择支出类型</option><?php foreach ($cost_category as $key=>$cost) {?><option value="<?php echo $key;?>"><?php echo $cost;?></option><?php }?></select></td>
		<td><textarea name="explanation"></textarea></td>
		<td><button name="create_item" type="submit" class="btn btn-primary btn-small" value="1" <?php if( $user['userId'] != $info['userId']) {?>disabled<?php }?>>add</button></td>
	</tr>
	<?php }else {?>
	</form>
	<form action="" method="post">
	<tr class="success">
		<td><input name="RecDate" class="form_datetime" size="23" type="text" value="<?php echo $edit_item['RecDate'];?>"></td>
		<td><input name="airfare" class="span1" type="text" value="<?php echo $edit_item['airfare'];?>" /></td>
		<td><input name="hotels" class="span1" type="text" value="<?php echo $edit_item['hotels'];?>" /></td>
		<td><input name="meals" class="span1" type="text" value="<?php echo $edit_item['meals'];?>" /></td>
		<td><input name="transport" class="span1" type="text" value="<?php echo $edit_item['transport'];?>" /></td>
		<td><input name="misc" class="span1" type="text" value="<?php echo $edit_item['misc'];?>" /></td>
		<td><?php echo $info['Expensetype'];?></td>
		<td>
			<select class="span2" name="costid">
				<?php foreach ($cost_category as $key=>$cost) {?><option <?php if( $edit_item['costid'] == $key) {?>selected="selected"<?php }?> value="<?php echo $key;?>"><?php echo $cost;?></option><?php }?>
			</select>
		</td>
		<td><textarea class="span2" name="explanation"><?php echo $edit_item['explanation'];?></textarea></td>
		<td><button name="save_item" type="submit" class="btn btn-primary btn-small" value="1">save</button></td>
		<input type="hidden" name="eid" value="<?php echo $edit_item['eid'];?>" />
		<input type="hidden" name="epid" value="<?php echo $edit_item['epid'];?>" />
	</tr>	
	<?php }?>
	<script type="text/javascript">
    	$(".form_datetime").datetimepicker({format: 'yyyy/mm/dd'});
	</script>

	<tr class="info">
		<td>Total : <?php echo $info['total'];?></td>
		<td><?php echo $info['totalAirfare'];?></td>
		<td><?php echo $info['totalHotels'];?></td>
		<td><?php echo $info['totalMeals'];?></td>
		<td><?php echo $info['totalTransport'];?></td>
		<td><?php echo $info['totalMisc'];?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>
</div>

</form>




<form action="" method="post">
<input type="hidden" name="epid" value="<?php echo $info['epid'];?>" />

<div class="hero-unit">
	<div>
		<h4>Total Expense to bill <?php echo $info['location'];?> ：</h4>
		<span class="badge"><h3>￥<?php echo $info['total'];?></h3></span>
		<hr/>
	</div>
		
	<div>
		
		<table class="table table-bordered">
			
			<tr>
				<td>Signature</td> 
				<td>
					<select name="userId">
					<option value="">选择相关人员</option>
						<?php foreach ($user_list as $key => $value) :?>
							<option <?php if( $info['userId']==$key){?>selected="selected"<?php }?> value="<?php echo $key;?>"><?php echo $value;?></option>
						<?php endforeach ?>
					</select>
				</td>
			</tr>

			<tr>
				<td>Department Manager Signature</td>
				<td>
					<select name="department">
					<option value="">选择相关人员</option>
						<?php foreach ($user_list as $key => $value) :?>
							<option <?php if( $info['department']==$key){?>selected="selected"<?php }?> value="<?php echo $key;?>"><?php echo $value;?></option>
						<?php endforeach ?>
					</select>
					
					<?php if( $info['depart_confirm']) {?><span class="label label-success">已经确认报销</span>
					<?php }else{?> <span class="label label-info">等待部门经理/项目经理，确认报销</span>
					<?php }?>
				</td>
			</tr>

			<tr>
				<td>Finance Signature</td>
				<td>
					<select name="financial">
						<option value="">选择相关人员</option>
						<?php foreach ($user_list as $key => $value) :?>
							<option <?php if( $info['financial']==$key){?>selected="selected"<?php }?> value="<?php echo $key;?>"><?php echo $value;?></option>
						<?php endforeach ?>
					</select>
					<?php if( $info['financial_confirm']) {?><span class="label label-success">已经确认报销</span>
					<?php }else{?>	<span class="label label-info">等待财务，确认报销</span>
					<?php }?>			
				</td>
			</tr>

			<tr>
				<td>Managing Director Signature</td>
				<td>
					<select name="general">
					<option value="">选择相关人员</option>
						<?php foreach ($user_list as $key => $value) :?>
							<option <?php if( $info['general']==$key){?>selected="selected"<?php }?> value="<?php echo $key;?>"><?php echo $value;?></option>
						<?php endforeach ?>
					</select>				
					<?php if( $info['general_confirm']) {?><span class="label label-success">已经确认报销</span>
					<?php }else{?>	<span class="label label-info">等待总监，确认报销</span>
					<?php }?>		
				</td>
			</tr>

		</table>
	</div>
<button type="submit" name="save_report" value="1" class="btn btn-primary" <?php if( $user['userId'] != $info['userId']) {?>disabled<?php }?>>Save Expense Report</button>

</div>

</form>