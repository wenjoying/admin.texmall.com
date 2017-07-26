<?php 
/**
 * Cgoods_cart.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cgoods_cart extends TM_Controller {
    private $table = 'goods_cart';
    private $table1 = 'user';
    
    function _init()
	{ 
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Mgoods_cart');
	}
	
    /**
	 * @购物车
	 * */
	public function grid($pg = 1)
	{
	    $this->checkAction(__METHOD__);
	
	    $this->load->library('pagination');
	    $config['per_page']   = 20;
	    $config['uri_segment'] = 3;
	    $config['suffix']     = $this->get_page_param($this->input->get());
	    $config['total_rows'] = $this->Mgoods_cart->total($this->input->get());
	    $config['first_url']  = base_url('Cgoods_cart/grid').$this->get_page_param($this->input->get());
	    $config['base_url']   = base_url('Cgoods_cart/grid');
	    $this->pagination->initialize($config);
	    $data['link']       = $this->pagination->create_links();
	    $data['res']        = $this->Mgoods_cart->grid($pg-1, $config['per_page'], $this->input->get())->result();
	    $data['sum']        = $config['total_rows'];
	    $data['per_page']   = $config['per_page'];
	    $data['one_level'] = '订单管理';
	    $data['two_level'] = '购物车';
	    $this->load->view('goods_cart/vgrid', $data);
	}
	
	/**
	 * @删除购物车
	 * */
	public function delete($id = 0)
	{
	    $this->checkAction(__METHOD__);
	
	    $res = $this->Base_model->delete($this->table, array('id'=>$id));
	
	    if ($res > 0) {
	        alert_msg('操作成功', 'Cgoods_cart/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	
	
	
	/************************************************
	 * @以下为后台admin模拟
	 * **********************************************/
	
	/**
	 * @新增购物车
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	     
	    $goods = $this->_get_goods();
	    if ($goods == FALSE) {
	        alert_msg('产品不存在');
	    }
	    $data['res'] = $goods;
	    $data['one_level'] = '订单管理';
	    $data['two_level'] = '购物车';
	    $this->load->view('goods_cart/vadd', $data);
	}
	
	/**
	 * @添加购物车
	 * */
	public function addPost()
	{
	    $postData = $this->input->post();
	    $user = $this->_get_user();
	    if ($user->num_rows() == 0) {
	        alert_msg('采购商不存在');
	    }
        if ($this->Base_model->getTableNum($this->table, array('uid'=>$user->row()->id, 'goods_id'=>$this->input->get('goods_id')))) {
            alert_msg('产品已经加入购物车了。。。');
        }
        $goods = $this->_get_goods();
        if ($goods == FALSE) {
            alert_msg('产品不存在');
        }
        $goods_attr = array(
            'component'     => $goods->component,
            'width'         => $goods->width,
            'square_weight' => $goods->square_weight,
            'shrinkage'     => $goods->shrinkage,
            'sanding'       => $goods->sanding,
            'lattice'       => $goods->lattice,
            'color'         => $goods->color,
            'pantone_color' => $goods->pantone_color,
            'tex_grid'      => $goods->tex_grid,
            'yarn_density'  => $goods->yarn_density,
            'back_size'     => $goods->back_size,
            'thickness'     => $goods->thickness,
            'tech_composed' => $goods->tech_composed
        );
	    $data['goods_id']      = $goods->id;
	    $data['cover_img']     = $goods->cover_img;
	    $data['supplier_id']   = $goods->supplier_id;
	    $data['supplier_name'] = $goods->supplier_name;
	    $data['supplier_code'] = $goods->supplier_code;
	    $data['price']         = $goods->price;
	    $data['goods_attr']    = json_encode($goods_attr);
	    $data['number']        = $postData['number'];
	    $data['uid'] = $user->row()->id;
	    $data['username'] = $user->row()->username;
	    $data['time'] = time();
	    
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Cgoods_cart/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @获取产品
	 * */
	private function _get_goods()
	{
	    $where['id'] = $this->input->get('goods_id');
	    $where['is_sale'] = 1;
	    $where['is_check'] = 2;
	    $goods = $this->Base_model->getWhere('goods', $where);
	    if ($goods->num_rows() > 0) {
	        return $goods->row();
	    }
	    return FALSE;
	}
	
	/**
	 * @获取用户
	 * */
	private function _get_user()
	{
	    return $this->Base_model->getWhere('user', array('id'=>$this->input->post('uid'), 'role_id'=>1));
	}
	
	
	
}

/** End of file Cgoods_cart.php */
/** Location: ./application/controllers/Cgoods_cart.php */
