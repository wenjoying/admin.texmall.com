<?php 
/**
 * Cuser.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuser extends TM_Controller {

    private $table = 'user';
    
	function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
		$this->load->model('Muser');
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
		$config['total_rows'] = $this->Muser->total($this->input->get());
		$config['first_url']  = base_url('Cuser/grid').$this->get_page_param($this->input->get());
		$config['base_url']   = base_url('Cuser/grid');
		$this->pagination->initialize($config);
		$data['link']       = $this->pagination->create_links();
		$data['res']        = $this->Muser->grid($pg-1, $config['per_page'], $this->input->get())->result();
		$data['sum']        = $config['total_rows'];
		$data['per_page']   = $config['per_page'];
		$data['one_level'] = '用户管理';
		$data['two_level'] = '用户列表';
		$this->load->view('user/vgrid', $data);
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
	    $this->load->view('user/vadd', $data);
	}
	
	/**
	 * @新增用户
	 * */
	public function addPost()
	{
	    $this->validata();
	    
	    $postData = $this->input->post();
	    $data['userimg'] = $this->config->default_img['userimg'];
	    $img = $this->deal_img('userimg', FALSE);
	    if (isset($img['upload']['userimg'])) {
	        $data['userimg'] = $img['upload']['userimg'];
	    }
	    $data['username']  = $postData['username'];
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
	        alert_msg('操作成功', 'Cuser/grid');
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
	    $this->load->view('user/vedit', $data);
	}
	
	/**
	 * @修改用户
	 * */
	public function editPost()
	{
	    $this->validata();
	    
	    $postData = $this->input->post();
	    $img = $this->deal_img('userimg', FALSE);
	    if (isset($img['upload']['userimg'])) {
	        $data['userimg'] = $img['upload']['userimg'];
	    }
	    $data['username']  = $postData['username'];
	    $data['password']  = ZD_md5($postData['password']);
	    $data['id_card']   = $postData['id_card'];
	    $data['companyid'] = $postData['companyid'];
	    $data['company']   = $postData['company'];
	    $data['positions'] = $postData['positions'];
	    $data['sex']       = $postData['sex'];
	    $res = $this->Base_model->update($this->table, array('id'=>$postData['id']), $data);
	    if ($res > 0) {
	        alert_msg('操作成功', 'Cuser/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @查看
	 * */
	public function page($id = 0)
	{
	    $this->checkAction(__METHOD__);
	     
	    $res = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($res->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    $data['res']       = $res->row();
	    $data['sex_arr']   = array('1'=>'男', '2'=>'女', '3'=>'保密');
	    $data['mail_list'] = $this->_get_user_mail_list($id);
	    $data['models']    = $this->_get_user_model($id);
	    $data['enshrine']  = $this->_get_user_enshrine($id);
	    $data['user_log']  = $this->_get_user_log($id);
	    $data['search']    = $this->_get_search_log($id); 
	    $data['workers']   = $this->_get_workers($data['res']->companyid);
	    $data['one_level'] = '用户管理';
	    $data['two_level'] = '用户列表';
	    $this->load->view('user/vprofile', $data);
	}
	
	/**
	 * @删除
	 * */
	public function delete($id = 0)
	{
	    $this->checkAction(__METHOD__);
	    
	    $checkid = $this->input->post('checkid');
	    $ids = $checkid ? $checkid : array($id);
	    $user = $this->Base_model->getWherein($this->table, 'id', $ids);
	    $res = $this->Base_model->deleteWherein($this->table, 'id', $ids);
	    if ($res>0) {
	        foreach ($user as $u) {
	            $this->delete_img($u->userimg);
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
	    if (is_empty($this->input->post('username'))) {
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
	    
	    $user = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($user->num_rows() == 0) {
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
	    $url = $this->config->html5_url.'Cqr_scan/scan?mobile='.ZD_md5($user->row()->mobile).'&uid='.$id;
	    $this->qrcode->png($url, $upload_path.$png, 4, 10);
	    $png = './'.$path.'/'.$day.'/'.$png;
	    if (file_exists($this->config->upload_image_path($png))) {
	        $res = $this->Base_model->update($this->table, array('id'=>$id), array('qr_img'=>$png));
	        if ($res > 0) {
	            alert_msg('操作成功', 'Cuser/grid');
	        }else{
	            alert_msg('操作失败');
	        }
	    }
	}
	
	/**
	 * @验证用户手机号
	 * */
	public function check_exists($mobile = '')
	{
	    $mobile = empty($mobile) ? $this->input->post_get('mobile') : $mobile;
	    $res = $this->Base_model->getTableNum($this->table, array('mobile'=>$mobile));
	    echo json_encode($res);
	}
	
	/**
	 * @获取角色
	 * */
	private function _get_role()
	{
	    return $this->Base_model->getTable('user_role')->result();
	}
	
	/**
	 * @获取用户选择的模特
	 * */
	private function _get_user_model($uid)
	{
	    $models = $this->Base_model->getWhere('user_model', array('uid'=>$uid));
	    if ($models->num_rows() > 0) {
	        $models_arr = explode(',', $models->row()->model_list);
	        return $this->Base_model->getWherein('correct_img', 'id', $models_arr)->result();
	    }
	    return array();
	}
	
	/**
	 * @获取用户收藏的列表
	 * */
	private function _get_user_enshrine($uid)
	{
	    return $this->Base_model->getWhere('user_enshrine', array('uid'=>$uid))->result();
	}
	
	/**
	 * @获取用户通讯录
	 * */
	private function _get_user_mail_list($uid)
	{
	    return $this->Base_model->getWhere('user_mail_list', array('uid'=>$uid), 'id', 20)->result();
	}
	
	/**
	 * @获取用户浏览记录
	 * */
	private function _get_user_log($uid)
	{
	    return $this->Base_model->getWhere('user_log', array('uid'=>$uid), 'id', 20)->result();
	}
	
	/**
	 * @获取用户搜索记录
	 * */
	private function _get_search_log($uid)
	{
	    return $this->Base_model->getWhere('search_log', array('uid'=>$uid), 'id', 20)->result();
	}
	
	/**
	 * @获取用我的同事
	 * */
	private function _get_workers($companyid)
	{
	    if (empty($companyid)) return array();
	    return $this->Base_model->getWhere('user', array('companyid'=>$companyid))->result();
	}
 
	
}
/** End of file Cuser.php */
/** Location: ./application/controllers/Cuser.php */
