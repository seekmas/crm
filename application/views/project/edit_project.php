
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="projectId" value="<?php echo $project['projectId'];?>" />
<input type="hidden" name="contractNo" value="<?php echo $project['contractNo'];?>" />
<input type="hidden" name="contractFile" value="<?php echo $project['contractFile'];?>" />

<div class="alert alert-info"><i class="icon-edit"></i> 编辑项目/Edit Project (蓝色标记为必填/Blue underline is required)</div>
<table class="table table-bordered table-condensed">
	<tr>
		<td>项目名称/Project Name</td>
		<td><input name="projectName" value="<?php echo $project['projectName'];?>" type="text" /></td>
		<td>项目相关</td>
		<td>
		<a class="btn btn-primary btn-mini" href="<?php echo site_url('project/project_reimburse/'.$project['projectId']);?>">点击查看项目报销成本</a>
		<a class="btn btn-primary btn-mini" href="<?php echo site_url('reimburse/add_reimburse_for_project/'.$project['projectId'])?>">添加报销成本</a>
		</td>
	</tr>

	<tr>
		<td>项目来源/Source</td>
		<td><?php echo $project['source'];?></td>
		<td>项目类型/Type</td>
		<td>
			<select>
				<?php foreach ($type as $t) {?>
					<option <?php if( $t['categoryId'] === $project['type']){?>selected="selected"<?php }?> value="<?php echo $t['categoryId'];?>"><?php echo $t['categoryname'];?></option>
				<?php }?>
			</select>
		</td>
	</tr>

	<tr>
		<td>公司名称/Company Name <a href="<?php echo site_url('company/edit_company/'.$project['companyName']);?>">查看</a></td>
		<td>
			<select name="companyName">
				<option value="0">None</option>
				<?php foreach ($company as $c) {?>
					<option <?php if( $c['companyId'] === $project['companyName']){?>selected="selected"<?php }?> value="<?php echo $c['companyId'];?>"><?php echo $c['companyname'];?></option>
				<?php }?>
			</select>
		</td>
		
		<td>项目负责人/Person</td>
		<td><?php echo $username[0]['userName'];?></td>
	</tr>
</table>


<div class="alert alert-info"><i class="icon-edit"></i> 合同信息( 蓝色下划线框为必填/Blue underline is required 修改日期请点击文本框)</div>
<table class="table table-bordered table-condensed">
	<tr>
		<td>合同编号/Contract NO</td>
		<td><?php echo $project['contractNo'];?></td>
		<td>合同金额/Total Price</td>
		<td>
			<input name="totalPrice" type="text" value="<?php echo $project['totalPrice'];?>" />
			<p class="text-info"><i class="icon-info-sign"></i> 注：此处为阿拉伯数字，请勿填入中文字和英文标点，如：50000</p>
		</td>
	</tr>

	<tr>
		<td>开始日期/Start Date</td>
		<td><input name="startDate" class="form_datetime" size="23" type="text" value="<?php echo $project['startDate']?>"></td>
		<td>结束日期/End Date</td>
		<td><input name="endDate" class="form_datetime" size="23" type="text" value="<?php echo $project['endDate']?>"></td>
	</tr>
	
	<tr>
		<td>总服务天数/Days</td>
		<td><input name="TotalUsedDays" type="text" value="<?php echo $project['TotalUsedDays'];?>" /></td>

		<td>已服务天数（销售填写）</td>
		<td><input name="Usedays_sales" type="text" value="<?php echo $project['Usedays_sales'];?>" /></td>
	</tr>

	<tr>
		<td>上传合同</td>
		<td><input name="contract" type="file" /><p class="text-info"><i class="icon-info-sign"></i> 请上传合同最终的电子版，Word格式</p></td>
		<td>查看合同</td>
		<td><a href="<?php echo site_url('upload/contract/'.$project['contractFile']);?>"><img class="img-polaroid" src="<?php echo base_url('public/images/contracticon.jpg');?>" /></a></td>
	</tr>

	<tr>
		<td>付款条件</td>
		<td><textarea name="descrption" class="span4" rows="6"><?php echo $project['descrption'];?></textarea></td>
		<td></td>
		<td></td>
	</tr>

	<tr>
		<td>客户CRM ID编号/ID</td>
		<td></td>
		<td>总项目利润/Total Profit:</td>
		<td><strong><?php echo $project['TotalIncome'];?> 元</strong></td>
	</tr>

	<tr>
		<td>项目报销成本</td>
		<td></td>
		<td>项目状态</td>
		<td><label class="checkbox"><input name="status" <?php if('on'===$project['status']){?>checked="checked"<?php }?> type="checkbox"/> 已完成</label></td>
	</tr>

	<tr>
		<td>创建日期</td>
		<td><?php echo $project['createDate'];?></td>
		<td>计算总利润</td>
		<td><a class="btn " href="<?php echo site_url('project/calc/'.$project['projectId']);?>">计算</a></td>
	</tr>

	<tr>
		<td>保存修改</td>
		<td><button class="btn btn-primary" type="submit" name="save_project" value="1">保存项目</button></td>
		<td></td>
		<td>注: 利润 = 总价-报销项目成本</td>
	</tr>


</table>
</form>


<div class="alert alert-info">
	<i class="icon-jpy"></i> 开票信息
</div>

<table class="table table-bordered table-condensed">
	<tr>
		<td>客户名称</td>
		<td><a href="<?php echo site_url('company/edit_company/'.$the_company['companyId']);?>"><?php echo $the_company['companyname'];?></a></td>
		<td>开户行</td>
		<td><?php echo $the_company['bank'];?></td>
	</tr>

	<tr>
		<td>纳税人识别号</td>
		<td><?php echo $the_company['taxnumber'];?></td>
		<td>开户行电话</td>
		<td><?php echo $the_company['bankphone'];?></td>
	</tr>

	<tr>
		<td>公司开票地址</td>
		<td><?php echo $the_company['invoiceaddress'];?></td>
		<td>公司开票电话信息</td>
		<td><?php echo $the_company['invoicephone'];?></td>
	</tr>
</table>


<!--
<div class="alert alert-info"><i class="icon-info-sign"></i> 收款记录列表/Edit Project</div>
<p>
<a class="btn btn-primary" href="">添加收款纪录</a>
</p>
<table class="table table-bordered table-condensed">
	<tr>
		<td>ID</td>
		<td>收款纪录名称</td>
		<td>合同收款金额</td>
		<td>合同收款日期</td>
		<td>发票号</td>
		<td>到款金额</td>
		<td>到款日期</td>
		<td>操作</td>
	</tr>
	<?php foreach ($receipt as $r) {?>
	<tr>
		<td><?php echo $r['rid'];?></td>
		<td><?php echo $r['receiptName'];?></td>
		<td><?php echo $r['contractPrice'];?></td>
		<td><?php echo $r['contractDate'];?></td>
		<td><?php echo $r['invoiceNo'];?></td>
		<td><?php echo $r['price'];?></td>
		<td><?php echo $r['receiptDate'];?></td>
		<td><a href="<?php echo site_url('project/receipt/'.$r['rid']);?>">添加成本</a></td>
	</tr>	
	<?php }?>

</table>

-->

<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy/mm/dd'});
</script>

