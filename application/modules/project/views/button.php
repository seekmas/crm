<?php
$ci = & get_instance();

?>
<div class="container">
<div class="btn-group">
	<?php foreach ($group_name as $key=>$button) {?>
    <a href="<?php echo site_url( ($this->uri->segment(1) ? $this->uri->segment(1) : 'company') .'/'.$key);?>" class="btn btn-primary <?php if( $ci->uri->segment(2) === $key){?>disabled<?php }?>">
    	<?php echo $button;?>
    </a>  	
	<?php }?>
</div>
</div>
<br/>
