<?php
/**
 * Cadmin_action.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadmin_action extends TM_Controller {
    private $table = 'admin_action';
    
    public function _init()
    {
        header("Content-type: text/html; Charset=utf-8");
        $this->load->model('Madmin_action');
    }

    /**
     * @权限方法列表
     * */
    public function grid($pg = 1)
    {
        $this->checkAction(__METHOD__);
        
        $this->load->library('pagination');
        $config['per_page']   = 20;
        $config['uri_segment'] = 3;
        $config['suffix']     = $this->get_page_param($this->input->get());
        $config['total_rows'] = $this->Madmin_action->total($this->input->get());
        $config['first_url']  = base_url('Cadmin_action/grid').$this->get_page_param($this->input->get());
        $config['base_url']   = base_url('Cadmin_action/grid');
        $this->pagination->initialize($config);
        $data['link']       = $this->pagination->create_links();
        $data['res']        = $this->Madmin_action->grid($pg-1, $config['per_page'], $this->input->get())->result();
        $data['sum']        = $config['total_rows'];
        $data['per_page']   = $config['per_page'];
        $data['one_level'] = '后台管理员';
        $data['two_level'] = '权限列表';
        $this->load->view('admin_action/vgrid', $data);
    }
    
    /**
     * @新增权限方法
     * */
    public function add()
    {
        $this->checkAction(__METHOD__);
        
        $data['one_level'] = '后台管理员';
        $data['two_level'] = '权限列表';
        $this->load->view('admin_action/vadd', $data);
    }
    
    /**
     * @新增
     * */
    public function addPost()
    {
        $this->validate();
        
        $postData = $this->input->post();
        $data['action'] = trim($postData['action']);
        $data['des']    = $postData['des'];
        $res = $this->Base_model->insert($this->table, $data);
        if ($res > 0) {
            alert_msg('操作成功', 'Cadmin_action/grid');
        }else{
            alert_msg('操作失败');
        }
    }
    
    /**
     * @验证
     * */
    public function validate()
    {
        $num = $this->Base_model->getTableNum($this->table, array('action'=>$this->input->post('action')));
        if ($num > 0) {
            alert_msg('权限方法已存在');
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
        $res = $this->Base_model->deleteWherein($this->table, 'id', $ids);
        if ($res>0) {
            alert_msg('操作成功', 'Cadmin_action/grid');
        }else{
            alert_msg('操作失败');
        }
    }

}
/** End of file Cadmin_action.php */
/** Location: ./application/controllers/Cadmin_action.php */