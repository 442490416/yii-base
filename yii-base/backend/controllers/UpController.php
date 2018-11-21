<?php
/**
 * Created by PhpStorm.
 * User: Jiang Haiqiang
 * Date: 2018/11/21
 * Time: 下午10:33
 */

namespace backend\controllers;

/**
 * Class UpController
 * @package backend\controllers
 * User Jiang Haiqiang
 */
class UpController extends Controller
{
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


}