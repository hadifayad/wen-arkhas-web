<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\SubCategory $model
*/

$this->title = Yii::t('models', 'Sub Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Sub Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud sub-category-create">

    <h1>
        <?= Yii::t('models', 'Sub Category') ?>
        <small>
                        <?= Html::encode($model->id) ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?=             Html::a(
            Yii::t('cruds', 'Cancel'),
            \yii\helpers\Url::previous(),
            ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <?= $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
