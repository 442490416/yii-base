<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/21
 * Time: 下午10:33
 */

namespace backend\controllers;

use common\helpers\ComHelper;
use common\helpers\UploadHelper;

/**
 * Class UpController
 * @package backend\controllers
 * User Jiang Haiqiang
 */
class UpController extends Controller
{
    /**
     * @var bool
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public $enableCsrfValidation = false;

    /**编辑器上传
     * @return array
     * @author 姜海强 <jhq0113@163.com>
     */
    public function actions()
    {
        return [
            'summer' =>[
                'class'         => 'common\widgets\summernote\UploadAction\UploadAction',
                'uploadPath'    => UPLOAD_SERVER_WEB_PATH.'/summer',
                'urlPrefix'     => FILE_URL.'/summer',
            ],
            'upload'  => [
                'class'         =>  'common\widgets\upload\UploadAction',
                'uploadPath'    =>  UPLOAD_SERVER_WEB_PATH.'/bootstrap-uploads',
                'urlPrefix'     => FILE_URL.'/bootstrap-uploads'
            ],
            'md' => [
                'class'         => 'common\widgets\mdeditor\UploadAction',
                'uploadPath'    => UPLOAD_SERVER_WEB_PATH.'/mdeditor',
                'urlPrefix'     => FILE_URL.'/mdeditor',
            ]
        ];
    }

    /**传图片
     * @author 姜海强 <jhq0113@163.com>
     */
    public function actionImg()
    {
        $name=ComHelper::fStr('name',$_POST);
        $file=UploadHelper::getFileByName($name);
        if(!$file)
        {
            ComHelper::retArray([
                'status'=>'404',
                'data'=>'请选择要上传的图片文件'
            ]);
        }
        $upInfo=UploadHelper::upImg($file,UPLOAD_SERVER_WEB_PATH);
        $upInfo['data']=$upInfo['message'];
        unset($upInfo['message']);
        ComHelper::retArray($upInfo);
    }

    /**上传文件
     * @author 姜海强 <jhq0113@163.com>
     */
    public function actionFile()
    {
        $name=ComHelper::fStr('name',$_POST);
        $file=UploadHelper::getFileByName($name);
        if(!$file)
        {
            ComHelper::retArray([
                'status'=>'404',
                'data'=>'请选择要上传的文件'
            ]);
        }
        $upInfo=UploadHelper::upFile($file,UPLOAD_SERVER_WEB_PATH);
        $upInfo['data']=$upInfo['message'];
        unset($upInfo['message']);
        ComHelper::retArray($upInfo);
    }

    /**上传视频文件
     * @author 姜海强 <jhq0113@163.com>
     */
    public function actionVideo()
    {
        $name=ComHelper::fStr('name',$_POST);
        $file=UploadHelper::getFileByName($name);
        if(!$file)
        {
            ComHelper::retArray([
                'status'=>'404',
                'data'=>'请选择要上传的视频文件'
            ]);
        }
        $upInfo=UploadHelper::upVideo($file,UPLOAD_SERVER_WEB_PATH);
        $upInfo['data']=$upInfo['message'];
        unset($upInfo['message']);
        ComHelper::retArray($upInfo);
    }
}