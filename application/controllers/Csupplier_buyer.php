<?php 
/**
 * Csupplier_buyer.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csupplier_buyer extends TM_Controller {

    private $table = 'supplier_buyer';
    
	function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Msupplier_buyer');
		$this->load->model('Mdistrict');
	}
	
	/**
	 * @企业列表
	 * */
	public function grid($pg = 1)  
	{  
	    $this->checkAction(__METHOD__);
	    
		$this->load->library('pagination');
		$config['per_page']   = 2;
		$config['uri_segment'] = 3;
		$config['suffix']     = $this->get_page_param($this->input->get());
		$config['total_rows'] = $this->Msupplier_buyer->total($this->input->get());
		$config['first_url']  = base_url('Csupplier_buyer/grid').$this->get_page_param($this->input->get());
		$config['base_url']   = base_url('Csupplier_buyer/grid');
		$this->pagination->initialize($config);
		$data['link']       = $this->pagination->create_links();
		$data['res']        = $this->Msupplier_buyer->grid($pg-1, $config['per_page'], $this->input->get())->result();
		$data['sum']        = $config['total_rows'];
		$data['per_page']   = $config['per_page'];
		$data['status_arr'] = get_status();
		$data['grade_arr'] = array('1'=>'一般', '2'=>'推荐', '3'=>'严选');
		$data['one_level'] = '企业管理';
		$data['two_level'] = '企业列表';
		$this->load->view('supplier_buyer/vgrid', $data);
	}
	
	/**
	 * @新增企业
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	    
	    $data['one_level'] = '企业管理';
		$data['two_level'] = '企业列表';
	    $this->load->view('supplier_buyer/vadd', $data);
	}
	
	/**
	 * @新增企业
	 * */
	public function addPost()
	{
	    $this->validata();
	 
	    $postData = $this->input->post();
	    $dis = $this->Mdistrict->get_address($postData['province_id'], $postData['city_id'], $postData['district_id']);
	    $data['uid']           = 0;
	    $data['username']      = '';
	    $data['type']          = $postData['type'];
	    $data['company_name']  = $postData['company_name'];
	    $data['province_id']   = $postData['province_id'];
	    $data['city_id']       = $postData['city_id'];
	    $data['district_id']   = $postData['district_id'];
	    $data['province_name'] = $dis[$postData['province_id']];
	    $data['city_name']     = $dis[$postData['city_id']];
	    $data['district_name'] = $dis[$postData['district_id']];
	    $data['ads_des']       = $postData['ads_des'];
	    $data['lnglat']        = get_lnglat_by_address($data['ads_des'], $data['city_name'].$data['district_name']);
	    $data['office_tel']    = $postData['office_tel'];
	    $data['main_business'] = $postData['main_business'];
	    $data['des']           = $postData['des'];
	    $data['status']        = $postData['status'];
	    $data['platform_grade'] = $data['type']==2 ? $postData['platform_grade'] : 0;  //供应商才有等级
	    $data['qr_img']    = '';
	    $data['time']  = time(); 
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res > 0) {
	        $this->_create_qr($res);
	        alert_msg('操作成功', 'Csupplier_buyer/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @修改企业
	 * */
	public function edit($id = 0)
	{
	    $this->checkAction(__METHOD__);
	    
	    $res = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($res->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    $data['res']  = $res->row();
	    $data['one_level'] = '企业管理';
		$data['two_level'] = '企业列表';
	    $this->load->view('supplier_buyer/vedit', $data);
	}
	
	/**
	 * @修改企业
	 * */
	public function editPost()
	{
	    $this->validata('edit');
	    
	    $postData = $this->input->post();
	    $dis = $this->Mdistrict->get_address($postData['province_id'], $postData['city_id'], $postData['district_id']);
	    $data['uid']           = 0;
	    $data['username']      = '';
	    $data['company_name']  = $postData['company_name'];
	    $data['province_id']   = $postData['province_id'];
	    $data['city_id']       = $postData['city_id'];
	    $data['district_id']   = $postData['district_id'];
	    $data['province_name'] = $dis[$postData['province_id']];
	    $data['city_name']     = $dis[$postData['city_id']];
	    $data['district_name'] = $dis[$postData['district_id']];
	    $data['ads_des']       = $postData['ads_des'];
	    $data['lnglat']        = get_lnglat_by_address($data['ads_des'], $data['city_name'].$data['district_name']);
	    $data['office_tel']    = $postData['office_tel'];
	    $data['main_business'] = $postData['main_business'];
	    $data['des']           = $postData['des'];
	    $data['status']        = $postData['status'];
	    if ($postData['type']==2) $data['platform_grade'] = $postData['platform_grade'];
	    $res = $this->Base_model->update($this->table, array('id'=>$postData['id']), $data);
	    if ($res > 0) {
	        if ($postData['type']==2) {//如果时供应商
	            if ($postData['status']==3) {//审核不通过，下架其所有产品
	                $this->_up_goods_status($postData['id']);
	            }
	            $this->_up_goods_grade($postData['id']);
	        }
	        alert_msg('操作成功', 'Csupplier_buyer/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @验证
	 * */
	public function validata($type = 'insert')
	{
	    if (is_empty($this->input->post('type'))) {
	        alert_msg('请选择企业类型');
	    }
	     
	    $ex = $this->check_exists(FALSE);
	    if ($type == 'insert') {
	        if ($ex['status']) {
	            alert_msg('企业名称已存在');
	        }
	    } else {
	        if ($ex['status'] && $ex['companyid'] != $this->input->post('id')) {
	            alert_msg('企业名称已存在');
	        }
	    }
	     
	    if (is_empty($this->input->post('province_id')) || is_empty($this->input->post('city_id')) || is_empty($this->input->post('district_id'))) {
	        alert_msg('请选择地址');
	    }
	     
	    if (is_empty($this->input->post('ads_des'))) {
	        alert_msg('请填写详细地址');
	    }
	     
	    if (is_empty($this->input->post('office_tel'))) {
	        alert_msg('请填写企业电话');
	    }
	     
	    if (is_empty($this->input->post('main_business'))) {
	        alert_msg('请填写主营业务');
	    }
	     
	    if (is_empty($this->input->post('status'))) {
	        alert_msg('请选择审核状态');
	    }
	     
	    if ($this->input->post('type') == 2) {
	        if (is_empty($this->input->post('platform_grade'))) {
	            alert_msg('请选择平台等级');
	        }
	    }
	}
	
	/**
	 * @查看详情
	 * */
	public function page($id = 0)
	{
	    $this->checkAction(__METHOD__);
	     
	    $res = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($res->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    $data['res']  = $res->row();
	    $data['status_arr'] = get_status();
	    $data['grade_arr'] = array('1'=>'一般', '2'=>'推荐', '3'=> '严选');
	    $data['workers'] = $this->_get_workers($id);
	    $data['one_level'] = '企业管理';
	    $data['two_level'] = '企业列表';
	    $this->load->view('supplier_buyer/vpage', $data);
	}
	
	/**
	 * @提交审核
	 * */
	public function up_status()
	{
	    $this->checkAction(__METHOD__);
	
	    $postData = $this->input->post(); 
	    $res = $this->Base_model->update($this->table, array('id'=>$postData['id'], 'status'=>1), array('status'=>$postData['status']));
	    if ($res>0) {
	        if ($postData['status']==3) {
	            $this->_up_goods_status($postData['id']);
	        }
	        alert_msg('操作成功', 'Csupplier_buyer/grid');
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
	    
	    $supplier_buyer = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    $res = $this->Base_model->delete($this->table, array('id'=>$id));
	    if ($res>0) {
	        $this->delete_img($supplier_buyer->row()->qr_img);
	        $this->_cancel_user($id);
	        alert_msg('操作成功', 'Csupplier_buyer/grid');
	    }else{
	        alert_msg('操作失败');
	    }  
	}
	
	/**
	 * 解除企业与员工关系
	 * */
	private function _cancel_user($companyid)
	{
	    $this->Base_model->update('user', array('companyid'=>$companyid), array('companyid'=>'', 'company'=>''));
	}
	
	/**
	 * @生成企业二维码
	 * */
	private function _create_qr($id = 0)
	{
	    $this->checkAction(__METHOD__);
	    
	    $supplier_buyer = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($supplier_buyer->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    
	    $this->load->library('Qrcode');
	    $path = 'qr_code';
	    $day  = date('Ymd');
	    $png  = daymicro().'.png';
	    $upload_path = $this->config->upload_image_path($path.'/'.$day, TRUE);
	    if (!is_dir($upload_path)) {
	        mkdir($upload_path, DIR_WRITE_MODE, TRUE);
	    }
	    $url = $this->config->html5_url.'Cqr_scan/scan?time='.ZD_md5($supplier_buyer->row()->time).'&companyid='.$id;
	    $this->qrcode->png($url, $upload_path.$png, 4, 10);
	    $png = './'.$path.'/'.$day.'/'.$png;
	    if (file_exists($this->config->upload_image_path($png))) {
	        $res = $this->Base_model->update($this->table, array('id'=>$id), array('qr_img'=>$png));
	        if ($res > 0) {
	            return TRUE;
	        }else{
	            return FALSE;
	        }
	    }
	}
	
	/**
	 * @获取地址
	 * */
	public function get_dis()
	{
	    echo json_encode($this->Mdistrict->grid($this->input->post('pid')));
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
	        $this->_up_goods_grade($id);
	        alert_msg('操作成功', 'Csupplier_buyer/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @验证企业名称
	 * @param boolean $json:是否返回接送数据
	 * */
	public function check_exists($json = TRUE)
	{
	    $postData = $this->input->post();
	    $data['company_name'] = $postData['company_name'];
	    if(isset($postData['type'])) $data['type'] = $postData['type'];
	    if(isset($postData['status'])) $data['status'] = $postData['status'];
	    $res = $this->Base_model->getWhere($this->table, $data);
	    if($res->num_rows() > 0) {
	        $ret['status'] = TRUE;
	        $ret['companyid'] = $res->row()->id;
	        $ret['company_name'] = $res->row()->company_name;
	        $ret['platform_grade'] = $res->row()->platform_grade;
	    } else {
	        $ret['status'] = FALSE;
	    }
	    if ($json == TRUE) {
	        echo json_encode($ret);
	    } else {
	        return $ret;
	    }
	    
	}
	
	/**
	 * @获取用企业员工
	 * */
	private function _get_workers($companyid)
	{
	    if (empty($companyid)) return array();
	    return $this->Base_model->getWhere('user', array('companyid'=>$companyid))->result();
	}
	
	/**
	 * @审核不通过时更改供应商产品审核不通过，并下架产品
	 * */
	private function _up_goods_status($companyid)
	{
	    $type = $this->Base_model->getFieldRes($this->table, 'type', array('id'=>$companyid));
	    if ($type->num_rows() > 0) {
	        if ($type->row()->type == 2) {
	            $this->Base_model->update('goods', array('supplier_id'=>$companyid), array('is_sale'=>3, 'is_check'=>3));
	        }
	    }
	}
	
	/**
	 * @更改供应商产品平台等级
	 * */
	private function _up_goods_grade($companyid)
	{
	    $type = $this->Base_model->getFieldRes($this->table, 'type, platform_grade', array('id'=>$companyid));
	    if ($type->num_rows() > 0) {
	        if ($type->row()->type == 2) {
	            $this->Base_model->update('goods', array('supplier_id'=>$companyid), array('platform_grade'=>$type->row()->platform_grade));
	        }
	    }
	}
	
}
/** End of file Csupplier_buyer.php */
/** Location: ./application/controllers/Csupplier_buyer.php */
