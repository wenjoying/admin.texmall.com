<?php 
/**
 * Corder_goods.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Corder_goods extends TM_Controller {
    private $table = 'order_goods';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Morder_goods');
	}
	
	/**
	 * @订单产品列表
	 * */
	public function grid($pg = 1) 
	{
	    $this->checkAction(__METHOD__);
        
        $this->load->library('pagination');
        $config['per_page']   = 2;
        $config['uri_segment'] = 3;
        $config['suffix']     = $this->get_page_param($this->input->get());
        $config['total_rows'] = $this->Morder_goods->total($this->input->get());
        $config['first_url']  = base_url('Corder_goods/grid').$this->get_page_param($this->input->get());
        $config['base_url']   = base_url('Corder_goods/grid');
        $this->pagination->initialize($config);
        $data['link']       = $this->pagination->create_links();
        $data['res']        = $this->Morder_goods->grid($pg-1, $config['per_page'], $this->input->get())->result();
        $data['sum']        = $config['total_rows'];
        $data['per_page']   = $config['per_page'];
        $data['one_level'] = '订单管理';
        $data['two_level'] = '订单产品';
        $this->load->view('order_goods/vgrid', $data);
	}
	
	/**
	 * @查看
	 * */
	public function page($id = 0)
	{
	    $this->checkAction(__METHOD__);
	     
	    $res = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($res->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    $data['res'] = $res->row();
	    $data['reviews'] = $this->_get_order_reviews($res->row()->order_id, $res->row()->goods_id);
	    $data['one_level'] = '订单管理';
        $data['two_level'] = '订单产品';
	    $this->load->view('order_goods/vpage', $data);
	}
	
	/**
	 * @删除
	 * */
	public function delete($id = 0) 
	{
	    $this->checkAction(__METHOD__);
	     
	    $res = $this->Base_model->delete($this->table, array('id'=>$id));
	    if ($res > 0) {
	        alert_msg('操作成功', 'Corder_goods/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @获取订单评价
	 * */
	private function _get_order_reviews($order_id=0, $goods_id=0)
	{
	    return $this->Base_model->getWhere('order_reviews', array('order_id'=>$order_id, 'goods_id'=>$goods_id))->result();
	}
	
}

/** End of file Corder_goods.php */
/** Location: ./application/controllers/Corder_goods.php */
