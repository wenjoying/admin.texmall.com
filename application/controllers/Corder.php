<?php 
/**
 * Corder.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Corder extends TM_Controller {
    
    private $table = 'order';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Morder');
	}
	
	/**
	 * @订单列表
	 * */
	public function grid($pg = 1)
	{  
	    $this->checkAction(__METHOD__);
        
        $this->load->library('pagination');
        $config['per_page']   = 20;
        $config['uri_segment'] = 3;
        $config['suffix']     = $this->get_page_param($this->input->get());
        $config['total_rows'] = $this->Morder->total($this->input->get());
        $config['first_url']  = base_url('Corder/grid').$this->get_page_param($this->input->get());
        $config['base_url']   = base_url('Corder/grid');
        $this->pagination->initialize($config);
        $data['link']       = $this->pagination->create_links();
        $data['res']        = $this->Morder->grid($pg-1, $config['per_page'], $this->input->get())->result();
        $data['sum']        = $config['total_rows'];
        $data['per_page']   = $config['per_page'];
        $data['state_arr']  = array('1'=>'未付款', '2'=>'已付款', '3'=>'已完成', '4'=>'评价', '5'=>'退款/售后');
        $data['status_arr'] = array('1'=>'取消订单', '2'=>'已签合同', '3'=>'待付款', '4'=>'已付款', '5'=>'备货中', '6'=>'已发货', '7'=>'已收货', '8'=>'已评价');
        $data['one_level'] = '订单管理';
        $data['two_level'] = '订单列表';
        $this->load->view('order/vgrid', $data);
	}
	
	/**
	 * @后台admin模拟
	 * @新增订单
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	    
	    $goods_cart = $this->_get_goods();
	    if (empty(count($goods_cart))) {
	        alert_msg('购物车还是空的。。。');
	    }
	    $data['res'] = $goods_cart;
	    $data['one_level'] = '订单管理';
        $data['two_level'] = '订单列表';
	    $this->load->view('order/vadd', $data);
	}
	
	/**
	 * @新增
	 * */
	public function addPost()
	{
	    $postData = $this->input->post();
	    vard($postData);
	    
	    
	    
	    $data['platform_code'] = $this->Morder->create_platform_code($data['platform_name']);
	    $data['supplier_id']   = (int)$postData['supplier_id'];
	    $data['supplier_name'] = $postData['supplier_name'];
	    $data['supplier_code'] = $postData['supplier_code'];
	    $data['uid']           = $this->admin->id;
	    $data['price']         = $postData['price'];
	    $data['in_stock']      = $postData['in_stock'];
	    $data['width']         = $postData['width'];
	    $data['square_weight'] = $postData['square_weight'];
	    $data['shrinkage']     = $postData['shrinkage'];
	    $data['time']          = time();
	    $data['update_time']   = '';
	    
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Corder/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @获取产品
	 * */
	private function _get_goods()
	{
	    return $this->Base_model->getWhere('goods_cart', array('uid'=>$this->input->post('uid')))->result();
	}
	
	/**
	 * @详情页
	 * */
	public function page($id = 0)
	{
	    $this->checkAction(__METHOD__);
	    
	    $res = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($res->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    $data['res'] = $res->row();
	    $data['order_goods'] = $this->_get_order_goods($res->row()->id);
	    $data['order_reviews'] = $this->_get_order_reviews($res->row()->id); 
	    $data['state_arr']  = array('1'=>'未付款', '2'=>'已付款', '3'=>'已完成', '4'=>'评价', '5'=>'退款/售后');
        $data['status_arr'] = array('1'=>'取消订单', '2'=>'已签合同', '3'=>'待付款', '4'=>'已付款', '5'=>'备货中', '6'=>'已发货', '7'=>'已收货', '8'=>'已评价');
        $data['one_level'] = '订单管理';
        $data['two_level'] = '订单列表';
	    $this->load->view('order/vpage', $data);
	}
	
	/**
	 * @获取订单产品
	 * */
	private function _get_order_goods($order_id = 0)
	{
	    return $this->Base_model->getWhere('order_goods', array('order_id'=>$order_id))->result();
	}
	
	/**
	 * @获取订单评价
	 * */
	private function _get_order_reviews($order_id = 0)
	{
	    return $this->Base_model->getWhere('order_reviews', array('order_id'=>$order_id))->result();
	}
	
	/**
	 * @删除订单
	 * */
	public function delete($id = 0)
	{    
	    $this->checkAction(__METHOD__);
	    
	    if ($id == 1) {
	        alert_msg('禁止删除!');
	    }
	    $checkid = $this->input->post('checkid');
	    $ids = $checkid ? $checkid : array($id);
	    $order = $this->Base_model->getWherein($this->table, 'id', $ids);
	    $res = $this->Base_model->deleteWherein($this->table, 'id', $ids);
	    
	    if ($res > 0) {
    	    foreach ($order as $u) {
    	        $this->delete_img($u->original_img);
    	    }
	        alert_msg('操作成功', 'Corder/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @单独采购商订单
	 * */
	public function buyer_order($buyer_id = 0)
	{
	    $data['res'] = $this->Base_model->getWhere($this->table, array('buyer_id'=>$buyer_id), 'id desc', 20)->result();
	    $data['status_arr'] = array('1'=>'取消订单', '2'=>'已签合同', '3'=>'待付款', '4'=>'已付款', '5'=>'备货中', '6'=>'已发货', '7'=>'已收货', '8'=>'已评价');
        
	    $this->load->view('order/vbuyer_order', $data);
	}

	

}

/** End of file Corder.php */
/** Location: ./application/controllers/Corder.php */
