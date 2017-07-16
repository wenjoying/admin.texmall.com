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
	}
	
	/**
	 * @用户列表
	 * */
	public function grid($pg = 1)  
	{  
	    $this->checkAction(__METHOD__);
	    
		$this->load->library('pagination');
		$config['per_page']   = 20;
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
		$data['one_level'] = '用户管理';
		$data['two_level'] = '用户列表';
		$this->load->view('Csupplier_buyer/vgrid', $data);
	}
	
	/**
	 * @新增用户
	 * */
	public function add()
	{
	    $this->checkAction(__METHOD__);
	    
	    $data['role'] = $this->_get_role();
	    $data['one_level'] = '用户管理';
	    $data['two_level'] = '用户列表';
	    $this->load->view('Csupplier_buyer/vadd', $data);
	}
	
	/**
	 * @新增用户
	 * */
	public function addPost()
	{
	    $this->validata();
	    
	    $postData = $this->input->post();
	    $data['Csupplier_buyerimg'] = $this->config->default_img['Csupplier_buyerimg'];
	    $img = $this->deal_img('Csupplier_buyerimg', FALSE);
	    if (isset($img['upload']['Csupplier_buyerimg'])) {
	        $data['Csupplier_buyerimg'] = $img['upload']['Csupplier_buyerimg'];
	    }
	    $data['Csupplier_buyername']  = $postData['Csupplier_buyername'];
	    $data['mobile']    = $postData['mobile'];
	    $data['password']  = ZD_md5($postData['password']);
	    $data['id_card']   = $postData['id_card'];
	    $data['companyid'] = $postData['companyid'];
	    $data['company']   = $postData['company'];
	    $data['positions'] = $postData['positions'];
	    $data['sex']       = $postData['sex'];
	    $data['role_id']   = $postData['role_id'];
	    $data['pid']       = 0;
	    $data['qr_img']    = '';
	    $data['reg_come']  = 5;
	    $data['reg_ip']    = getIp();
	    $data['reg_time']  = time(); 
	    $res = $this->Base_model->insert($this->table, $data);
	    if ($res > 0) {
	        alert_msg('操作成功', 'Csupplier_buyer/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @修改用户
	 * */
	public function edit($id = 0)
	{
	    $this->checkAction(__METHOD__);
	    
	    $res = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($res->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    $data['res']  = $res->row();
	    $data['role'] = $this->_get_role();
	    $data['one_level'] = '用户管理';
	    $data['two_level'] = '用户列表';
	    $this->load->view('Csupplier_buyer/vedit', $data);
	}
	
	/**
	 * @修改用户
	 * */
	public function editPost()
	{
	    $this->validata();
	    
	    $postData = $this->input->post();
	    $img = $this->deal_img('Csupplier_buyerimg', FALSE);
	    if (isset($img['upload']['Csupplier_buyerimg'])) {
	        $data['Csupplier_buyerimg'] = $img['upload']['Csupplier_buyerimg'];
	    }
	    $data['Csupplier_buyername']  = $postData['Csupplier_buyername'];
	    $data['password']  = ZD_md5($postData['password']);
	    $data['id_card']   = $postData['id_card'];
	    $data['companyid'] = $postData['companyid'];
	    $data['company']   = $postData['company'];
	    $data['positions'] = $postData['positions'];
	    $data['sex']       = $postData['sex'];
	    $res = $this->Base_model->update($this->table, array('id'=>$postData['id']), $data);
	    if ($res > 0) {
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
	    
	    $checkid = $this->input->post('checkid');
	    $ids = $checkid ? $checkid : array($id);
	    $Csupplier_buyer = $this->Base_model->getWherein($this->table, 'id', $ids);
	    $res = $this->Base_model->deleteWherein($this->table, 'id', $ids);
	    if ($res>0) {
	        foreach ($Csupplier_buyer as $u) {
	            $this->delete_img($u->Csupplier_buyerimg);
	            $this->delete_img($u->qr_img);
	        }
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
	    if (is_empty($this->input->post('Csupplier_buyername'))) {
	        alert_msg('请填写名称');
	    }
	    
	    if (!is_mobile($this->input->post('mobile'))) {
	        alert_msg('手机号码错误');
	    }
	    
	    if (@file_get_contents($this->check_exists($this->input->post('mobile'))) == 1) {
	        alert_msg('手机号码已存在');
	    }
	    
	    if (strlen($this->input->post('password'))<6 || strlen($this->input->post('password'))>15) {
	        alert_msg('密码为6-15位');
	    }
	    
	    if (is_empty($this->input->post('role_id'))) {
	        alert_msg('请选择角色');
	    }
	}
	
	/**
	 * @生成用户二维码
	 * */
	public function create_qr($id = 0)
	{
	    $this->checkAction(__METHOD__);
	    
	    $Csupplier_buyer = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($Csupplier_buyer->num_rows() == 0) {
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
	    $url = $this->config->html5_url.'Cqr_scan/scan?mobile='.ZD_md5($Csupplier_buyer->row()->mobile).'&uid='.$id;
	    $this->qrcode->png($url, $upload_path.$png, 4, 10);
	    $png = './'.$path.'/'.$day.'/'.$png;
	    if (file_exists($this->config->upload_image_path($png))) {
	        $res = $this->Base_model->update($this->table, array('id'=>$id), array('qr_img'=>$png));
	        if ($res > 0) {
	            alert_msg('操作成功', 'Csupplier_buyer/grid');
	        }else{
	            alert_msg('操作失败');
	        }
	    }
	}
	
	/**
	 * @验证公司名称
	 * */
	public function check_exists($company_name = '')
	{
	    $company_name = empty($company_name) ? $this->input->post_get('company_name') : $company_name;
	    $res = $this->Base_model->getWhere($this->table, array('company_name'=>$company_name));
	    if($res->num_rows() > 0) {
	        $ret['status'] = TRUE;
	        $ret['companyid'] = $res->row()->id;
	        $ret['company_name'] = $res->row()->company_name;
	    } else {
	        $ret['status'] = FALSE;
	    }
	    echo json_encode($ret);
	}
	
	
}
/** End of file Csupplier_buyer.php */
/** Location: ./application/controllers/Csupplier_buyer.php */
