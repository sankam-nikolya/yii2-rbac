<?php

use sankam\rbac\ModuleAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use sankam\rbac\components\Configs;

/* @var $this yii\web\View */
/* @var $model sankam\rbac\models\AuthItem */
/* @var $context sankam\rbac\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

ModuleAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'items' => $model->getItems(),
]);

$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';

$primaryRole = sankam\rbac\models\AuthItem::checkPrimaryGroup($model->name);
?>
<div class="box-header with-border">
    <p>
        <?php if(Configs::editMode()):?>
        <?=Html::a(Yii::t('rbac-admin', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']);?>
        <?php if(!$primaryRole):?>
        <?=Html::a(Yii::t('rbac-admin', 'Delete'), ['delete', 'id' => $model->name], [
            'class' => 'btn btn-danger',
            'data-confirm' => Yii::t('rbac-admin', 'Are you sure to delete this item?'),
            'data-method' => 'post',
        ]);?>
        <?php endif;?>
        <?=Html::a(Yii::t('rbac-admin', 'Create'), ['create'], ['class' => 'btn btn-success']);?>
        <?php endif;?>
        <?=Html::a(Yii::t('rbac-admin', 'Cancel'), ['index'], ['class' => 'btn btn-default']);?>
    </p>
</div>

<div class="row">
    <div class="col-sm-12">
        <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'description:ntext',
                    'ruleName',
                    'data:ntext'
                ],
            ]);
        ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-5">
        <div class="form-group-select-list">
            <input class="form-control search" data-target="available" placeholder="<?=Yii::t('rbac-admin', 'Search for available');?>">
        </div>
        <select multiple size="20" class="form-control list" data-target="available"></select>
    </div>
    <div class="col-sm-2">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6 assign-elements-block">
                <div class="form-group">
                    <?=Html::a('<span class="glyphicon glyphicon-chevron-right"></span>' . $animateIcon, ['assign', 'id' => $model->name], [
                        'class' => 'btn btn-success btn-assign',
                        'data-target' => 'available',
                        'title' => Yii::t('rbac-admin', 'Assign'),
                    ]);?>
                </div>
                <div class="form-group">
                    <?=Html::a('<span class="glyphicon glyphicon-chevron-left"></span>' . $animateIcon, ['remove', 'id' => $model->name], [
                        'class' => 'btn btn-danger btn-assign',
                        'data-target' => 'assigned',
                        'title' => Yii::t('rbac-admin', 'Remove'),
                    ]);?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group-select-list">
            <input class="form-control search" data-target="assigned" placeholder="<?=Yii::t('rbac-admin', 'Search for assigned');?>">
        </div>
        <select multiple size="20" class="form-control list" data-target="assigned"></select>
    </div>
</div>