<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gemba CRM</title>
<link  href="<?php echo base_url('public/bootstrap/css/bootstrap.css');?>" rel="stylesheet" type="text/css"/>
<link  href="<?php echo base_url('public/bootstrap/css/bootstrap-responsive.css');?>" rel="stylesheet" type="text/css"/>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet"/>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"/>
<link href="<?php echo base_url('public/bootstrap-datetimepicker/css/datetimepicker.css');?>" rel="stylesheet"/>
<style>
* {
  font-size: 13px;
}
</style>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('public/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js');?>"></script>
<style>
  * {
    font-size: 12px;
    font-family: 微软雅黑;
  }
</style>

</head>

<body>
<div class="container">
<form action="" method="post">


<div class="control-group">
<div class="controls">
	选择用户
	<select name="uid">

		<?php foreach ($data as $value) :?>

			<option value="<?php echo $value['userId'];?>"><?php echo $value['userName'];?></option>

		<?php endforeach ?>

	</select>
</div>
</div>



<div class="control-group">
<div class="controls">

<button type="submit" name="posts" class="btn btn-primary" value="1">提交</button>

</div>
</div>
</form>


<?php if( isset( $list)){?>
<table class="table table-bordered table-condensed">

	<tr>
		<td>eid</td>
		<td>RecDate</td>
		<td>airfare</td>
		<td>meals</td>
		<td>transport</td>
		<td>hotels</td>
		<td>misc</td>
		<td>type</td>
		<td>explanation</td>
		<td>epid</td>
	</tr>

	<?php foreach ($list as $list_one) :?>
	
	<tr>
		<td><?php echo $list_one['eid'];?></td>
		<td><?php echo date('Y/m/d h:i:s' , strtotime( $list_one['RecDate']))?></td>
		<td><?php echo $list_one['airfare'];?></td>
		<td><?php echo $list_one['meals'];?></td>
		<td><?php echo $list_one['transport'];?></td>
		<td><?php echo $list_one['hotels'];?></td>
		<td><?php echo $list_one['misc'];?></td>
		<td><?php echo $list_one['type'];?></td>
		<td><?php echo $list_one['explanation'];?></td>
		<td><?php echo $list_one['epid'];?></td>
	</tr>

	<?php endforeach ?>

</table>



<?php } ?>
</div>

</body>

</html>