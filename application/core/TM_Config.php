<?php
class TM_Config extends CI_Config 
{
    public $main_base_url   =  'http://texmall.com/';
    public $image_url       =  'http://img.texmall.com/';
    public $default_img     = array(
        'userimg' => './userimg/profile-pic.jpg',   //默认头像
    );
    
    
    
	/**
	 * @param string $dirname：路径
	 * @param bool $is_dir：true/false 是否是目录
	 * @return string
	 * */
    public function upload_image_path($dirname='images', $is_dir=false)
    {
        if (empty($dirname)) return false;
        if ($is_dir) {
            return dirname(FCPATH) . '/img.texmall.com/' . $dirname . '/';
        }
        return dirname(FCPATH) . '/img.texmall.com/' . $dirname;
    }
    
    
}