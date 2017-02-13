<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use sankam\rbac\components\Configs;

/**
 * @var yii\web\View $this
 * @var sankam\rbac\models\AuthItem $model
 */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view">

    <div class="box-header with-border">
        <p>
            <?php if(Configs::editMode()):?>
            <?= Html::a(Yii::t('rbac-admin', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
            <?php
                echo Html::a(Yii::t('rbac-admin', 'Delete'), ['delete', 'id' => $model->name], [
                    'class' => 'btn btn-danger',
                    'data-confirm' => Yii::t('rbac-admin', 'Are you sure to delete this item?'),
                    'data-method' => 'post',
                ]);
            ?>
            <?php endif;?>
            <?=Html::a(Yii::t('rbac-admin', 'Cancel'), ['index'], ['class' => 'btn btn-default']);?>
        </p>
    </div>

    <?php
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'className',
            ],
        ]);
    ?>

</div>
