<?php 
/**
 * Cuser_log.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuser_log extends TM_Controller {
    private $table = 'user_log';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Muser_log');
	}
	
	/**
	 * @收藏列表
	 * */
	public function grid($pg = 1)
	{
	    $this->checkAction(__METHOD__);
	
	    $this->load->library('pagination');
	    $config['per_page']   = 20;
	    $config['uri_segment'] = 3;
	    $config['suffix']     = $this->get_page_param($this->input->get());
	    $config['total_rows'] = $this->Muser_log->total($this->input->get());
	    $config['first_url']  = base_url('Cuser_log/grid').$this->get_page_param($this->input->get());
	    $config['base_url']   = base_url('Cuser_log/grid');
	    $this->pagination->initialize($config);
	    $data['link']       = $this->pagination->create_links();
	    $data['res']        = $this->Muser_log->grid($pg-1, $config['per_page'], $this->input->get())->result();
	    $data['sum']        = $config['total_rows'];
	    $data['per_page']   = $config['per_page'];
	    $data['one_level'] = '用户管理';
	    $data['two_level'] = '浏览记录';
	    $this->load->view('user_log/vgrid', $data);
	}
	
    /**
	 * @用户浏览记录
	 * */
	public function user_grid($uid = 0)
	{ 
	    $data['res'] = $this->Base_model->getWhere($this->table, array('uid'=>$uid))->result();
        
        $this->load->view('user_log/vuser_grid', $data);
	}
	
	/**
	 * @删除
	 * */
	public function delete($id = 0)
	{
	    $this->checkAction(__METHOD__);
	
	    $checkid = $this->input->post('checkid');
	    $ids = $checkid ? $checkid : array($id);
	    $res = $this->Base_model->deleteWherein($this->table, 'id', $ids);
	    if ($res>0) {
	        alert_msg('操作成功', 'Cuser_log/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
}

/** End of file Cuser_log.php */
/** Location: ./application/controllers/Cuser_log.php */
