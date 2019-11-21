
# show create table meta_admin_user;
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
  `last_access` timestamp NOT NULL DEFAULT '2019-11-11 11:00:00' COMMENT '最近一次访问时间',
  `remarks` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户标识备注[名称]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=1601 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='管理员用户表'

INSERT INTO `metadata`.`meta_admin_user`(`id`, `username`, `user_level`, `password_hash`, `auth_key`, `email`, `status`, `created_at`, `updated_at`, `last_access`, `remarks`) VALUES (1, 'admin', 0, '$2y$13$Ugf7/miRElIXJugi6ZnLae3LpjIwVDpS0hWxk/YZy7uUrXj7pb1wu', 'rD-vD632aVc3mQQZm0zw0uJrZB-Zvx1A', 'aaa@gaopeng.com', 1, '2019-11-08 07:00:50', '2019-11-18 15:47:04', '2019-11-18 15:47:04', '超级管理员');
INSERT INTO `metadata`.`meta_admin_user`(`id`, `username`, `user_level`, `password_hash`, `auth_key`, `email`, `status`, `created_at`, `updated_at`, `last_access`, `remarks`) VALUES (2, '11111', 1, '$2y$13$0cbSuvgrYsYwdVdEArQRv.V0F54Sq/aSpO40rDpjM077ClJPZ6E2i', 'V_3tkqF1QCr1hNfmh1Xbjfuuxa4eIG3E', 'bbb.sd@wetax.com.cn', 1, '2019-11-08 07:00:50', '2019-11-08 07:00:50', '2019-11-11 11:00:00', '安抚');
INSERT INTO `metadata`.`meta_admin_user`(`id`, `username`, `user_level`, `password_hash`, `auth_key`, `email`, `status`, `created_at`, `updated_at`, `last_access`, `remarks`) VALUES (3, '22222', 1, '$2y$13$l1WMhGHKZDe6atr2bL59jueCNByWloe/3QSXAx/BoAsKHAw0Dpi6a', 'M3CpEn1iQde2FSwhd9IdYuMkILjCZOKr', 'ccc.asd@wetax.com.cn', 1, '2019-11-08 07:00:50', '2019-11-08 07:00:50', '2019-11-11 11:00:00', '撒旦法');
INSERT INTO `metadata`.`meta_admin_user`(`id`, `username`, `user_level`, `password_hash`, `auth_key`, `email`, `status`, `created_at`, `updated_at`, `last_access`, `remarks`) VALUES (4, '33333', 1, '$2y$13$MBhEDKhAdi.6TEl1SurSI.OS.EIv6r6YEN7QZzEul18KjmIk1G0s2', 'W6EhaNQjLERTlO5h-cR05EieCIrsHUSL', 'ddd.sadf@wetax.com.cn', 1, '2019-11-08 07:00:50', '2019-11-08 07:00:50', '2019-11-11 11:00:00', '阿斯蒂芬');
INSERT INTO `metadata`.`meta_admin_user`(`id`, `username`, `user_level`, `password_hash`, `auth_key`, `email`, `status`, `created_at`, `updated_at`, `last_access`, `remarks`) VALUES (5, '44444', 1, '$2y$13$uiY/brHLfj1ak68HFHSagedXd8vaQvj/nAJClTS6OuJU6QEe0ezbe', 'eO6A0-RcK3VON46AeraUWivM_9F2rYBJ', 'eee.sadf@wetax.com.cn', 1, '2019-11-08 07:00:50', '2019-11-08 07:00:50', '2019-11-11 11:00:00', '阿斯蒂芬');
INSERT INTO `metadata`.`meta_admin_user`(`id`, `username`, `user_level`, `password_hash`, `auth_key`, `email`, `status`, `created_at`, `updated_at`, `last_access`, `remarks`) VALUES (6, '55555', 2, '$2y$13$BFBZIzzHG20rOopiYPjwzucacYGJe3sXnDk0va4sffql9y/JCsVd.', 'bqT1YNp6WfCYCcyejAndC5bnWmT52ikD', 'fff.user@wetax.com.cn', 1, '2019-11-08 07:00:50', '2019-11-18 15:39:57', '2019-11-18 15:39:57', '阿斯蒂芬');

