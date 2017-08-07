<?php 
/**
 * Cgoods_recom.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cgoods_recom extends TM_Controller {
    
    private $table = 'goods_recom';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
	}
	
	/**
	 * @特价&推荐列表
	 * */
	public function grid($pg = 1)
	{ 
	    $this->checkAction(__METHOD__);
	     
	    $data['res'] = $this->Base_model->getTable($this->table)->result();
		$data['one_level'] = '产品中心';
		$data['two_level'] = '特价&推荐';
	    $this->load->view('goods_recom/vgrid', $data);
	}
	
	/**
	 * @新增特价&推荐
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	     
	    $data['one_level'] = '产品中心';
		$data['two_level'] = '特价&推荐';
	    $this->load->view('goods_recom/vadd', $data);
	}
	
	/**
	 * @新增
	 * */
	public function addPost()
	{
	    $this->_validate();
	    
	    $postData = $this->input->post();
	    $id_arr = array();
	    foreach (explode(',', $postData['des']) as $v) {
	        $v = (int)$v;
	        if ($v && is_int($v)) $id_arr[] = $v;
	    }
	    if (empty($id_arr)) {
	        alert_msg('请填写产品id');
	    }
	    $data['en_name'] = $postData['en_name'];
	    $data['zh_name'] = $postData['zh_name'];
	    $data['des'] = implode(',', array_flip(array_flip($id_arr)));
	     
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Cgoods_recom/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @验证
	 * */
	private function _validate()
	{
	    if (is_empty($this->input->post('en_name'))) {
	        alert_msg('请填写英文名称');
	    }
	    
	    if (is_empty($this->input->post('zh_name'))) {
	        alert_msg('请填写中文名称');
	    }
	    
	    if (is_empty($this->input->post('des'))) {
	        alert_msg('请填写产品id');
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
		$data['two_level'] = '特价&推荐';
	    $this->load->view('goods_recom/vedit', $data);
	}
	
	/**
	 * @修改提交
	 * */
	public function editPost()
	{
	    $this->_validate();
	    
	    $postData = $this->input->post();
	    $id_arr = array();
	    foreach (explode(',', $postData['des']) as $v) {
	        $v = (int)$v;
	        if ($v && is_int($v)) $id_arr[] = $v;
	    }
	    if (empty($id_arr)) {
	        alert_msg('请填写产品id');
	    }
	    $data['en_name'] = $postData['en_name'];
	    $data['zh_name'] = $postData['zh_name'];
	    $data['des'] = implode(',', array_flip(array_flip($id_arr)));
	     
	    $res = $this->Base_model->update($this->table, array('id'=>$postData['id']), $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Cgoods_recom/grid');
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
	        alert_msg('操作成功', 'Cgoods_recom/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	

	
}

/** End of file Cgoods_recom.php */
/** Location: ./application/controllers/Cgoods_recom.php */