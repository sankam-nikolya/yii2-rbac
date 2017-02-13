<?php

use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use sankam\rbac\DefaultAsset;

/* @var $this View */

$js = <<<JS
$(".rbac-roles-tree").treeview({
    collapsed: true,
    control:"#sidetreecontrol",
});
JS;

DefaultAsset::register($this);
$this->registerJs($js);

$this->title = Yii::t('rbac-admin', 'Access Control');
?>
<div class="auth-roles">
    <div class="box-header with-border">
        <div class="btn-group" id="sidetreecontrol">
            <a class="btn btn-default" href="#"><?php echo Yii::t('rbac-admin', 'Collapse All');?></a>
            <a class="btn btn-default" href="#"><?php echo Yii::t('rbac-admin', 'Expand All');?></a>
        </div>
    </div>

    <div class="auth-default-index">
        <div class="row">
            <div class="col-md-12">
                <?php echo $data;?>
            </div>
        </div>
    </div>

</div>
