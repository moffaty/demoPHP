<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Report $model */

$this->title = 'Создать запись';
$this->params['breadcrumbs'][] = ['label' => 'Записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
