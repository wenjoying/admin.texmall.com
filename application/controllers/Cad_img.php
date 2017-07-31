<?php 
/**
 * Cad_img.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cad_img extends TM_Controller {

    private $table = 'ad_img';
    
    public function _init()
    {
        header("Content-type: text/html; Charset=utf-8");
        $this->load->model('Mad_img');
    }
	
	/**
	 * @des:轮播图&广告图
	 * */
	public function grid()
	{
	    $this->checkAction(__METHOD__);
	    
	    $data['res'] = $this->Mad_img->grid($this->input->get())->result();
	    $data['one_level'] = '网站设置';
	    $data['two_level'] = '轮播图&广告图';
	    $this->load->view('ad_img/vgrid', $data);
	}
	
	/**
	 * @新增
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	    
	    $data['one_level'] = '网站设置';
	    $data['two_level'] = '轮播图&广告图';
	    $this->load->view('ad_img/vadd', $data);
	}
	
	/**
	 * @插入
	 * */
	public function addPost()
	{
	    $this->validata();
	    
	    $postData = $this->input->post(); 
	    $img = $this->deal_img('ad_img', FALSE);
	    if (isset($img['upload']['ad_img'])) {
	        $data['ad_img'] = $img['upload']['ad_img'];
	    }else{
	        alert_msg('上传失败');
	    }
	    $data['ad_name']   = $postData['ad_name'];
	    $data['ad_info']   = $postData['ad_info'];
	    $data['ad_url']    = $postData['ad_url'] ? $postData['ad_url'] : 'javascript:;';
	    $data['reorder']   = $postData['reorder'];
	    $data['status']    = $postData['status'];
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res > 0) {
	        alert_msg('操作成功', 'Cad_img/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @验证
	 * */
	public function validata()
	{
	    if (is_empty($this->input->post('ad_name'))) {
	        alert_msg('请填写名称');
	    }
	    
	    if (is_empty($this->input->post('reorder'))) {
	        alert_msg('请填写排序');
	    }
	    
	    if (is_empty($this->input->post('status'))) {
	        alert_msg('请选择状态');
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
	    $data['res'] = $res->row();
	    $data['one_level'] = '网站设置';
	    $data['two_level'] = '轮播图&广告图';
	    $this->load->view('ad_img/vedit', $data);
	}
	
	/**
	 * @编辑上线
	 * */
	public function editPost($id = 0)
	{ 
	    $this->validata();
	    
	    $postData = $this->input->post();
	    $img = $this->deal_img('ad_img', FALSE);
	    if (isset($img['upload']['ad_img'])) {
	        $data['ad_img'] = $img['upload']['ad_img'];
	    }
	    $data['ad_name']   = $postData['ad_name'];
	    $data['ad_info']   = $postData['ad_info'];
	    $data['ad_url']    = $postData['ad_url'] ? $postData['ad_url'] : 'javascript:;';
	    $data['reorder']   = $postData['reorder'];
	    $data['status']    = $postData['status'];
	    $res = $this->Base_model->update($this->table, array('id'=>$postData['id']), $data);
	    if ($res > 0) {
	        alert_msg('操作成功', 'Cad_img/grid');
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
	    
	    $ad_img = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    $res = $this->Base_model->delete($this->table, array('id'=>$id));
	    if ($res>0) {
            $this->delete_img($ad_img->row()->ad_img);
	        alert_msg('操作成功', 'Cad_img/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	
}
/** End of file Cad_img.php */
/** Location: ./application/controllers/Cad_img.php */