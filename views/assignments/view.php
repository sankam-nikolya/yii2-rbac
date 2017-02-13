<?php

use sankam\rbac\ModuleAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model sankam\rbac\models\Assignment */
/* @var $fullnameField string */

$userName = $model->{$usernameField};
if (!empty($fullnameField)) {
    $userName .= ' (' . ArrayHelper::getValue($model, $fullnameField) . ')';
}
$userName = Html::encode($userName);

$this->title = Yii::t('rbac-admin', 'Assignment') . ' : ' . $userName;

$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $userName;

ModuleAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'items' => $model->getItems(),
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<div class="assignment-index">

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
                        <?=Html::a('<span class="glyphicon glyphicon-chevron-right"></span>' . $animateIcon, ['assign', 'id' => $model->id], [
                            'class' => 'btn btn-success btn-assign',
                            'data-target' => 'available',
                            'title' => Yii::t('rbac-admin', 'Assign'),
                        ]);?>
                    </div>
                    <div class="form-group">
                        <?=Html::a('<span class="glyphicon glyphicon-chevron-left"></span>' . $animateIcon, ['revoke', 'id' => $model->id], [
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

</div>