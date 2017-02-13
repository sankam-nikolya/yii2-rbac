<?php

namespace sankam\rbac\components;

use Yii;
use yii\base\ActionEvent;
use yii\base\ActionFilter;
use yii\web\Controller;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;

/*
 * use sankam\rbac\components\editModeAccess;
 *  
 *  public function behaviors()
 *  {
 *      return [
 *          'editmode' => [
 *              'class' => editModeAccess::className(),
 *              // 'only' => ['list']
 *          ]
 *      ];
 *  }
 *  
 *  
 */

class editModeAccess extends ActionFilter
{

    /**
     * Declares event handlers for the [[owner]]'s events.
     * @return array events (array keys) and the corresponding event handler methods (array values).
     */
    public function events()
    {
        return [Controller::EVENT_BEFORE_ACTION => 'beforeAction'];
    }

    /**
     * @param ActionEvent $event
     * @return boolean
     * @throws MethodNotAllowedHttpException when the request method is not allowed.
     */
    public function beforeAction($event)
    {
        if (Configs::editMode()) {
            return parent::beforeAction($event);
        } else {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));;
        }
    }

}
