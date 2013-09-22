<?php

class Message_message_module extends CI_Module
{
	public function form_origin_error()
	{
		echo '请刷新之后重试';
	}

	public function form_post_timeout()
	{
		echo '登录页面超时,请刷新后登录';
	}

	public function authenticate_failed()
	{
		echo '验证失败,请检查账户或者密码';
	}

	public function user_not_exist()
	{
		echo '用户不存在';
	}
}