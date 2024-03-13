<?php

use app\models\Report;
use app\models\Role;
use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ReportSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Записи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать запись', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $items = Status::find()->select(['status'])->indexBy('id')->column(); ?>

    <?php 
        $users = User::find()->select(['login'])->indexBy('id')->column(); 
        $userFilter = [
            'class' => 'form-control input-sm',
            'id' => null,
        ]
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'number',
            'description:ntext',
            [
                'attribute' => 'status_id',
                'filter' => $items,
                'content' => function ($report) {
                    return $report->status;
                },
                'filterAttribute' => 'status_id',
                'enableSorting' => true,
            ],
            [
                'attribute' => 'imageFile',
                'content' => function ($report) {
                    return '<img src="/uploads/' . $report->imageFile . '" title="' . $report->imageFile . '" alt="Картинка)">';
                },
            ],
            [
                'attribute' => 'user_id',
                'visible' => Yii::$app->user->identity->role_id == Role::ADMIN_ROLE_ID ? true : false,
                'filter' => $users,
                'content' => function ($report) {
                    return $report->user;
                },
                'filterAttribute' => 'user_id',
                'filterInputOptions' => $userFilter,
                'enableSorting' => true,
            ],
            [
                'header' => 'Изменить запись',
                'class' => ActionColumn::className(),
                'visible' => Yii::$app->user->identity->role_id == Role::ADMIN_ROLE_ID ? true : false,
                'template' => '<div style="display: flex; justify-content: center">{update}</div>',
                'urlCreator' => function ($action, Report $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
