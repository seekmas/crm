<?php
$ci = & get_instance();
$user = $ci->get_my();

?>

 <div class="alert alert-info"><i class="icon-plus"></i> 新费用报表/New Expense Report (蓝色下划线框为必填/Blue underline is required) </div>

<form action="" method="post">
<input name="userId" type="hidden" value="<?php echo $user['userId'];?>"/>
<input name="createdate" type="hidden" value="<?php echo date('Y-m-d h:i:s');?>"/>



 <table class="table table-bordered table-condensed">
	
	<tr>
		<td>Expense Name</td>
		<td><input name="ename" class="span3" type="text" value="<?php echo $user['userName'].' '.date('Y-m-d')?> Expense Report" readonly></td>
		<td>Office</td>
		<td>
			<select name="location" >	  
                <option value="Gemba_China_Shanghai">Gemba_China_Shanghai</option>  
                <option value="Gemba_China_Dongguan">Gemba_China_Dongguan</option>
                <option value="Gemba_China_Chongqing">Gemba_China_Chongqing</option>
                <option value="Gemba_China_Beijing">Gemba_China_Beijing</option>
            </select>
		</td>
	</tr>

	<tr>
		<td>Name</td>
		<td><span class="badge badge-success"><?php echo $user['userName'];?></span></td>
		<td>Explanation</td>
		<td>
			<textarea name="explanation"></textarea>
			<p>例:　xx项目/xx销售机会/７月报销单</p>
		</td>
	</tr>

	<tr>
		<td>Type</td>
		<td>
			<select name="Expensetype" >
           				<option value="">选择类型</option>     
            			
            			<option selected="selected" value="Opportunity">Opportunity</option>

                        <option value="Project">Project</option>
                 
                        <option value="Marketing">Marketing</option>
                 
                        <option value="Office">Office</option>
                 
                        <option value="Gemba_Shop">Gemba_Shop</option>
                 
                        <option value="Other">Other</option>
                 
                        <option value="代垫费用">代垫费用</option>
                 
                        <option value="KIK">KIK</option>
                 
                        <option value="Training">Training</option>
            </select>
		</td>

		<td>销售机会</td>
		<td>
		
		<div class="input-append">
		<form class="form-inline" action="" method="post">
			<input class="input-xlarge" type="text" name="keyword" placeholder="销售机会关键字" />
			<button name="search_opportunity" type="submit" class="btn btn-primary" value="1"><i class="icon-search"></i> 搜索</button>
		</form>
		</div>
		
		<div>
			选择销售机会
			<select name="oppid">
				<option value="">无相关销售机会</option>
				<?php foreach ($result as  $opp) :?>
					<option value="<?php echo $opp['oppId'];?>"><?php echo $opp['oppname'];?></option>
				<?php endforeach ?>
				
			</select>
		</div>

		</td>
	</tr>

	<tr>
		<td></td>
		<td><button name="add_reimburse" type="submit" value="1" class="btn btn-primary">添加报销</button></td>
		<td></td>
		<td></td>
	</tr>
 </table>
 </form>
