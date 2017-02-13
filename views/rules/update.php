<?php

use yii\helpers\Html;

/* @var $this  yii\web\View */
/* @var $model sankam\rbac\models\BizRule */

$this->title = Yii::t('rbac-admin', 'Update Rule') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="auth-item-update">

    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>
    
</div>
