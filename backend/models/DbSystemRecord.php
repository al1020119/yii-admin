<?php

namespace backend\models;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%db_system_record}}".
 *
 * @property integer $id
 * @property string $meta_id
 * @property string $author
 * @property string $action_type
 * @property string $action_content
 * @property string $created_at
 * @property string $updated_at
 */
class DbSystemRecord extends \yii\db\ActiveRecord
{
    const ACTION_CREATE = 0;
    const ACTION_UPDATE = 1;
    const ACTION_DELETE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%db_system_record}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',// 自己根据数据库字段修改
                'updatedAtAttribute' => 'updated_at', // 自己根据数据库字段修改, // 自己根据数据库字段修改
                //'value'   => new Expression('NOW()'),
                'value'   => function(){return date('Y-m-d H:i:s',time()+8*60*60);},
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meta_id', 'author', 'action_type', 'action_content', 'created_at','updated_at'], 'required'],
        ];
    }

    public static function getRecordCount() {
        return self::find()->count();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'meta_id' => '元数据ID',
            'author' => '操作人',
            'action_type' => '操作类型',
            'action_content' => '操作内容',
            'created_at' => '操作时间',
            'updated_at' => '更新时间',
        ];
    }

}
