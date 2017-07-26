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
	    $data['moth_order'] = '[
                         	{"xaxis": "1月", "val": 34},
                         	{"xaxis": "2月", "val": 24},
                         	{"xaxis": "3月", "val": 3},
                         	{"xaxis": "4月", "val": 12},
                         	{"xaxis": "5月", "val": 13},
                         	{"xaxis": "6月", "val": 22},
                         	{"xaxis": "7月", "val": 5},
                         	{"xaxis": "8月", "val": 26},
                         	{"xaxis": "9月", "val": 12},
                         	{"xaxis": "10月", "val": 19},
                         	{"xaxis": "11月", "val": 19},
                         	{"xaxis": "12月", "val": 19},
						]';
	    $data['moth_amount'] = '[
                         	{"xaxis": "1月", "val": 34},
                         	{"xaxis": "2月", "val": 24},
                         	{"xaxis": "3月", "val": 3},
                         	{"xaxis": "4月", "val": 12},
                         	{"xaxis": "5月", "val": 13},
                         	{"xaxis": "6月", "val": 22},
                         	{"xaxis": "7月", "val": 5},
                         	{"xaxis": "8月", "val": 26},
                         	{"xaxis": "9月", "val": 12},
                         	{"xaxis": "10月", "val": 19},
                         	{"xaxis": "11月", "val": 19},
                         	{"xaxis": "12月", "val": 19},
						]';
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
	    $data['user_role_name'] = $this->_get_role($this->admin->role_id);
	    $data['one_level'] = '后台管理员';
	    $data['two_level'] = '个人信息';
	    $this->load->view('admin_user/vpage', $data);
	}
	
	/**
	 * @修改个人消息
	 * */
	public function editPost()
	{ 
	    $this->validate('edit');
	    
	    $postData = $this->input->post();
	    $data['username'] = trim($postData['username']);
	    $data['mobile']   = trim($postData['mobile']);
	    $data['role_id']  = $postData['role_id'];
	    $data['update_time']  = time();
	    if (!is_empty($postData['password'])) {
	        $data['password'] = ZD_md5(trim($postData['password']));
	    }
	    $img = $this->deal_img('userimg', FALSE);
	    if (isset($img['upload']['userimg'])) {
	        $data['userimg'] = $img['upload']['userimg'];
	        if ($this->admin->userimg != $this->config->default_img['userimg']) {
	            @unlink($this->config->upload_image_path($this->admin->userimg));
	        }
	    }
	    $res = $this->Base_model->update($this->table, array('id'=>$postData['id']), $data);
	    if ($res > 0) {
	        alert_msg('操作成功', 'Clogin/login_out');
	    } else {
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @检验管理员用户是否存在
	 * */
	public function check_exists()
	{
	    $postData = $this->input->post();
	    if (empty($postData['username']) && empty($postData['mobile'])) {
	        echo json_encode(FALSE);
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
	        if ($this->input->post('id') == 1) {
	            alert_msg('禁止修改');
	        }
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
	    $data['role'] = $this->_get_role();
	    $data['one_level'] = '后台管理员';
	    $data['two_level'] = '管理员列表';
	    $this->load->view('admin_user/vpage', $data);
	}
	
	/**
	 * @新增管理员
	 * */
	public function add()   
	{
	    $this->checkAction(__METHOD__);
	    
	    $data['res'] = $this->_get_role();
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
	    $data['role_id']  = $postData['role_id'];
	    $data['reg_time'] = time();
	    $data['update_time']  = '';
	    $img = $this->deal_img('userimg', FALSE);
	    if (isset($img['upload']['userimg'])) {
	        $data['userimg'] = $img['upload']['userimg'];
	    }
	    
	    $res = $this->Base_model->insert($this->table, $data);
		if ($res>0) {
			alert_msg('操作成功', 'Cadmin_user/grid');
		}else{
			alert_msg('操作失败');
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
	        alert_msg('操作成功', 'Cadmin_user/grid');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @重置密码
	 * */
	public function reset_pwd($id = 0)  
	{
	    $this->checkAction(__METHOD__);
	    
	    if ($id == 1) {
	        alert_msg('禁止重置密码');
	    }
		$res = $this->Base_model->update($this->table, array('id'=>$id), array('password'=>ZD_md5('texmall@2017')));
	    if ($res>0) {
			alert_msg('操作成功', 'Cadmin_user/grid');
		}else{
			alert_msg('操作失败');
		}
	}

	/**
	 * @获取角色信息
	 * */
	private function _get_role($role_id = 0)
	{
	    $table = 'admin_role';
	    if (!empty($role_id)) {
	        return $this->Base_model->getWhere($table, array('id'=>$role_id))->row()->role_name;
	    }
	    return $this->Base_model->getTable($table)->result();
	}

}

/** End of file Cadmin_user.php */
/** Location: ./application/controllers/Cadmin_user.php */
