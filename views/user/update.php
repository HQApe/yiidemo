<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Country */

$this->title = 'Update User: ' . $model->name;
?>
<div class="country-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_userForm', [
        'model' => $model,
    ]) ?>

</div>
