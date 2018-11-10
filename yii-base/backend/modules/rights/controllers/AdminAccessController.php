<?php

namespace backend\modules\rights\controllers;

use Yii;
use backend\models\AdminAccess;
use backend\models\search\AdminAccess as AdminAccessSearch;
use backend\controllers\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminAccessController implements the CRUD actions for AdminAccess model.
 */
class AdminAccessController extends Controller
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
     * Lists all AdminAccess models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminAccessSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminAccess model.
     * @param integer $role_id
     * @param integer $right_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($role_id, $right_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($role_id, $right_id),
        ]);
    }

    /**
     * Creates a new AdminAccess model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminAccess();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'role_id' => $model->role_id, 'right_id' => $model->right_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AdminAccess model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $role_id
     * @param integer $right_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($role_id, $right_id)
    {
        $model = $this->findModel($role_id, $right_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'role_id' => $model->role_id, 'right_id' => $model->right_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AdminAccess model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $role_id
     * @param integer $right_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($role_id, $right_id)
    {
        $this->findModel($role_id, $right_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdminAccess model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $role_id
     * @param integer $right_id
     * @return AdminAccess the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($role_id, $right_id)
    {
        if (($model = AdminAccess::findOne(['role_id' => $role_id, 'right_id' => $right_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
