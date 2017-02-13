<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this  yii\web\View */
/* @var $model sankam\rbac\models\BizRule */
/* @var $form ActiveForm */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin([
        'errorSummaryCssClass' => 'error-summary callout callout-danger'
    ]); ?>

    <?php echo $form->errorSummary($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'className')->textInput() ?>

    <div class="form-group">
        <?php
            echo Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        ?>
        <?=Html::a(Yii::t('rbac-admin', 'Cancel'), ['index'], ['class' => 'btn btn-default']);?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
