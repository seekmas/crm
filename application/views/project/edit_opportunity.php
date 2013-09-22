<div class="alert alert-info"><i class="icon-edit"></i> 编辑销售机会 (带蓝色标记的字段为必填项)</div>
<?php
$ci = &get_instance();
$u = $ci->get_my();
?>

<?php if( empty( $project)) {?>
<p><a class="btn btn-success" href="<?php echo site_url('project/convert_opportunity/'.$opportunity['oppId']);?>"><i class="icon-refresh icon-spin"></i> 转换成项目 Change to Project</a></p>
<?php }else{?>

	<span class="label label-success"><h4><i class="icon-info-sign icon-2x"></i> 该销售机会已经转换成为项目</h4></span>

<?php }?>

<form action="" method="post">
<input type="hidden" name="oppId" value="<?php echo $opportunity['oppId'];?>" />
<input type="hidden" name="updatedate" value="<?php echo date('Y-m-d h:i:s');?>" />
<table class="table table-bordered">

	<tr>
		<td>销售机会名称</td>
		<td><input name="oppname" type="text" value="<?php echo $opportunity['oppname'];?>" /></td>
		<td>产品</td>
		<td>
			<select name="productId">
				<?php foreach ($product as $option) :?>
				<option <?php if( $opportunity['productId'] == $option['categoryId']){?>selected="selected"<?php }?> value="<?php echo $option['categoryId']?>"><?php echo $option['categoryname'];?></option>
				<?php endforeach ?>
			</select>
		</td>
	</tr>

	<tr>
		<td>公司名称</td>
		<td><a href="<?php echo site_url('company/edit_company/'.$company['companyId']);?>" target="blank"><?php echo $company['companyName'];?></a></td>
		<td>描述</td>
		<td><textarea name="description" class="description"><?php echo $opportunity['description'];?></textarea></td>
	</tr>

	<tr>
		<td>销售负责人</td>
		<td>
			<select name="sales">
				<?php foreach ($user as $option) :?>
				<option <?php if( $opportunity['sales'] === $option['userId']){?>selected="selected"<?php }?> value="<?php echo $option['userId'];?>">
					<?php echo $option['userName'];?>
				</option>
				<?php endforeach ?>
			</select>
		</td>

		<td>来源</td>
		<td>
			<select class="source">
				<?php foreach ($source as $option) : ?>
					<option <?php if( $opportunity['source'] == $option['source']){?>selected="selected"<?php }?> value="<?php echo $option['source'];?>"><?php echo $option['source'];?></option>
				<?php endforeach ?>
				
			</select>
		</td>
	</tr>

	<tr>
		<td>合作人/Cooperator</td>
		<td>
			<select name="cooperator">
				<?php foreach ($user as $option) :?>
				<option <?php if( $opportunity['cooperator'] == $option['userId']){?>selected="selected"<?php }?> value="<?php echo $option['userId'];?>">
					<?php echo $option['userName'];?>
				</option>
				<?php endforeach ?>
			</select>			
		</td>
		<td>级别</td>
		<td>
			<select name="level">
				<?php foreach ($level as $option) :?>
				<option <?php if( $opportunity['level'] == $option['level']){?>selected="selected"<?php }?> value="<?php echo $option['level'];?>">
					<?php echo $option['level'];?>
				</option>
				<?php endforeach ?>
			</select>			
		</td>
	</tr>

	<tr>
		<td>项目顾问</td>
		<td>
			<select name="assistant">
				<?php foreach ($user as $option) :?>
				<option <?php if( $opportunity['assistant'] == $option['userId']){?>selected="selected"<?php }?> value="<?php echo $option['userId'];?>">
					<?php echo $option['userName'];?>
				</option>
				<?php endforeach ?>
			</select>			
		</td>
		<td>销售阶段</td>
		<td>
			<select name="stage">
				<?php foreach ($stage as $option) : ?>
					<option <?php if( $opportunity['stage'] == $option['sid']){?>selected="selected"<?php }?> value="<?php echo $option['sid'];?>"><?php echo $option['stage'].' - '.$option['description'];?></option>
				<?php endforeach ?>
			</select>
		</td>
	</tr>

	<tr>
		<td>执行顾问</td>
		<td>
			<select name="excutive">
				<?php foreach ($user as $option) :?>
				<option <?php if( $opportunity['excutive'] == $option['userId']){?>selected="selected"<?php }?> value="<?php echo $option['userId'];?>">
					<?php echo $option['userName'];?>
				</option>
				<?php endforeach ?>
			</select>			
		</td>
		<td>预计结束时间</td>
		<td>
			<input name="expectDate" class="form_datetime" size="23" type="text" value="<?php echo $opportunity['expectDate'];?>">
		</td>
	</tr>

	<tr>
		<td>金额</td>
		<td><input name="price" type="text" value="<?php echo $opportunity['price'];?>"/></td>
		<td>签单地点</td>
		<td>
			<select name="contract">
				<option <?php if($opportunity['contract'] === 'SH'){?>selected="selected"<?php }?> value="SH">SH-Shanghai</option>
				<option <?php if($opportunity['contract'] === 'DG'){?>selected="selected"<?php }?> value="DG">DG-Dongguan</option>
				<option <?php if($opportunity['contract'] === 'CQ'){?>selected="selected"<?php }?> value="CQ">CQ-Chongqing</option>
				<option <?php if($opportunity['contract'] === 'BJ'){?>selected="selected"<?php }?> value="BJ">BJ-Beijing</option>
			</select>
		</td>
	</tr>

	<tr>
		<td>状态</td>
		<td>
		<select name="status" class="required" >
            <option value="正常">正常</option>
            <option value="锁定">锁定</option>
            <option value="赢单">赢单</option>
            <option value="输单">输单</option>
		</select>			
		</td>
		<td>最后更新</td>
		<td><?php echo $opportunity['updatedate'];?></td>
	</tr>

	<tr>
		<td>创建日期</td>
		<td><?php echo $opportunity['createdate'];?></td>
		<td></td>
		<td></td>
	</tr>
