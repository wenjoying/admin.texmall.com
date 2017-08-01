<?php
/**
 * Cthird_manage.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cthird_manage extends TM_Controller {
    private $table = 'third_manage';
    
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
        $data['one_level'] = '网站设置';
        $data['two_level'] = '第三方接口';
        $this->load->view('third_manage/vgrid', $data);
    }
    
    /**
     * @新增权限方法
     * */
    public function add()
    {
        $this->checkAction(__METHOD__);
        
        $data['one_level'] = '网站设置';
        $data['two_level'] = '第三方接口';
        $this->load->view('third_manage/vadd', $data);
    }
    
    /**
     * @新增
     * */
    public function addPost()
    {
        $this->_validate();
        
        $postData = $this->input->post(); 
        $data['name'] = $postData['name'];
        $data['third_url'] = $postData['third_url'];
        $data['username'] = $postData['username'];
        $data['password'] = $postData['password'];
        $data['note'] = $postData['note'];
        $res = $this->Base_model->insert($this->table, $data);
        if ($res > 0) {
            alert_msg('操作成功', 'Cthird_manage/grid');
        }else{
            alert_msg('操作失败');
        }
    }
    
    /**
     * @验证
     * */
    private function _validate()
    {
        if ($this->Base_model->getTableNum($this->table, array('name'=>$this->input->post('name'))) > 0) {
            alert_msg('名称已存在');
        }
        
        if (!is_url($this->input->post('third_url'))) {
            alert_msg('请填写第三方网址');
        }
        
        if (is_empty($this->input->post('username'))) {
	        alert_msg('请填写用户名');
	    }
	    
	    if (is_empty($this->input->post('password'))) {
	        alert_msg('请填写密码');
	    }
    }
    
    /**
     * @删除
     * */
    public function delete($id = 0) 
    {
        $this->checkAction(__METHOD__);
         
        $res = $this->Base_model->delete($this->table, array('id'=>$id));
        if ($res>0) {
            alert_msg('操作成功', 'Cthird_manage/grid');
        }else{
            alert_msg('操作失败');
        }
    }

}
/** End of file Cthird_manage.php */
/** Location: ./application/controllers/Cthird_manage.php */