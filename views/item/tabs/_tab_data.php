<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sankam\rbac\components\RouteRule;
use sankam\rbac\AutocompleteAsset;
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

?>

    <?php $form = ActiveForm::begin(['id' => 'item-form', 'errorSummaryCssClass' => 'error-summary callout callout-danger']); ?>

    <?php echo $form->errorSummary($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
    
    <?= $form->field($model, 'ruleName')->textInput(['id' => 'rule_name']) ?>

    <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php
            echo Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                'name' => 'submit-button']);
        ?>
        <?=Html::a(Yii::t('rbac-admin', 'Cancel'), ['index'], ['class' => 'btn btn-default']);?>
    </div>

    <?php ActiveForm::end(); ?>
