<?php
/**
 * 日志路径
 */
Yii::setAlias('@logPath',dirname(dirname(dirname(__DIR__))).'/logs/yii-base');

//common目录
Yii::setAlias('@common', dirname(__DIR__));

//模块
Yii::setAlias('@modules', dirname(dirname(__DIR__)).'/modules');

//文件服务器
Yii::setAlias('@file', dirname(dirname(__DIR__)).'/file');

/**
 * 文件服务器根目录
 */
define('UPLOAD_SERVER_WEB_PATH',\Yii::getAlias('@file').'/web');

/**
 * 主域名
 */
define('DOMAIN','360tryst.com');

/**
 * 网站前台域名
 */
define('WEB_URL','http://www.'.DOMAIN);

/**
 * 微信域名
 */
define('WEIXIN_URL','http://weixin.'.DOMAIN);

/**
 * 网站后台域名
 */
define('BACKEND_URL','http://backend.'.DOMAIN);

/**
 * 接口域名
 */
define('REST_URL','http://rest.'.DOMAIN);

/**
 * 文件域名
 */
define('FILE_URL','http://file.'.DOMAIN);

/**
 * 分页大小
 */
define('PAGE_SIZE',20);

//跨域脚本
define('CROSSDOMAINSCRIPT','<script type="text/javascript">document.domain="'.DOMAIN.'";</script>');

