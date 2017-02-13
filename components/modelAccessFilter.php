<?php

namespace sankam\rbac\components;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

/**
 * Usage
 *
 * ```
 *  public function behaviors()
 *  {
 *      return [
 *         ...
 *          'modelAccess' => [
 *              'class' => \sankam\rbac\components\modelAccessFilter::className(),
 *              'only' => ['index', 'view', 'update', 'delete'],
 *              'modelClass' => Model::className(),
 *              // 'modelCreatedByAttribute' => 'created_by',
 *              // 'modelPkParam' => 'id'
 *          ],
 *          ...
 *      ];
 *  }
 *
 */

/**
 * Class modelAccessFilter
 * @author Nikolya <k_m_i@i.ua>
 */
class modelAccessFilter extends ActionFilter
{
    /**
     * @var string Model class name
     */
    public $modelClass;

    /**
     * @var string Primary key param name
     */
    public $modelPkParam = 'id';

    /**
     * @var string Created by attribute name
     */
    public $modelCreatedByAttribute = 'created_by';

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function beforeAction($action)
    {
        $isAllowed = true;

        $actionName = $action->id;
        $modelPk = Yii::$app->request->getQueryParam($this->modelPkParam);
        $modelName = (new \ReflectionClass($this->modelClass))->getShortName();

        if ($modelPk) {
            $model = call_user_func($this->modelClass . '::findOne', $modelPk);
            if ($model) {
                $isAllowed = Yii::$app->user->can('editOwn' . $modelName, [
                    'model' => $model,
                    'attribute' => $this->modelCreatedByAttribute
                ]);
                if(!$isAllowed) {
                    $isAllowed = Yii::$app->user->can($actionName . $modelName);
                }
            }
        } else {
            if($actionName == 'index') {
                $actionName = 'list';
            }
            $isAllowed = Yii::$app->user->can($actionName . $modelName);
        }

        if (!$isAllowed) {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        } else {
            return true;
        }
    }
}
