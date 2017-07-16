<?php 
/**
 * Corder_reviews.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Corder_reviews extends TM_Controller {
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
	}
	
	public function grid() 
	{
	    $this->checkAction(__METHOD__);
	    
	    $data['one_level'] = '网站设置';
	    $data['two_level'] = '字体图标';
	    $this->load->view('order_reviews/vgrid', $data);
	}
	
}

/** End of file Corder_reviews.php */
/** Location: ./application/controllers/Corder_reviews.php */
