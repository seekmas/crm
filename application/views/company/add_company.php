<?php
$target = $status['target'];
unset( $status['target']);
?>

<div class="container">

<div class="span8">
<div class="alert alert-info"><i class="icon-plus"></i> 添加 (带蓝色下划线的字段为必填项)</div>
	<div class="alert alert-success">公司名称: </div>
		<form class="form-inline" name="" action="" method="post">
		<div class="input-prepend input-append">
		<input class="span6" name="companyname" type="text"/><button type="submit" name="create_test" value="1" class="btn btn-primary"><i class="icon-search"></i> 检查是否存在</button>

		<?php if( empty( $status)){?>
		<p><span class="label label-info">公司名可以创建</span></p>
		<?php }else{?>
		<p><span class="label label-important">右边列表公司已被录入 如有相同请先和销售经理联系</span></p>
		<?php }?>	
		</div>
		</form>

<form action="" method="post">
<table class="table table-bordered table-condensed table-striped">
	<tr>
		<td>公司名称</td><td><div class="control-group info"><div class="controls"><input name="companyname" type="text" readonly  value="<?php echo $target;?>" required/></div></div></td>
		<td>行业</td>
		<td><div class="control-group info"><div class="controls">
			<select name="industry" required>
				<?php foreach ($industry as $option) : ?>
				<option value="<?php echo $option['industry'];?>"><?php echo $option['industry']?></option>>
				<?php endforeach ?>
			</select>
			</div></div>
		</td>
	</tr>


	<tr>
		<td>信息来源</td>
		<td>
			<div class="control-group info"><div class="controls"><select name="source" required>
				<?php foreach ($source as $option) :?>
				<option value="<?php echo $option['source'];?>"><?php echo $option['source'];?></option>
				<?php endforeach ?>
			</select></div></div>
			<p>其它: <input name="other" type="text" /></p>
		</td>
		
		<td>公司电话</td>
		<td><div class="control-group info"><div class="controls"><input name="phone" type="text" required/></div></div></td>
	</tr>


	<tr>
		<td>国家</td>
		<td><div class="control-group info"><div class="controls">
			<select name="country" required>
				<option value="">无</option>
				<?php foreach ($country as $option) : ?>
				<option value="<?php echo $option['country'];?>" <?php if('China'===$option['country']){?>selected="selected"<?php }?>><?php echo $option['country'];?></option>
				<?php endforeach ?>
			</select>
			</div></div>
		</td>
		

		<td>省</td>
		<td><div class="control-group info"><div class="controls">
			<select name="province" required>
				<option value="无">无</option>
				<?php foreach ($province as $option) :?>
				<option value="<?php echo $option['province'];?>"><?php echo $option['province'];?></option>
				<?php endforeach ?>
			</select>
			</div></div>
		</td>
	</tr>


	<tr>
		<td>城市</td>
		<td><div class="control-group info"><div class="controls"><input name="city" type="text" required/></div></div></td>
		<td>客户级别</td>
		<td><div class="control-group info"><div class="controls">
			<select name="level" required>
				<?php foreach ($level as $option) : ?>
				<option value="<?php echo $option['level'];?>"><?php echo $option['level'] . '-' .$option['description'];?></option>
				<?php endforeach ?>
			</select>
			</div></div>	
		</td>
	</tr>


	<tr>
		<td>地址</td><td><div class="control-group info"><div class="controls"><input name="address" type="text" required/></div></div></td>
		<td>公司背景</td><td><div class="control-group info"><div class="controls"><input name="background" type="text" required/></div></div></td>
	</tr>


	<tr>
		<td>公司网址</td><td><input name="url" type="text" /></td>
		<td>邮政编码</td><td><input name="zip" type="text"/></td>
	</tr>

	<tr>
		<td>传真</td><td><input name="fax" type="text" /></td>
		<td>公司营业额</td><td><input name="revenue" type="text"/></td>
	</tr>
	<tr>
		<td>员工数量</td><td><input name="employees" type="text" /></td>
		<td>公司状态</td>
		<td>
		    <input name="active" type="radio" id="radio" value="1" checked="checked" />正常
		   	<input name="active" type="radio" id="radio" value="0" />锁定			
		</td>
	</tr>

	<tr>
		<td>邮箱</td>
		<td><input name="email" type="text" /></td>

		<td></td>
		<td></td>
	</tr>

