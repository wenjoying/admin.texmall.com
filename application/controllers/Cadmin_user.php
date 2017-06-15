<?php 
/**
 * Cadmin_user.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadmin_user extends TM_Controller {
    
    private $table = 'admin_user';
    
    function _init()
	{
		header("Content-type: text/html; Charset=utf-8");
	}
	
	/**
	 * @后台首页
	 * */
	public function index()
	{
	    $data['one_level'] = 'Texmall后台首页';
	    $data['two_level'] = '';
	    $this->load->view('layout/vindex', $data);
	}
	
	/**
	 * @个人信息
	 * */
	public function profile()
	{    
	    $data['res'] = $this->admin;
	    $data['one_level'] = '后台管理员';
	    $data['two_level'] = '个人信息';
	    $this->load->view('admin_user/vprofile', $data);
	}
	
	/**
	 * @修改个人消息
	 * */
	public function editPost()
	{ 
	    $this->validate(0);
	    
	    $postData = $this->input->post();
	    $data['username'] = trim($postData['username']);
	    $data['mobile']   = trim($postData['mobile']);
	    $data['up_time']  = time();
	    if (!is_empty($postData['password'])) {
	        $data['password'] = ZD_md5(trim($postData['password']));
	    }
	    $img = $this->deal_img('userimg', false);
	    if (isset($img['upload']['userimg'])) {
	        $data['userimg'] = $img['upload']['userimg'];
	        if ($this->admin->userimg != $this->config->default_img['userimg']) {
	            @unlink($this->config->upload_image_path($this->admin->userimg));
	        }
	    }
	    $res = $this->Base_model->update($this->table, array('id'=>$this->admin->id), $data);
	    if ($res > 0) {
	        alert_msg('操作成功', 'Clogin/login_out');
	    } else {
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @检验管理员用户是否存在
	 * */
	public function check_admin_user()
	{
	    $postData = $this->input->post();
	    if (empty($postData['username']) && empty($postData['mobile'])) {
	        echo json_encode(false);
	    }
	    
	    $res = $this->Base_model->getWhere($this->table, $postData);
	    if ($res->num_rows() > 0) {
	        echo json_encode($res->row()->id);
	    }
	}
	
	/**
	 * @验证
	 * @param number $type:insert为新增
	 * */
	public function validate($type = 'insert')
	{
	    if (is_empty($this->input->post('username'))) {
	        alert_msg('请填写用户名');
	    }
	    
	    if (!is_mobile($this->input->post('mobile'))) {
	        alert_msg('请填写手机号');
	    }
	    
	    $exsit = $this->Base_model->getOrWhere($this->table, array('username'=>trim($this->input->post('username'))), array('mobile'=>trim($this->input->post('mobile'))));
	    if ($type == 'insert') {
	        if ($exsit->num_rows() > 0) {
	            alert_msg('用户名或手机号已存在');
	        }
	        $len = mb_strlen(trim($this->input->post('password')), 'utf-8');
	        if ($len<6 || $len>15) {
	            alert_msg('请输入6-15位密码');
	        }
	    } else {
	        if ($exsit->row()->id != $this->input->post('id')) {
	            alert_msg('用户名或手机号已存在');
	        }
	    }
	}
	
	/**
	 * @后台管理员列表
	 * */
	public function grid()   
	{
	    $this->checkAction(__METHOD__);
	    
		$data['res'] = $this->Base_model->getTable($this->table)->result();
		$data['one_level'] = '后台管理员';
	    $data['two_level'] = '管理员列表';
		$this->load->view('admin_user/vgrid', $data);
	}
	
	public function page($id = 0)
	{
	    $this->checkAction(__METHOD__);
	    
	    $res = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($res->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    $data['res'] = $res->row();
	    $data['one_level'] = '后台管理员';
	    $data['two_level'] = '管理员列表';
	    $this->load->view('admin_user/vprofile', $data);
	}
	
	/**
	 * @新增管理员
	 * */
	public function add()   
	{
	    $this->checkAction(__METHOD__);
	    
		$data['one_level'] = '后台管理员';
	    $data['two_level'] = '管理员列表';
		$this->load->view('admin_user/vadd', $data);
	}
	
	/**
	 * @新增
	 * */
	public function addPost()  
	{
	    $this->validate();
	    $postData = $this->input->post();
	    $data['username'] = trim($postData['username']);
	    $data['mobile']   = trim($postData['mobile']);
	    $data['password'] = ZD_md5(trim($postData['password']));
	    $data['userimg']  = $this->config->default_img['userimg'];
	    $data['reg_time'] = time();
	    $data['up_time']  = '';
	    $img = $this->deal_img('userimg', false);
	    if (isset($img['upload']['userimg'])) {
	        $data['userimg'] = $img['upload']['userimg'];
	    }
	    
	    $res = $this->Base_model->insert($this->table, $data);
		if ($res>0) {
			alert_msg('操作成功!', 'Cadmin_user/grid');
		}else{
			alert_msg('操作失败!');
		}
	}
	
	/**
	 * @删除管理员
	 * */
	public function delete($id = 0)
	{    
	    $this->checkAction(__METHOD__);
	    
	    if ($id == 1) {
	        alert_msg('禁止删除!');
	    }
	    $checkid = $this->input->post('checkid');
	    $ids = $checkid ? $checkid : array($id);
	    $user = $this->Base_model->getWherein($this->table, 'id', $ids);
	    $res = $this->Base_model->deleteWherein($this->table, 'id', $ids);
	    
	    if ($res > 0) {
    	    foreach ($user as $u) {
    	        $this->delete_img($u->userimg);
    	    }
	        alert_msg('操作成功!', 'Cadmin_user/grid');
	    }else{
	        alert_msg('操作失败!');
	    }
	}
	
	/**
	 * @重置密码
	 * */
	public function reset_pwd($id = 0)  
	{
	    $this->checkAction(__METHOD__);
	    
	    if ($id == 1) {
	        alert_msg('禁止重置密码!');
	    }
		$res = $this->Base_model->update($this->table,array('id'=>$id),array('password'=>ZD_md5('texmall@2017')));
	    if ($res>0) {
			alert_msg('操作成功!', 'Cadmin_user/grid');
		}else{
			alert_msg('操作失败!');
		}
	}

}

/** End of file Cadmin_user.php */
/** Location: ./application/controllers/Cadmin_user.php */
