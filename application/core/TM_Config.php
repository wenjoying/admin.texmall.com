<?php
class TM_Config extends CI_Config 
{
    public $main_base_url   = 'http://texmall.com/';
//     public $image_url       = 'http://img.texmall.com/';
    public $image_url       = 'http://zoudong.oss-cn-shanghai.aliyuncs.com/';
    public $html5_url       = 'http://html5.texmall.com/';
    public $default_img     = array(
        'userimg' => './userimg/profile-pic.jpg',   //默认头像
    );
    
    
    
	/**
	 * @param string $dirname：路径
	 * @param bool $is_dir：TRUE/FALSE 是否是目录
	 * @return string
	 * */
    public function upload_image_path($dirname='images', $is_dir=FALSE)
    {
        if (empty($dirname)) return FALSE;
        if ($is_dir) {
            return dirname(FCPATH) . '/img.texmall.com/' . $dirname . '/';
        }
        return dirname(FCPATH) . '/img.texmall.com/' . $dirname;
    }
    
    
}