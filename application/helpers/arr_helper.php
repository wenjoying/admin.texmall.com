<?php
/**
 * @预定义数组
 * */

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