<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'UserManager';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add User', ['add'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'userId',
            'account',
            'name',
            'sex',
            'age',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
