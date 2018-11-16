<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name'=>'yii-base',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'homeUrl' => '/site/index',
    'components' => [
        'formatter' => [
            'datetimeFormat' => 'Y-m-d H:i:s',
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        /**
         * 登录
         */
        'login'=>[
            'class'           => 'backend\service\Login',
            'loginSessionKey' => 'keySessionLogin',
            'tokenKey'        => 'KeyTokens',
            'salt'            => 'back123dne#34SDsdfasfd'
        ],
        /**
         * 操作日志
         */
        'operator' =>[
            'class'     => 'backend\service\OperateLog',
            'template'  => require __DIR__.'/operate-template.php',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'assetManager'=>[
            'appendTimestamp' => false,
            'linkAssets'      => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@logPath/backend.log',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
    'modules' => [
        'rights' => [
            'class' => 'backend\modules\rights\Module'
        ]
    ]
];
