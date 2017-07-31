<?php 
/**
 * C3d_fitting.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C3d_fitting extends TM_Controller {
    private $table = '3d_fitting';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('M3d_fitting');
	}
	
	/**
	 * @搜索列表
	 * */
	public function grid($pg = 1)
	{
	    $this->checkAction(__METHOD__);
	
	    $this->load->library('pagination');
	    $config['per_page']   = 2;
	    $config['uri_segment'] = 3;
	    $config['suffix']     = $this->get_page_param($this->input->get());
	    $config['total_rows'] = $this->M3d_fitting->total($this->input->get());
	    $config['first_url']  = base_url('C3d_fitting/grid').$this->get_page_param($this->input->get());
	    $config['base_url']   = base_url('C3d_fitting/grid');
	    $this->pagination->initialize($config);
	    $data['link']       = $this->pagination->create_links();
	    $data['res']        = $this->M3d_fitting->grid($pg-1, $config['per_page'], $this->input->get())->result();
	    $data['sum']        = $config['total_rows'];
	    $data['per_page']   = $config['per_page'];
	    $data['one_level'] = '用户管理';
	    $data['two_level'] = '搜索记录';
	    $this->load->view('3d_fitting/vgrid', $data);
	}
	
    /**
	 * @3d试衣
	 * */
	public function addPost()
	{
	    $param = array(
	        'token'     => 'texmall2017-token', //请求令牌，令牌一致则可以请求接口
	        'tex_img'   => './images/20170721/110218_4001.jpg', //布料图
	        'model_img' => './correct_img/20170721/110218_4001.jpg',    //模特图
	        'dx'        => 0,  //右正左负
	        'dy'        => 0,  //上正下负
	        'zoom'      => '100'   //布料缩放25%-250%
	    );
	    $url = 'http://zhanggong.com/3dshiyi';  //张工3d试衣url，返回json数据
	    $res = json_decode(fn_get_contents($url, $param, 'post'));  //数据post提交
	    $d = json_encode(array(  //模拟返回数据
	        'status' => TRUE,
	        'data' => array(
	            '3d_img' => 'http://zhanggong.com/images/1243423534.jpg'   //3d试衣结果图
	        )
	    ));
	}
	
	/**
	 * @删除
	 * */
	public function delete($id = 0)
	{
	    $this->checkAction(__METHOD__);
	
	    $res = $this->Base_model->delete($this->table, array('id'=>$id));
	    if ($res>0) {
	        alert_msg('操作成功', 'C3d_fitting/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
}

/** End of file C3d_fitting.php */
/** Location: ./application/controllers/C3d_fitting.php */
