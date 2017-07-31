<?php 
/**
 * Ccorrect_img.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccorrect_img extends TM_Controller {
    
    private $table = 'correct_img';
    
    function _init()
	{   
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Mcorrect_img');
	}
	
	/**
	 * @标准图片列表
	 * */
	public function grid($pg = 1)
	{   
	    $this->checkAction(__METHOD__);
	     
	    $this->load->library('pagination');
		$config['per_page']   = 2;
		$config['uri_segment'] = 3;
		$config['suffix']     = $this->get_page_param($this->input->get());
		$config['total_rows'] = $this->Mcorrect_img->total($this->input->get());
		$config['first_url']  = base_url('Ccorrect_img/grid').$this->get_page_param($this->input->get());
		$config['base_url']   = base_url('Ccorrect_img/grid');
		$this->pagination->initialize($config);
		$data['link']       = $this->pagination->create_links();
		$data['res']        = $this->Mcorrect_img->grid($pg-1, $config['per_page'], $this->input->get())->result();
		$data['sum']        = $config['total_rows'];
		$data['per_page']   = $config['per_page'];
		$data['one_level'] = '产品中心';
		$data['two_level'] = '标准图片';
	    $this->load->view('correct_img/vgrid', $data);
	}
	
	/**
	 * @新增标准图片
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	     
	    $data['one_level'] = '产品中心';
		$data['two_level'] = '标准图片';
	    $this->load->view('correct_img/vadd', $data);
	}
	
	/**
	 * @新增
	 * */
	public function addPost()
	{
	    $this->validate();
	    $postData = $this->input->post();
	    $img = $this->deal_img('correct_img', FALSE);
	    if (isset($img['upload']['correct_img'])) {
	        $data['correct_img'] = $img['upload']['correct_img'];
	    } else {
	        alert_msg('上传失败');
	    }
	    $data['type']      = $postData['type'];
	    $data['img_name']  = $this->Mcorrect_img->create_name($data['type']);
	    $data['des']       = $postData['des'];
	    $data['time']      = time();
	    
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Ccorrect_img/grid');
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
	}
	
	/**
	 * @删除标准图
	 * */
	public function delete($id = 0)
	{    
	    $this->checkAction(__METHOD__);
	    
	    $correct = $this->Base_model->getWherein($this->table, array('id'=>$id));
	    $res = $this->Base_model->delete($this->table, array('id'=>$id));
	    if ($res > 0) {
	        $this->delete_img($correct->row()->correct_img);
	        alert_msg('操作成功', 'Ccorrect_img/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @采集瓦栏模特
	 * */
	public function collection() 
	{
// 	    require_once APPPATH.'libraries/phpQuery.php';
// 	    phpQuery::newDocumentFile('http://www.walanwalan.com/console/mymodels/');
// 	    $items = pq('.row .col-xs-2 img');
// 	    var_dump($items);
	    
	}
	
}

/** End of file Ccorrect_img.php */
/** Location: ./application/controllers/Ccorrect_img.php */
