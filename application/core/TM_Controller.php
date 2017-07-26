<?php 
/**
 * TM_Controller.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TM_Controller extends CI_Controller{

    public $admin;
    
	public function __construct()
	{
		parent::__construct();
		$this->_init(); 
		
		/**@开发模式下开启性能分析*/ 
		if (ENVIRONMENT === 'development') {
// 			$this->output->enable_profiler(TRUE);
		}
		
		$this->admin = json_decode(base64_decode($this->input->cookie('admin')));
		if (!$this->admin) {
		    redirect('Clogin/index');
		}
	}
	
	/**
	 * @用着重载
	 * */
	public function _init() {}
	
	/**
	 * @检查权限
	 * @param string $func:权限方法
	 * **/
	public function checkAction($func)
	{ 
// 	    $this->admin_log($func);
// 	    $action_list = $this->admin->action_list;
	    $action_list = 'all_action';
	    if ($action_list == 'all_action') {
	        return TRUE;
	    }
	    $action_arr = explode('|', $action_list);
	    if (in_array($func, $action_arr)) {
	        return TRUE;
	    }
	    alert_msg('权限不足');
	}
	
	/**
	 * @后台访问日志
	 * @param string $func:权限方法
	 * */
	public function admin_log($func)
	{
	    $log['username'] = $this->admin->username;
	    $log['mobile']   = $this->admin->mobile;
	    $log['ip']       = getIp();
	    $log['func']     = $func;
	    
	    $data['admin_uid'] = $this->admin->id;
	    $data['log']       = json_encode($log);
	    $data['time']      = time();
	    $this->Base_model->insert('admin_log', $data);
	}
	
	/**
	 * @param string $path:上传路径
	 * @param string $maxsize:最大文件大小
	 * @param string $width:最大宽度
	 * @param string $height:最大高度
	 * @param string $type:允许上传文件类型,并修改扩展名  //文件不能为空,为空报错
	 * @return boolean|array 图片路径
	 */
	public function deal_img($path='images', $thumb_water=TRUE, $conf=array('maxsize'=>5120, 'width'=>0, 'height'=>0, 'type'=>'jpg|png|jpeg'))
	{
	    $day = date('Ymd');
	    $this->load->library('upload');
	    $config['upload_path'] = $this->config->upload_image_path($path.'/'.$day, TRUE);
	    if (!is_dir($config['upload_path'])) { 
	        mkdir($config['upload_path'], DIR_WRITE_MODE, TRUE);
	    }
	    $config['allowed_types']   = $conf['type'];
	    $config['max_size']        = $conf['maxsize'];
	    $config['max_width']       = $conf['width'];
	    $config['max_height']      = $conf['height'];
	    $config['overwrite']       = TRUE;
	    if (empty($_FILES)) {
	        return FALSE;
	    }else{
	        foreach ($_FILES as $key=>$val) {
	            $config['file_name'] = daymicro();
	            $this->upload->initialize($config);
	            if ($this->upload->do_upload($key)) {
	                $data =  $this->upload->data();
	                $uploadfile = './'.$path.'/'.$day.'/'.$data['file_name'];
	                if ($data['is_image'] && $thumb_water) {
	                    $creat = $this->creat_thumb($uploadfile);
	                    $water = $this->waterimg($uploadfile);
	                }
	                $img['upload'][$key] = $uploadfile;
	            }else{
	                $img['error'][$key] = $this->upload->display_errors('<p>', '</p>');
	            }
	        }
	        return $img;
	    }
	}
	
	/**
	 * @param string $path:上传路径
	 * @param string $maxsize:最大文件大小
	 * @param string $width:最大宽度
	 * @param string $height:最大高度
	 * @param string $type:允许上传文件类型,并保持扩展名
	 * @return boolean|array 文件路径
	 */
	public function deal_file($path='images', $thumb_water=TRUE, $conf=array('maxsize'=>5120, 'width'=>0, 'height'=>0, 'type'=>'jpg|png|jpeg|pdf'))
	{
	    $day = date('Ymd');
	    $this->load->library('upload');
	    $config['upload_path'] = $this->config->upload_image_path($path.'/'.$day, TRUE);
	    if (!is_dir($config['upload_path'])) {
	        mkdir($config['upload_path'], DIR_WRITE_MODE, TRUE);
	    }
	    $config['allowed_types']   = $conf['type'];
	    $config['max_size']        = $conf['maxsize'];
	    $config['max_width']       = $conf['width'];
	    $config['max_height']      = $conf['height'];
	    $config['overwrite']       = TRUE;
	    if (empty($_FILES)) {
	        return FALSE;
	    }else{
	        foreach ($_FILES as $key=>$val) {
	            $time = daymicro();
	            $config['file_name'] = $time;
	            $this->upload->initialize($config);
	            if ($this->upload->do_upload($key)) {
	                $data =  $this->upload->data();
// 	                $uploadfile = './'.$path.'/'.$day.'/'.$time.$data['file_ext'];
	                $uploadfile = './'.$path.'/'.$day.'/'.$data['file_name'];;
	                if ($data['is_image'] && $thumb_water) {
	                    $creat = $this->creat_thumb($uploadfile);
	                    $water = $this->waterimg($uploadfile);
	                }
	                $file['upload'][$key] = $uploadfile;
	            }else{
	                $file['error'][$key] = $this->upload->display_errors('<p>', '</p>');         // echo $error;
	            }
	        }
	        return $file;
	    }
	}
	
	/**
	 * @param string $source_image:原图路径
	 * @param string $width:缩略宽度
	 * @param string $height:缩略高度
	 * @return boolean 
	 * */
	public function creat_thumb($source_image, $size='100x100')
	{
	    $resize = TRUE;
	    $config['image_library'] = 'gd2';
	    $config['source_image'] = $this->config->upload_image_path($source_image);
	    $config['create_thumb'] = TRUE;
	    $config['maintain_ratio'] = TRUE;
	    foreach (explode(',', $size) as $s) {
	        $s_arr = explode('x', $s);
	        $config['width']    = $s_arr[0];
	        $config['height']   = $s_arr[1];
	        $config['thumb_marker']   = '_'.$s_arr[0].'x'.$s_arr[1];
	        $this->load->library('image_lib');
	        $this->image_lib->initialize($config);
	        $resize = @$this->image_lib->resize();
	        $this->image_lib->clear();
	    }
	    return $resize;
	}
	
	/**
	 * @删除图片，如果有缩略图也删除
	 * @param string $img：图片路径
	 * @param string $size：缩略图尺寸
	 * */
	public function delete_img($img, $size='')
	{
	    if (empty($img) || in_array($img, $this->config->default_img)) {
	        return TRUE;
	    }
	    
	    if (!file_exists($this->config->upload_image_path($img))) {
	        return TRUE;
	    }
	    
	    @unlink($this->config->upload_image_path($img));
	    if (!empty($size)) {
	        $img_arr = explode('.', $img);
	        foreach (explode(',', $size) as $s) {
	            @unlink($this->config->upload_image_path('.'.$img_arr[1].'_'.$s.'.'.$img_arr[2]));
	        }
	        return TRUE;
	    }
	}
	
	/**
	 * @param string $path:保存地址
	 * @param string $source:源文件路径
	 * @param string $text:水印文字
	 * @return array 图片路径
	 */
	public function waterimg($source_image='', $text='Texmall 版权所有')	
	{
        $this->load->library('image_lib');
        $config['source_image'] = $this->config->upload_image_path($source_image);
        $config['wm_text'] = $text;
        $config['wm_type'] = 'text';
        $config['wm_font_path'] = './assets/css/YHBold.ttf';
        $config['wm_font_size'] = '12';
        $config['wm_font_color'] = 'e4e4e4';
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'right';
        $config['wm_vrt_offset'] = '20';
        $config['wm_padding'] = '-20';
        $this->image_lib->initialize($config);
        if ($this->image_lib->watermark()) {
            $img['waterimg'] = $source_image;
        } else {
            $img['error'] = $this->image_lib->display_errors('<p>', '</p>');
        }
	    return $img;
	}
	
	/**
	 * @压缩文件$path上传地址, $encrypt加密文件名
	 * @param string $upload:input表单域名称
	 * @param string $path:上传地址
	 * @param string $maxsize:最大文件大小
	 * @return array 文件路径
	 */
	public function dealzip($upload='zip', $path='zip', $maxsize='2048')  
	{
	    $time = daymicro();
	    $this->load->library('upload');
	    $config['upload_path'] = './upload/'.$path.'/';
	    $config['allowed_types'] = 'zip';
	    $config['max_size'] = $maxsize;
	    $config['file_name'] = $time.'.zip';
	    $this->upload->initialize($config);    //重点
	    if ($this->upload->do_upload($upload)) {
	        $data =  $this->upload->data($upload);
	        $zip['upload'][$upload] = './upload/'.$path.'/'.$data['file_name'];
	    }else{
	        $zip['error'][$upload] = $this->upload->display_errors('<p>', '</p>');
	    }
	    return $zip;
	}
	
	/**
	 * @下载图片（未完成）
	 * */
	public function download($dir = '')     
	{
	    if (empty($dir)) {
	        return FALSE;
	    }
	    if (!is_dir($this->config->upload_image_path($dir))) {
	        return FALSE;
	    }
	    $this->load->library('zip');
	    $this->zip->read_dir($this->config->upload_image_path($dir));
	    $this->zip->download('download.zip');
	}
	
	/**
	 * @param number $len:验证码长度
	 * @param string $width:验证码宽
	 * @param string $height:验证码高
	 * @param string $size:验证码字体大小
	 * @return 图片
	 */
	public function create_captcha($len=4, $width='80', $height='30')
	{
	    $this->load->helper('captcha');
	    $word = randomStr($len, 3);
	    $config = array(
	        'word' => $word,
	        'img_path' => $this->config->upload_image_path('captcha', TRUE),
	        'img_url' => $this->config->image_url.'captcha/',
	        'font_path' => 'assets/plugins/YHBold.ttf',
	        'img_width' => $width,
	        'img_height' => $height,
	        'expiration' => '1200',
	    );
	    return create_captcha($config);
	}
	
	/**
	 * 分页get参数
	 * @param unknown $param
	 */
	public function get_page_param($param)
	{
	    $suffix = '';
	    if ($param) {
	        $param = http_build_query($param);
	        $suffix = '?'.$param;
	    }
	    return $suffix;
	}
	
	/**
	 * @跳转
	 * @param string $url:路径
	 * @param string $method:跳转方法
	 * @param number $http_response_code:错误码
	 * */
	function redirect($url='', $method='location', $http_response_code=302)
	{
	    if (!preg_match('#^https?://#i', $url)) {
	        $url = base_url($url);
	    }
	    switch($method) {
	        case 'refresh' :
	            header("Refresh:0;url=".$url);
	            break;
	        default :
	            header("Location: ".$url, TRUE, $http_response_code);
	            break;
	    }
	    exit;
	}
	
	/**
	 * @复制文件
	 * @param string $file:文件名
	 * @param string $dir:文件夹
	 * */
	function file2dir($file, $dir)
	{
	    $f_path = $this->config->upload_image_path($file);
	    if (is_dir($f_path)) {
	        return FALSE;
	    }
	    if (!file_exists($f_path)) { 
	        return FALSE;
	    }
	    $day = date('Ymd');
	    $d_path = $this->config->upload_image_path($dir.'/'.$day, TRUE);
	    if (!is_dir($d_path)) {
	        mkdir($d_path, DIR_WRITE_MODE, TRUE);
	    }
	    $new = daymicro().'.'.pathinfo($file, PATHINFO_EXTENSION); //获取扩展名end(explode('.', $file));
	    if (copy($f_path, $d_path.'/'.$new)) {
	        return './'.$dir.'/'.$day.'/'.$new;
	    } else {
	        return FALSE;
	    }
	    
	}
	
	/**
	 * @从俩下载图片
	 * @param string $img_url:图片地址
	 * @param string $dir:图片地址
	 * */
	public function download_img($img_url, $dir)
	{
	    $day = date('Ymd');
	    $d_path = $this->config->upload_image_path($dir.'/'.$day, TRUE);
	    if (!is_dir($d_path)) {
	        mkdir($d_path, DIR_WRITE_MODE, TRUE);
	    }
	    $img = './'.$dir.'/'.$day.'/'.daymicro().'.jpg';
	    $creat = create_file(file_get_contents($img_url), $this->config->upload_image_path($img));
	    if ($creat) {
	        return $img;
	    }
	    return FALSE;
	}
	
	

	
	
}

/** End of file TM_controller.php */
/** Location: ./application/controllers/TM_controller.php */