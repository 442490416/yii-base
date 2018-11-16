<?php

namespace backend\modules\rights\controllers;

use backend\models\AdminRole;
use backend\models\AdminUserRole;
use common\helpers\SessionHelper;
use Yii;
use backend\models\AdminUser;
use backend\models\search\AdminUser as AdminUserSearch;
use backend\controllers\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * AdminUserController implements the CRUD actions for AdminUser model.
 */
class AdminUserController extends Controller
{
    /**
     * Lists all AdminUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminUser model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdminUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminUser();

        if ($model->load(Yii::$app->request->post())){
            $model->password = \Yii::$app->login->encryptPassword($model->password);
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AdminUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model) {
            $oldPassword = $model->password;

            if ($model->load(Yii::$app->request->post())) {
                //如果修改了密码
                if($oldPassword !== $model->password) {
                    $model->password = \Yii::$app->login->encryptPassword($model->password);
                }

                if($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AdminUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function actionRoleSet($id)
    {
        if(\Yii::$app->request->isPost) {
            return;
        }

        $model = $this->findModel($id);
        if(!$model) {
            SessionHelper::error('管理员不存在');
            return $this->redirect(['index']);
        }

        $roleList = AdminRole::find()
            ->where(['is_on'=>'1'])
            ->asArray()
            ->all();

        $adminRoleList = AdminUserRole::find()
            ->where(['admin_id' => $model->id ])
            ->asArray()
            ->all();

        if(!empty($roleList)) {
            $roleList = array_column($roleList,'role_name','id');
        }

        $hasRoleIds = [];
        if(!empty($adminRoleList)) {
            $hasRoleIds = array_column($adminRoleList,'role_id');
        }

        return $this->render('role-set',[
            'model'          => $model,
            'roleList'       => $roleList,
            'hasRoleIds'     => $hasRoleIds
        ]);
    }

    /**
     * Finds the AdminUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
