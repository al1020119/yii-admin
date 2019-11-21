<?php
namespace  common\services;

use yii\helpers\Url;

class UrlService {

    public static function buildWebUrl($path,$params = []){
        $path = Url::toRoute(array_merge([$path],$params));
        return $path;
    }

	public static function buildNullUrl(){
		return "javascript:void(0);";
	}

}