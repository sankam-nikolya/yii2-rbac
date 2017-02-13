<?php

namespace sankam\rbac\controllers;

use Yii;
use yii\helpers\Html;

/**
 * RbacListController
 *
 */
class RbacListController extends \yii\web\Controller
{

    /**
     * Action index
     */
    public function actionIndex()
    {
        $manager = Yii::$app->authManager;

        $data = '';

        foreach($manager->getRoles() as $role) {
            $data .= '<ul class="rbac-roles-tree">';
            $name = '<strong>' . Yii::t('rbac-admin','Role') . ':</strong> ' . $role->name;
            $data .= Html::tag('span', $name, [
                'class'=> 'role-label',
                'content'=> $role->description,
                'data-toggle' => 'tooltip',
            ]);
            $childs = $manager->getChildren($role->name);
            $data .= $this->_recursiveList($childs,1);
            $data .= '</ul>';
        }

        return $this->render('index', ['data' => $data]);
    }

    /**
     * Format output string for recursive list
     *
     * @param $item
     * @return string
     */
    protected function _formatItem($item){
        /**
         * @var \yii\rbac\Item $item
         */
        switch ($item->type) {
            case 2:
                if(strncmp($item->name, '/', 1) === 0 || strncmp($item->name, '@', 1) === 0){
                    $name = '<strong>' . Yii::t('rbac-admin','Route') . ':</strong> ' . $item->name;
                    $description = '';
                } else {
                    $name = '<strong>' . Yii::t('rbac-admin','Permission') . ':</strong> ' . $item->name;
                    $description = '';
                }
                
                break;
            case 1:
                $name = '<strong>' . Yii::t('rbac-admin','Role') . ':</strong> ' . $item->name;
                $description = '';
                break;
            default:
                $name = '?';
                $description = '';
                break;
        }

        return Html::tag('span', $name, [
            'class'=> 'role-label',
            'content'=> $description,
            'data-toggle' => 'tooltip',
        ]);
    }

    /**
     * Generate recursive list or roles and permissions
     *
     * @param $items
     * @param $level
     * @return string
     */

    protected function _recursiveList($items, $level)
    {
        $out = '';
        $manager = \Yii::$app->authManager;

        if ($level > 100) {
            return '';
        }

        if(is_array($items) && count($items) > 0){
            $out .= '<ul>';
            foreach($items as $i){
                $out .= '<li>';
                $out .= $this->_formatItem($i);
                $childs = $manager->getChildren($i->name);
                $out.= $this->_recursiveList($childs, $level+1);
                $out .= '</li>';
            }
            $out .= '</ul>';
        } else {
            return '';
        }

        return $out;
    }

}
