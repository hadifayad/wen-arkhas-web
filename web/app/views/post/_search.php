<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\PostSearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'r_sub_category_id') ?>

		<?= $form->field($model, 'r_user_id') ?>

		<?= $form->field($model, 'c_shop_name') ?>

		<?= $form->field($model, 'c_shop_place') ?>

		<?php // echo $form->field($model, 'c_price') ?>

		<?php // echo $form->field($model, 'c_duration') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
