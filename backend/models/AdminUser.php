<?php
namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\data\Pagination;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property integer $user_level
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property string $source_type
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer remarks
 * @property integer last_access
 * @property string $password write-only password
 */
class AdminUser extends ActiveRecord implements IdentityInterface
{
    const ADMIN_ROOT = 0;
    const ADMIN_ADMIN = 1;
    const ADMIN_NORMAL = 2;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public $rememberMe = true;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_user}}';
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

            [['username','email','password_hash'],'required'],
            [['username','email'],'trim'],

            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'unique', 'message' => '该用户名已经存在.'],

            ['email','email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'message' => '该邮箱已经存在.'],

            ['password_hash', 'string', 'min' => 6],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

            ['rememberMe', 'boolean'],

        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * 获取管理员头像
     * @return string
     */
    public static function getAvatar()
    {
        return '/static/images/web/avatar.png';
    }

    /**
     * 获取用户级别
     * @return string
     */
    public static function getUserLevel()
    {
        $admin = self::findOne(Yii::$app->user->getId());
        if (empty($admin)) {
            return;
        }
        if($admin->user_level == 0){
            return self::ADMIN_ROOT;
        } else if($admin->user_level == 1){
            return self::ADMIN_ADMIN;
        }
        return self::ADMIN_NORMAL;
    }

    /**
     * 获取用户级别
     * @return AdminUser
     */
    public static function getSelfModel()
    {
        $admin = self::findOne(Yii::$app->user->getId());
        return $admin;
    }

    /**
     * 获取用户级别
     * @return string
     */
    public static function getUserName()
    {
        $admin = self::findOne(Yii::$app->user->getId());
        if (empty($admin)) {
            return;
        }
        return $admin->username;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }


    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public static function getAdminCount() {
        return self::find()->count();
    }

    /**
     * 获取管理员数据
     * @param array $map
     * @return array
     */
    public function getAdmins($map = [])
    {
        $query = static::find()->select(['id','username','user_level','email','status','created_at','remarks','last_access']);
        if(isset($map['username'])){
            $query->andFilterWhere(['like','username',$map['username']]);
        }
        $pageSize = isset($map['pageSize']) ?$map['pageSize']:10;
        $countQuery = clone $query;
        $pages = new Pagination([
            'pageSize' => $pageSize,
            'totalCount' => $countQuery->count(),
        ]);
        $query->orderBy("created_at desc");
        $items = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return compact('items','pages');
    }

    /**
     * 管理员登录
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if (!$admin = static::findByUsername($this->username)) {
            $this->addErrors(['对不起，该管理员不存在！']);
            return false;
        }
        if (0 == $admin->status) {
            $this->addErrors(['对不起，该管理员已被禁用！']);
            return false;
        }
        if($admin->validatePassword($this->password_hash)){
            return Yii::$app->user->login(static::findByUsername($this->username), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        $this->addErrors(['对不起，密码错误！']);
        return false;
    }

}
