<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'verified')->radio(['label' => 'confirm', 'value' => 1, 'uncheck' => null]) ?>
    <?= $form->field($model, 'verified')->radio(['label' => 'reject', 'value' => 0, 'uncheck' => null]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

