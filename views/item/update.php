<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model sankam\rbac\models\AuthItem */
/* @var $context sankam\rbac\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', 'Updating') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="auth-item-update">
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>
</div>
