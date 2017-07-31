<?php
/**
 * @预定义数组
 * */

/**
 * @错误数组
 * @param string/int $errcode：错误码
 * @param boolean $errmsg：错误描述
 * @param mix $data：数据
 * */
function getJson($index=0, $data=null) 
{
    $arr = array(
        '0' => array(
            'errcode'   => '0',
            'errmsg'    => 'success',
            'data'      => $data
        ),
        '1001' => array(
            'errcode'   => '1001',
            'errmsg'    => '系统错误'
        ),
        '1002' => array(
            'errcode'   => '1002',
            'errmsg'    => '请登录'
        ),
    );
    echo isset($arr[$index]) ? json_encode($arr[$index]) : json_encode($arr['1001']);
    exit;
}

/**
 * @获取一般状态
 * */
function get_status($index = 0)
{
    $arr = array(
        '1' => '正在审核',
        '2' => '审核通过',
        '3' => '审核不通过',
    );
    if ($index === 0) {
        return $arr;
    }
    return isset($arr[$index]) ? $arr[$index] : FALSE;
}

/**
 * @注册来源
 * */
function get_reg_come($index = 0)
{
    $arr = array(
        '1' => 'web',
        '2' => 'Android',
        '3' => 'iOS',
        '4' => '微信',
        '5' => '后台',
        '6' => '其他'
    );
    if ($index === 0) {
        return $arr;
    }
    return isset($arr[$index]) ? $arr[$index] : FALSE;
}

/**
 * @企业性质
 * */
function get_enterprise_nature()
{
    return array(
        '1' => '个体工商户',
        '2' => '企业',
        '3' => '企业单位',
        '4' => '民办非企业单位',
        '5' => '社会团体',
        '6' => '其他'
    );
}

/**
 * @订单分类
 * */
function get_oreder_state()
{
    return array(
        '1' => '未付款', 
        '2' => '已付款', 
        '3' => '已完成', 
        '4' => '评价', 
        '5' => '退款/售后'
    );
}

/**
 * @订单状态
 * */
function get_order_status()
{
    return array(
        '1' => '取消订单', 
        '2' => '未签合同', 
        '3' => '待付款', 
        '4' => '已付款', 
        '5' => '备货中', 
        '6' => '已发货', 
        '7' => '已收货', 
        '8' => '已评价'
    );
}

/**
 * @认证审核状态
 * */
function get_auth_status()
{
    return array(
        '1' => '正在审核',
        '2' => '已打款',
        '3' => '审核通过',
        '4' => '一次错误',
        '5' => '二次错误',
        '6' => '审核不通过'
    );
}


