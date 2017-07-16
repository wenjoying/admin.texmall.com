<?php
/**
 * xxx.php
 * ==============================================
 * Copy right 2017 http://www.texmall.com
 * ==============================================
 * @author: zoudong
 * @date: 2017年6月29日
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cad_img extends TM_Controller {
    function grid()
    {
        $page = $this->input->get_post('page') ? $this->input->get_post('page') : 1;
        $pageNum = $this->input->get_post('pageNum') ? $this->input->get_post('pageNum') : 12;
        $goodsType = $this->input->get_post('goodsType');
        $typeArray = array(2=>'women', 1=>'man', 5=>'runhua', 4=>'neiyi', 3=>'qingqu', 78=>'biyuntao');
        if (in_array($goodsType, $typeArray)) {
            $topCatId = array_search($goodsType, $typeArray);
        } else {
            die('抓取类型参数值（goodsType）有误');
        }
        require_once APPPATH.'libraries/phpQuery.php';
        $productUrl = array();
        for ($i=$page; $i<=$pageNum; $i++) {
            phpQuery::newDocumentFile('http://www.taohv.cn/category.php?top_cat_id='.$topCatId.'&page='.$i);
            $items = pq('.plist ul li');
            foreach ($items as $key=>$item) {
                $productUrl[$i][$key]['provide_price'] = preg_replace('/[^\.0123456789]/s', '', pq($item)->find('.pxinxi .xinxileft .xxjiage')->text());
                $productUrl[$i][$key]['url'] = 'http://www.taohv.cn'.pq($item)->find('.ptupian a')->attr('href');
            }
        }
        if (!empty($productUrl)) {
            $item = array();
            foreach ($productUrl as $valueArray) {
                foreach ($valueArray as $value) {
                    phpQuery::newDocumentFile($value['url']);
                    $goods_id = pq('#wrap_con #goods_id')->val();
                    $goods_sku = 'THW' . $goods_id;
                    if (!$goods_id) {
                        continue;
                    }
                    //获取产品属性
                    $attrValues = pq('#wrap_con .basic_con dl');
                    $attrItem = array();
                    foreach ($attrValues as $k => $v) {
                        $attrItem['group_name'] = '女性用品-主体';
                        $attrItem['group_value'][$k]['attr_name'] = trim(pq($v)->find('dt')->text(), '：');
                        $attrItem['group_value'][$k]['attr_value'] = pq($v)->find('dd')->text();
                    }
                    $attr_value = array($attrItem);
                    //获取产品图片
                    $goodsimgs = pq('#wrap_con .mat_js_img dd');
                    $imgItem = array();
                    foreach ($goodsimgs as $kk => $vv) {
                        $imgItem[] = str_replace(array('changeImage(\'', '\');return false;'), array('', ''), pq($vv)->find('a')->attr('onclick'));
                    }
                    $goods_img = implode('|', $imgItem);
                    $item['goods_name'] = mb_convert_encoding(pq('#wrap_con ul.title li:eq(1)')->html(), 'UTF-8', 'GBK');
                    $item['goods_sku'] = $goods_sku;
                    $item['from_id'] = 4; //商品来源
                    //$item['brand_id']             = 0;
                    $item['goods_weight'] = 100;
                    $item['market_price'] = trim(pq('.cpjiage .shijia em')->text(), '￥');
                    $item['shop_price'] = $this->rePrice($value['provide_price']);
                    $item['provide_price'] = $value['provide_price'];
                    $item['promote_start_date'] = 0;
                    $item['promote_end_date'] = 0;
                    $item['attr_set_id'] = array_search($goodsType, array(5=>'women', 4=>'man', 8=>'runhua', 3=>'neiyi', 7=>'qingqu', 2=>'biyuntao'));
                    $item['goods_brief'] = mb_convert_encoding(pq('#wrap_con ul.title li:eq(0)')->html(), 'UTF-8', 'GBK');
                    $item['goods_desc'] = mb_convert_encoding(trim(pq('.brands_con .brands_middle')->html(), ' '), 'UTF-8', 'GBK');
                    $item['wap_goods_desc'] = mb_convert_encoding(trim(pq('.brands_con .brands_middle')->html(), ' '), 'UTF-8', 'GBK');
                    $item['goods_note'] = $value['url'];
                    $item['attr_spec'] = array();
                    $item['attr_value'] = $attr_value;
                    $item['goods_img'] = '';
                    $item['extension_code'] = 'simple';
                    $item['is_on_sale'] = 1;
                    $item['is_check'] = 2;
                    $item['in_stock'] = 100;
                    $item['booking_limit'] = 0;
                    $item['limit_num'] = 0;
                    $item['minus_stock'] = 1;
                    $item['integral'] = 0;
                    $item['supplier_id'] = 15;
                    $item['freight_id'] = 0;
                    $item['freight_cost'] = 0;
                    $item['province_id'] = 12;
                    $item['city_id'] = 123;
                    $item['district_id'] = 1363;
                    $item['address'] = '浙江省 杭州市 下城区 新天地跨贸小镇';
                    $item['auto_cancel'] = 720;
                    //$item['sale_count']           = 0;
                    //$item['review_count']         = 0;
                    //$item['tour_count']           = 0;
                    //$item['sort_order']           = 50;
                    //$item['created_at']           = date('Y-m-d H:i:s');
                    //$item['updated_at']           = date('Y-m-d H:i:s');
                    $result = $this->mall_goods_base->findByGoodsSku($goods_sku);
                    if ($result->num_rows() > 0) {
                        $mallGoodsBase = $result->row(0);
                        $goods_id = $mallGoodsBase->goods_id;
                        $item['goods_id'] = $goods_id;
                        $item['goods_note'] = $value['url'] . '====' . $goods_sku;
                        $item['attr_value'] = $value['attr_value'];
                        if (empty($mallGoodsBase->goods_img)) {
                            $item['goods_img'] = $goods_img;
                        }
                        $update = $this->mall_goods_base->updateCopy($item);
                        $note = '产品ID（' . $goods_id . '）更新';
                    } else {
                        $item['is_check'] = 2;
                        $item['goods_img'] = $goods_img;
                        $goodsId = $this->mall_goods_base->insert($item);
                        $categoryIds = $this->getcategoryIds($goodsType);
                        $isInsert = $this->mall_category_product->insertBatchByGoodsId($goodsId, $categoryIds);
                        $note = '产品ID（' . $goods_id . '）添加';
                    }
                    if ((isset($update) && $update) || (isset($goods_id, $isInsert) && $goods_id && $isInsert)) {
                        echo $note . '成功<br />';
                    } else {
                        echo $note . '失败<br />';
                    }
                    /*
                    if ( $goods_sku != 'THW3682' && $goods_sku != 'THW4772' && $goods_sku != 'THW1153' && $goods_sku != 'THW2979') {
                    pr($item);
                    exit('成功'.$goods_sku);
                    }*/
                }
            }
        }
    }
    
    
    /**
    * 支付宝用户授权登陆
    * access_token  令牌
    * user_id  支付宝用户唯一UID
    */
    public function alipayAuth() {
        $url = "https://openapi.alipay.com/gateway.do"; //测试参数
        $app_id = $this->input->get('app_id');
        $backurl = $this->input->get('backurl');
        $invite_code = $this->input->get('invite_code');
        $param = array(
            'app_id' => $app_id,
            'method' => "alipay.system.oauth.token",
            'charset' => "utf-8",
            'sign_type' => "RSA",
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => "1.0",
            'grant_type' => "authorization_code",
            'code' => $this->input->get('auth_code'),
        );
        $param['sign'] = $this->aliLogin->generateSign($param,$signType = "RSA"); //验证签名
        $result = json_decode($this->fn_get_contents($url,$param,'post'));
        $alipayTokenResponse = $result->alipay_system_oauth_token_response;
        $access_token = $alipayTokenResponse->access_token;//交换令牌--用于获取用户信息
        $user_id = $alipayTokenResponse->user_id; //用户的userId--支付宝用户的唯一userId
        $this->getAlipayUserInfor($access_token,$app_id,$backurl,$invite_code);
    }
    
    /**
    * 获取用户基础信息(姓别，姓名);
    * @param unknown $auth_token
    * https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7386797.0.0.ETCoNL&treeId=53&articleId=104114&docType=1#s5
    */
    private function getAlipayUserInfor($auth_token,$app_id,$backurl,$invite_code) {
        $url = "https://openapi.alipay.com/gateway.do"; //测试参数
        $param = array(
            'method' => "alipay.user.userinfo.share",
            'timestamp' => date('Y-m-d H:i:s'),
            'app_id' => $app_id,
            'auth_token' => $auth_token,
            'charset' => "utf-8",
            'sign_type' => "RSA",
            'version' => "1.0",
        );
        $param['sign'] = $this->aliLogin->generateSign($param,$signType = "RSA"); //验证签名
        $result = json_decode($this->fn_get_contents($url,$param,'post'));
        $alipayUserInfor = $result->alipay_user_userinfo_share_response;
        $this->alipayLoginOperate($alipayUserInfor,$backurl,$invite_code);
    }
    
    /**
    * 阿里授权登陆操作和妙处网会员综合处置
    * @param unknown $alipayUserInfor
    */
    private function alipayLoginOperate($alipayUserInfor,$backurl,$invite_code)
    {
        if (empty($alipayUserInfor)) { //如果授权失败
            $this->redirect(site_url('pc/register'));
        }
        $isAuth = $this->user_bind->getResultByRes(array('other_id'=>$alipayUserInfor->alipay_user_id,'type'=>1),'bind_id,user_id');
        if ($isAuth->num_rows()>0) { //以前授权过
            $user_id = $isAuth->row(0)->user_id;
            $userResult = $this->user->findByUid($user_id);
            if ($userResult->num_rows()<=0) {
                $this->redirect(site_url('pc/register'));
            }
            $user = $userResult->row(0);
            $userInfor = array(
                'uid'       => $user->uid,
                'aliasName' => !empty($user->alias_name) ? $user->alias_name : $user->phone,
                'userPhone' => $user->phone,
                'userEmail' => $user->email,
                'parentId'  => $user->parent_id,
                'userPhoto' => $user->photo,
            );
            set_cookie('frontUser',base64_encode(serialize($userInfor)), 7200);
            $this->cache->memcached->save('frontUser', base64_encode(serialize($userInfor)), 7200);
            $userLog = $this->user_log->insert($user->uid, $ip_from=getIP(), $operate_type=1, $status=1);
            $url = empty($backurl) ? $this->config->main_base_url : $backurl;
            $this->redirect($url); // 直接跳转
        } else {  // 没有授权登陆过
            if ( !empty($invite_code)) {
                $parent = $this->user_invite_code->validateInviteCode($invite_code);
                if ($parent->num_rows() > 0) {
                    $parent_id = $parent->row(0)->uid;
                } else {
                    $parent_id = 1;// 妙处网总部
                }
            } else {
                $parent_id = 1;// 妙处网总部
            }
            $param = array(
                'alias_name' => empty($alipayUserInfor->nick_name) ? '妙处网会员' : $alipayUserInfor->nick_name,
                'sex' => empty($alipayUserInfor->gender) ? '1' : (($alipayUserInfor->gender==m)? 1 : 2),
                'photo' => rand(0, 9).'.jpg',//默认生成一张0-9的jpg图片
            );
            $this->db->trans_start();
            $userId = $this->user->authInsert($param, $parent_id);
            $bindId = $this->user_bind->insert($alipayUserInfor->alipay_user_id,$userId,$type=1);
            $inviteCode = $this->user_invite_code->insert(array('uid'=>$userId)); //自动生成唯一邀请码
            $getCoupon = $this->getCoupon($coupon_set_id = 1, $userId);
            $userLog = $this->user_log->insert($userId, $ip_from=getIP(), $operate_type=1, $status=1);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->redirect(site_url('pc/register'));
            }
            $userInfor = array(
                'uid'       => $userId,
                'aliasName' => $param['alias_name'],
                'userPhone' => '',
                'userEmail' => '',
                'parentId'  => $parent_id,
                'userPhoto' => $param['photo'],
            );
            set_cookie('frontUser', base64_encode(serialize($userInfor)), 7200);
            $this->cache->memcached->save('frontUser', base64_encode(serialize($userInfor)), 7200);
            $url = empty($backurl) ? $this->config->main_base_url : $backurl;
            $this->redirect($url); // 直接跳转
        }
    
    }
}