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
	 * @个人认证
	 * */
	public function grid($pg = 1)
	{
	    $this->checkAction(__METHOD__);
	
	    $this->load->library('pagination');
	    $getData = $this->input->get();
	    $getData['bank_address'] = $this->_get_bank_address();
	    $config['per_page']   = 2;
	    $config['uri_segment'] = 3;
	    $config['suffix']     = $this->get_page_param($this->input->get());
	    $config['total_rows'] = $this->Mauthenticate_personal->total($getData);
	    $config['first_url']  = base_url('Cauthenticate_personal/grid').$this->get_page_param($this->input->get());
	    $config['base_url']   = base_url('Cauthenticate_personal/grid');
	    $this->pagination->initialize($config);
	    $data['link']       = $this->pagination->create_links();
	    $data['res']        = $this->Mauthenticate_personal->grid($pg-1, $config['per_page'], $getData)->result();
	    $data['sum']        = $config['total_rows'];
	    $data['per_page']   = $config['per_page'];
	    $data['status_arr'] = get_auth_status();
	    $data['one_level'] = '认证审核';
	    $data['two_level'] = '个人认证';
	    $this->load->view('authenticate_personal/vgrid', $data);
	}
	
	/**
	 * @获取开户地址
	 * */
	private function _get_bank_address()
	{
	    $dis = $this->Base_model->getWherein('district', 'id', array($this->input->get('province_id'), $this->input->get('city_id')), array(), 'id asc');
	    $bank_address = '';
	    foreach ($dis as $d) {
	        $bank_address .= $d->district_name;
	    }
	    return $bank_address;
	}
	
	/**
	 * @详情
	 * */
	public function page($id = 0)
	{
	    $this->checkAction(__METHOD__);
	     
	    $res = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($res->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	     
	    $data['res'] = $res->row();
	    $data['status_arr'] = get_auth_status();
	    $data['one_level'] = '认证审核';
	    $data['two_level'] = '个人认证';
	    $this->load->view('authenticate_personal/vpage', $data);
	}
	
	/**
	 * @提交审核
	 * */
	public function up_status()
	{
	    $this->validate();
	    $postData = $this->input->post();
	    $data['is_check'] = $postData['is_check'];
	    $data['reject_des'] = $postData['is_check']==2 ? '后台审核通过，准备打款' : $postData['reject_des'];
	    $data['validate_money'] = rand(1, 99);
	    $data['update_time']   = time();
	
	    $res = $this->Base_model->update($this->table, array('id'=>$postData['id'], 'is_check'=>1), $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Cauthenticate_personal/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @验证
	 * */
	public function validate()
	{
	    if ($this->input->post('is_check')==6 && is_empty($this->input->post('reject_des'))) {
	        alert_msg('请填写审核不通过原因');
	    }
	}
	
	/**
	 * @删除
	 * */
	public function delete($id = 0)
	{
	    $this->checkAction(__METHOD__);
	
	    $res = $this->Base_model->delete($this->table, array('id'=>$id));
	    if ($res>0) {
	        alert_msg('操作成功', 'Cauthenticate_personal/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
}

/** End of file Cauthenticate_personal.php */
/** Location: ./application/controllers/Cauthenticate_personal.php */
