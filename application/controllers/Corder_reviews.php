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
    private $table = 'order_reviews';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Morder_reviews');
	}
	
	/**
	 * @p评价列表
	 * */
	public function grid($pg = 1) 
	{
	    $this->checkAction(__METHOD__);
        
        $this->load->library('pagination');
        $config['per_page']   = 2;
        $config['uri_segment'] = 3;
        $config['suffix']     = $this->get_page_param($this->input->get());
        $config['total_rows'] = $this->Morder_reviews->total($this->input->get());
        $config['first_url']  = base_url('Corder_reviews/grid').$this->get_page_param($this->input->get());
        $config['base_url']   = base_url('Corder_reviews/grid');
        $this->pagination->initialize($config);
        $data['link']       = $this->pagination->create_links();
        $data['res']        = $this->Morder_reviews->grid($pg-1, $config['per_page'], $this->input->get())->result();
        $data['sum']        = $config['total_rows'];
        $data['per_page']   = $config['per_page'];
        $data['status_arr'] = get_status();
        $data['one_level'] = '订单管理';
        $data['two_level'] = '订单评价';
        $this->load->view('order_reviews/vgrid', $data);
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
	    $data['status_arr'] = get_status();
	    $data['one_level'] = '订单管理';
        $data['two_level'] = '订单评价';
	    $this->load->view('order_reviews/vpage', $data);
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
	        alert_msg('操作成功', 'Corder_reviews/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
}

/** End of file Corder_reviews.php */
/** Location: ./application/controllers/Corder_reviews.php */
