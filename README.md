元数据管理系统(MetaData)
===============================

### 元数据管理系统测试版：

线上版
+ meta.etc.gplqdb.com
+ host:
    + 118.25.78.235	 meta.etc.gplqdb.com
测试版：http://local.metadata.admin.com
本地版：http://local.bi.metadata.com/

### MySQL只读账号
+ MySQL账号密码信息
+ host: metadb.gplqdb.com   
+ ip: 10.128.24.11
+ 账号：caolipeng
+ 密码：Ws3fvrg677!2hj7

## 角色

+ 超级管理员：administrator
> 可以做管理系统所有操作

+ 普通管理员：admin
> 只能修改密码，增删查改元数据

+ 普通用户：normal
> 只能浏览元数据
 
## 管理员(用户)
超级管理员：创建管理员，用户，不能编辑和操作元数据
+ admin:111111	 noreply@gaopeng.com
管理员：只能编辑和操作元数据
+ icocos:123456	 icocos.cao@wetax.com.cn 
+ kenneth:123456 kenneth.fang@wetax.com.cn
+ jesse:123456	 jesse.liu@wetax.com.cn 
+ cxlong:123456	 cxlong.chen@wetax.com.cn
普通用户： 只能查看元数据
+ general:123456 general.user@wetax.com.cn    

## 数据库

------------- meta_admin_user : 管理员用户表 ------------- 

唯一标识 id
用户名 username
用户级别 user_level
授权key auth_key		
密码哈希 password_hash	
邮箱 email
状态 status
创建时间 created_at		
更新时间 updated_at
用户标识备注 remarks

``code
CREATE TABLE `meta_admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户唯一标识',
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '管理员登录名',
  `user_level` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '用户级别,0:超级管理员,1:管理员,2:普通用户',
  `password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '密码哈希',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '认证密钥',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '管理员邮箱',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '管理员状态,1:可用,0:不可用',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `remarks` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户标识备注[名称]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=1601 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='管理员用户表'
``

INSERT INTO `metadata`.`meta_admin_user`(`id`, `username`, `user_level`, `auth_key`, `password_hash`, `email`, `status`, `created_at`, `updated_at`, `remarks`) VALUES (1, 'admin', '0', 'rD-vD632aVc3mQQZm0zw0uJrZB-Zvx1A', '$2y$13$Ugf7/miRElIXJugi6ZnLae3LpjIwVDpS0hWxk/YZy7uUrXj7pb1wu', 'noreply@gaopeng.com', 1, '2019-11-08 07:00:50', '2019-11-08 07:00:50', '超级管理员');
INSERT INTO `metadata`.`meta_admin_user`(`id`, `username`, `user_level`, `auth_key`, `password_hash`, `email`, `status`, `created_at`, `updated_at`, `remarks`) VALUES (2, 'icocos', '1', 'V_3tkqF1QCr1hNfmh1Xbjfuuxa4eIG3E', '$2y$13$0cbSuvgrYsYwdVdEArQRv.V0F54Sq/aSpO40rDpjM077ClJPZ6E2i', 'icocos.cao@wetax.com.cn', 1, '2019-11-08 07:00:50', '2019-11-08 07:00:50', '曹理鹏');
INSERT INTO `metadata`.`meta_admin_user`(`id`, `username`, `user_level`, `auth_key`, `password_hash`, `email`, `status`, `created_at`, `updated_at`, `remarks`) VALUES (3, 'kenneth', '1', 'M3CpEn1iQde2FSwhd9IdYuMkILjCZOKr', '$2y$13$l1WMhGHKZDe6atr2bL59jueCNByWloe/3QSXAx/BoAsKHAw0Dpi6a', 'kenneth.fang@wetax.com.cn', 1, '2019-11-08 07:00:50', '2019-11-08 07:00:50', '方宇坤');
INSERT INTO `metadata`.`meta_admin_user`(`id`, `username`, `user_level`, `auth_key`, `password_hash`, `email`, `status`, `created_at`, `updated_at`, `remarks`) VALUES (4, 'jesse', '1', 'W6EhaNQjLERTlO5h-cR05EieCIrsHUSL', '$2y$13$MBhEDKhAdi.6TEl1SurSI.OS.EIv6r6YEN7QZzEul18KjmIk1G0s2', 'jesse.liu@wetax.com.cn', 1, '2019-11-08 07:00:50', '2019-11-08 07:00:50', '刘振兴');
INSERT INTO `metadata`.`meta_admin_user`(`id`, `username`, `user_level`, `auth_key`, `password_hash`, `email`, `status`, `created_at`, `updated_at`, `remarks`) VALUES (5, 'cxlong', '1', 'eO6A0-RcK3VON46AeraUWivM_9F2rYBJ', '$2y$13$uiY/brHLfj1ak68HFHSagedXd8vaQvj/nAJClTS6OuJU6QEe0ezbe', 'cxlong.chen@wetax.com.cn', 1, '2019-11-08 07:00:50', '2019-11-08 07:00:50', '陈晓龙');
INSERT INTO `metadata`.`meta_admin_user`(`id`, `username`, `user_level`, `auth_key`, `password_hash`, `email`, `status`, `created_at`, `updated_at`, `remarks`) VALUES (6, 'general', '2', 'bqT1YNp6WfCYCcyejAndC5bnWmT52ikD', '$2y$13$BFBZIzzHG20rOopiYPjwzucacYGJe3sXnDk0va4sffql9y/JCsVd.', 'general.user@wetax.com.cn', 1, '2019-11-08 07:00:50', '2019-11-08 07:00:50', '普通用户');

