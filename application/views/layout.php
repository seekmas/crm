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
<?php
$c = & get_instance();
if( method_exists( $c, 'get_my'))
  $user = $c->get_my();
?>


<div class="navbar navbar-fixed-top navbar-inverse" style="position: absolute;margin-bottom:40px;">
  <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a class="brand" href="#">CRM2013</a>
                  <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">
                      <li class="active"><a href="<?php echo site_url('company/index');?>">首页 Home</a></li>
                    </ul>

                    <ul class="nav pull-right">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <?php echo $user['userName'];?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo site_url('user/profile');?>"><i class="icon-cog"></i> 修改资料 Reimburse Profile</a></li>
                          <li><a href="<?php echo site_url('user/logout/');?>"><i class="icon-off"></i> 注销 Logout</a></li>

                        </ul>
                      </li>
                    </ul>
                  </div><!-- /.nav-collapse -->
                </div>
  </div>
</div>


<?php $ci = & get_instance();
$controller = strtolower( get_class( $ci));
?>
<div class="container" style="padding-top:50px;">
        <ul class="nav nav-tabs" >
          <li <?php if( 'company' === $controller){?>class="active"<?php }?>><a href="<?php echo site_url('company/index');?>">公司 Company</a></li>
          <li <?php if( 'client' === $controller){?>class="active"<?php }?>><a href="<?php echo site_url('client/index');?>">我的客户 Client</a></li>
          <li <?php if( 'project' === $controller){?>class="active"<?php }?>><a href="<?php echo site_url('project/index');?>">销售机会/项目 Opportunity/Project</a></li>
          <li <?php if( 'reimburse' === $controller){?>class="active"<?php }?>><a href="<?php echo site_url('reimburse/index');?>">报销 Reimburse</a></li>
          <li <?php if( 'setting' === $controller){?>class="active"<?php }?>><a href="<?php echo site_url('setting/index');?>">系统设置 Settings</a></li>
        </ul>
<?php $this->load->module('project/buttongroup/button');?>

<?php 
if( 'setting' === $controller )
{
  $this->load->module('setting/topsetting' , array( 'action' => $action));
} 
?>
</div>

<div class="container" style="margin-bottom:80px;">

<?php echo $content;?>
</div>


</div>

<div class="navbar-fixed-bottom" >
  <h5><p class="text-center" style="font-size:10px;">Gemba Research 2013</p></h5>
</div>

</body>
</html>