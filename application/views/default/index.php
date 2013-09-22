
<div class="container">
<h4>登录成功 正在转到 </h4>

<p><a href="<?php echo site_url('company/index');?>">手动跳转到首页</a></p>
</div>
<script>
	$(function(){

		setInterval( append , 1000);
		setInterval( redirect , 5000);

	});

	function append()
	{
		$('h4').append('。');
	}

	function redirect(){

		window.location.href = "<?php echo site_url('company/index');?>";

	}


</script>