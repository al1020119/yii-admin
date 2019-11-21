<?php

namespace backend\models\mongo;

use yii\mongodb\ActiveRecord;

/**
 * //--->MongoDB连接数据查看处理<---
 *
 * echo "1.------------------------------------------------------------------------------------------------";
 * //直接获取集合数据,通过集合名字，数据类型(yii\mongodb\Collection)
 * $reportKey = 'meta_admin_user';
 * // @var Connection $db
 * $db = \Yii::$app->mongodb;
 * $reporData = $db->getCollection($reportKey);
 * var_dump($reporData);
 *
 * echo "2.------------------------------------------------------------------------------------------------";
 * //查询构造器获取mongoDB对应集合数据(相比getCollection方便排序)
 * $collectionName = 'meta_admin_user';
 * $queryData = (new MetaQuery())
 * ->from($collectionName)
 * ->all();
 * var_dump($queryData);
 *
 * echo "3.------------------------------------------------------------------------------------------------";
 * //根据模型(ActivedRecord)查询对应集合数据
 * $id = '5db80a6ab580862cf87a5592';
 * $modelData = AdminUser::findAll(['_id' => $id]);
 * var_dump($modelData);
 *
 * //--->MongoDB连接数据查看处理<---
 */
class MetaMongo extends ActiveRecord
{

    public static function collectionName()
    {
        return 'meta_admin_user';
    }

    public function attributes()
    {
        return [
            '_id',
            'username',
            'user_level',
            'password_hash',
            'auth_key',
            'email',
            'status',
            'created_at',
            'updated_at',
            'remarks'
        ];
    }
}