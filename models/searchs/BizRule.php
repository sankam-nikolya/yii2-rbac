<?php

namespace sankam\rbac\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use sankam\rbac\models\BizRule as MBizRule;
use sankam\rbac\components\RouteRule;
use sankam\rbac\components\Configs;

/**
 * Description of BizRule
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class BizRule extends Model
{
    /**
     * @var string name of the rule
     */
    public $name;

    /**
     * @var string Class Name of the rule
     */
    public $className;

    public function rules()
    {
        return [
            [['name', 'className'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('rbac-admin', 'Name'),
            'className' => Yii::t('rbac-admin', 'Class Name')
        ];
    }

    /**
     * Search BizRule
     * @param array $params
     * @return \yii\data\ActiveDataProvider|\yii\data\ArrayDataProvider
     */
    public function search($params)
    {
        /* @var \yii\rbac\Manager $authManager */
        $authManager = Configs::authManager();
        $models = [];
        $included = !($this->load($params) && $this->validate() && (trim($this->name) !== '' || trim($this->className) !== ''));
        foreach ($authManager->getRules() as $name => $item) {
            if ($name != RouteRule::RULE_NAME && ($included || stripos($item->name, $this->name) !== false || stripos(get_class($item), $this->className) !== false)) {
                $models[$name] = new MBizRule($item);
            }
        }

        return new ArrayDataProvider([
            'allModels' => $models,
        ]);
    }
}
