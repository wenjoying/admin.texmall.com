<?php 
/**
 * Chelp_category.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chelp_category extends TM_Controller {
    private $table = 'help_category';
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
	}
	
	/**
	 * @分类列表
	 * */
	public function grid() 
	{
	    $this->checkAction(__METHOD__);
	    
	    $data['res'] = $this->Base_model->getTable($this->table)->result();
	    $data['one_level'] = '资讯&帮助中心';
	    $data['two_level'] = '分类';
	    $this->load->view('help_category/vgrid', $data);
	}
	
	/**
	 * @新增
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	    
	    $data['one_level'] = '资讯&帮助中心';
	    $data['two_level'] = '分类';
	    $this->load->view('help_category/vadd', $data);
	}
	
	/**
	 * @新增
	 * */
	public function addPost()
	{
	    $this->validate();
	    $postData = $this->input->post();
	    $data['type']          = $postData['type'];
	    $data['category_name'] = $postData['category_name'];
	    $data['reorder']       = $postData['reorder'];
	    $data['status']        = $postData['status'];
	     
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Chelp_category/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @验证
	 * */
	public function validate()
	{
	    if (is_empty($this->input->post('type'))) {
	        alert_msg('请选择类型');
	    }
	    
	    if (is_empty($this->input->post('category_name'))) {
	        alert_msg('请填写类名');
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
	        alert_msg('操作成功', 'Chelp_category/grid');
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
	     
	    if ($this->Base_model->getTableNum('help_center', array('category_id'=>$id))) {
	        alert_msg('请先删除此分类的数据');
	    }
	    $res = $this->Base_model->delete($this->table, array('id'=>$id));
	    if ($res>0) {
	        alert_msg('操作成功', 'Chelp_category/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
}

/** End of file Chelp_category.php */
/** Location: ./application/controllers/Chelp_category.php */
