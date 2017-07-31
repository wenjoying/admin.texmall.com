<?php 
/**
 * Cfonts.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cfonts extends TM_Controller {
    private $table = 'fonts';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
	}
	
	/**
	 * @字体列表
	 * */
	public function grid($pg = 1)
	{ 
	    $this->checkAction(__METHOD__);
	
	    $data['res'] = $this->Base_model->getTable($this->table)->result();
	    $data['one_level'] = '网站设置';
	    $data['two_level'] = '字体';
	    $this->load->view('fonts/vgrid', $data);
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
	        alert_msg('操作成功', 'Cfonts/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @新增
	 * */
	public function add($id = 0)
	{
	    $this->checkAction(__METHOD__);
	
	    $data['one_level'] = '网站设置';
	    $data['two_level'] = '字体';
	    $this->load->view('fonts/vadd', $data);
	}
	
	/**
	 * @回复
	 * */
	public function addPost()
	{
	    $postData = $this->input->post(); 
	    $data['fonts_name'] = $postData['fonts_name'];
	    $data['fonts_img']  = './fonts/'.$postData['fonts_name'].'.PNG';
	    $data['fonts_path'] = './fonts/'.$postData['fonts_name'].'.ttf';
	    $data['status']     = $postData['status'];
	    
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Cfonts/grid');
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
	        alert_msg('操作成功', 'Cfonts/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	
	
}

/** End of file Cfonts.php */
/** Location: ./application/controllers/Cfonts.php */
