<?php

namespace app\controllers;

use app\models\Post;
use app\models\PostSearch;
use app\models\PostTag;
use app\models\Tag;
use app\models\UserTbl;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
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
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {


        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $tags = (new \yii\db\Query())->select(['*'])->from('post_tag')->all();


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $post = $this->findModel($id);
//        var_dump($post->author->username);die();
//        $post->author_id = $post->author->username;
        return $this->render('view', [
            'model' => $post,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //var_dump(Post::findOne(30)->getTags()->all());die();
        $model = new Post();
        $tags = (new \yii\db\Query())->select(['*'])->from('tag')->all();
        if ($this->request->isPost) {
            $model->author_id = \Yii::$app->user->identity->id;
            $model->created_at = date('Y-m-d H:i:s');
            $model->load($this->request->post());
            if ($model->save(false)) {
                foreach ($this->request->post()['Post']['tags'] as $tag) {
                    $post_tag = new PostTag([
                        'post_id' => $model->id,
                        'tag_id' => $tag,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                    $post_tag->save();
                }
                return $this->redirect('/index.php?r=post');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', ['model' => $model, 'tags' => $tags]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
