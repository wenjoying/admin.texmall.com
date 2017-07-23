<?php 
/**
 * Cfeedback.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cfeedback extends TM_Controller {
    private $table = 'feedback';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Mfeedback');
	}
	
	/**
	 * @意见列表
	 * */
	public function grid($pg = 1)
	{ 
	    $this->checkAction(__METHOD__);
	
	    $this->load->library('pagination');
	    $config['per_page']   = 20;
	    $config['uri_segment'] = 3;
	    $config['suffix']     = $this->get_page_param($this->input->get());
	    $config['total_rows'] = $this->Mfeedback->total($this->input->get());
	    $config['first_url']  = base_url('Cfeedback/grid').$this->get_page_param($this->input->get());
	    $config['base_url']   = base_url('Cfeedback/grid');
	    $this->pagination->initialize($config);
	    $data['link']       = $this->pagination->create_links();
	    $data['res']        = $this->Mfeedback->grid($pg-1, $config['per_page'], $this->input->get())->result();
	    $data['sum']        = $config['total_rows'];
	    $data['per_page']   = $config['per_page'];
	    $data['type_arr']   = array('竞品骚扰', '担保交易', '实名认证', '功能操作', '使用不畅', '建言献策', '其他');
	    $data['one_level'] = '网站设置';
	    $data['two_level'] = '意见反馈';
	    $this->load->view('feedback/vgrid', $data);
	}
	
	/**
	 * @修改
	 * */
	public function edit($id = 0)
	{
	    $this->checkAction(__METHOD__);
	
	    $res = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($res->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    $data['res'] = $res->row();
	    $data['one_level'] = '网站设置';
	    $data['two_level'] = '意见反馈';
	    $this->load->view('feedback/vedit', $data);
	}
	
	/**
	 * @回复
	 * */
	public function editPost()
	{
	    $this->validate();
	    $postData = $this->input->post();
	    $data['reply'] = $postData['reply'];
	    $data['reply_time']  = time();
	    
	    $res = $this->Base_model->update($this->table, array('id'=>$postData['id']), $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Cfeedback/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @验证
	 * */
	public function validate()
	{
	    if (is_empty($this->input->post('reply'))) {
	        alert_msg('请填写回复内容');
	    }
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
	        alert_msg('操作成功', 'Cfeedback/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
}

/** End of file Cfeedback.php */
/** Location: ./application/controllers/Cfeedback.php */
