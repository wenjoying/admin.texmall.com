<?php 
/**
 * var_dump()打印
 * */
function vard($data)       //打印
{
	var_dump($data);die;
}

/**
 * print_r()打印
 * */
function p($data)
{
	print_r($data);die;
}

/**
 * @console.log调试
 * */
function console_log($data)
{
    echo '<script>';
    echo 'console.log('.json_encode($data).')';
    echo '</script>';
}

/**
 * @引入js文件
 * @param string $file_name:js文件
 * */
function inc_js($file_name)     
{
	echo '<script type="text/javascript" src="'.base_url('assets/js/'.$file_name.'.js').'"></script>';
}

/**
 * @引入CSS文件
 * @param string $file_name:css文件
 * */
function inc_css($file_name) 
{
	echo '<link rel="stylesheet" type="text/css" href="'.base_url('assets/css/'.$file_name.'.css').'"  media="screen" />';
}

/**
 * @引入文件
 * @param string $file_name:文件名
 * @param string $dir:文件夹
 * */
function inc_file($file_name, $dir='img')
{
    echo base_url('assets/'.$dir.'/'.$file_name);
}

/**
 * @消息弹框(1秒后消失)
 * @param string $str:消息
 * @param string $url:跳转路径
 * @param number $i:提示图片
 * */
function alert_msg($str='', $url='', $i=0)   
{
    header("Content-Type:text/html;Charset=UTF-8");
    if ($url) {
        if (!preg_match('#^https?://#i', $url)) {
            $url = base_url($url);
        }
        $i = empty($i) ? 1 : $i;
    }else{
        $i = 2;
    }
    inc_js('jquery-2.2.4.min');
    inc_js('layer/layer');
    echo '<script style="Text/Javascript">;$(function(){';
    echo 'var alertMsg = function(str,url,i){layer.msg(str,{icon:i,time:1000,area:["300px","100px"],offset:"200px"}, function(){if (url){location.href=url;}else{window.history.back();}});};';
    echo 'alertMsg("'.$str.'","'.$url.'","'.$i.'");});</script>';
    die;
}

/**
 * @双重MD5
 * @param string $str：需加密字符串
 * @param string $pre：加密前缀
 * */
function ZD_md5($str, $pre='Z_d@2016'){
    return md5($pre.md5(trim($str)));
}

/**
 * $str:要截取的字符串
 * $num:截取长度
 * @return 截取后字符串
 * */
function cutstr($str, $num) {  //截取字符串
	if (mb_strlen($str,'utf-8') > $num) {
		$str = mb_substr($str,0, $num,'utf-8').'...';
	}
	return $str;
}

/**
 * @获取毫秒时间
 * @param number $len:毫秒长度
 * @return 101155_1234 样式
 * */
function daymicro($len=4)   
{
	$time = explode(' ', microtime());
	$str = date('His', $time[1]).'_'.mb_substr($time[0],2, $len);
	return $str;
}

/**
 * @对象转换成数组
 * @param obj $obj:对象
 * @return 数组
 * */
function ob2ar($obj)    
{
	if (is_object($obj)) {
		$obj = (array)$obj;
		$obj = ob2ar($obj);
	}elseif (is_array($obj)){
		foreach($obj as $key => $value) {
			$obj[$key] = ob2ar($value);
		}
	}
	return $obj;
}

/**
 * @对象转化为数组
 * @param obj $obj:对象
 * @return 数组
 * */
function objectToArray($obj)   
{
    $_arr = is_object($obj)? get_object_vars($obj) : $obj;
    foreach ($_arr as $key => $val){
        $val=(is_array($val)) || is_object($val) ? objectToArray($val) :$val;
        $arr[$key] = $val;
    }
    return $arr;
}

/**
 * @判断是否有空值,至少有一个空值返回TRUE
 * @param array $data:数组或字符串
 * @return boolean 
 * */
function one_empty($data)  
{
	if (is_array($data)) {
		foreach($data as $v) {
			$val = trim($v);
			if (empty($val)) return TRUE;
		}
	}else{
		$val = trim($data);
		if (empty($val)) return TRUE;
	}
	return FALSE;
}