------------- meta_db_system : 数据库元数据表 ------------- 

唯一标识 id
库名 db_name
表名 table_name
表描述 table_desc
字段名 field_name
字段中文名称 field_desc
字段的类型 field_type
字段的取值 field_value
字段值中文名称 field_value_desc
状态 status
创建人 create_author
创建时间 created_at
修改人 updated_author
修改时间 updated_at
备注 comment

``code
CREATE TABLE `meta_db_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `db_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '库名',
  `table_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '表名',
  `table_desc` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT '表描述',
  `field_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '字段名',
  `field_desc` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT '字段描述',
  `field_type` tinyint(11) NOT NULL COMMENT '字段类型',
  `field_value` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT '字段取',
  `field_value_desc` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT '字段值描述',
  `source_type` tinyint(1) NOT NULL COMMENT '数据源',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `created_author` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '创建人',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_author` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '更新人',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='数据库元数据表'
``

alter table meta_admin_user add column source_type tinyint(1) not null after id;

------------- meta_db_system_record : 数据库元数据操作记录表 ------------- 

唯一标识 id
元数据id meta_id
创建人 author
操作类型 action_type
操作记录 action_content
创建时间 created_at
修改时间 updated_at

``code
CREATE TABLE `meta_db_system_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `meta_id` int(11) NOT NULL COMMENT '元数据id',
  `author` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '创建人',
  `action_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '操作类型(新增，修改，删除)',
  `action_content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '操作记录',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `record_id` (`meta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='数据库元数据操作记录表'
``

INSERT INTO `metadata`.`meta_db_system` (`id`, `db_name`, `table_name`, `table_desc`, `field_name`, `field_desc`, `field_value`, `field_value_type`, `field_value_desc`, `status`, `create_author`, `created_at`, `updated_author`, `updated_at`, `comment`) VALUES (1, 'etc', 'etc_apply_orders', '省办订单表', 'free_type', '省办方式', '0', '6', '押金模式', 0, 'icocos', '2019-11-06 09:01:38', 'icocos', '2019-11-06 09:02:55', '增加押金模式申办方式');

### MongoDB处理

```code
//--->MongoDB连接数据查看处理<---

$reportKey = 'meta_admin_user';
/** @var Connection $db */
$db = \Yii::$app->mongodb;
$reporData = $db->getCollection($reportKey);
var_dump($reporData);


// 查询构造器获取mongoDB对应集合数据(相比getCollection方便排序)
$collectionName = 'meta_admin_user';
$queryData = (new MetaQuery())
    ->from($collectionName)
    ->all();
var_dump($queryData);

//根据模型(ActivedRecord)查询对应集合数据
$id = '5db80a6ab580862cf87a5592';
$modelData = AdminUser::findAll(['_id' => $id]);
var_dump($modelData);

//--->MongoDB连接数据查看处理<---
```