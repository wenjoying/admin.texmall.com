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
        $config['per_page']   = 20;
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
	    $data['status_arr'] = array('1'=>'审核中', '2'=>'通过', '3'=>'不通过');
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
	     
	    $reviews = $this->Base_model->getWhere($this->table, array('id'=>$id))->row();
	    $res = $this->Base_model->delete($this->table, array('id'=>$id));
	    if ($res > 0) {
	        foreach (explode('|', $reviews->imgs) as $i) {
	            $this->delete_img($i);
	        }
	        alert_msg('操作成功', 'Corder_goods/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
}

/** End of file Corder_goods.php */
/** Location: ./application/controllers/Corder_goods.php */
