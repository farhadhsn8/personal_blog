<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

    </p>

    <div class="card mb-3">
        <div class="card-body">
            <h2 class="card-title">title : <?php echo $model->title; ?></h2>
            <h5 class="card-author">author : <?php echo $model->author->username; ?></h5>
            <h5 class="card-title">tags : </h5>
                    <?php foreach ($model->tags as $tag){?>
                    <h5>  <span  style="float: left" class="badge badge-danger"><?php echo $tag->title; ?></span></h5>
                    <?php }  ?>

            <br>
            <hr>
            <p class="card-text"><?php echo $model->body; ?></p>
            <hr>
            <p class="card-text"><small class="text-muted"><?php echo $model->created_at; ?></small></p>
        </div>
    </div>

</div>

<br>
<hr>
<br>
<h3>Comments :</h3>


<p>
    <?= Html::a('Create Comment', ['comment/create','postID' => $model->id], ['class' => 'btn btn-success' ]) ?>
    <?php

    ?>

</p>

<?php
    foreach ($model->comments as $comment){
?>
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">author : <?php echo $comment->author->username; ?></h5>
        <hr>
        <p class="card-text"><?php echo $comment->body; ?></p>
        <hr>
        <p class="card-text"><small class="text-muted"> <?php echo $comment->created_at; ?></small></p>
    </div>
</div>
<?php
    }
?>
