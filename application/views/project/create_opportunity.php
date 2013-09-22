<div class="page-header">
	<h3>添加一个新的销售机会 <small>添加销售机会 (带蓝色标记的字段为必填项)</small></h3>
</div>

<table class="table table-bordered table-striped table-condensed">
	
	<tr>	
		<td>销售机会名称</td>
		<td><input type="text" /> <span class="help-block">例：公司简称-机会类型-期号</span></td>
		<td>产品类型</td>
		<td>
		<select>
			<option></option>
		</select>
		</td>
	</tr>

	<tr>
		<td>公司名称</td>
		<td>
		<select>
			<option></option>
		</select>
		</td>

		<td>描述</td>
		<td><textarea></textarea></td>
	</tr>
	
	<tr>
		<td>销售负责人</td>
		<td><select><option></option></select></td>

		<td>描述</td>
		<td><textarea></textarea></td>
	</tr>

	<tr>
		<td>合作人/Cooperator</td>
		<td><input type="text" /></td>
		<td></td>
		<td></td>
	</tr>

	<tr>
		<td>项目顾问</td>
		<td><input type="text" /></td>
		<td>销售阶段</td>
		<td><select><option></option></select></td>
	</tr>

	<tr>
		<td>执行顾问</td>
		<td></td>
		<td>预计结束时间</td>
		<td><input class="form_datetime" size="23" type="text" value="2012-06-15 14:45" readonly></td>
	</tr>

	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	
</table>

<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});
</script>