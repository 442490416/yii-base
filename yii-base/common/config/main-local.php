<?php
return [
    'components' => [
        'db' => [
            'class'         => 'yii\db\Connection',
            'dsn'           => 'mysql:host=10.20.76.58;dbname=yii-base;charset=utf8',
            'username'      => 'yii-base',
            'password'      => '123456',
            'charset'       => 'utf8',
            'tablePrefix'   => 'base_'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
