<?php

namespace backend\modules\rights\controllers;

use Yii;
use backend\models\AdminUserRole;
use backend\models\search\AdminUserRole as AdminUserRoleSearch;
use backend\controllers\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminUserRoleController implements the CRUD actions for AdminUserRole model.
 */
class AdminUserRoleController extends Controller
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
     * Lists all AdminUserRole models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminUserRoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminUserRole model.
     * @param integer $admin_id
     * @param integer $role_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($admin_id, $role_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($admin_id, $role_id),
        ]);
    }

    /**
     * Creates a new AdminUserRole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminUserRole();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'admin_id' => $model->admin_id, 'role_id' => $model->role_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AdminUserRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $admin_id
     * @param integer $role_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($admin_id, $role_id)
    {
        $model = $this->findModel($admin_id, $role_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'admin_id' => $model->admin_id, 'role_id' => $model->role_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AdminUserRole model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $admin_id
     * @param integer $role_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($admin_id, $role_id)
    {
        $this->findModel($admin_id, $role_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdminUserRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $admin_id
     * @param integer $role_id
     * @return AdminUserRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($admin_id, $role_id)
    {
        if (($model = AdminUserRole::findOne(['admin_id' => $admin_id, 'role_id' => $role_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
