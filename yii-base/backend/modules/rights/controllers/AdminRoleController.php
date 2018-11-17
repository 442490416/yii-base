<?php

namespace backend\modules\rights\controllers;

use backend\models\AdminAccess;
use backend\models\AdminRights;
use common\helpers\SessionHelper;
use Yii;
use backend\models\AdminRole;
use backend\models\search\AdminRole as AdminRoleSearch;
use backend\controllers\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminRoleController implements the CRUD actions for AdminRole model.
 */
class AdminRoleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

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

    public function actionRoleRightSet($id)
    {
        $model = $this->findModel($id);
        if(!$model) {
            SessionHelper::error('角色不存在');
            return $this->redirect(['index']);
        }

        if(\Yii::$app->request->isAjax) {
            SessionHelper::success();
            return $this->redirect(['index']);
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
