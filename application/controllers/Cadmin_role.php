<?php
/**
 * Cadmin_role.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadmin_role extends TM_Controller {
    private $table = 'admin_role';
    private $table2 = 'admin_user';
    
    public function _init()
    {
        header("Content-type: text/html; Charset=utf-8");
    }

    /**
     * @权限方法列表
     * */
    public function grid()
    {
        $this->checkAction(__METHOD__);
        
        $data['res'] = $this->Base_model->getTable($this->table)->result();
        $data['one_level'] = '后台管理员';
        $data['two_level'] = '管理员角色';
        $this->load->view('admin_role/vgrid', $data);
    }
    
    /**
     * @新增角色
     * */
    public function add()
    {
        $this->checkAction(__METHOD__);
        
        $data['action']    = $this->_get_action();
        $data['one_level'] = '后台管理员';
        $data['two_level'] = '管理员角色';
        $this->load->view('admin_role/vadd', $data);
    }
    
    /**
     * @新增
     * */
    public function addPost()
    {
        $this->validate();
        
        $postData = $this->input->post();
        $data['role_name']   = trim($postData['role_name']);
        $data['action_list'] = implode('|', $postData['action_list']);
        $data['menu_list']   = $postData['menu_list'];
        $data['des']         = $postData['des'];
        $res = $this->Base_model->insert($this->table, $data);
        if ($res > 0) {
            alert_msg('操作成功', 'Cadmin_role/grid');
        }else{
            alert_msg('操作失败');
        }
    }
    
    /**
     * @验证
     * */
    public function validate($type = 'insert')
    {
        if ($type == 'insert') {
            if ($this->Base_model->getTableNum($this->table, array('role_name'=>$this->input->post['role_name'])) > 0) {
                alert_msg('角色已存在');
            }
        }
        
        if (is_empty($this->input->post('action_list'))) {
            alert_msg('请选择权限');
        }
        
        if (is_empty($this->input->post('menu_list'))) {
            alert_msg('请输入菜单号');
        }
    }
    
    /**
     * @角色修改
     * */
    public function edit($id = 0)
    {
        $this->checkAction(__METHOD__);
    
        $res = $this->Base_model->getWhere($this->table, array('id'=>$id));
	    if ($res->num_rows() == 0) {
	        $this->redirect('Clogin/show_404');
	    }
	    $data['res'] = $res->row();
        $data['action'] = $this->_get_action();
        $data['one_level'] = '后台管理员';
        $data['two_level'] = '管理员角色';
        $this->load->view('admin_role/vedit', $data);
    }
    
    /**
     * @修改角色
     * */
    public function editPost()
    {
        $this->validate(0);
        
        $postData = $this->input->post();
        if ($postData['id'] == 1) {
            alert_msg('禁止修改');
        }
        $data['role_name']   = trim($postData['role_name']);
        $data['action_list'] = implode('|', $postData['action_list']);
        $data['menu_list']   = $postData['menu_list'];
        $data['des']         = $postData['des'];
        $res = $this->Base_model->update($this->table, array('id'=>$postData['id']), $data);
        if ($res > 0) {
            alert_msg('操作成功', 'Cadmin_role/grid');
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
         
        if ($id == 1) {
            alert_msg('禁止删除');
        }
        
        if ($this->_get_user_num($id) > 0) {
            alert_msg('请将此角色的管理员删除后再操作');
        }
        
        $res = $this->Base_model->delete($this->table, array('id'=>$id));
        if ($res>0) {
            alert_msg('操作成功', 'Cadmin_role/grid');
        }else{
            alert_msg('操作失败');
        }
    }
    
    /**
     * @获取权限方法
     * */
    private function _get_action()
    {
        return $this->Base_model->getTable('admin_action', 'action ASC')->result();
    }
    
    /**
     * @获取权限方法
     * */
    private function _get_user_num($role_id = 0)
    {
        return $this->Base_model->getTableNum('admin_user', array('role_id'=>$role_id));
    }
    
    

}
/** End of file Cadmin_role.php */
/** Location: ./application/controllers/Cadmin_role.php */