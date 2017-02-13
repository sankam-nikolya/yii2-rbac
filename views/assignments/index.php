<?php
use sankam\core\grid\EnumColumn;
use yii\helpers\Html;
use sankam\core\adminlte\widgets\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel sankam\rbac\models\searchs\Assignment */
/* @var $usernameField string */
/* @var $extraColumns string[] */

$this->title = Yii::t('rbac-admin', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;

$User = new $userClassName;
?>
<div class="assignment-index">

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            [
                'attribute' => 'image',
                'label' => Yii::t('common', 'Picture'),
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(
                        Html::img(
                            Yii::$app->glide->createSignedUrl([
                                'glide/index',
                                'path' => $model->userProfile->getAvatarPath($this->assetManager->getAssetUrl($bundle, 'img/anonymous.gif')),
                                'w' => (int) Yii::$app->keyStorage->get('backend.list.thumb')
                            ], true),
                            ['class' => 'img-responsive']),
                    ['update', 'id'=>$model->id]);
                }
            ],
            [
                'attribute' => 'username',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a($model->username, ['view', 'id'=>$model->id]);
                }
            ],
            'email:email',
            [
                'class' => EnumColumn::className(),
                'attribute' => 'status',
                'enum' => $User::statuses(),
                'filter' => $User::statuses()
            ],
            [
                'attribute' => 'roles',
                'label' => Yii::t('common', 'Roles'),
                'format' => 'raw',
                'value' => function($model) {
                    $rolesLinks = [];
                    $roles = $model->getRolesByUser($model->id);
                    if(!empty($roles)) {
                        foreach ($roles as $key => $name) {
                            $rolesLinks[] = Html::a($name, ['/rbac/roles/update', 'id'=>$key]);
                        }
                        return implode(', ', $rolesLinks);
                    } else {
                        return null;
                    }
                },
                'filter' => $User::getRoles()
            ],
            [
                'attribute' => 'created_at',
                'value' => function($model) {
                    return date('d.m.Y, H:i:s', $model->created_at);
                },
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'type' => DatePicker::TYPE_INPUT,
                     'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd.mm.yyyy',
                        'todayHighlight' => true
                    ]
                ]),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}'
            ],
        ],
    ]); ?>

</div>
