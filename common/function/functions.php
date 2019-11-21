<?php
/**
 * Created by PhpStorm.
 * User: iCocos
 * Date: 2019/9/10
 * Time: 20:55
 */

/*
 * 自定义打印函数
 */
function dd()
{
    $vars = func_get_args();
    if (!empty($vars)) {
        foreach ($vars as $var) {
            var_dump($var);
        }
    }
    die;
}

/*
 * 对数组中的每个元素应用用户自定义函数
 */
function array_flatten($array)
{
    $return = [];

    array_walk_recursive($array, function ($x) use (&$return) {
        $return[] = $x;
    });

    return $return;
}

/*
 * 获取子字符串长度
 */
function mb_subtext($text, $length)
{
    return $length < mb_strlen($text, 'utf8') ? mb_substr($text, 0, $length, 'utf8').'...' : $text;
}