# show create table meta_db_system;
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='数据库元数据表'

INSERT INTO `metadata`.`meta_db_system`(`id`, `db_name`, `table_name`, `table_desc`, `field_name`, `field_desc`, `field_type`, `field_value`, `field_value_desc`, `source_type`, `status`, `created_author`, `created_at`, `updated_author`, `updated_at`, `comment`) VALUES (1, 'esdaf', 'apasdfders', '申办订单表', 'order_sn', '订单号', 22, '后端产生', '申办订单号', 1, 1, 'admin', '2019-11-14 19:58:45', 'admin', '2019-11-14 20:13:00', '申办订单号');
INSERT INTO `metadata`.`meta_db_system`(`id`, `db_name`, `table_name`, `table_desc`, `field_name`, `field_desc`, `field_type`, `field_value`, `field_value_desc`, `source_type`, `status`, `created_author`, `created_at`, `updated_author`, `updated_at`, `comment`) VALUES (2, 'esdaf', 'apasdfders', '申办订单表', 'free_type', '申办类型', 3, '1', '省份免费', 1, 1, 'admin', '2019-11-14 20:01:44', 'admin', '2019-11-14 20:01:44', '订单申办模式');
INSERT INTO `metadata`.`meta_db_system`(`id`, `db_name`, `table_name`, `table_desc`, `field_name`, `field_desc`, `field_type`, `field_value`, `field_value_desc`, `source_type`, `status`, `created_author`, `created_at`, `updated_author`, `updated_at`, `comment`) VALUES (3, 'esdaf', 'apasdfders', '申办订单表', 'credit_card_bank', '银行申办模式', 3, '0', '默认【非银行】', 1, 1, 'admin', '2019-11-14 20:03:02', 'icocos', '2019-11-14 20:14:32', '银行申办模式');
INSERT INTO `metadata`.`meta_db_system`(`id`, `db_name`, `table_name`, `table_desc`, `field_name`, `field_desc`, `field_type`, `field_value`, `field_value_desc`, `source_type`, `status`, `created_author`, `created_at`, `updated_author`, `updated_at`, `comment`) VALUES (4, 'esdaf', 'apasdfders_log', '申办订单日志表', 'content', '申办订单日志内容', 24, '文本内容', '协定文本', 1, 1, 'admin', '2019-11-14 20:04:25', 'icocos', '2019-11-14 20:14:13', '申办流程日志【待补充】');
INSERT INTO `metadata`.`meta_db_system`(`id`, `db_name`, `table_name`, `table_desc`, `field_name`, `field_desc`, `field_type`, `field_value`, `field_value_desc`, `source_type`, `status`, `created_author`, `created_at`, `updated_author`, `updated_at`, `comment`) VALUES (5, 'esdaf', 'apasdfders_log', '申办订单日志表', 'uid', '用户ID', 7, '随机字符串', '后端生成', 1, 1, 'admin', '2019-11-14 20:05:49', 'icocos', '2019-11-14 20:14:01', '用户识别id与openid关联，小程序授权后就产生');
INSERT INTO `metadata`.`meta_db_system`(`id`, `db_name`, `table_name`, `table_desc`, `field_name`, `field_desc`, `field_type`, `field_value`, `field_value_desc`, `source_type`, `status`, `created_author`, `created_at`, `updated_author`, `updated_at`, `comment`) VALUES (6, 'esdaf', 'apasdfders', '申办订单表', 'status', '订单状态', 7, '50', '激活', 1, 1, 'admin', '2019-11-14 20:07:18', 'admin', '2019-11-14 20:07:18', '用户激活ETC');
INSERT INTO `metadata`.`meta_db_system`(`id`, `db_name`, `table_name`, `table_desc`, `field_name`, `field_desc`, `field_type`, `field_value`, `field_value_desc`, `source_type`, `status`, `created_author`, `created_at`, `updated_author`, `updated_at`, `comment`) VALUES (7, 'esdaf', 'apasdfders', '申办订单表', 'order_sn', '订单号', 22, '后端产生', '申办订单号', 1, 1, 'admin', '2019-11-14 19:58:45', 'admin', '2019-11-14 20:13:00', '申办订单号');
INSERT INTO `metadata`.`meta_db_system`(`id`, `db_name`, `table_name`, `table_desc`, `field_name`, `field_desc`, `field_type`, `field_value`, `field_value_desc`, `source_type`, `status`, `created_author`, `created_at`, `updated_author`, `updated_at`, `comment`) VALUES (8, 'esdaf', 'apasdfders', '申办订单表', 'free_type', '申办类型', 3, '1', '省份免费', 1, 1, 'admin', '2019-11-14 20:01:44', 'admin', '2019-11-14 20:01:44', '订单申办模式');
INSERT INTO `metadata`.`meta_db_system`(`id`, `db_name`, `table_name`, `table_desc`, `field_name`, `field_desc`, `field_type`, `field_value`, `field_value_desc`, `source_type`, `status`, `created_author`, `created_at`, `updated_author`, `updated_at`, `comment`) VALUES (9, 'esdaf', 'apasdfders', '申办订单表', 'credit_card_bank', '银行申办模式', 3, '0', '默认【非银行】', 1, 1, 'admin', '2019-11-14 20:03:02', 'icocos', '2019-11-14 20:14:32', '银行申办模式');
INSERT INTO `metadata`.`meta_db_system`(`id`, `db_name`, `table_name`, `table_desc`, `field_name`, `field_desc`, `field_type`, `field_value`, `field_value_desc`, `source_type`, `status`, `created_author`, `created_at`, `updated_author`, `updated_at`, `comment`) VALUES (10, 'sdafc', '_asdforders_log', '申办订单日志表', 'content', '申办订单日志内容', 24, '文本内容', '协定文本', 1, 1, 'admin', '2019-11-14 20:04:25', 'icocos', '2019-11-14 20:14:13', '申办流程日志【待补充】');
INSERT INTO `metadata`.`meta_db_system`(`id`, `db_name`, `table_name`, `table_desc`, `field_name`, `field_desc`, `field_type`, `field_value`, `field_value_desc`, `source_type`, `status`, `created_author`, `created_at`, `updated_author`, `updated_at`, `comment`) VALUES (11, 'sdafc', '_asdforders_log', '申办订单日志表', 'uid', '用户ID', 7, '随机字符串', '后端生成', 1, 1, 'admin', '2019-11-14 20:05:49', 'icocos', '2019-11-14 20:14:01', '用户识别id与openid关联，小程序授权后就产生');
INSERT INTO `metadata`.`meta_db_system`(`id`, `db_name`, `table_name`, `table_desc`, `field_name`, `field_desc`, `field_type`, `field_value`, `field_value_desc`, `source_type`, `status`, `created_author`, `created_at`, `updated_author`, `updated_at`, `comment`) VALUES (12, 'sdafc', '_asdforders', '申办订单表', 'status', '订单状态', 7, '50', '激活', 1, 1, 'admin', '2019-11-14 20:07:18', 'admin', '2019-11-14 20:07:18', '用户激活ETC');

