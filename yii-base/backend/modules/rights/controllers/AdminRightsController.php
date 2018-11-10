<?php

namespace backend\modules\rights\controllers;

use Yii;
use backend\models\AdminRights;
use backend\models\search\AdminRights as AdminRightsSearch;
use backend\controllers\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminRightsController implements the CRUD actions for AdminRights model.
 */
class AdminRightsController extends Controller
{
    /**
     * Lists all AdminRights models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminRightsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminRights model.
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
     * @var array 默认action列表
     * @author Jiang Haiqiang
     * @email  jhq0113@163.com
     */
    protected static $_defaultActionList = [
        [
            'name' => 'index',
            'desc' => '列表'
        ],
        [
            'name' => 'create',
            'desc' => '添加'
        ],
        [
            'name' => 'view',
            'desc' => '详情'
        ],
        [
            'name' => 'delete',
            'desc' => '删除'
        ],
        [
            'name' => 'remove',
            'desc' => '是否启用'
        ]
    ];

    /**
     * Creates a new AdminRights model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminRights();

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                if($model->level == AdminRights::CONTROLLER) {
                    foreach (self::$_defaultActionList as $action) {
                        $actionModel = new AdminRights();
                        $actionModel->level = AdminRights::ACTION;
                        $actionModel->is_on = '1';
                        $actionModel->name  = $action['name'];
                        $actionModel->range = '0';
                        $actionModel->description = $action['desc'];
                        $actionModel->parent_id = $model->id;
                        $actionModel->save();
                    }
                }

                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'list'  => AdminRights::find()->where(['level' => ['0','1','2']])->asArray()->all()
        ]);
    }

    /**
     * Updates an existing AdminRights model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'list'  => AdminRights::find()->where(['level' => ['0','1','2']])->asArray()->all()
        ]);
    }

    /**
     * Deletes an existing AdminRights model.
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
     * Finds the AdminRights model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminRights the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminRights::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
