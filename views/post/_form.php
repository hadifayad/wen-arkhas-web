<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'r_sub_category_id')->textInput() ?>

    <?= $form->field($model, 'r_user_id')->textInput() ?>

    <?= $form->field($model, 'c_shop_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_shop_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_price')->textInput() ?>

    <?= $form->field($model, 'c_duration')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
