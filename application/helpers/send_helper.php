<?php
/**
 * 发送帮助函数，
 * send_email：发送邮件
 * send_sms：发送短信
 * send_push：极光推送
 * 
 * */


/**
 * @param string $frome:发送邮箱
 * @param string $password:发送邮箱密码
 * @param string $fromu:发送人
 * @param string $toe:接受邮箱
 * @param string $info:邮件内容
 * @param string $copye:抄送邮箱
 * @param string $theme:主题
 * @param string $attach:附件
 */
function send_email($frome, $password, $fromu, $toe, $info, $copye=null, $theme=null, $attach=null)
{
    $CI =& get_instance();
    $CI->load->library('email');
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'smtp.126.com';  //  'smtp.qq.com'  'smtp.126.com'
    $config['smtp_user'] = $frome;
    $config['smtp_pass'] = $password;
    $config['smtp_port'] = '25';
    $config['wordwrap'] = TRUE;
    $config['charset'] = 'utf-8';
    $config['validate'] = TRUE;
    $config['mailtype'] = 'html';
    $config['newline'] = "\r\n";   //重要
    $config['crlf'] = "\r\n";      //重要
    $CI->email->initialize($config);
    $CI->email->from($frome, $fromu);
    $CI->email->to($toe);
    if($copye) $CI->email->cc($copye);
    if($theme) $CI->email->subject($theme);
    if($attach) {
        foreach ($attach as $a) {
            $CI->email->attach($a);  //参数用路径而不是URL
        }
    }
    $CI->email->message($info);
    $email = $CI->email->send();
    //echo $CI->email->print_debugger();
    $CI->email->clear(TRUE);
    return $email;
}

/**
 * @param string $code:验证码
 * @param string $limit：有效期
 * @param string $mobile：发送手机号
 * @return array $sms：发送结果
 * */
function send_sms($code, $limit, $mobile, $tempId=22680)   //发送短信
{
    $CI =& get_instance();
    $data = array($code, $limit);
    $accountSid= '8a48b551510f653b0151130a74a80b19';
    $accountToken= '90e8987ccae24a0d863af182596095bd';
    $appId='aaf98f8952f7367a015317ced8a13d8e';
    $CI->load->library('REST');
    $CI->rest->setAccount($accountSid, $accountToken);
    $CI->rest->setAppId($appId);
    $result = objectToArray($CI->rest->sendTemplateSMS($mobile, $data, $tempId));
    if($result == NULL) {
        $sms['status'] = FALSE;
        $sms['res'] = NULL;
    }
    if($result['statusCode'] != '000000') {
        $sms['status'] = FALSE;
        $sms['res'] = $result;
    } else {
        $sms['status'] = TRUE;
        $sms['res'] = strtotime($result['TemplateSMS']['dateCreated']);
    }
    return $sms;
}

/**
 * @param string $msg:消息内容
 * @param string $title:消息标题
 * @param array $alia:别名
 * @param array $tag:标签
 * @param array $extra:扩展字段
 * @param array $plat:推送平台
 * @return blean $send：发送结果
 */
function send_push($msg, $title, $alia=array(), $tag=array(), $extra=array(), $plat=array('ios', 'android'))
{
    $CI =& get_instance();
    ini_set("display_errors", "On");
    error_reporting(E_ALL | E_STRICT);
    $CI->load->library('JPush');
    /**@ 完整的推送示例,包含指定Platform,指定Alias,Tag,指定iOS,Android notification,指定Message等*/
    if(empty($alia) && empty($tag)) {
        $result = $CI->jpush->push()->setPlatform($plat)->addAllAudience();
    } else {
        $result = $CI->jpush->push()->setPlatform($plat)->addAlias($alia)->addTag($tag);
    }
    
    $res = $result->setNotificationAlert($msg)
    ->addAndroidNotification($msg, $title, 1, $extra)
    ->addIosNotification($msg, 'iOS sound', '+1', TRUE, 'iOS category', $extra)
    //->setMessage("msg content", 'msg title', 'type', array("key1"=>"value1", "key2"=>"value2"))
    ->setOptions(null, 86400, null, TRUE)->send();
    
    if(isset($res->data)) {
        $push = TRUE;
    } else {
        $push = FALSE;
    }
    return $push;
}