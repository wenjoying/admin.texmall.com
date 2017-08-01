<?php 
/**
 * Ccorrect_model.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccorrect_model extends TM_Controller {
    
    private $table = 'correct_model';
    
    function _init()
	{   
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Mcorrect_model');
	}
	
	/**
	 * @模特图片列表
	 * */
	public function grid($pg = 1)
	{   
	    $this->checkAction(__METHOD__);
	    $category = $this->_get_category();
	    if ($category === FALSE) {
	        alert_msg('请先添加产品类目category', 'Cgoods_attr_set/grid');
	    }
	    $this->load->library('pagination');
		$config['per_page']   = 2;
		$config['uri_segment'] = 3;
		$config['suffix']     = $this->get_page_param($this->input->get());
		$config['total_rows'] = $this->Mcorrect_model->total($this->input->get());
		$config['first_url']  = base_url('Ccorrect_model/grid').$this->get_page_param($this->input->get());
		$config['base_url']   = base_url('Ccorrect_model/grid');
		$this->pagination->initialize($config);
		$data['link']       = $this->pagination->create_links();
		$data['res']        = $this->Mcorrect_model->grid($pg-1, $config['per_page'], $this->input->get())->result();
		$data['sum']        = $config['total_rows'];
		$data['per_page']   = $config['per_page'];
		$data['category']  = $category;  
		$data['one_level'] = '产品中心';
		$data['two_level'] = '模特图片';
	    $this->load->view('correct_model/vgrid', $data);
	}
	
	/**
	 * @新增模特图片
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	     
	    $category = $this->_get_category();
	    if ($category === FALSE) {
	        alert_msg('请先添加产品类目category', 'Cgoods_attr_set/grid');
	    }
	    $data['category']  = $category;
	    $data['one_level'] = '产品中心';
		$data['two_level'] = '模特图片';
	    $this->load->view('correct_model/vadd', $data);
	}
	
	/**
	 * @新增
	 * */
	public function addPost()
	{
	    $this->_validate();
	    $postData = $this->input->post();
	    $img = $this->deal_img('correct_img', FALSE);
	    if (isset($img['upload']['correct_img'])) {
	        $data['correct_img'] = $img['upload']['correct_img'];
	    } else {
	        alert_msg('上传失败');
	    }
	    $data['type']      = $postData['type'];
	    $data['img_name']  = $this->_create_name();
	    $data['des']       = $postData['des'];
	    $data['time']      = time();
	    
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Ccorrect_model/grid');
	    }else{
	        alert_msg('操作失败');
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
	        alert_msg('操作成功', 'Ccorrect_model/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @验证
	 * */
	private function _validate()
	{
	    if (is_empty($this->input->post('type'))) {
	        alert_msg('请选择类型');
	    }
	}
	
	/**
	 * @获取类目
	 * */
	private function _get_category()
	{
	    $category = $this->Base_model->getWhere('goods_attr_set', array('attr_en_name'=>'category', 'is_show'=>1));
	    if ($category->num_rows() > 0) {
	        return explode(',', $category->row()->attr_val);
	    }
	    return FALSE;
	}
	
	/**
	 * @生成模特名字
	 * */
	private function _create_name()
	{
	    $name = $this->Base_model->getMax($this->table, 'img_name');
	    if ($name == NULL) {
	        return 'M0001';
	    } else {
	        $k = $name{0};
	        $n = (int)mb_substr($name, 1, 4) +1;
	        return $k.(string)sprintf('%04d', $n); //return chr(ord($k)+1).'0001';
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

/** End of file Ccorrect_model.php */
/** Location: ./application/controllers/Ccorrect_model.php */
