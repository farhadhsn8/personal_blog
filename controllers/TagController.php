<?php

namespace app\controllers;

use app\models\Tag;
use app\models\TagSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;


/**
 * TagController implements the CRUD actions for Tag model.
 */
class TagController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Tag models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException;
        }
        if (is_null(\Yii::$app->user->identity->role )) {
            throw new ForbiddenHttpException;
        }
        if (!\Yii::$app->user->identity->role->role_name == 'admin') {
            throw new ForbiddenHttpException;
        }
        $searchModel = new TagSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tag model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException;
        }
        if (is_null(\Yii::$app->user->identity->role )) {
            throw new ForbiddenHttpException;
        }
        if (!\Yii::$app->user->identity->role->role_name == 'admin') {
            throw new ForbiddenHttpException;
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException;
        }
        if (is_null(\Yii::$app->user->identity->role )) {
            throw new ForbiddenHttpException;
        }
        if (!\Yii::$app->user->identity->role->role_name == 'admin') {
            throw new ForbiddenHttpException;
        }
        $model = new Tag();

        if ($this->request->isPost) {
            $model->created_at = date('Y-m-d H:i:s');
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException;
        }
        if (is_null(\Yii::$app->user->identity->role )) {
            throw new ForbiddenHttpException;
        }
        if (!\Yii::$app->user->identity->role->role_name == 'admin') {
            throw new ForbiddenHttpException;
        }
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException;
        }
        if (is_null(\Yii::$app->user->identity->role )) {
            throw new ForbiddenHttpException;
        }
        if (!\Yii::$app->user->identity->role->role_name == 'admin') {
            throw new ForbiddenHttpException;
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
