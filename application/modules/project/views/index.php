<?php
$ci = &get_instance();
?>
<div class="container">
<div class="btn-group">
    <a href="<?php echo site_url('project/index');?>" class="span2 btn btn-primary <?php if( $ci->uri->segment(2) === 'index'){?>disabled<?php }?>" href="">项目列表</a>
    <a href="<?php echo site_url('project/opportunity');?>" class="span2 btn btn-primary <?php if( $ci->uri->segment(2) === 'opportunity'){?>disabled<?php }?>">销售机会</a>
  
</div>
</div>
<br/>