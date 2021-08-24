<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'post.title',
                'format' => 'text',
                'label' => 'post_title',
                'value' =>function($model){
                    return $model->post->title;
                }
            ],

            [
                'attribute' => 'author.username',
                'format' => 'text',
                'label' => 'author',
                'value' =>function($model){
                    return $model->author->username;
                }
            ],
            'body:ntext',
            [
                'attribute' => 'verified',
                'format' => 'text',
                'label' => 'verified',
                'value' =>function($model){
                    if($model->verified)
                        return   "verified" ;
                    return "rejected";
                }
            ],
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
