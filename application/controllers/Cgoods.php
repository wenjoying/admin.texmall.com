<?php 
/**
 * Cgoods.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cgoods extends TM_Controller {
    
    private $table = 'goods';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Mgoods');
		$this->load->model('Mcorrect_img');
	}
	
	/**
	 * @产品列表
	 * */
	public function grid($pg = 1)
	{  
	    $this->checkAction(__METHOD__);
        
        $this->load->library('pagination');
        $config['per_page']   = 20;
        $config['uri_segment'] = 3;
        $config['suffix']     = $this->get_page_param($this->input->get());
        $config['total_rows'] = $this->Mgoods->total($this->input->get());
        $config['first_url']  = base_url('Cgoods/grid').$this->get_page_param($this->input->get());
        $config['base_url']   = base_url('Cgoods/grid');
        $this->pagination->initialize($config);
        $data['link']       = $this->pagination->create_links();
        $data['res']        = $this->Mgoods->grid($pg-1, $config['per_page'], $this->input->get())->result();
        $data['sum']        = $config['total_rows'];
        $data['per_page']   = $config['per_page'];
        $data['check_arr'] = array(
            '1'=>'<span class="label label-table label-info">审核中</span>',
            '2'=>'<span class="label label-table label-success">通过</span>',
            '3'=>'<span class="label label-table label-danger">不通过</span>'
        );
        $data['grade_arr'] = array('1'=>'正常', '2'=>'推荐', '3'=>'严选');
        $data['one_level'] = '产品中心';
        $data['two_level'] = '产品列表';
        $this->load->view('goods/vgrid', $data);
	}
	
	/**
	 * @新增产品
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	     
	    $data['attr'] = $this->_get_attr();
	    $data['one_level'] = '产品中心';
        $data['two_level'] = '产品列表';
	    $this->load->view('goods/vadd', $data);
	}
	
	/**
	 * @新增
	 * */
	public function addPost()
	{
	    $this->validate();
	    $postData = $this->input->post();
	    $img = $this->deal_img('goods', FALSE);
	    if (isset($img['upload']['original_img'])) {
	        $data['original_img'] = $img['upload']['original_img'];
	        $contrast = $this->_get_contrast($data['original_img']);
	        $data['cover_img']     = $contrast['cover_img'];
	        $data['platform_name'] = $contrast['platform_name'];
	        $data['lattice']       = $contrast['lattice'];
	        $data['color']         = $contrast['color'];
	        $data['tex_grid']      = $contrast['tex_grid'];
	        $data['yarn_density']  = $contrast['yarn_density'];
	        $data['back_size']     = $contrast['back_size'];
	    } else {
	        alert_msg('上传失败');
	    }
	    $data['platform_code'] = $this->Mgoods->create_platform_code($data['platform_name']);
	    $data['supplier_id']   = (int)$postData['supplier_id'];
	    $data['supplier_name'] = $postData['supplier_name'];
	    $data['supplier_code'] = $postData['supplier_code'];
	    $data['uid']           = $this->admin->id;
	    $data['price']         = $postData['price'];
	    $data['in_stock']      = $postData['in_stock'];
	    $data['width']         = $postData['width'];
	    $data['square_weight'] = $postData['square_weight'];
	    $data['shrinkage']     = $postData['shrinkage'];
	    $data['sanding']       = $postData['sanding'];
	    $data['thickness']     = $postData['thickness'];
	    $data['tech_composed'] = $postData['tech_composed'];
	    $data['component']     = $postData['component'];
	    $data['category']      = implode(',', $postData['category']);
	    $data['style']         = implode(',', $postData['style']);
	    $data['source']        = implode(',', $postData['source']);
	    $data['des']           = $postData['des'];
	    $data['is_sale']       = $postData['is_sale'];
	    $data['is_check']      = 1;
	    $data['platform_grade'] = 1;
	    $data['sum_sale']      = 0;
	    $data['sum_review']    = 0;
	    $data['pv']            = 0;
	    $data['time']          = time();
	    $data['update_time']   = '';
	    
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Cgoods/grid');
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
	    $data['attr'] = array_column($this->_get_attr(), null, 'attr_en_name');
	    $data['one_level'] = '产品中心';
        $data['two_level'] = '产品列表';
	    $this->load->view('goods/vedit', $data);
	}
	
	/**
	 * @提交修改
	 * */
	public function editPost()
	{
	    $this->validate('edit');
	    $postData = $this->input->post();
	    $data['supplier_code'] = $postData['supplier_code'];
	    $data['price']         = $postData['price'];
	    $data['in_stock']      = $postData['in_stock'];
	    $data['width']         = $postData['width'];
	    $data['square_weight'] = $postData['square_weight'];
	    $data['shrinkage']     = $postData['shrinkage'];
	    $data['sanding']       = $postData['sanding'];
	    $data['thickness']     = $postData['thickness'];
	    $data['tech_composed'] = $postData['tech_composed'];
	    $data['component']     = $postData['component'];
	    $data['category']      = implode(',', $postData['category']);
	    $data['style']         = implode(',', $postData['style']);
	    $data['source']        = implode(',', $postData['source']);
	    $data['des']           = $postData['des'];
	    $data['is_sale']       = $postData['is_sale'];
	    $data['is_check']      = 1;
	    $data['update_time']   = time();
	     
	    $res = $this->Base_model->update($this->table, array('id'=>$postData['id']), $data);
	    if ($res>0) {
	        alert_msg('操作成功', 'Cgoods/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @审核
	 * */
	public function check_out($id = 0)
	{
	    $this->checkAction(__METHOD__);
	     
	    $goods = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($goods->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    $is_check = $this->input->get('is_check')==2 ? 2 : 3;
	    $res = $this->Base_model->update($this->table, array('id'=>$id), array('is_check'=>$is_check));
	    if ($res>0) {
	        alert_msg('操作成功', 'Cgoods/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @修改等级
	 * */
	public function up_grade($id = 0)
	{
	    $this->checkAction(__METHOD__);
	    
	    $goods = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($goods->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    $grade = in_array($this->input->get('grade'), array(1, 2, 3)) ? $this->input->get('grade') : 1;
	    $res = $this->Base_model->update($this->table, array('id'=>$id), array('platform_grade'=>$grade));
	    if ($res>0) {
	        alert_msg('操作成功', 'Cgoods/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @获取属性信息
	 * */
	private function _get_attr()
	{
	    $attr = $this->Base_model->getWhere('goods_attr_set', array('is_show'=>1))->result();
	    return array_column($attr, null, 'attr_en_name');
	}
	
	/**
	 * @获取以图找图结果
	 * @$original:需要和标准图片对比的图
	 * */
	private function _get_contrast($original)
	{
	    $res = $this->Base_model->getWhere('correct_img', array('type'=>'tex'), 'img_name desc')->result();
	    $param = array('or'=>$original, 'img_arr'=>array_column($res, 'correct_img', 'img_name'));
// 	    $url = '';
// 	    $res = json_decode($this->fn_get_contents($url, $param, 'post'));

	    $d = json_encode(array(  //模拟
	        'status' => TRUE,
	        'data' => array(
	            'img_name' => '',
	            'lattice' => '0.5',
	            'color' => '黑,红,黄',
	            'tex_grid' => '1',
	            'yarn_density' => '234',
	            'back_size' => '2332',
	        )
	    ));
	    $res = json_decode($d); 
	    
	    if ($res->status == FALSE) {//执行对比提取失败
	        return FALSE;
	    }
	    if (empty($res->data->img_name)) {//标准库没有找到结果
	        $new = $this->file2dir($original, 'correct_img');
	        if (empty($new)) {//复制失败
	            return FALSE;
	        }
	        $img['correct_img'] = $new;
	        $img['type']      = 'tex';
	        $img['img_name']  = $this->Mcorrect_img->create_name();
	        $img['des']       = '布料';
	        $img['time']      = time();
	        if (!$this->Base_model->insert('correct_img', $img)) {//插入失败
	            return FALSE;
	        }
	        $ret['platform_name']  = $img['img_name'];
	        $ret['cover_img']      = $new;
	    } else{
	        $ret['platform_name'] = $res->data->img_name;
	        $ret['cover_img'] = $param['img_arr'][$ret['platform_name']];
	    }
	    $ret['lattice'] = $res->data->lattice;
	    $ret['color'] = $res->data->color;
	    $ret['tex_grid'] = $res->data->tex_grid;
	    $ret['yarn_density'] = $res->data->yarn_density;
	    $ret['back_size'] = $res->data->back_size;
	    return $ret;
	}
	
	/**
	 * @验证
	 * @param number $type:insert为新增
	 * */
	public function validate($type = 'insert')
	{
	    if ($type == 'insert') {
	        if (is_empty($_FILES)) {
	            alert_msg('请上传图片');
	        }
	         
	        if (is_empty($this->input->post('supplier_id')) || is_empty($this->input->post('supplier_name'))) {
	            alert_msg('请填写供应商');
	        }
	    }
	    
	    if (is_empty($this->input->post('supplier_code'))) {
	        alert_msg('请填写供应商型号');
	    }
	    
	    if (is_empty($this->input->post('price'))) {
	        alert_msg('请填写价格');
	    }
	    
	    if (is_empty($this->input->post('in_stock'))) {
	        alert_msg('请填写库存');
	    }
	    
	    if (is_empty($this->input->post('width'))) {
	        alert_msg('请填写门幅');
	    }
	    
	    if (is_empty($this->input->post('square_weight'))) {
	        alert_msg('请填写平方克重');
	    }
	    
	    if (is_empty($this->input->post('shrinkage'))) {
	        alert_msg('请填写缩水率');
	    }
	    
	    if (is_empty($this->input->post('component'))) {
	        alert_msg('请选择成分');
	    }
	    
	    if (is_empty($this->input->post('is_sale'))) {
	        alert_msg('请选择是否上架');
	    }
	    
	}
	
	public function page($id = 0)
	{
	    $this->checkAction(__METHOD__);
	    
	}
	
	
	/**
	 * @删除产品
	 * */
	public function delete($id = 0)
	{    
	    $this->checkAction(__METHOD__);
	    
	    if ($id == 1) {
	        alert_msg('禁止删除!');
	    }
	    $checkid = $this->input->post('checkid');
	    $ids = $checkid ? $checkid : array($id);
	    $goods = $this->Base_model->getWherein($this->table, 'id', $ids);
	    $res = $this->Base_model->deleteWherein($this->table, 'id', $ids);
	    
	    if ($res > 0) {
    	    foreach ($goods as $u) {
    	        $this->delete_img($u->original_img);
    	    }
	        alert_msg('操作成功', 'Cgoods/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	

	

}

/** End of file Cgoods.php */
/** Location: ./application/controllers/Cgoods.php */
