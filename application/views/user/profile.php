<?php if( $status){?>

<div class="alert alert-info"><i class="icon-ok"></i> 修改成功<button type="button" class="close" data-dismiss="alert">&times;</button></div>

<?php }?>

<div class="media page-header">
    <div class="pull-left">
		<?php if( file_exists(FCPATH.'/upload/photo/'.$user['userId'].'.jpg')){ ?>
			<img class="media-object img-polaroid" src="<?php echo site_url().'upload/photo/'.$user['userId'].'.jpg';?>" width="120px">
		<?php }else{ ?>
			<i class="icon-picture icon-4x"></i>
		<?php }?>        
    </div>
    
    <div class="media-body">
        <h4 class="media-heading">当前登录 <?php echo $user['userName'];?></h4>
               Email : <?php echo $user['email'];?>
    </div>
</div>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="userId" value="<?php echo $user['userId'];?>">

<div class="alert alert-info"><i class="icon-cog"></i> 修改我的资料 (注销后生效)</div>
<div class="container">
	<div class="span3">
	<div class="control-group">
		<label>登录名</label>
		<div class="controls">
			<input name="userName" type="text" value="<?php echo $user['userName'];?>" readonly />
		</div>
	</div>
	</div>

	<div class="span3">
	<div class="control-group">
		<label>Email</label>
		<div class="controls">
			<input name="email" type="text" value="<?php echo $user['email'];?>" />
		</div>
	</div>
	</div>	

	<div class="span3">
	<div class="control-group">
		<label>旧密码</label>
		<div class="controls">
			<input name="" type="text" value="<?php echo $user['passWord'];?>" readonly />
		</div>
	</div>
	</div>		

	<div class="span3">
	<div class="control-group">
		<label>新密码</label>
		<div class="controls">
			<input name="newPass" type="text" value="" />
		</div>
	</div>
	</div>

	<div class="span3">
	<div class="control-group">
		<label>重复密码</label>
		<div class="controls">
			<input name="newPass2" type="text" value=""  />
		</div>
	</div>
	</div>

	<div class="span3">
	<div class="control-group">
		<label>工作语言</label>
		<div class="controls">
			<select name="lang"  class="required" >                 
            	<option value=86>中文</option>
            	<option value=1033>英文</option> 
            	<option value=82>日文</option>                
       		</select>
		</div>
	</div>
	</div>

	<div class="span3">
	<div class="control-group">
		<label>头像</label>
		<input name="photo" type="file" />
	</div>
	</div>

</div>

<hr />

<div class="container">

	<div class="span3">
	<div class="control-group">
		<button name="save_update" type="submit" value="1" class="btn btn-primary">Save</button>
	</div>
	</div>

</div>

</form>