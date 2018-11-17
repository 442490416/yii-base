<?php

namespace backend\modules\rights\controllers;

use backend\models\AdminAccess;
use backend\models\AdminRights;
use common\helpers\ComHelper;
use common\helpers\ErrorHelper;
use common\helpers\SessionHelper;
use Yii;
use backend\models\AdminRole;
use backend\models\search\AdminRole as AdminRoleSearch;
use backend\controllers\Controller;
use yii\web\NotFoundHttpException;

/**
 * AdminRoleController implements the CRUD actions for AdminRole model.
 */
class AdminRoleController extends Controller
{
    /**
     * Lists all AdminRole models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminRoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminRole model.
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
     * Creates a new AdminRole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminRole();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AdminRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AdminRole model.
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
     * @throws \yii\db\Exception
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    public function actionRoleRightSet($id)
    {
        $model = $this->findModel($id);
        if(!$model) {
            SessionHelper::error('角色不存在');
            return $this->redirect(['index']);
        }

        if(\Yii::$app->request->isPost && \Yii::$app->request->isAjax) {

            $rightIds = $_POST['ids'];
            AdminRights::deleteAll(['role_id' => $model->id]);

            if(!empty($rightIds)) {
                $rows = [];
                foreach ($rightIds as $rightId) {
                    array_push($rows,[
                        $model->id,
                        (int)$rightId
                    ]);
                }

                $connection = AdminAccess::getDb();
                $connection->createCommand()
                    ->batchInsert(
                        AdminAccess::tableName(),
                        [
                            'role_id',
                            'right_id'
                        ],
                        $rows
                    )
                    ->execute();
            }

            SessionHelper::success();

            ErrorHelper::success();
        }

        $rightList = AdminRights::find()
            ->where([
                'is_on' => '1',
            ])
            ->orderBy([
                'level' => SORT_ASC,
                'range' => SORT_ASC
            ])
            ->asArray()
            ->all();

        $rightList = AdminRights::format($rightList);

        $hasRightIds = AdminAccess::find()
            ->where([
                'role_id'=>$model->id
            ])
            ->asArray()
            ->all();
        if(!empty($hasRightIds)) {
            $hasRightIds = array_column($hasRightIds,'right_id');
        }

        $treeViewList = AdminRights::formatRightList2TreeView($rightList,$hasRightIds);

        return $this->render('role-right-set',[
            'model'        => $model,
            'treeViewList' => $treeViewList
        ]);
    }

    /**
     * Finds the AdminRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminRole::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