# show create table meta_db_system_record;
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='数据库元数据操作记录表'

INSERT INTO `metadata`.`meta_db_system_record`(`id`, `meta_id`, `author`, `action_type`, `action_content`, `created_at`, `updated_at`) VALUES (1, 1, 'asgfbg', 0, '{\"db_name\":\"etc\",\"table_name\":\"etc_apply_orders\",\"table_desc\":\"\\u7533\\u529e\\u8ba2\\u5355\\u8868\",\"field_name\":\"order_sn\",\"field_desc\":\"\\u8ba2\\u5355\\u53f7\",\"field_type\":\"22\",\"field_value\":\"\\u540e\\u7aef\\u4ea7\\u751f\",\"field_value_desc\":\"\\u7533\\u529e\\u8ba2\\u5355\\u53f7\",\"source_type\":\"2\",\"status\":\"1\",\"comment\":\"\\u7533\\u529e\\u8ba2\\u5355\\u53f7\"}', '2019-11-14 19:58:45', '2019-11-14 19:58:45');
INSERT INTO `metadata`.`meta_db_system_record`(`id`, `meta_id`, `author`, `action_type`, `action_content`, `created_at`, `updated_at`) VALUES (2, 2, 'asgfbg', 0, '{\"db_name\":\"etc\",\"table_name\":\"etc_apply_orders\",\"table_desc\":\"\\u7533\\u529e\\u8ba2\\u5355\\u8868\",\"field_name\":\"free_type\",\"field_desc\":\"\\u7533\\u529e\\u7c7b\\u578b\",\"field_type\":\"3\",\"field_value\":\"1\",\"field_value_desc\":\"\\u7701\\u4efd\\u514d\\u8d39\",\"source_type\":\"1\",\"status\":\"1\",\"comment\":\"\\u8ba2\\u5355\\u7533\\u529e\\u6a21\\u5f0f\"}', '2019-11-14 20:01:44', '2019-11-14 20:01:44');
INSERT INTO `metadata`.`meta_db_system_record`(`id`, `meta_id`, `author`, `action_type`, `action_content`, `created_at`, `updated_at`) VALUES (3, 3, 'asgfbg', 0, '{\"db_name\":\"etc\",\"table_name\":\"etc_apply_orders\",\"table_desc\":\"\\u7533\\u529e\\u8ba2\\u5355\\u8868\",\"field_name\":\"credit_card_bank\",\"field_desc\":\"\\u94f6\\u884c\\u7533\\u529e\\u6a21\\u5f0f\",\"field_type\":\"3\",\"field_value\":\"0\",\"field_value_desc\":\"\\u9ed8\\u8ba4\\uff0c\\u975e\\u94f6\\u884c\",\"source_type\":\"1\",\"status\":\"1\",\"comment\":\"\\u94f6\\u884c\\u7533\\u529e\\u6a21\\u5f0f\"}', '2019-11-14 20:03:02', '2019-11-14 20:03:02');
INSERT INTO `metadata`.`meta_db_system_record`(`id`, `meta_id`, `author`, `action_type`, `action_content`, `created_at`, `updated_at`) VALUES (4, 4, 'asgfbg', 0, '{\"db_name\":\"etc\",\"table_name\":\"etc_apply_orders_log\",\"table_desc\":\"\\u7533\\u529e\\u8ba2\\u5355\\u65e5\\u5fd7\\u8868\",\"field_name\":\"content\",\"field_desc\":\"\\u7533\\u529e\\u8ba2\\u5355\\u65e5\\u5fd7\\u5185\\u5bb9\",\"field_type\":\"24\",\"field_value\":\"\\u6587\\u672c\\u5185\\u5bb9\",\"field_value_desc\":\"\\u9ed8\\u8ba4\\u540e\\u7aef\\u534f\\u5b9a\\u6587\\u672c\",\"source_type\":\"1\",\"status\":\"1\",\"comment\":\"\\u7533\\u529e\\u6d41\\u7a0b\\u65e5\\u5fd7\\u3010\\u5f85\\u8865\\u5145\\u3011\"}', '2019-11-14 20:04:25', '2019-11-14 20:04:25');
INSERT INTO `metadata`.`meta_db_system_record`(`id`, `meta_id`, `author`, `action_type`, `action_content`, `created_at`, `updated_at`) VALUES (5, 5, 'asgfbg', 0, '{\"db_name\":\"etc\",\"table_name\":\"etc_apply_orders_log\",\"table_desc\":\"\\u7533\\u529e\\u8ba2\\u5355\\u65e5\\u5fd7\\u8868\",\"field_name\":\"uid\",\"field_desc\":\"\\u7528\\u6237ID\",\"field_type\":\"7\",\"field_value\":\"\\u540e\\u53f0\\u968f\\u673a\\u5b57\\u7b26\\u4e32\",\"field_value_desc\":\"\\u9ed8\\u8ba4\\u540e\\u7aef\\u751f\\u6210\",\"source_type\":\"1\",\"status\":\"1\",\"comment\":\"\\u7528\\u6237\\u8bc6\\u522bid\\u4e0eopenid\\u5173\\u8054\\uff0c\\u5c0f\\u7a0b\\u5e8f\\u6388\\u6743\\u540e\\u5c31\\u4ea7\\u751f\"}', '2019-11-14 20:05:49', '2019-11-14 20:05:49');
INSERT INTO `metadata`.`meta_db_system_record`(`id`, `meta_id`, `author`, `action_type`, `action_content`, `created_at`, `updated_at`) VALUES (6, 6, 'asgfbg', 0, '{\"db_name\":\"etc\",\"table_name\":\"etc_apply_orders\",\"table_desc\":\"\\u7533\\u529e\\u8ba2\\u5355\\u8868\",\"field_name\":\"status\",\"field_desc\":\"\\u8ba2\\u5355\\u72b6\\u6001\",\"field_type\":\"7\",\"field_value\":\"50\",\"field_value_desc\":\"\\u6fc0\\u6d3b\",\"source_type\":\"1\",\"status\":\"1\",\"comment\":\"\\u7528\\u6237\\u6fc0\\u6d3bETC\"}', '2019-11-14 20:07:18', '2019-11-14 20:07:18');
INSERT INTO `metadata`.`meta_db_system_record`(`id`, `meta_id`, `author`, `action_type`, `action_content`, `created_at`, `updated_at`) VALUES (7, 1, 'asgfbg', 1, '{\"source_type\":\"1\"}', '2019-11-14 20:13:00', '2019-11-14 20:13:00');
INSERT INTO `metadata`.`meta_db_system_record`(`id`, `meta_id`, `author`, `action_type`, `action_content`, `created_at`, `updated_at`) VALUES (8, 5, 'isgfbgs', 1, '{\"field_value\":\"\\u968f\\u673a\\u5b57\\u7b26\\u4e32\"}', '2019-11-14 20:13:55', '2019-11-14 20:13:55');
INSERT INTO `metadata`.`meta_db_system_record`(`id`, `meta_id`, `author`, `action_type`, `action_content`, `created_at`, `updated_at`) VALUES (9, 5, 'isgfbgs', 1, '{\"field_value_desc\":\"\\u540e\\u7aef\\u751f\\u6210\"}', '2019-11-14 20:14:01', '2019-11-14 20:14:01');
INSERT INTO `metadata`.`meta_db_system_record`(`id`, `meta_id`, `author`, `action_type`, `action_content`, `created_at`, `updated_at`) VALUES (10, 4, 'sgfbgos', 1, '{\"field_value_desc\":\"\\u534f\\u5b9a\\u6587\\u672c\"}', '2019-11-14 20:14:13', '2019-11-14 20:14:13');
INSERT INTO `metadata`.`meta_db_system_record`(`id`, `meta_id`, `author`, `action_type`, `action_content`, `created_at`, `updated_at`) VALUES (11, 3, 'sgfbgos', 1, '{\"field_value_desc\":\"\\u9ed8\\u8ba4\\u3010\\u975e\\u94f6\\u884c\\u3011\"}', '2019-11-14 20:14:32', '2019-11-14 20:14:32');


