<?php

use sankam\rbac\ModuleAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $routes [] */

$this->title = Yii::t('rbac-admin', 'Routes');
$this->params['breadcrumbs'][] = $this->title;

ModuleAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'routes' => $routes,
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="input-group">
                <input id="inp-route" type="text" class="form-control" placeholder="<?=Yii::t('rbac-admin', 'New route(s)');?>">
                <span class="input-group-btn">
                    <?=Html::a(Yii::t('rbac-admin', 'Add') . $animateIcon, ['create'], [
                        'class' => 'btn btn-success',
                        'id' => 'btn-new',
                    ]);?>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-5">
        <div class="form-group-select-list">
            <div class="input-group">
                <input class="form-control search" data-target="available" placeholder="<?=Yii::t('rbac-admin', 'Search for available');?>">
                <span class="input-group-btn">
                    <?=Html::a('<span class="glyphicon glyphicon-refresh"></span>', ['refresh'], [
                        'class' => 'btn btn-default',
                        'id' => 'btn-refresh',
                    ]);?>
                </span>
            </div>
        </div>
        <select multiple size="20" class="form-control list" data-target="available"></select>
    </div>
    <div class="col-sm-2">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6 assign-elements-block">
                <div class="form-group">
                    <?=Html::a('<span class="glyphicon glyphicon-chevron-right"></span>' . $animateIcon, ['assign'], [
                        'class' => 'btn btn-success btn-assign',
                        'data-target' => 'available',
                        'title' => Yii::t('rbac-admin', 'Assign'),
                    ]);?>
                </div>
                <div class="form-group">
                    <?=Html::a('<span class="glyphicon glyphicon-chevron-left"></span>' . $animateIcon, ['remove'], [
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

<div class="row">
    <div class="col-md-12 view-btns-block">
        <?=Html::a(Yii::t('rbac-admin', 'Cancel'), ['index'], ['class' => 'btn btn-default']);?>
    </div>
</div>
