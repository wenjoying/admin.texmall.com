<?php 
/**
 * Cauthenticate_personal.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cauthenticate_personal extends TM_Controller {
    private $table = 'authenticate_personal';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Mauthenticate_personal');
	}
	
	/**
	 * @平台服务商
	 * */
	public function grid($pg = 1)
	{
	    $this->checkAction(__METHOD__);
	
	    $this->load->library('pagination');
	    $config['per_page']   = 20;
	    $config['uri_segment'] = 3;
	    $config['suffix']     = $this->get_page_param($this->input->get());
	    $config['total_rows'] = $this->Mauthenticate_personal->total($this->input->get());
	    $config['first_url']  = base_url('Cauthenticate_personal/grid').$this->get_page_param($this->input->get());
	    $config['base_url']   = base_url('Cauthenticate_personal/grid');
	    $this->pagination->initialize($config);
	    $data['link']       = $this->pagination->create_links();
	    $data['res']        = $this->Mauthenticate_personal->grid($pg-1, $config['per_page'], $this->input->get())->result();
	    $data['sum']        = $config['total_rows'];
	    $data['per_page']   = $config['per_page'];
	    $data['status_arr'] = array(
	        '1'=>'<span class="label label-table label-info">审核中</span>',
	        '2'=>'<span class="label label-table label-success">通过</span>',
	        '3'=>'<span class="label label-table label-danger">不通过</span>'
	    );
	    $data['one_level'] = '认证审核';
	    $data['two_level'] = '个人认证';
	    $this->load->view('authenticate_personal/vgrid', $data);
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
	        alert_msg('操作成功', 'Cauthenticate_personal/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
}

/** End of file Cauthenticate_personal.php */
/** Location: ./application/controllers/Cauthenticate_personal.php */
