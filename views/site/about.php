<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'О нас';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Наши контакты: 
        <p><?php echo 'Почта: ',\Yii::$app->params['companyEmail']; ?></p>
        <p><?php echo 'Телефон: ',\Yii::$app->params['companyPhone']; ?></p>

    </p>
<!-- 
    <code><?= __FILE__ ?></code> -->
</div>
