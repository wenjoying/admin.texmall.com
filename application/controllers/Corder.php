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
        $config['per_page']   = 2;
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
        $data['state_arr']  = get_oreder_state();
        $data['status_arr'] = get_order_status();
        $data['one_level'] = '订单管理';
        $data['two_level'] = '订单列表';
        $this->load->view('order/vgrid', $data);
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
	    $data['state_arr']  = get_oreder_state();
        $data['status_arr'] = get_order_status();
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
	    
	    $res = $this->Base_model->delete($this->table, array('id'=>$id));
	    if ($res > 0) {
	        $this->Base_model->delete('order_goods', array('order_id'=>$id));
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
	    $data['status_arr'] = get_order_status();
	    
	    $this->load->view('order/vbuyer_order', $data);
	}
	
	
	
	

	/**************************************************
	 * @以下为后台admin模拟
	 * ************************************************/
	
	/**
	 * @新增订单
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	     
	    $goods_cart = $this->_get_cart();
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
	    $user = $this->_get_user();
	    if ($user->num_rows() == 0) {
	        alert_msg('采购商不存在');
	    }
	    $time = time();
	    $cart = $this->_get_cart(FALSE);
	    $sum_goods_price = '0';    //选中产品总价
	    foreach ($cart as $c) {
	        $sum_goods_price = bcadd($sum_goods_price, bcmul($c->price, $c->number, 2), 2);
	    }
	    
	    $data['platform_code'] = date('Ymd-Hi');
	    $data['order_state']   = 1;
	    $data['order_status']  = 2;
	    $data['buyer_id']      = $user->row()->companyid;
	    $data['buyer_name']    = $user->row()->company;
	    $data['uid']           = $user->row()->id;
	    $data['username']      = $user->row()->username;
	    $data['sum_goods']     = count($this->input->post('cart_id'));
	    $data['sum_order_price']   = $sum_goods_price;
	    $data['deliver_order_id']  = 0;    //0未发货，存在就是物流id
	    $data['deliver_des']   = '';
	    $data['note']          = $postData['note'];
	    $data['time']          = $time;
	    $data['update_time']   = '';
	    $data['pay_time']      = '';
	    $data['send_time']     = '';
	    $data['receive_time']  = '';
	    $data['reviews_time']  = '';
	    
	    $this->db->trans_start();
	    $res = $this->Base_model->insert($this->table, $data);
	    $i = 0;
	    foreach ($cart as $c) {
	        $order_goods[$i]['order_id']       = $res;
	        $order_goods[$i]['platform_code']  = $data['platform_code'];
	        $order_goods[$i]['goods_id']       = $c->goods_id;
	        $order_goods[$i]['supplier_id']    = $c->supplier_id;
	        $order_goods[$i]['supplier_name']  = $c->supplier_name;
	        $order_goods[$i]['cover_img']      = $c->cover_img;
	        $order_goods[$i]['supplier_code']  = $c->supplier_code;
	        $order_goods[$i]['price']          = $c->price;
	        $order_goods[$i]['number']         = $c->number;
	        $order_goods[$i]['sum_goods_price'] = bcmul($c->price, $c->number, 2);
	        $order_goods[$i]['goods_attr']     = $c->goods_attr;
	        $order_goods[$i]['order_price']    = $c->price;
	        $order_goods[$i]['time']           = $time;
	        $i ++;
	    }
	    
	    $this->_add_order_goods($order_goods);
	    $this->db->trans_complete();
	    if ($this->db->trans_status()===TRUE && $res>0) {
	        alert_msg('操作成功', 'Corder/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @获取产品
	 * */
	private function _get_cart($byUid = TRUE)
	{
	    $postData = $this->input->post();
	    if ($byUid == TRUE) {
	        return $this->Base_model->getWhere('goods_cart', array('uid'=>$postData['uid']))->result();
	    } else {
	        return $this->Base_model->getWherein('goods_cart', 'id', $postData['cart_id']);
	    }
	}
	
	/**
	 * @获取采购商用户
	 * */
	private function _get_user()
	{
	    return $this->Base_model->getWhere('user', array('id'=>$this->input->post('uid'), 'role_id'=>1));
	}
	
	/**
	 * @新增订单产品
	 * */
	private function _add_order_goods($order_goods)
	{
	    $this->Base_model->insertArray('order_goods', $order_goods);   //新增订单产品
	    $this->Base_model->deleteWherein('goods_cart', 'id', $this->input->post('cart_id'));   //删除购物车里提交订单的产品
	}
	
	

}

/** End of file Corder.php */
/** Location: ./application/controllers/Corder.php */
