<div class="alert alert-info"><i class="icon-plus"></i> 添加销售机会 (带蓝色标记的字段为必填项)</div>
<form name="" action="" method="post">
<table class="table table-bordered table-condensed">
	<tr>
		<td class="span3">销售机会名称</td>
		<td class="span3">
			<div class="control-group info">
			<div class="controls">
				<input name="oppname" type="text" /><p>例：公司简称-机会类型-期号</p>
			</div>
			</div>
		</td>

		<td class="span3">产品类型</td>
		<td class="span3">			
			<div class="control-group info">
			<div class="controls">
			<select name="productId">
				<?php foreach ($product as $option) : ?>
				<option value="<?php echo $option['proId'];?>"><?php echo $option['productname'];?></option>	
				<?php endforeach?>
			</select>
			</div>
			</div>
		</td>
	</tr>

	<tr>
		<td>公司名称</td>
		<td>
		<div class="control-group info">
		<div class="controls">

		<select name="account">
			<?php foreach ($company as $option): ?>
			<option <?php if( $default == $option['companyId']){?>selected="selected"<?php }?> value="<?php echo $option['companyId'];?>"><?php echo $option['companyname'];?></option>	
			<?php endforeach ?>
		</select>

		</div>
		</div>
		</td>
		<td>描述</td>
		<td><textarea name="description"></textarea></td>
	</tr>

	<tr>
		<td>销售负责人</td>
		<td>
		<div class="control-group info">
		<div class="controls">		
		<select name="sales">
			<?php foreach ($user as $option): ?>
			<option value="<?php echo $option['userId'];?>"><?php echo $option['userName'];?></option>	
			<?php endforeach ?>
		</select>
		</div>
		</div>
		</td>

		<td>来源</td>
		<td>
		<div class="control-group info">
		<div class="controls">	
		<select name="source">
			<?php foreach ($source as $option): ?>
			<option value="<?php echo $option['source'];?>"><?php echo $option['source'];?></option>	
			<?php endforeach ?>	
		</select>
		<p>其它:<input name="other" type="text" /></p>
		</div>
		</div>
		</td>
	</tr>

	<tr>
		<td>合作人/Cooperator</td>
		<td>
		<div class="control-group info">
		<div class="controls">
			<select name="cooperator">
				<?php foreach ($user as $option) {?>
				<option value="<?php echo $option['userId'];?>"><?php echo $option['userName'];?></option>
				<?php }?>
			</select>
		</div>
		</div>
		</td>
		<td></td>
		<td></td>
	</tr>

	<tr>
		<td>项目顾问</td>
		<td>
		<div class="control-group info">
		<div class="controls">
			<select name="assistant">
				<?php foreach ($user as $option) {?>
				<option value="<?php echo $option['userId'];?>"><?php echo $option['userName'];?></option>
				<?php }?>
			</select>
		</div>
		</div>
		</td>
		<td>销售阶段</td>
		<td>
		<div class="control-group info">
		<div class="controls">
			<select name="stage">
				<?php foreach ($stage as $option) {?>
				<option value="<?php echo $option['sid'];?>"><?php echo $option['stage'];?> - <?php echo $option['description'];?></option>
				<?php }?>
			</select>
		</div>
		</div>
		</td>
	</tr>

	<tr>
		<td>执行顾问 </td>
		<td>
		<div class="control-group info">
		<div class="controls">
			<select name="excutive">
				<?php foreach ($user as $option) {?>
				<option value="<?php echo $option['userId'];?>"><?php echo $option['userName'];?></option>
				<?php }?>
			</select>
		</div>
		</div>		
		</td>
		<td>预计结束时间</td>
		<td>
		<div class="control-group info">
		<div class="controls">
			<input name="expectDate" class="form_datetime" size="23" type="text" value="<?php echo date('Y-m-d');?>">
		</div>
		</div>
		</td>
	</tr>

	<tr>
		<td>金额 </td>
		<td>
		<div class="control-group info">
		<div class="controls">
		<input name="price" type="text" /><p>注：此处为阿拉伯数字，请勿填入中文字和英文标点 如：50000</p>
		</div>
		</div>
		</td>
		

		<td>签单地点</td>
		<td>
		<div class="control-group info">
		<div class="controls">
			<select name="contract">
				<option value="SH">SH-Shanghai</option>
				<option value="DG">DG-Dongguan</option>
				<option value="CQ">CQ-Chongqing</option>
				<option value="BJ">BJ-Beijing</option>
			</select>
		</div>
		</div>
		</td>
	</tr>

	<tr>
		<td></td>
		<td></td>
		<td>状态</td>
		<td>
		<div class="control-group info">
		<div class="controls">
		<select name="status" class="required" >
            <option value="正常">正常</option>
            <option value="锁定">锁定</option>
            <option value="赢单">赢单</option>
            <option value="输单">输单</option>
		</select>
		</div>
		</div>
		</td>
	</tr>
</table>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy/mm/dd'});
</script>

<button name="add_opportunity" type="submit" class="btn btn-primary" value="1">添加 Add</button>