<?php 
/**
 * Csetting.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csetting extends TM_Controller {
    
    function __init()
	{
		header("Content-type: text/html; Charset=utf-8");
	}
	
	public function fonts() 
	{
	    $data['one_level'] = '网站设置';
	    $data['two_level'] = '字体图标';
	    $this->load->view('setting/vfonts', $data);
	}
	
}

/** End of file Csetting.php */
/** Location: ./application/controllers/Csetting.php */
