<?php 
/**
 * Cplatform_service.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cplatform_service extends TM_Controller {
    private $table = 'platform_service';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Mplatform_service');
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
	    $config['total_rows'] = $this->Mplatform_service->total($this->input->get());
	    $config['first_url']  = base_url('Cplatform_service/grid').$this->get_page_param($this->input->get());
	    $config['base_url']   = base_url('Cplatform_service/grid');
	    $this->pagination->initialize($config);
	    $data['link']       = $this->pagination->create_links();
	    $data['res']        = $this->Mplatform_service->grid($pg-1, $config['per_page'], $this->input->get())->result();
	    $data['sum']        = $config['total_rows'];
	    $data['per_page']   = $config['per_page'];
	    $data['status_arr'] = array(
	        '1'=>'<span class="label label-table label-info">审核中</span>',
	        '2'=>'<span class="label label-table label-success">通过</span>',
	        '3'=>'<span class="label label-table label-danger">不通过</span>'
	    );
	    $data['one_level'] = '认证审核';
	    $data['two_level'] = '平台服务商';
	    $this->load->view('platform_service/vgrid', $data);
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
	        alert_msg('操作成功', 'Cplatform_service/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
}

/** End of file Cplatform_service.php */
/** Location: ./application/controllers/Cplatform_service.php */
