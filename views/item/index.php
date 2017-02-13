<?php

use yii\helpers\Html;
use sankam\core\adminlte\widgets\GridView;
use sankam\rbac\components\RouteRule;
use sankam\rbac\components\Configs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel sankam\rbac\models\searchs\AuthItem */
/* @var $context sankam\rbac\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', $labels['Items']);
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Configs::authManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<div class="role-index">
    <?php if(Configs::editMode()):?>
    <div class="box-header with-border">
        <p>
            <?= Html::a(Yii::t('rbac-admin', 'Create ' . $labels['Item']), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    <?php endif;?>
    
    <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'name',
                    'label' => Yii::t('rbac-admin', 'Name'),
                    'format' => 'raw',
                    'value' => function($model) {
                        return Html::a($model->name, [Configs::editMode() ? 'update' : 'view', 'id'=>$model->name]);
                    }
                ],
                [
                    'attribute' => 'ruleName',
                    'label' => Yii::t('rbac-admin', 'Rule Name'),
                    'filter' => $rules
                ],
                [
                    'attribute' => 'description',
                    'format' => 'ntext',
                    'label' => Yii::t('rbac-admin', 'Description'),
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => Configs::editMode() ? '{view} {update} {delete}' : '{view}'
                ],
            ],
        ])
    ?>

</div>
