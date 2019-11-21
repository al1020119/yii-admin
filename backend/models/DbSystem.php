<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%db_system}}".
 *
 * @property integer $id
 * @property string $db_name
 * @property string $table_name
 * @property string $table_desc
 * @property string $field_name
 * @property string $field_desc
 * @property string $field_type
 * @property string $field_value
 * @property string $field_value_desc
 * @property integer $source_type
 * @property integer $status
 * @property string $created_author
 * @property string $created_at
 * @property string $updated_author
 * @property string $updated_at
 * @property string $comment
 */
class DbSystem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%db_system}}';
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
                'value' => function(){return date('Y-m-d H:i:s',time()+8*60*60);},
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['db_name', 'table_name', 'table_desc', 'field_name', 'field_desc', 'field_type', 'field_value', 'field_value_desc', 'source_type', 'status'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['db_name', 'table_name', 'field_name', 'field_value', 'created_author', 'updated_author'], 'string', 'max' => 32],

            //[['db_name', 'table_name', 'field_name'], 'match', 'pattern'=>'^[a-zA-Z_]+$','message'=>'输入的名字有误'],
            //[['table_desc', 'field_desc', 'field_value_desc'], 'match', 'pattern'=>'^[\u4E00-\u9FA5]{2,20}$','message'=>'必须中文汉字描述'],

            [['comment'], 'string', 'max' => 255],
        ];
    }

    public static function getDbSysCount() {
        return self::find()->count();
    }

    public static function getYesDbSysCount() {
        $yesCount = self::find()
            ->where([
                'between',
                'created_at',
                date("Y-m-d 00:00:00",strtotime("-1 day")),
                date("Y-m-d 23:59:59",strtotime("-1 day"))
            ])
            ->count();
        return $yesCount;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'db_name' => '数据库名',
            'table_name' => '表名',
            'table_desc' => '表描述',
            'field_name' => '字段名',
            'field_desc' => '字段描述',
            'field_type' => '字段类型',
            'field_value' => '字段值',
            'field_value_desc' => '字段值描述',
            'source_type' => '数据源',
            'status' => '字段状态',
            'created_author' => '创建人',
            'created_at' => '创建时间',
            'updated_author' => '修改人',
            'updated_at' => '修改时间',
            'comment' => '备注',
        ];
    }

    /*查询数据库-表-字段组合*/
    public static function getMetaDbInfo() {
        $data = self::find()->select(['db_name','table_name','field_name'])->groupBy(['db_name','table_name','field_name'])->all();
        return $data;
    }


    /*默认查询数据库*/
    public static function getMetaDbName() {
        $data = self::findBySql("SELECT db_name FROM metadata.meta_db_system GROUP BY db_name ORDER BY db_name ASC")->asArray()->all();
        return $data;
    }

    /*默认查询表*/
    public static function getMetaTableName($db_name) {
        if (empty($db_name)) {
            return [];
        }
        $sql = 'SELECT table_name FROM metadata.meta_db_system where db_name=:db_name GROUP BY table_name ORDER BY table_name ASC';
        $data = self::findBySql($sql, [':db_name'=>$db_name])->asArray()->all();
        return $data;
    }

    /*默认查询字段*/
    public static function getMetaFieldName($table_name) {
        if (empty($table_name)) {
            return [];
        }
        $sql = 'SELECT field_name FROM metadata.meta_db_system where table_name=:table_name GROUP BY field_name ORDER BY field_name ASC';
        $data = self::findBySql($sql, [':table_name' => $table_name])->asArray()->all();
        return $data;
    }


    /*点击后查询表*/
    public static function getMetaTableNameJSON($db_name,$isJson) {
        if (empty($db_name)) {
            $sql = 'SELECT table_name FROM metadata.meta_db_system GROUP BY table_name ORDER BY table_name ASC';
            $data = self::findBySql($sql)->asArray()->all();
            return $data;
            return [];
        }
        $sql = 'SELECT table_name FROM metadata.meta_db_system where db_name=:db_name GROUP BY table_name ORDER BY table_name ASC';
        $data = self::findBySql($sql, [':db_name'=>$db_name])->asArray()->all();

        $data_json = array();
        array_walk_recursive($data,function ($value) use (&$data_json) {
            array_push($data_json,$value);
        });
        if ($isJson) {
            return json_encode($data_json);
        }
        return $data_json;
    }

    /*点击后查询字段*/
    public static function getMetaFieldNameJSON($table_name,$isJson) {
        if (empty($table_name)) {
            $sql = 'SELECT field_name FROM metadata.meta_db_system GROUP BY field_name ORDER BY field_name ASC';
            $data = self::findBySql($sql)->asArray()->all();
            return $data;
            return [];
        }
        $sql = 'SELECT field_name FROM metadata.meta_db_system where table_name=:table_name GROUP BY field_name ORDER BY field_name ASC';
        $data = self::findBySql($sql, [':table_name' => $table_name])->asArray()->all();

        $data_json = array();
        array_walk_recursive($data,function ($value) use (&$data_json) {
            array_push($data_json,$value);
        });
        if ($isJson) {
            return json_encode($data_json);
        }
        return $data_json;
    }

    public static function getFileStatus($index)
    {
        $status = [1 => '使用中', 0 => '已废弃'];
        if (empty($index) && $index != 0) {
            return $index;
        }
        if (isset($status[$index])) {
            return $status[$index];
        }
        return '未知';
    }


    public static function getDbSourceType($index)
    {
        $types = [1 => 'MySQL',2 => 'TDSQL', 3 => 'MongoDB',4 => 'Redis', 5 => 'Hive',6 => 'HBase', 7 => 'RabbitMQ',8 => 'Text', 99 => '未知'];
        if (empty($index)) {
            return $types;
        }
        if (isset($types[$index])) {
            return $types[$index];
        }
        return '未知';
    }

    /*
    整数类型：BIT、BOOL、TINY INT、SMALL INT、MEDIUM INT、 INT、 BIG INT
    浮点数类型：FLOAT、DOUBLE、DECIMAL
    字符串类型：CHAR、VARCHAR、TINY TEXT、TEXT、MEDIUM TEXT、LONGTEXT、TINY BLOB、BLOB、MEDIUM BLOB、LONG BLOB
    日期类型：Date、DateTime、TimeStamp、Time、Year
    其他数据类型：BINARY、VARBINARY、ENUM、SET、Geometry、Point、MultiPoint、LineString、MultiLineString、Polygon、GeometryCollection等
    */
    public static function getFileType($index)
    {
        $types = [1 => 'BIT', 2 => 'BOOL', 3 => 'TINYINT', 4 => 'SMALLINT', 5 => 'MEDIUMINT ', 6 => 'INT', 7 => 'BIGINT',
            11 => 'FLOAT', 12 => 'DOUBLE', 13 => 'DECIMAL',
            21 => 'CHAR', 22 => 'VARCHAR', 23 => 'TINYTEXT', 24 => 'TEXT', 25 => 'MEDIUMTEXT', 26 => 'LONGTEXT', 27 => 'TINYBLOB', 28 => 'BLOB', 29 => 'MEDIUM ', 30 => 'BLOB', 31 => 'LONG ', 32 => 'BLOB',
            41 => 'Date', 42 => 'DateTime', 43 => 'TimeStamp', 44 => 'Time', 45 => 'Year',
            51 => 'BINARY', 52 => 'VARBINARY', 53 => 'ENUM', 54 => 'SET', 55 => 'Geometry', 56 => 'Point', 57 => 'MultiPoint', 58 => 'LineString', 59 => 'MultiLineString', 60 => 'Polygon', 61 => 'GeometryCollection'
        ];
        if (empty($index)) {
            return $types;
        }
        if (isset($types[$index])) {
            return $types[$index];
        }
        return '未知';

    }

    public static function getLastAccessMeta() {
//        $last_access = AdminUser::getSelfModel()->last_access;
//        $last_access_meta = DbSystem::find()->where(['or' , 'updated_at' > $last_access , 'created_at' > $last_access])->all();
//        return $last_access_meta;
    }

}
