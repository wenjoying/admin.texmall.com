<?php 
/**
 * Ccorrect_tex.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccorrect_tex extends TM_Controller {
    
    private $table = 'correct_tex';
    
    function _init()
	{   
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Mcorrect_tex');
	}
	
	/**
	 * @标准布料列表
	 * */
	public function grid($pg = 1)
	{   
	    $this->checkAction(__METHOD__);
	    
	    $this->load->library('pagination');
		$config['per_page']   = 2;
		$config['uri_segment'] = 3;
		$config['suffix']     = $this->get_page_param($this->input->get());
		$config['total_rows'] = $this->Mcorrect_tex->total($this->input->get());
		$config['first_url']  = base_url('Ccorrect_tex/grid').$this->get_page_param($this->input->get());
		$config['base_url']   = base_url('Ccorrect_tex/grid');
		$this->pagination->initialize($config);
		$data['link']       = $this->pagination->create_links();
		$data['res']        = $this->Mcorrect_tex->grid($pg-1, $config['per_page'], $this->input->get())->result();
		$data['sum']        = $config['total_rows'];
		$data['per_page']   = $config['per_page'];
		$data['one_level'] = '产品中心';
		$data['two_level'] = '标准布料';
	    $this->load->view('correct_tex/vgrid', $data);
	}
	
	/**
	 * @新增标准布料
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	    
	    $data['one_level'] = '产品中心';
		$data['two_level'] = '标准布料';
	    $this->load->view('correct_tex/vadd', $data);
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
	    $tex_colors = $this->_tex_colors($data['correct_tex']);    //一花多色
	    $data['tex_colors']  = empty($tex_colors) ? '' : $tex_colors;
	    $data['img_name']  = $this->_create_name();
	    $data['des']       = $postData['des'];
	    $data['time']      = time();
	    
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res>0) {
	        if (empty($tex_colors)) {  //如果不是一花多色，则是新花
	            $this->Base_model->update($this->table, array('id'=>$res), array('tex_colors'=>$res));
	        }
	        alert_msg('操作成功', 'Ccorrect_tex/grid');
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
	        alert_msg('操作成功', 'Ccorrect_tex/grid');
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
	 * @生成标准图名字
	 * */
	private function _create_name()
	{
	    $name = $this->Base_model->getMax($this->table, 'img_name');
	    if ($name == NULL) {
	        return 'A0001';
	    } else {
	        $k = $name{0};
	        $n = (int)mb_substr($name, 1, 4) +1;
	        return $k.(string)sprintf('%04d', $n); //return chr(ord($k)+1).'0001';
	    }
	}
	
	/**
	 * @获取一花多色
	 * */
	private function _tex_colors($tex)
	{
	    $res = $this->Base_model->groupBy($this->table, 'tex_colors')->result();
// 	    $param = array('tex'=>$tex, 'img_arr'=>array_column($res, 'correct_img', 'tex_colors')); 
	    //tex要与img_arr做对比，如果有相同的花不同的颜色即为一花多色，返回的是img_arr的键
	    $param = array(//模拟提交数据
	        'token'    => 'texmall2017-token', //请求令牌，令牌一致则可以请求接口
	        'tex'      => './goods/20170721/110218_4001.jpg',  //上传的标准布料图
	        'img_arr'  => array(//标准图库的路径
	            1 => './correct_img/20170721/092208_6075.jpg',   //键表示一花多色的id，即所有同一花的布料为相同的花id；值表示布料图
	            3 => './correct_img/20170721/092424_8172.jpg',
	        )
	    );
	    $url = 'http://zhanggong.com/yihuaduose';  //张工一花多色(图片修正，图片提取)url，返回json数据
// 	    $res = json_decode(fn_get_contents($url, $param, 'post'));  //数据post提交
        $d = json_encode(array(//模拟返回数据
            'status' => TRUE,
            'data' => 1,    //花id；值表示布料图，如果为''，则不是一花多色了
        ));
	    $res = json_decode($d);
	     
	    if ($res->status == FALSE) {//执行对比提取失败
	        return FALSE;
	    } else {
	        return $res->data;
	    }
	}
	
	
}

/** End of file Ccorrect_tex.php */
/** Location: ./application/controllers/Ccorrect_tex.php */
