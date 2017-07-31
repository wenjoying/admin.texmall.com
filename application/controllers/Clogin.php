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
			header("Location:".base_url('Chome/index'), TRUE, 302);
		}else{
		    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=base_url('Clogin/login_out')) {
		        $parseUrl = parse_url($_SERVER['HTTP_REFERER']);
		        if (isset($parseUrl['query']) && strpos($parseUrl['query'], 'backurl') !== false) {
		            $data['backurl'] = urldecode(strstr($parseUrl['query'], 'http'));
		        } else {
		            $data['backurl'] = $_SERVER['HTTP_REFERER'];
		        }
		    } else {
		        $data['backurl'] = base_url('Chome/index');
		    }
		    $data['code'] = ZD_md5(date('Ymd'));
			$this->load->view('layout/vlogin', $data); 
		}
	}
	
	/**
	 * @验证码
	 * */
	public function get_captcha()
	{
	    $this->load->helper('captcha');
	    $word = randomStr(4, 3);
	    $config = array(
	        'word'       => $word,
	        'img_path'   => $this->config->upload_image_path('captcha', TRUE),
	        'img_url'    => $this->config->image_url.'captcha/',
	        'font_path'  => 'assets/plugins/YHBold.ttf',
	        'img_width'  => 80,
	        'img_height' => 30,
	        'expiration' => '1200',
	    );
	    $captcha = create_captcha($config);
	    $this->input->set_cookie('captcha', $captcha['word'], 600);
	    echo json_encode($captcha);
	}
	
	/**
	 * @登陆验证
	 * */
	public function check_login()
	{  
	    if ($this->input->post('code') != ZD_md5(date('Ymd'))) {
	        header("Location:https://baidu.com", TRUE, 302);
	    }
	    
	    if (strtoupper($this->input->post('captcha')) != strtoupper($this->input->cookie('captcha'))) {
	        alert_msg('验证码错误');
	    }
	    
		$where['username'] = trim($this->input->post('username'));
		$where['password'] = ZD_md5(trim($this->input->post('password'))); 
		$res = $this->Base_model->getWhere('admin_user', $where); 
		if ($res->num_rows()>0) {
			$admin_str = base64_encode(json_encode($res->row()));
			$this->input->set_cookie('admin', $admin_str, 60*60*3);
			
			header("Location:".$this->input->post('backurl'), TRUE, 302);
		}else{
			alert_msg('登录失败');
		}
	}
	
	/**
	 * @404错误
	 * */
	public function show_404()
	{
	    $data['one_level'] = '';
	    $data['two_level'] = '';
	    $this->load->view('layout/vshow_404', $data);
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