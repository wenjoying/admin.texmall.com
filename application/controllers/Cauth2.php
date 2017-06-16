<?php
/**
 * Cauth2.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月13日
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'auth2.0/PDOoauth2.php';

class Cauth2 extends TM_Controller {
    private $table = 'auth_clients';
    
    public function _init()
    {
        header("Content-type: text/html; Charset=utf-8");
    }
    
    /**
     * @应用列表
     * */
    public function grid()
    {
        $this->checkAction(__METHOD__);
        
        $data['res'] = $this->Base_model->getTable($this->table)->result();
        $data['one_level'] = '网站设置';
        $data['two_level'] = '应用授权';
        $this->load->view('auth_clients/vgrid', $data);
    }
    
    /**
     * @申请应用appid
     * */
    public function add()
    {
        $this->checkAction(__METHOD__);
        
        $data['one_level'] = '网站设置';
        $data['two_level'] = '应用授权';
        $this->load->view('auth_clients/vadd', $data);
    }
    
    /**
     * @新增应用appid
     * */
    public function addPost()
    {
        $postData = $this->input->post();
        $auth = new PDOoauth2();
        $appid = randomStr(16, 3);
        $redirect = $auth->checkappid($appid);
        if (!$redirect) {
            $appname = $postData['appname'];
            $redirect = $postData['redirect_uri'];
            $appsec = randomStr(32, 3);
            $auth->addClient($appid, $appname, $appsec, $redirect);
            alert_msg('应用申请成功', 'Cauth2/grid');
        } else {
            alert_msg('请重新填写');
        }
    }
    
    /**
     * @删除
     * */
    public function delete($appid = 0)
    {
        $this->checkAction(__METHOD__);
        
        $res = $this->Base_model->delete($this->table, array('appid'=>$appid));
        if ($res>0) {
            alert_msg('操作成功', 'Cthird_manage/grid');
        }else{
            alert_msg('操作失败');
        }
    }
    
    /**
     * @获取应用配置
     * */
    public function get_client($key = '')
    {
        $client = array(
            'appid'      =>  '',    //客户端appid
            'secret'     =>  '',    //密钥
            'response'   =>  'code',    
            'redirect'   =>  '',    //回调地址
            'grant'      =>  'authorization_code'   //授权方式
        );
        return empty($key) ? $client : $client[$key];
    }
    
    /**
     * @授权登陆
     * @param string $mobile:手机号
     * @param string $password:密码
     * */
    public function authorize()
    {
        $postData = $this->input->post();
        $oauth = new PDOoauth2();
        $ck_user = $oauth->ckUser(trim($postData['mobile']), ZD_md5($postData['password']));
        if (empty($ck_user['id'])) {
            alert_msg('用户不存在');
        }
        
        $client = $this->get_client();
        $conf = array(
            'client_id'      => $client['appid'],
            'client_secret'  => $client['secret'],
            'response_type'  => $client['response'],
            'redirect_uri'   => $client['redirect']
        );
        $token = $oauth->getToken($ck_user['id'], $client['appid']);
        if (empty($token)) {
            $oauth->finishClientAuthorization(TRUE, $ck_user['id'], $conf);
        }
        
        if ($token['expires'] < time()-10) {
            $oauth->finishClientAuthorization(TRUE, $ck_user['id'], $conf);
        } else {
            $user = $this->getUserinfo($token['oauth_token']);
            alert_msg('登陆成功');
        }
    }
    
    /**
     * @回调地址
     * $_GET['code']:code码换取token，再换取用户信息
     * @$user:用户信息
     * */
    public function auth()
    {
        if (isset($_GET['code'])) {
            $user = $this->getUserinfo($this->getToken());
            echo json_encode(array('errcode'=>0, 'errmsg'=>'ok', 'data'=>$user));
            exit();
        } else {
            $this->getJson(10001);
        }
    }
    
    /**
     * @请求token
     * */
    public function getToken()
    {
        require_once 'http.class.php';
        $http = new PPHTTP();
        $client = $this->get_client();
        $array = array(
            'client_id'     => $client['appid'],
            'client_secret' => $client['secret'],
            'redirect_uri'  => $client['redirect'],
            'grant_type'    => $client['grant'],
            'code'          => $_GET['code']
        );
        $result = $http->httppost(base_url('Cauth2/token'), $array);
        $assoc = json_decode($result, true);
        return $assoc['access_token'];
    }
    
    /**
     * @获得token
     * */
    public function token()
    {
        $oauth = new PDOoauth2();
        $oauth->grantAccessToken();
    }
    
    /**
     * @请求用户消息
     * */
    public function getUserinfo($token)
    {
        require_once 'http.class.php';
        $http = new PPHTTP();
        $result = $http->httppost(base_url('Cauth2/user_info'), array('oauth_token'=>$token));
        return json_decode(trim($result,chr(239).chr(187).chr(191)));
    }
    
    /**
     * @获取用户消息
     * */
    public function user_info()
    {
        $oauth = new PDOoauth2();
        $status = $oauth->verifyAccessToken();
        if ($status !== TRUE) {
            alert_msg('TOKEN无效');
        }
            
        $token = $this->Base_model->getWhere('auth_tokens', array('oauth_token'=>$_POST['oauth_token']), 'expires desc');
        if ($token->num_rows() == 0) {
            alert_msg('TOKEN无效');
        }
            
        $user = $this->Base_model->getWhere('user', array('user.id'=>$token->row()->uid))->row();
        echo json_encode($user);    
    }
    
}
/** End of file Cauth2.php */
/** Location: ./application/controllers/Cauth2.php */