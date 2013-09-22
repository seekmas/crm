<div class="alert alert-info">
	<i class="icon-edit"></i> 编辑收款纪录/Edit Receipt (蓝色标记框为必填/Blue underline is required)
</div>

<div class="row">
		
	<div class="span2">项目名称/Project Name</div>
	<div class="span3">
		<div class="control-group info">
			<input type="text" />
		</div>
	</div>

	<div class="span2">发票号/Invoice NO</div>
	<div class="span3">
		<div class="control-group info">
			<input type="text" />
		</div>
	</div>
</div>



<div class="row">

	<div class="span2">本期合同收款金额/Price</div>
	<div class="span3">
		<div class="control-group info">
			<input type="text" />
		</div>
	</div>


	<div class="span2">本期合同收款日期</div>
	<div class="span3">
		<div class="control-group info">
			<input type="text" />
		</div>
	</div>
</div>


<div class="row">
	<div class="span2">到款金额/Price</div>
	<div class="span3">
		<div class="control-group info">
			<input type="text" />
		</div>
	</div>

	<div class="span2">到款日期/Receipt Date</div>
	<div class="span3">
		<div class="control-group info">
			<input type="text" />
		</div>
	</div>
</div>

<div class="row">
	<div class="span2">本期总天数/Total Days</div>
	<div class="span3">
		<div class="control-group info">
			<input type="text" />
		</div>
	</div>

	<div class="span2">本期实际发生天数/Used Days</div>
	<div class="span3">
		<div class="control-group info">
			<input type="text" />
		</div>
	</div>
</div>

<div class="row">
	<div class="span2"></div>
	<div class="span3"></div>

	<div class="span2">时间周期/Time Cycle:</div>
	<div class="span3">
		<div class="control-group info">
			<input type="text" />
		</div>
	</div>
</div>

<div class="row">
	<div class="span2">顾问本期分配金额/Consultant Price</div>
	<div class="span3">
		<div class="control-group info">
			<input type="text" />
			<h5><small>顾问本期分配金额 = 到款金额 * （ 已用天数 / 总天数 ) </small></h5>
		</div>
	</div>


	<div class="span2">
		<ul class="unstyled">
			<li>营业税</li>
			<li>河道税</li>
			<li>子项目利润/Profit</li>
		</ul>
	</div>
	<div class="span3">
		<div class="control-group info">
		<ul class="unstyled">
			<li>0 元</li>
			<li>0 元</li>
			<li>0 元</li>
		</ul>
		<h5><small>子项目利润 = 到款金额 - 项目成本 - 奖金总额 - 营业税 - 河道税</small></h5>
		</div>
	</div>
</div>

<div class="row">
	<div class="span2">是否收款?</div>
	<div class="span3">
		<div class="control-group info">
			<select></select>
		</div>
	</div>
	
	<div class="span2">时间周期/Time Cycle:</div>
	<div class="span3">
		<div class="control-group info">
			<textarea></textarea>
		</div>
	</div>
</div>





<div class="alert alert-info"><i class="icon-edit"></i> 编辑项目成本/Edit Project Cost (蓝色标记框为必填/Blue underline is required)</div>

<?php
var_dump( $receipt);
?>