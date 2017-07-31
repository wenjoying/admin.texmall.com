<?php 
/**
 * Cdeliver_address.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cdeliver_address extends TM_Controller {
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Mdeliver_address'); 
	}
	
	/**
	 * @收货地址
	 * */
	public function grid($pg = 1)
	{
	    $this->checkAction(__METHOD__);
	
	    $this->load->library('pagination');
	    $config['per_page']   = 2;
	    $config['uri_segment'] = 3;
	    $config['suffix']     = $this->get_page_param($this->input->get());
	    $config['total_rows'] = $this->Mdeliver_address->total($this->input->get());
	    $config['first_url']  = base_url('Cdeliver_address/grid').$this->get_page_param($this->input->get());
	    $config['base_url']   = base_url('Cdeliver_address/grid');
	    $this->pagination->initialize($config);
	    $data['link']       = $this->pagination->create_links();
	    $data['res']        = $this->Mdeliver_address->grid($pg-1, $config['per_page'], $this->input->get())->result();
	    $data['sum']        = $config['total_rows'];
	    $data['per_page']   = $config['per_page'];
	    $data['one_level'] = '订单管理';
	    $data['two_level'] = '收货地址';
	    $this->load->view('deliver_address/vgrid', $data);
	}
	
	/**
	 * @删除收货地址
	 * */
	public function delete($id = 0)
	{
	    $this->checkAction(__METHOD__);
	     
	    $res = $this->Base_model->delete($this->table, array('id'=>$id));
	    if ($res > 0) {
	        alert_msg('操作成功', 'Cgoods/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	
}

/** End of file Cdeliver_address.php */
/** Location: ./application/controllers/Cdeliver_address.php */
