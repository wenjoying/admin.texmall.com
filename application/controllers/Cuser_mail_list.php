<?php 
/**
 * Cuser_mail_list.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuser_mail_list extends TM_Controller {
    private $table = 'user_mail_list';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Muser_mail_list');
	}
	
    /**
	 * @通讯录列表
	 * */
	public function grid($pg = 1)
	{ 
	    $this->checkAction(__METHOD__);
        
        $this->load->library('pagination');
        $config['per_page']   = 2;
        $config['uri_segment'] = 3;
        $config['suffix']     = $this->get_page_param($this->input->get());
        $config['total_rows'] = $this->Muser_mail_list->total($this->input->get());
        $config['first_url']  = base_url('Cuser_mail_list/grid').$this->get_page_param($this->input->get());
        $config['base_url']   = base_url('Cuser_mail_list/grid');
        $this->pagination->initialize($config);
        $data['link']       = $this->pagination->create_links();
        $data['res']        = $this->Muser_mail_list->grid($pg-1, $config['per_page'], $this->input->get())->result();
        $data['sum']        = $config['total_rows'];
        $data['per_page']   = $config['per_page'];
        $data['one_level'] = '用户管理';
        $data['two_level'] = '通讯录';
        $this->load->view('user_mail_list/vgrid', $data);
	}
	
	/**
	 * @删除
	 * */
	public function delete($id = 0)
	{
	    $this->checkAction(__METHOD__);
	     
	    $res = $this->Base_model->delete($this->table, array('id'=>$id));
	    if ($res>0) {
	        alert_msg('操作成功', 'Cad_img/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
}

/** End of file Cuser_mail_list.php */
/** Location: ./application/controllers/Cuser_mail_list.php */
