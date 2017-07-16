<?php 
/**
 * Cgoods_cart.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cgoods_cart extends TM_Controller {
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Mgoods_cart');
	}
	
    /**
	 * @购物车
	 * */
	public function grid($pg = 1)
	{
	    $this->checkAction(__METHOD__);
	
	    $this->load->library('pagination');
	    $config['per_page']   = 20;
	    $config['uri_segment'] = 3;
	    $config['suffix']     = $this->get_page_param($this->input->get());
	    $config['total_rows'] = $this->Mgoods_cart->total($this->input->get());
	    $config['first_url']  = base_url('Cgoods_cart/grid').$this->get_page_param($this->input->get());
	    $config['base_url']   = base_url('Cgoods_cart/grid');
	    $this->pagination->initialize($config);
	    $data['link']       = $this->pagination->create_links();
	    $data['res']        = $this->Mgoods_cart->grid($pg-1, $config['per_page'], $this->input->get())->result();
	    $data['sum']        = $config['total_rows'];
	    $data['per_page']   = $config['per_page'];
	    $data['one_level'] = '订单管理';
	    $data['two_level'] = '购物车';
	    $this->load->view('goods_cart/vgrid', $data);
	}
	
	/**
	 * @删除购物车
	 * */
	public function delete($id = 0)
	{
	    $this->checkAction(__METHOD__);
	     
	    if ($id == 1) {
	        alert_msg('禁止删除!');
	    }
	    $checkid = $this->input->post('checkid');
	    $ids = $checkid ? $checkid : array($id);
	    $res = $this->Base_model->deleteWherein($this->table, 'id', $ids);
	     
	    if ($res > 0) {
	        alert_msg('操作成功', 'Cgoods/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
}

/** End of file Cgoods_cart.php */
/** Location: ./application/controllers/Cgoods_cart.php */
