<?php

namespace sankam\rbac\components;

use Yii;
use yii\web\ForbiddenHttpException;

/**
 * Usage
 * 1. In ActiveQuery
 *
 * ```
 * class ModelQuery extends ActiveQuery
 * {
 *      use \sankam\rbac\components\listOwnItemsTrait;
 *      // public $createdByAttribute = 'created_by'; // optional
 *          ...
 * ```
 *  
 * 2. When searching use "own" method
 *  
 * ```
 *  ...
 *  $query = Article::find()->own();
 *  ...
 * ```
 */

/**
 * trait listOwnItemsTrait
 * @author Nikolya <k_m_i@i.ua>
 */

trait listOwnItemsTrait
{

    public function own() {
        if(isset($this->createdByAttribute)) {
            $createdByAttribute = $this->createdByAttribute;
        } else {
            $createdByAttribute = 'created_by';
        }
        $modelName = (new \ReflectionClass($this->modelClass))->getShortName();

        $hasPermission = Yii::$app->user->can('update' . $modelName);
        
        if(!$hasPermission) {
            $this->andWhere([$createdByAttribute => Yii::$app->user->getID()]);
        }

        return $this;
    }

}
