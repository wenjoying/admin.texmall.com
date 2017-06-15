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
		$this->load->library('pagination');
		$config['per_page']   = 2;
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
	    $data['one_level'] = '用户管理';
	    $data['two_level'] = '用户列表';
	    $this->load->view('user/vadd', $data);
	}
	
	public function insert()
	{
	    $post = $this->input->post();
        $num = $this->Base_model->getTableNum($this->table);
        if ($num > 0){
            $rec = $this->Base_model->getTableNum($this->table, array('username'=>$post['recommend_username']));
            if ($rec <= 0) {
                alert_msg('必须添加推荐人');
            }
        }
        $money = $this->Base_model->getWhere('web_set', array('id'=>1))->row();
        if ($money->a_in<1 || $money->b_in<1) {
            alert_msg('A区或B区设置进入的人数必须大于1');
        }
	    $data['username']  = $post['username'];
	    $data['realname']  = $post['realname'];
	    $data['id_card']   = $post['id_card'];
	    $data['card_no']   = $post['card_no'];
	    $data['mobile']    = $post['mobile'];
	    $data['recommend_uid'] = $post['recommend_uid'];
	    $data['recommend_username'] = $post['recommend_username'];
	    $data['time']  = time();
	    $this->db->trans_start();
	    $id = $this->Base_model->insert($this->table, $data);
	    $this->a_area_add($id, $post['username'], $money->a_in, $money->a_money);  //执行A区处理
	    if (!empty($post['recommend_username'])) {  //如果有推荐人执行B区处理
	        $this->b_area_add($post['recommend_uid'], $post['recommend_username'], $money->b_in, $money->b_money);
	    }
	    $this->db->trans_complete();
	    if ($this->db->trans_status()===TRUE && $id) {
	        alert_msg('操作成功', 'Cuser/add');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	
	
	/**
	 * @修改用户
	 * */
	public function edit($id = 0)
	{
	    $data['res'] = $this->Base_model->getWhere($this->table, array('id'=>$id))->row();
	    $data['one_level'] = '用户管理';
	    $data['two_level'] = '用户列表';
	    $this->load->view('user/vupdate', $data);
	}
	
	public function update()
	{
	    $post = $this->input->post();
	    $data['realname']  = $post['realname'];
	    $data['id_card']   = $post['id_card'];
	    $data['card_no']   = $post['card_no'];
	    $data['mobile']    = $post['mobile'];
	    $data['time']  = time();
	    $id = $this->Base_model->update($this->table, array('id'=>$post['id']), $data);
	    if ($id) {
	        alert_msg('操作成功', 'Cuser/show');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @删除
	 * */
	public function delete($id = 0)
	{
	    $ids = $this->input->post('checkid');
	    $checkid = $ids ? $ids : array($id); 
	    $res = $this->Base_model->deleteWhereIn($this->table, 'id', $checkid);
	    if ($res > 0) {
	        alert_msg('操作成功', 'Cuser/show');
	    }else{
	        alert_msg('操作失败');
	    }
	}
	
	/**
	 * @验证用户
	 * */
	public function check_user()   
	{
		$username = $this->input->post('username');
		$res = $this->Base_model->getTableNum($this->table, array('username'=>$username));
		echo json_encode($res);
	}
	
	public function get_recommend() 
	{
	    $res = $this->Base_model->getWhere($this->table, array('username'=>$this->input->post('recommend')));
	    if($res->num_rows() > 0){
	        echo json_encode(array('status'=>true, 'uid'=>$res->row()->id));
	    }else{
	        echo json_encode(array('status'=>false));
	    }
	}
	
	
}
/** End of file Cuser.php */
/** Location: ./application/controllers/Cuser.php */
