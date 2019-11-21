<?php
namespace common\helper;

use Yii;

class CacheHelper {

    /*销毁所有缓存数据*/
    public static function destoryAllCache() {
        Yii::$app->cache->flush();
    }

    /*清空搜索缓存*/
    public static function destorySearchQuery() {
        Yii::$app->cache->delete('db_name');
        Yii::$app->cache->delete('table_name');
        Yii::$app->cache->delete('field_name');
    }

}