</table>

<button name="save_opportunity" type="submit" class="btn btn-primary" value="1">保存修改</button>
</form>

<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy/mm/dd'});
</script>


<div class="alert alert-info"><i class="icon-plus"></i> 项目信息</div>
<table class="table table-bordered">
	<tr>
		<td>ID</td>
		<td>合同编号</td>
		<td>项目名称[公司名称]</td>
		<td>类型</td>
		<td>开始日期 - 结束日期</td>
		<td>总服务天数</td>
		<td>合同金额</td>
	</tr>

	<?php foreach ($project as $p) : ?>
	<tr>
		<td><?php echo $p['projectId'];?></td>
		<td><?php echo $p['contractNo'];?></td>
		<td><a href="<?php echo site_url('project/edit_project/'.$p['projectId']);?>"><?php echo $p['projectName'];?></a></td>
		<td><?php echo $p['type'];?></td>
		<td><?php echo $p['startDate'];?></td>
		<td><?php echo $p['TotalUsedDays'];?></td>
		
		<td><?php echo $p['totalPrice'];?></td>
	</tr>
	<?php endforeach ?>

</table>


<form action="" method="post">
<input type="hidden" name="type" value="opportunity"/>
<input type="hidden" name="cid" value="<?php echo $opportunity['oppId'];?>"/>

<table class="table table-bordered">
	<tr>
		<td>历史记录</td>
		<td><textarea class="span8" name="history"></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><button type="submit" name="add_history" value="1" class="btn btn-primary">添加历史</button></td>
	</tr>
</table>
</form>

<div class="alert alert-info"><i class="icon-list"></i> 历史记录列表</div>


<?php foreach ($history as $option) : ?>
<?php if( !trim( $option['history'])) continue;?>
            <div class="media">
            	<h4><small>创建日期 <?php echo $option['createdate']?></small></h4>
                <i class="icon-comments-alt icon-3x pull-left"></i>
              <div class="media-body">
                
                <p><?php echo $option['history'];?></p>
				<button class="btn btn-small btn-primary edit">Edit</button>
                
                <div class="hidden">
                <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $option['id'];?>" />
                <textarea name="history" class="span11"><?php echo $option['history'];?> </textarea>
                <p><button class="btn btn-success" name="save_history" value="1">保存</button></p>
				</form>
				</div>

              </div>
            </div>
            <hr/>
<?php endforeach ?>

<script>
$(function(){

	$('.edit').on('click',function(){

		$(this).hide();
		$(this).prev().hide();

		$(this).next().removeAttr('class');

	});

});
</script>