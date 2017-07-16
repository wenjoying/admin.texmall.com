<?php
/**
 * xxx.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */

if (!defined('BASEPATH'))  exit('No direct script access allowed');
class Keditor extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('kindeditor');
    }

    /**
     public function index(){
     $data['uploadJSON'] = base_url().'editor/upload'; //更改图片上传
     $data['manageJSON'] = base_url().'editor/manage';//更改图片浏览
     $this->load->view('editor', $data);
     }
     */
    
    /**
     * @上传
     * */
    public function upload(){
        if (!empty ($_FILES)){
            $this->kindeditor->upload($_FILES);
        }
    }

    /**
     * @地址
     * */
    public function manage(){
        $path = isset($_GET['path']) ? $_GET['path'] : '';
        $this->kindeditor->manage($path);
    }


}