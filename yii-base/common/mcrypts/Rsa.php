<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/9
 * Time: 下午9:15
 */

namespace common\mcrypts;

use yii\helpers\StringHelper;

/**
 * Class Rsa
 * @package common\mcrypt
 * User Jiang Haiqiang
 */
class Rsa extends Mcrypt
{
    /**私钥
     * @var string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $privateKey;

    /**公钥
     * @var string
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $publicKey;

    /**
     * @var int
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $padding = OPENSSL_PKCS1_PADDING;

    /**
     * @param string $data
     * @return string|void
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function encrypt($data)
    {
        // TODO: Implement encode() method.
        if (openssl_public_encrypt($data, $encrypted, $this->publicKey,$this->padding))
            $data = StringHelper::base64UrlEncode($encrypted);
        else
            $data = '';
        return $data;
    }

    /**
     * @param string $data
     * @return string|void
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function decrypt($data)
    {
        // TODO: Implement decode() method.
        if (openssl_private_decrypt(StringHelper::base64UrlDecode($data), $decrypted, $this->privateKey,$this->padding))
            $data = $decrypted;
        else
            $data = '';
        return $data;
    }
}