/**
 * @判断是否为空,全为空返回TRUE
 * @param array $data:传值,数组或字符串
 * @return boolean 
 * */
function is_empty($data)   
{
	$is_empty = FALSE;
	if (is_array($data)) { 
		$arrStr = '';
		foreach ($data as $val) {
			$arrStr .= trim($val);
		}
		if (empty($arrStr)) $is_empty = TRUE;
	}else{
		$val = trim($data);
		if (empty($val)) $is_empty = TRUE;
	}
	return $is_empty;
}

/**
 * @判断是否是邮箱
 * @param string $email:邮箱
 * @return boolean
 * */
function is_email($email)   
{
	return (!preg_match('/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/', $email)) ? FALSE : TRUE;
}

/**
 * @验证手机号
 * @param string $mobile:手机号
 * @return boolean
 */
function is_mobile($mobile)
{
    return (!preg_match('/^1[34578]\d{9}$/', $mobile)) ? FALSE : TRUE;
}

/**
 * @验证网址
 * @param string $url:网址
 * @return boolean
 */
function is_url($url)
{
    return (!preg_match('/^(http(s)?:\/\/)?(www\.)?[\w-]+\.\w{2,4}(\/)?$/', $url)) ? FALSE : TRUE;
}

/**
 * @验证身份证
 * @param string $id_card:身份证号
 * */
function is_id_card($id_card)
{
    $aCity = array(11=>"北京",12=>"天津",13=>"河北",14=>"山西",15=>"内蒙古",21=>"辽宁",22=>"吉林",23=>"黑龙江",31=>"上海",32=>"江苏",33=>"浙江",34=>"安徽",35=>"福建",36=>"江西",37=>"山东",41=>"河南",42=>"湖北",43=>"湖南",44=>"广东",45=>"广西",46=>"海南",50=>"重庆",51=>"四川",52=>"贵州",53=>"云南",54=>"西藏",61=>"陕西",62=>"甘肃",63=>"青海",64=>"宁夏",65=>"新疆",71=>"台湾",81=>"香港",82=>"澳门",91=>"国外");

    if (!preg_match('/^\d{17}(\d|x)$/i', $id_card)) {
        return FALSE;
    }

    if (!isset($aCity[(int)substr($id_card, 0, 2)])) {
        return FALSE;
    }

    $bir = substr($id_card, 6, 4).'-'.substr($id_card, 10, 2).'-'.substr($id_card, 12, 2);
    if (strtotime($bir) === FALSE) {
        return FALSE;
    }
    
    return TRUE;
}

/**
 * @验证邮箱数组
 * @param array $arr:邮箱数组
 * @return 验证通过的邮箱数组
 * */
function get_email_arr($arr)
{
    $reg = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
    for($i=0;$i<count($arr);$i++) {
        if (preg_match($reg, $arr[$i])) {
            $email[] = $arr[$i];
        }
    }
    return $email;
}

/**
 * 获取ip
 * @return:ip
 * */
