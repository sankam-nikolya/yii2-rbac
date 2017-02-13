<?php
use yii\web\YiiAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sankam\rbac\components\RouteRule;
use sankam\rbac\AutocompleteAsset;
use sankam\rbac\ModuleAsset;
use yii\helpers\Json;
use sankam\rbac\components\Configs;

/* @var $this yii\web\View */
/* @var $model sankam\rbac\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
/* @var $context sankam\rbac\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$rules = Configs::authManager()->getRules();
unset($rules[RouteRule::RULE_NAME]);
$source = Json::htmlEncode(array_keys($rules));

$js = <<<JS
    $('#rule_name').autocomplete({
        source: $source,
    });
JS;
AutocompleteAsset::register($this);
$this->registerJs($js);

ModuleAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'items' => $model->getItems(),
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>

<div class="auth-item-form">

    <?php  echo \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => Yii::t('rbac-admin', 'Data'),
                'content' => $this->render('tabs/_tab_data', ['model' => $model, 'form' => $form]),
                'active' => true
            ],
            [
                'label' => Yii::t('rbac-admin', 'Permissions'),
                'content' => $this->render('tabs/_tab_permission', ['model' => $model, 'form' => $form]),
                'visible' => !$model->isNewRecord
            ]
        ]]);
    ?>

</div>
