<?php 
/**
 * Cgoods_attr_set.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cgoods_attr_set extends TM_Controller {
    
    private $table = 'goods_attr_set';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Mgoods_attr_set');
	}
	
	/**
	 * @产品属性列表
	 * */
	public function grid($pg = 1)
	{ 
	    $this->checkAction(__METHOD__);
	     
	    $this->load->library('pagination');
		$config['per_page']   = 2;
		$config['uri_segment'] = 3;
		$config['suffix']     = $this->get_page_param($this->input->get());
		$config['total_rows'] = $this->Mgoods_attr_set->total($this->input->get());
		$config['first_url']  = base_url('Cgoods_attr_set/grid').$this->get_page_param($this->input->get());
		$config['base_url']   = base_url('Cgoods_attr_set/grid');
		$this->pagination->initialize($config);
		$data['link']       = $this->pagination->create_links();
		$data['res']        = $this->Mgoods_attr_set->grid($pg-1, $config['per_page'], $this->input->get())->result();
		$data['sum']        = $config['total_rows'];
		$data['per_page']   = $config['per_page'];
		$data['one_level'] = '产品中心';
		$data['two_level'] = '产品属性';
	    $this->load->view('goods_attr_set/vgrid', $data);
	}
	
	/**
	 * @新增产品属性
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	     
	    $data['one_level'] = '产品中心';
		$data['two_level'] = '产品属性';
	    $this->load->view('goods_attr_set/vadd', $data);
	}
	
	/**
	 * @新增
	 * */
	public function addPost()
	{
	    $this->_validate();
	    $postData = $this->input->post();
	    $data['attr_en_name'] = $postData['attr_en_name'];
	    $data['attr_name'] = $postData['attr_name'];
	    $data['attr_val'] = toEnComma($postData['attr_val']);
	    $data['is_multi'] = $postData['is_multi'];
	    $data['status'] = $postData['status'];
	     
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Cgoods_attr_set/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @验证
	 * */
	private function _validate($type = 'insert')
	{
	    if (is_empty($this->input->post('attr_en_name'))) {
	        alert_msg('请填写英文名称');
	    }
	    
	    if (is_empty($this->input->post('attr_name'))) {
	        alert_msg('请填写名称');
	    }
	    
	    if ($type == 'insert') {
	        $res = $this->Base_model->getOrWhere($this->table, array('attr_en_name'=>$this->input->post('attr_en_name')), array('attr_name'=>$this->input->post('attr_name')));
	        if ($res->num_rows() > 0) {
	            alert_msg('名称不能重复');
	        }
	    }
	    
	    if (is_empty($this->input->post('attr_val'))) {
	        alert_msg('请填写属性');
	    }
	    
	    if (is_empty($this->input->post('is_multi'))) {
	        alert_msg('请选择是否多选');
	    }
	    
	    if (is_empty($this->input->post('status'))) {
	        alert_msg('请选择是否显示');
	    }
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
	    $data['res']  = $res->row();
	    $data['one_level'] = '产品中心';
		$data['two_level'] = '产品属性';
	    $this->load->view('goods_attr_set/vedit', $data);
	}
	
	/**
	 * @修改提交
	 * */
	public function editPost()
	{
	    $this->_validate('edit');
	    
	    $postData = $this->input->post();
	    $data['attr_val'] = toEnComma($postData['attr_val']);
	    $data['is_multi'] = $postData['is_multi'];
	    $data['status'] = $postData['status'];
	    
	    $res = $this->Base_model->update($this->table, array('id'=>$postData['id']), $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Cgoods_attr_set/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @删除属性
	 * */
	public function delete($id = 0)
	{    
	    $this->checkAction(__METHOD__);
	    
	    $res = $this->Base_model->delete($this->table, array('id'=>$id));
	    if ($res > 0) {
	        alert_msg('操作成功', 'Cgoods_attr_set/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	

	
}

/** End of file Cgoods_attr_set.php */
/** Location: ./application/controllers/Cgoods_attr_set.php */