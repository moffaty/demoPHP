<?php

use app\models\Report;
use app\models\Status;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Report $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <?php
        $items = Status::find()->select(['status'])->indexBy('id')->column();
        if ($model->status_id != Status::STATUS_NEW) {
            unset($items[1]);
        }
    ?>

    <?= $form->field($model, 'status_id')->dropDownList(
        $items
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
