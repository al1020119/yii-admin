<?php
namespace common\helper;

class FilterHalper {

    /**
     * 判断全是中文
     */
    public static function isAllChinese($str) {
        if (preg_match_all("/^([\x81-\xfe][\x40-\xfe])+$/", $str, $match)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 判断含有中文 （方法2）
     */
    public static function hasChinese($str) {
        if (preg_match("/([\x81-\xfe][\x40-\xfe])/", $str, $match)) {
            return true;
        } else {
            return false;
        }
    }

}




