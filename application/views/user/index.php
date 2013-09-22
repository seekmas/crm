  <form class="form-signin" action="" method="post">
  <input type="hidden" name="LIMITTIME" value="<?php echo time();?>">
  <input type="hidden" name="HASHFORM"  value="<?php echo $hash;?>">
    <h2 class="text-success">
      登录到 KAIZEN CRM
    </h2>

    <?php if( $status) {?><div class="alert alert-info"><i class="icon-info-sign"></i> <?php $this->load->module( 'message/message/'.$status);?></div><?php }?>

      <div class="input-prepend">
        <span class="add-on">账户</span>
        <input name="username" type="text" class="input-block" placeholder="Username">
      </div>


    <div class="input-prepend">
      <span class="add-on">密码</span>
      <input name="password" type="password" class="input-block" placeholder="Password">
    </div>
  
    
    <div class="control-group">
      <div class="controls">
        <button name="signin" class="btn btn-primary" type="submit" value="1">Sign in</button>
      </div>
    </div>
  </form>