function getIp()  
{
    $ip = '0.0.0.0';
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
	{
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

/**
 * @获取随机字符串
 * @param number $len:字符长度
 * @param number $type:类型
 * @return:一定长度的随机字符串
 * */
function randomStr($len=4, $type=1)   
{
    switch ($type) {
        case 1 : $str = '0123456789';
        break;
        case 2 : $str = 'abcdefghigklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        break;
        case 3 : $str = 'abcdefghigklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        break;
    }
	$word = '';
	for($i=0;$i<$len;$i++){
		$word .= $str[mt_rand(0,strlen($str)-1)];
	}
	return $word;
}

/**
 * @列出目录文件
 * @param string $filedir：目录
 * @return:$file_name:文件夹下文件名称数组
 * */
function showDir( $filedir = '.' ) {
    $dir = @ dir($filedir);
    while (($file = $dir->read())!==FALSE) //可替换为 while(($file = readdir($dir)) !== FALSE)
    {
        if (is_dir($filedir."/".$file) AND ($file!=".") AND ($file!="..")) {
            showDir($filedir."/".$file);
        }else{
            $file_name[] = $filedir."/".$file;
        }
    }
    $dir->close();
    return $file_name;
}

/**
 * @生成文件
 * @param string $file:需要写入的文件或者二进制流
 * @return $filename:需要生成的文件名的绝对路径
 **/
function create_file($file, $filename)
{
    $write = @fopen($filename, "w");
    if ($write==FALSE) {
        return FALSE;
    }
    if (fwrite($write, $file)==FALSE) {
        return FALSE;
    }
    if (fclose($write)==FALSE) {
        return FALSE;
    }
    return TRUE;
}

/**
 * 人民币小写转大写
 *
 * @param string $number   待处理数值
 * @param bool   $is_round 小数是否四舍五入,默认"四舍五入"
 * @param string $int_unit 币种单位,默认"元"
 * @return string
 */
function rmb_format($money = 0, $is_round = TRUE, $int_unit = '元') {
    $chs     = array (0, '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖');
    $uni     = array ('', '拾', '佰', '仟' );
    $dec_uni = array ('角', '分' );
    $exp     = array ('','万','亿');
    $res     = '';
    // 以 元为单位分割
    $parts   = explode ( '.', $money, 2 );
    $int     = isset ( $parts [0] ) ? strval ( $parts [0] ) : 0;
    $dec     = isset ( $parts [1] ) ? strval ( $parts [1] ) : '';
    // 处理小数点
    $dec_len = strlen ( $dec );
    if (isset ( $parts [1] ) && $dec_len > 2) {
        $dec = $is_round ? substr ( strrchr ( strval ( round ( floatval ( "0." . $dec ), 2 ) ), '.' ), 1 ) : substr ( $parts [1], 0, 2 );
    }
    // number= 0.00时，直接返回 0
    if (empty ( $int ) && empty ( $dec )) {
        return '零';
    }
    
    // 整数部分 从右向左
    for($i = strlen ( $int ) - 1, $t = 0; $i >= 0; $t++) {
        $str = '';
        // 每4字为一段进行转化
        for($j = 0; $j < 4 && $i >= 0; $j ++, $i --) {
            $u   = $int{$i} > 0 ? $uni [$j] : '';
            $str = $chs [$int {$i}] . $u . $str;
        }
        $str = rtrim ( $str, '0' );
        $str = preg_replace ( "/0+/", "零", $str );
        $u2  = $str != '' ? $exp [$t] : '';
        $res = $str . $u2 . $res;
    }
    $dec = rtrim ( $dec, '0' );
    // 小数部分 从左向右
    if (!empty ( $dec )) {
        $res .= $int_unit;
        $cnt =  strlen ( $dec );
        for($i = 0; $i < $cnt; $i ++) {
            $u = $dec {$i} > 0 ? $dec_uni [$i] : ''; // 非0的数字后面添加单位
            $res .= $chs [$dec {$i}] . $u;
        }
        if ($cnt == 1) $res .= '整';
        $res = rtrim ( $res, '0' ); // 去掉末尾的0
        $res = preg_replace ( "/0+/", "零", $res ); // 替换多个连续的0
    } else {
        $res .= $int_unit . '整';
    }
    return $res;
}

/**
 * CURL 获取参数
 * @param unknown $url:地址
 * @param unknown $keysArr:参数
 * @param string $mothod:获取方式
 * @return unknown
 */
function fn_get_contents($url, $keysArr=array(), $mothod='get')
{
    $ch = curl_init() ;
    $ssl = substr($url, 0, 8) == "https://" ? TRUE : FALSE;
    if (!$ssl) {
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE ) ;
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST,2);
        curl_setopt( $ch, CURLOPT_SSLVERSION, 4);
    }
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE ) ;
    if (strtolower($mothod) == 'post'){
        curl_setopt( $ch, CURLOPT_POST, TRUE ) ;
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $keysArr ) ;
    } else {
        $url = $url . "?" . http_build_query( $keysArr ) ;
    }
    curl_setopt( $ch, CURLOPT_URL, $url ) ;
    $ret = curl_exec( $ch ) ;
    curl_close( $ch ) ;
    return $ret;
}

