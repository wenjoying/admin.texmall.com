<?php 
/**
 * Chome.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chome extends TM_Controller {
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
	}
	
	/**
	 * @后台首页
	 * */
	public function index()
	{
	    $data['user_num'] = $this->_get_user_num();
	    $data['company_num'] = $this->_get_company_num();
	    $data['goods_num'] = $this->_get_goods_num();
	    $data['order_num'] = $this->_get_order_num(); 
	    
	    $data['moth_order'] = '[
                         	{"xaxis": "1月", "val": 34},
                         	{"xaxis": "2月", "val": 24},
                         	{"xaxis": "3月", "val": 3},
                         	{"xaxis": "4月", "val": 12},
                         	{"xaxis": "5月", "val": 13},
                         	{"xaxis": "6月", "val": 22},
                         	{"xaxis": "7月", "val": 5},
                         	{"xaxis": "8月", "val": 26},
                         	{"xaxis": "9月", "val": 12},
                         	{"xaxis": "10月", "val": 19},
                         	{"xaxis": "11月", "val": 19},
                         	{"xaxis": "12月", "val": 19},
						]';
	    $data['moth_amount'] = '[
                         	{"xaxis": "1月", "val": 34},
                         	{"xaxis": "2月", "val": 24},
                         	{"xaxis": "3月", "val": 3},
                         	{"xaxis": "4月", "val": 12},
                         	{"xaxis": "5月", "val": 13},
                         	{"xaxis": "6月", "val": 22},
                         	{"xaxis": "7月", "val": 5},
                         	{"xaxis": "8月", "val": 26},
                         	{"xaxis": "9月", "val": 12},
                         	{"xaxis": "10月", "val": 19},
                         	{"xaxis": "11月", "val": 19},
                         	{"xaxis": "12月", "val": 19},
						]';
	    $data['one_level'] = 'Texmall后台首页';
	    $data['two_level'] = '';
	    $this->load->view('layout/vindex', $data);
	}
	
	/**
	 * @获取用户数量
	 * */
	private function _get_user_num()
	{
	    $ret['month_num'] = $this->Base_model->getTableNum('user', array('reg_time >'=>strtotime(date('Y-m'))));
	    $ret['all_num'] = $this->Base_model->getTableNum('user');
	    return $ret;
	}
	
	/**
	 * @获取企业数量
	 * */
	private function _get_company_num()
	{
	    $ret['month_num'] = $this->Base_model->getTableNum('supplier_buyer', array('time >'=>strtotime(date('Y-m'))));
	    $ret['all_num'] = $this->Base_model->getTableNum('supplier_buyer');
	    return $ret;
	}
	
	/**
	 * @获取产品数量
	 * */
	private function _get_goods_num()
	{
	    $ret['month_num'] = $this->Base_model->getTableNum('goods', array('time >'=>strtotime(date('Y-m'))));
	    $ret['all_num'] = $this->Base_model->getTableNum('goods');
	    return $ret;
	}
	
	/**
	 * @获取订单数量
	 * */
	private function _get_order_num()
	{
	    $ret['month_num'] = $this->Base_model->getTableNum('order', array('time >'=>strtotime(date('Y-m'))));
	    $ret['all_num'] = $this->Base_model->getTableNum('order');
	    $ret['month_money'] = $this->Base_model->getSum('order', 'sum_order_price', array('order_state'=>2))->row()->sum_order_price;
	    $ret['all_money'] = $this->Base_model->getSum('order', 'sum_order_price', array('order_state'=>2))->row()->sum_order_price;
	    return $ret;
	}
	
}

/** End of file Chome.php */
/** Location: ./application/controllers/Chome.php */
