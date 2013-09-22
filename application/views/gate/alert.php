<div class="alert alert-info"><i class="icon-info-sign"></i> 提示信息</div>
<?php 
$ci = & get_instance();
?>
<h2 class="text-center text-info"><i class="icon-exclamation-sign icon-2x"></i> <?php echo $info;?></h2>
<br />
<br />
<br />

<?php if( isset( $return)){?>

<p align="center"><a class="btn btn-primary btn-large" href="<?php echo $return;?>">返回上一页</a></p>

<?php }else {?>

<p align="center"><a class="btn btn-primary btn-large" href="<?php echo $ci->referer();?>">返回上一页</a></p>

<?php }?>