/**
 * 根据经纬度获取距离
 * @param string $lnglat1：原点经纬度
 * @param string $lnglat2：目标经纬度
 * */
function get_dis($lnglat1, $lnglat2)
{
    $lnglat1_arr = explode(',', $lnglat1);
    $lnglat2_arr = explode(',', $lnglat2);
    $lat1 = $lnglat1_arr[1];
    $lng1 = $lnglat1_arr[0];
    $lat2 = $lnglat2_arr[1];
    $lng2 = $lnglat2_arr[0];
    return round(6378.138*2*asin(sqrt(pow(sin( ($lat1*pi()/180-$lat2*pi()/180)/2),2) + cos($lat1*pi()/180) * cos($lat2*pi()/180) * pow(sin(($lng1*pi()/180-$lng2*pi()/180)/2),2)))*1000);
}

/**
 * 根据经纬度获取地址信息
 * @param string $lnglat：经纬度（默认杭州）
 * */
function get_address_by_lnglat($lnglat='')
{
    $lnglat = empty($lnglat) ? '120.181139,30.316008' : $lnglat;
    $lnglat_arr = explode(',' ,$lnglat);
    $lat = empty($lnglat_arr[1]) ? '30.316008' : $lnglat_arr[1];
    $lng = empty($lnglat_arr[0]) ? '120.181139' : $lnglat_arr[0];
    $content = file_get_contents("http://api.map.baidu.com/geocoder/v2/?ak=1dc771f8e1d5ab15e12a9503773c18f3&location={$lat},{$lng}&output=json&pois=0");
    return json_decode($content);
}

/**
 * @根据ip获取经纬度及地址
 * */
function get_lnglat_by_ip()
{
    $getIp = getIp();
    if (in_array($getIp, array('127.0.0.1', '0.0.0.0'))) {
        return FALSE;
    }
    $content = file_get_contents("http://api.map.baidu.com/location/ip?ak=1dc771f8e1d5ab15e12a9503773c18f3&ip={$getIp}&coor=bd09ll");
    $json = json_decode($content);
    $lnglat = $json->{'content'}->{'point'}->{'x'}.','.$json->{'content'}->{'point'}->{'y'};
    $add = $json->{'content'}->{'address'};
    $prov = $json->{'content'}->{'address_detail'}->{'province'};
    $city = $json->{'content'}->{'address_detail'}->{'city'};
    return array('lnglat'=>$lnglat, 'address'=>$add, 'province'=>$prov, 'city'=>$city);
}

/**
 * @根据地址获取经纬度 
 * */
function get_lnglat_by_address($address, $city)
{
    $content = file_get_contents("http://api.map.baidu.com/geocoder/v2/?ak=1dc771f8e1d5ab15e12a9503773c18f3&output=json&address={$address}&city={$city}");
    $json = json_decode($content);
    if (empty($json->{'result'})) {
        $content = file_get_contents("http://api.map.baidu.com/geocoder/v2/?ak=1dc771f8e1d5ab15e12a9503773c18f3&output=json&address={$city}");
        $json = json_decode($content);
    }
    $lnglat = $json->{'result'}->{'location'}->{'lng'}.','.$json->{'result'}->{'location'}->{'lat'};
    return $lnglat;
}

/**
 * @字符串格式化为英文逗号的字符串，并排序
 * @param string $str
 * */
function toEnComma($str, $sep = ',')
{
    $str = str_replace('，', ',', $str);
    $str_arr = @explode(',', $str);
    $str_arr = array_flip(array_flip($str_arr));  // 去除重复值
    $new_arr = array();
    foreach ($str_arr as $s) {
        $s = trim($s);
        if(!empty($s)) {
            if (mb_strlen($s, 'utf8') == 11) {
                if (is_mobile($s)) $new_arr[] = $s;
            } else {
                $new_arr[] = $s;
            }
        }
    }
    asort($new_arr);
    return @implode($sep, $new_arr);
}

/**
 * @根据空行切割数组
 * */
function txt2arr()
{
    $data = file_get_contents('wosign.txt');
    $res = preg_split('/([\r\n]+)\\1/', $data);
}
