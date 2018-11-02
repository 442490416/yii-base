<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/2
 * Time: 下午10:40
 */

namespace common\helpers;

use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * Class UploadHelper
 * @package common\helpers
 * User Jiang Haiqiang
 */
class UploadHelper
{
    /**
     * 图片
     */
    const IMG='image';

    /**
     * 视频
     */
    const VIDEO='video';

    /**
     * 文件
     */
    const FILE='file';

    /**默认文件白名单
     * @var array
     * @author 姜海强 <jhq0113@163.com>
     */
    public static $fileWhiteMap=[
        self::IMG           => [ 'jpg', 'jpeg', 'png', 'bmp','gif'],
        self::VIDEO         => ['flv', 'avi','mp4','m4v'],
        self::FILE          => ['zip','apk','pdf','xls','xlsx','doc','docx','mp3']
    ];

    /**
     * 文件最大大小,单位M
     */
    const MAX_SIZE=10;


    /**b转M
     * @param int   $size
     * @return float
     * @author 姜海强 <jhq0113@163.com>
     */
    public static function b2M($size)
    {
        return round( ( $size / (1024*1024) ),1);
    }

    /**获取扩展名目录
     * @param string   $extension
     * @return bool|int|string
     * @author 姜海强 <jhq0113@163.com>
     */
    public static function getExtensionDir($extension)
    {
        foreach (static::$fileWhiteMap as $dir=>$items) {
            if(in_array($extension,$items)) {
                return $dir;
            }
        }
        return false;
    }

    /**生成随机文件名
     * @return string
     * @author 姜海强 <jhq0113@163.com>
     */
    public static function getRandomName()
    {
        return date('H_i_s_').md5(uniqid());
    }

    /**创建上传目录和文件名并获取信息
     * @param string    $basePath
     * @param string    $extensionDir
     * @param string    $urlPrefix
     * @param string    $fileExtension
     * @return array
     * @author 姜海强 <jhq0113@163.com>
     */
    public static function autoCreateDirAndGetUploadInfo($basePath,$extensionDir,$urlPrefix,$fileExtension)
    {
        $datePath = date('/Y/m/d');

        $uploadInfo['fileName'] = static::getRandomName().'.'.$fileExtension;

        return [
            'fileName' => static::getRandomName().'.'.$fileExtension,
            'url'      => $urlPrefix.'/'.$extensionDir.$datePath,
            'path'     => $basePath.'/'.$extensionDir.$datePath
        ];
    }

    /**上传
     * @param string        $file        文件上传实例
     * @param string        $basePath    基础物理目录
     * @param string        $urlPrefix   url前缀，默认为空串
     * @param string        $fileType    文件类型
     * @param array         $accessList  白名单
     * @param callable|null $createDirAndGetUploadInfoCallBack  创建上传目录和文件名并获取信息回调函数
     * @author 姜海强 <jhq0113@163.com>
     */
    protected static function up(UploadedFile $file, $basePath, $urlPrefix='', $fileType='',$accessList=[], callable $createDirAndGetUploadInfoCallBack=null)
    {
        if(!$file) {
            return ['data'=>'请选择文件','status'=>'1001'];
        }

        //获取扩展名
        $fileExtension = $file->getExtension();

        $extensionDir=false;

        //没传文件类型，自动分配目录
        if(empty($fileType)) {
            $extensionDir=static::getExtensionDir($fileExtension);
        }
        else {
            //文件类型是否在白名单中
            if(!isset(static::$fileWhiteMap[ $fileType ])) {
                throw new HttpException('500','参数$fileType值需为【'.implode(',',array_keys(static::$fileWhiteMap)).'】中之一');
            }

            //文件类型白名单
            $accessList = empty($accessList) ? static::$fileWhiteMap[ $fileType ] : $accessList;

            if(in_array($fileExtension,$accessList)) {
                $extensionDir=$fileType;
            }
        }

        if(!$extensionDir) {
            return ['data'=>'暂不支持【.'.$fileExtension.'】格式的文件上传','status'=>'1002'];
        }

        if($file->size == 0) {
            $iniMaxFileSize = ini_get('upload_max_filesize');
            return ['data'=>'文件大小超过服务器设置限制'.$iniMaxFileSize,'status'=>'1003'];
        }

        $size=static::b2M($file->size);

        if($size > static::MAX_SIZE) {
            return ['data'=>'文件大小不能超过'.static::MAX_SIZE.'M','status'=>'1004'];
        }

        //如果用户自定义回调函数
        if(isset($createDirAndGetUploadInfoCallBack)) {
            $uploadInfo = call_user_func($createDirAndGetUploadInfoCallBack);
        }
        else {
            $uploadInfo = static::autoCreateDirAndGetUploadInfo($basePath,$extensionDir,$urlPrefix,$fileExtension);
        }

        FileHelper::createDirectory($uploadInfo['path']);

        //保存文件
        if($file->saveAs( $uploadInfo['path'].'/'.$uploadInfo['fileName'])) {
            return ['data'=>$uploadInfo['url'].'/'.$uploadInfo['fileName'],'status'=>'200'];
        }

        return ['data'=>'上传失败','status'=>'1006'];
    }

    /**根据参数名获取上传文件对象
     * @param string  $name     参数名
     * @return null|UploadedFile
     * @author 姜海强 <jhq0113@163.com>
     */
    public static function getFileByName($name)
    {
        return UploadedFile::getInstanceByName($name);
    }

    /**传图片
     * @param UploadedFile  $file         上传文件对象
     * @param string        $basePath     上传基础路径
     * @param string        $urlPrefix    url前缀，默认为空串
     * @param array         $accessList  白名单
     * @param callable|null $createDirAndGetUploadInfoCallBack  创建上传目录和文件名并获取信息回调函数
     * @return array
     * @author 姜海强 <jhq0113@163.com>
     */
    public static function upImg(UploadedFile $file, $basePath, $urlPrefix='',$accessList=[], callable $createDirAndGetUploadInfoCallBack=null)
    {
        return static::up($file,$basePath,$urlPrefix,static::IMG,$accessList,$createDirAndGetUploadInfoCallBack);
    }

    /**传视频
     * @param UploadedFile  $file       上传文件对象
     * @param string        $basePath   上传基础路径
     * @param string        $urlPrefix  url前缀，默认为空串
     * @param array         $accessList  白名单
     * @param callable|null $createDirAndGetUploadInfoCallBack  创建上传目录和文件名并获取信息回调函数
     * @return array
     * @author 姜海强 <jhq0113@163.com>
     */
    public static function upVideo(UploadedFile $file, $basePath, $urlPrefix='',$accessList=[], callable $createDirAndGetUploadInfoCallBack=null)
    {
        return static::up($file,$basePath,$urlPrefix,static::VIDEO,$accessList,$createDirAndGetUploadInfoCallBack);
    }

    /**传文件
     * @param UploadedFile  $file        上传文件对象
     * @param string        $basePath    上传基础路径
     * @param string        $urlPrefix   url前缀，默认为空串
     * @param array         $accessList  白名单
     * @param callable|null $createDirAndGetUploadInfoCallBack  创建上传目录和文件名并获取信息回调函数
     * @return array
     * @author 姜海强 <jhq0113@163.com>
     */
    public static function upFile(UploadedFile $file, $basePath, $urlPrefix='',$accessList=[], callable $createDirAndGetUploadInfoCallBack=null)
    {
        return static::up($file,$basePath,$urlPrefix,static::FILE,$accessList,$createDirAndGetUploadInfoCallBack);
    }
}