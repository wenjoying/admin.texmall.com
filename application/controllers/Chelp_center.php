<?php 
/**
 * Chelp_center.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chelp_center extends TM_Controller {
    private $table = 'help_center';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Mhelp_center');
	}
	
	/**
	 * @信息列表
	 * */
	public function grid($pg = 1) 
	{
	    $this->checkAction(__METHOD__);
	    
        $this->load->library('pagination');
        $config['per_page']   = 2;
        $config['uri_segment'] = 3;
        $config['suffix']     = $this->get_page_param($this->input->get());
        $config['total_rows'] = $this->Mhelp_center->total($this->input->get());
        $config['first_url']  = base_url('Chelp_center/grid').$this->get_page_param($this->input->get());
        $config['base_url']   = base_url('Chelp_center/grid');
        $this->pagination->initialize($config);
        $data['link']       = $this->pagination->create_links();
        $data['res']        = $this->Mhelp_center->grid($pg-1, $config['per_page'], $this->input->get())->result();
        $data['sum']        = $config['total_rows'];
        $data['per_page']   = $config['per_page'];
        $data['cat_arr']    = $this->_get_category();
	    $data['one_level'] = '资讯&帮助中心';
	    $data['two_level'] = '信息列表';
	    $this->load->view('help_center/vgrid', $data);
	}
	
	/**
	 * @新增
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	    
	    $data['cat_arr']    = $this->_get_category();
	    $data['one_level'] = '资讯&帮助中心';
	    $data['two_level'] = '信息列表';
	    $this->load->view('help_center/vadd', $data);
	}
	
	/**
	 * @新增
	 * */
	public function addPost()
	{
	    $this->_validate();
	    $postData = $this->input->post();
	    $data['category_id'] = $postData['category_id'];
	    $data['title']       = $postData['title'];
	    $data['author']      = $postData['author'];
	    $data['des']         = $postData['des'];
	    $data['reorder']     = $postData['reorder'];
	    $data['status']      = $postData['status'];
	    $data['time']        = time();
	    $data['update_time'] = '';
	     
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Chelp_center/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @修改产品
	 * */
	public function edit($id = 0)
	{
	    $this->checkAction(__METHOD__);
	     
	    $res = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($res->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    $data['res'] = $res->row();
	    $data['cat_arr']    = $this->_get_category();
	    $data['one_level'] = '资讯&帮助中心';
	    $data['two_level'] = '信息列表';
	    $this->load->view('help_center/vedit', $data);
	}
	
	/**
	 * @提交修改
	 * */
	public function editPost()
	{
	    $this->_validate();
	    $postData = $this->input->post();
	    $data['category_id'] = $postData['category_id'];
	    $data['title']       = $postData['title'];
	    $data['author']      = $postData['author'];
	    $data['des']         = $postData['des'];
	    $data['reorder']     = $postData['reorder'];
	    $data['status']      = $postData['status'];
	    $data['update_time'] = time();
	    
	    $res = $this->Base_model->update($this->table, array('id'=>$postData['id']), $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Chelp_center/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @验证
	 * */
	private function _validate()
	{
	    if (is_empty($this->input->post('category_id'))) {
	        alert_msg('请选择分类');
	    }
	    
	    if (is_empty($this->input->post('title'))) {
	        alert_msg('请填写标题');
	    }
	    
	    if (is_empty($this->input->post('author'))) {
	        alert_msg('请填写作者');
	    }
	    
	    if (is_empty($this->input->post('des'))) {
	        alert_msg('请填写内容');
	    }
	    
	    if (is_empty($this->input->post('reorder'))) {
	        alert_msg('请填写排序');
	    }
	    
	    if (is_empty($this->input->post('status'))) {
	        alert_msg('请选择状态');
	    }
	}
	
	/**
	 * @更新状态
	 * */
	public function up_status($id = 0)
	{
	    $this->checkAction(__METHOD__);
	    
	    $res = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($res->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    $status = $this->input->get('status')==1 ? 2 : 1;
	    $res = $this->Base_model->update($this->table, array('id'=>$id), array('status'=>$status));
	    if ($res>0) {
	        alert_msg('操作成功', 'Chelp_center/grid');
	    }else{
	        alert_msg('操作失败');
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
	        alert_msg('操作成功', 'Chelp_center/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @获取分类
	 * */
	private function _get_category()
	{
	    $cat = $this->Base_model->getWhere('help_category', array('status'=>1))->result();
	    return array_column($cat, 'category_name', 'id');
	}
	
}

/** End of file Chelp_center.php */
/** Location: ./application/controllers/Chelp_center.php */
