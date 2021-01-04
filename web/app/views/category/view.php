<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var app\models\Category $model
*/
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'View');
?>
<div class="giiant-crud category-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= Yii::t('models', 'Category') ?>
        <small>
            <?= Html::encode($model->id) ?>
        </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?= Html::a(
            '<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('cruds', 'Edit'),
            [ 'update', 'id' => $model->id],
            ['class' => 'btn btn-info']) ?>

            <?= Html::a(
            '<span class="glyphicon glyphicon-copy"></span> ' . Yii::t('cruds', 'Copy'),
            ['create', 'id' => $model->id, 'Category'=>$copyParams],
            ['class' => 'btn btn-success']) ?>

            <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New'),
            ['create'],
            ['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
            . Yii::t('cruds', 'Full list'), ['index'], ['class'=>'btn btn-default']) ?>
        </div>

    </div>

    <hr/>

    <?php $this->beginBlock('app\models\Category'); ?>

    
    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
            'c_name',
    ],
    ]); ?>

    
    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('cruds', 'Delete'), ['delete', 'id' => $model->id],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => '' . Yii::t('cruds', 'Are you sure to delete this item?') . '',
    'data-method' => 'post',
    ]); ?>
    <?php $this->endBlock(); ?>


    
<?php $this->beginBlock('SubCategories'); ?>
<div style='position: relative'>
<div style='position:absolute; right: 0px; top: 0px;'>
  <?= Html::a(
            '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('cruds', 'List All') . ' Sub Categories',
            ['sub-category/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New') . ' Sub Category',
            ['sub-category/create', 'SubCategory' => ['r_cat_id' => $model->id]],
            ['class'=>'btn btn-success btn-xs']
        ); ?>
</div>
</div>
<?php Pjax::begin(['id'=>'pjax-SubCategories', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-SubCategories ul.pagination a, th a']) ?>
<?=
 '<div class="table-responsive">'
 . \yii\grid\GridView::widget([
    'layout' => '{summary}<div class="text-center">{pager}</div>{items}<div class="text-center">{pager}</div>',
    'dataProvider' => new \yii\data\ActiveDataProvider([
        'query' => $model->getSubCategories(),
        'pagination' => [
            'pageSize' => 20,
            'pageParam'=>'page-subcategories',
        ]
    ]),
    'pager'        => [
        'class'          => yii\widgets\LinkPager::className(),
        'firstPageLabel' => Yii::t('cruds', 'First'),
        'lastPageLabel'  => Yii::t('cruds', 'Last')
    ],
    'columns' => [
 [
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function ($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'sub-category' . '/' . $action;
        $params['SubCategory'] = ['r_cat_id' => $model->primaryKey()[0]];
        return $params;
    },
    'buttons'    => [
        
    ],
    'controller' => 'sub-category'
],
        'id',
        'c_name',
]
])
 . '</div>' 
?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


    <?= Tabs::widget(
                 [
                     'id' => 'relation-tabs',
                     'encodeLabels' => false,
                     'items' => [
 [
    'label'   => '<b class=""># '.Html::encode($model->id).'</b>',
    'content' => $this->blocks['app\models\Category'],
    'active'  => true,
],
[
    'content' => $this->blocks['SubCategories'],
    'label'   => '<small>Sub Categories <span class="badge badge-default">'. $model->getSubCategories()->count() . '</span></small>',
    'active'  => false,
],
 ]
                 ]
    );
    ?>
</div>
