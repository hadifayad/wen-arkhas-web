<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\SubCategorySearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="sub-category-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'c_name') ?>

		<?= $form->field($model, 'r_cat_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