</table>

<div class="alert alert-info"><i class="icon-plus"></i> 开票信息</div>

<table class="table table-bordered table-condensed table-striped">
	<tr>
		<td>纳税人识别号</td>
		<td><div class="control-group info"><div class="controls"><input name="taxnumber" type="text" required/></div></div></td>
		<td>公司开票电话信息</td>
		<td><div class="control-group info"><div class="controls"><input name="invoicephone" type="text" required/></div></div></td>
	</tr>

	<tr>
		<td>公司开票地址</td>
		<td><div class="control-group info"><div class="controls"><input name="invoiceaddress" type="text" required/></div></div></td>
		<td></td>
		<td></td>
	</tr>

	<tr>
		<td>开户行</td>
		<td><div class="control-group info"><div class="controls"><input name="bank" type="text" required/></div></div></td>
		<td>开户行电话</td>
		<td><div class="control-group info"><div class="controls"><input name="bankphone" type="text" required/></div></div></td>
	</tr>

	<tr>
		<td>开户行地址</td>
		<td><div class="control-group info"><div class="controls"><input name="bankaddress" type="text" required/></div></div></td>
		<td></td>
		<td></td>
	</tr>
</table>

<div class="alert alert-info"><i class="icon-plus"></i> 添加联系人(带蓝色标记的字段为必填项)</div>

<table class="table table-bordered table-condensed table-striped">
	<tr>
		<td>姓</td>
		<td><div class="control-group info"><div class="controls"><input name="fname" type="text" required/></div></div></td>
		<td>名</td>
		<td><div class="control-group info"><div class="controls"><input name="lname" type="text" required/></div></div></td>		
	</tr>

	<tr>
		<td>性别</td>
		<td><div class="control-group info"><div class="controls">
			<select name="sex" required>
                    <option value="男">男</option>
                    <option value="女">女</option>       
         	</select>
         	</div></div>
		</td>
		<td>联系人电话</td>
		<td><div class="control-group info"><div class="controls"><input name="businessphone" type="text" required/></div></div></td>		
	</tr>

	<tr>
		<td>职位</td>
		<td><div class="control-group info"><div class="controls"><input name="position" type="text" required/></div></div></td>
		<td>手机</td>
		<td><div class="control-group info"><div class="controls"><input name="mobile" type="text" required/></div></div></td>		
	</tr>

	<tr>
		<td>工作语言 </td>
		<td><div class="control-group info"><div class="controls">
			<select name="worklang" required>          
                <option value=86>中文</option>      
                <option value=1033>英文</option>
                <option value=82>日文</option>       
       		</select>
       		</div></div>
		</td>
		<td></td>
		<td></td>		
	</tr>

	<tr>
		<td>助手</td>
		<td><input name="assistance" type="text" /></td>
		<td>秘书名字</td>
		<td><input name="secretary" type="text" /></td>		
	</tr>

	<tr>
		<td>联系人邮件</td>
		<td><div class="control-group info"><div class="controls"><input name="cemail" type="text" required/></div></div></td>
		<td></td>
		<td></td>		
	</tr>
	
	<tr>
		<td>联系人背景</td>
		<td><div class="control-group info"><div class="controls"><textarea name="cbackground" required></textarea></div></div></td>
		<td></td>
		<td></td>
	</tr>
</table>

<button name="create_company_profile" class="btn btn-success" value="1">创建公司档案</button>
</form>
</div>

<div class="span3">
	<?php if( $status){?>
	<div class="alert alert-info"><i class="icon-search"></i> 检索的结果</div>
	<ul class="nav nav-tabs nav-stacked">
	<?php foreach ($status as $company) : ?>
        <li><a href="<?php echo site_url('company/edit_company/'.$company['companyId']);?>" target="blank"><?php echo $company['companyName'];?></a></li>
	<?php endforeach ?>
	</ul>
	<?php }?>
</div>

</div>