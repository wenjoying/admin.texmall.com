<?php 
/**
 * Clogin.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clogin extends CI_Controller {
    
	public function _init()
	{
		
	}

	/**
	 * @首页
	 * */
	public function index()
	{  
		$admin = json_decode(base64_decode($this->input->cookie('admin')));
		if ($admin) {  
			header("Location:".base_url('Cadmin_user/index'), TRUE, 302);
		}else{
		    $data['code'] = ZD_md5(date('Ymd'));
			$this->load->view('layout/vlogin', $data); 
		}
	}
	
	/**
	 * @登陆验证
	 * */
	public function check_login()
	{  
	    if ($this->input->post('code') != ZD_md5(date('Ymd'))) {
	        header("Location:https://baidu.com", TRUE, 302);
	    }
	    
		$where['username'] = trim($this->input->post('username'));
		$where['password'] = ZD_md5(trim($this->input->post('password'))); 
		$res = $this->Base_model->getWhere('admin_user', $where); 
		if ($res->num_rows()>0) {
			$admin_str = base64_encode(json_encode($res->row()));
			$this->input->set_cookie('admin', $admin_str, 60*60*2);
			
			header("Location:".base_url('Cadmin_user/index'), TRUE, 302);
		}else{
			alert_msg('登录失败!');
		}
	}
	
	/**
	 * @404错误
	 * */
	public function show_404()
	{
	    $this->load->view('layout/vshow_404');
	}
	
	/**
	 * @退出
	 * */
	public function login_out()
	{ 
		$this->input->set_cookie('admin', '', 0);
		alert_msg('欢迎再次使用', 'Clogin/index');
	}
	
}

/** End of file Clogin.php */
/** Location: ./application/controllers/Clogin.php */