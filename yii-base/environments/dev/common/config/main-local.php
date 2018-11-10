<?php
return [
    'components' => [
        'db' => [
            'class'         => 'yii\db\Connection',
            'dsn'           => 'mysql:host=127.0.0.1;dbname=yii-base',
            'username'      => 'yii-base',
            'password'      => '123456',
            'charset'       => 'utf8',
            'tablePrefix'   => 'base_'
        ],
        /**
         * 加密组件
         */
        'mcrypt'=>[
            'class'       => 'common\mcrypts\Rsa',
            'privateKey'  => '-----BEGIN RSA PRIVATE KEY-----
MIICWwIBAAKBgQCrOG5Yp/CWoRhB22MJHstyMmkkcLoLQphckt4TYDaB17/N3HpK
YoB53NJft5VK7/YiuzWQUqpztpIuwXekQ+SDc2t3NygIXDRHdcdoaYa48+3xIQ/S
3BHRTWUuwBVA+LbgWs2qU11T5Op25iQE31ZXfbye+1zmLoOCCprSx6/v6QIDAQAB
AoGACyH5YSy6PFdvh+8UOpmUyaR0qN8Z5nWHPPp64HBwp6Y39tJCsud1fXbzYf0P
AsPx3kKlGIpndTkGIQgifiNaWwTJ+HlpjV4cfPUnhs7X+nDHfainag36BdekLVMX
rEr/MMhbhlLwnPgaf6Byv7/Ra/mCUP99oau96grwLRt2JgECQQDg96KjayWVWojb
hyJEuAZLRuveRxLVfRIadk7AMuXjD5rVY18AryU2JaeNIdtmX9jSjU9Voz4oe+lO
lXVRXXNhAkEAwtbPNQ4QJKCbcWTHbmP42vP3AH2ozO0w6Kcb7Zvi6hezasVIK8pT
73e2G0ZZedqPN9HNBw9mh3wDw7KZrlvRiQJANsBOFtOm6/iCwlrbHjpjXcK++PP3
Q3oTA9mzRNeeV2qe1jw/DN2TguAbLSAGU54UGPpHSqJWKGgv2e5KBSlnQQJADz1J
+7Zb4OGHBvmA98tt/YIzgaBSgaTTvH7FmnIk73ZnHCTOHk62/fX5Em0QNo23wf/w
72pu9I3opXfkuVSJMQJAET6DIBWGs+Jb8qPxjJCq9CpDAzcA+o4VJ4iKwP8dVJHA
KHbc1URH6Vr4ACTUhyRg0CIF2a5NaZozaRqMFgvbig==
-----END RSA PRIVATE KEY-----',
            'publicKey'   => '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCrOG5Yp/CWoRhB22MJHstyMmkk
cLoLQphckt4TYDaB17/N3HpKYoB53NJft5VK7/YiuzWQUqpztpIuwXekQ+SDc2t3
NygIXDRHdcdoaYa48+3xIQ/S3BHRTWUuwBVA+LbgWs2qU11T5Op25iQE31ZXfbye
+1zmLoOCCprSx6/v6QIDAQAB
-----END PUBLIC KEY-----',
            'jsPublicKey'   => '-----BEGIN PUBLIC KEY-----MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCrOG5Yp/CWoRhB22MJHstyMmkkcLoLQphckt4TYDaB17/N3HpKYoB53NJft5VK7/YiuzWQUqpztpIuwXekQ+SDc2t3NygIXDRHdcdoaYa48+3xIQ/S3BHRTWUuwBVA+LbgWs2qU11T5Op25iQE31ZXfbye+1zmLoOCCprSx6/v6QIDAQAB-----END PUBLIC KEY-----'
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
