<?php

use yii\helpers\Html;
use sankam\core\adminlte\widgets\GridView;
use yii\widgets\Pjax;
use sankam\rbac\components\Configs;

/* @var $this  yii\web\View */
/* @var $model sankam\rbac\models\BizRule */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel sankam\rbac\models\searchs\BizRule */

$this->title = Yii::t('rbac-admin', 'Rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">
    <?php if(Configs::editMode()):?>
    <p>
        <?= Html::a(Yii::t('rbac-admin', 'Create Rule'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
                'attribute' => 'className',
                'label' => Yii::t('rbac-admin', 'Class Name')
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Configs::editMode() ? '{view} {update} {delete}' : '{view}'
            ],
        ],
    ]);
    ?>

</div>
