<div class="alert alert-info"><i class="icon-search"></i> 搜索联系人</div>

<table class="table table-bordered table-hover table-condensed table-striped">
<tr>
	<td>联系人名字</td>
	<td>职位</td>
	<td>工作电话</td>
	<td>Email</td>
	<td>公司</td>
	<td>部门</td>
	<td>城市</td>

	<td>创建日期</td>
</tr>

<?php foreach ($contacts as $contact) :?>
<tr>
			
	<td><a href="<?php echo site_url('company/edit_contact/'.$contact['contactId']);?>"><i class="icon-user"></i> <?php echo $contact['fname'] . ' ' . $contact['lname'] ;?></a></td>
	<td><?php echo $contact['position'];?></td>
	<td><?php echo $contact['businessphone'];?></td>
	<td><?php echo $contact['email'];?></td>
	<td><?php echo $contact['companyname'];?></td>
	<td><?php echo $contact['department'];?></td>
	<td><?php echo $contact['city'];?></td>
	<td><?php echo $contact['createDate'];?></td>

</tr>
<?php endforeach ?>
</table>
<?php $this->load->module('pagination/pagination/index' , $pagination)?>