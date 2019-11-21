<?php
namespace common\services;


class ConstantService {

    // 业务扩展
	public static $client_type_mapping = [
		0 => '',
		1 => 'db',
	];

	public static $low_password = [
		"111111","123456"
	];


	public static $status_default = 2;
	public static $status_mapping = [
        2 => '不限',
		1 => '使用中',
		0 => '已废弃'
	];

}