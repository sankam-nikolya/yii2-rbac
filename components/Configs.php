<?php

namespace sankam\rbac\components;

use Yii;
use yii\caching\Cache;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\rbac\ManagerInterface;

/**
 * Configs
 * Used to configure some values. To set config you can use [[\yii\base\Application::$params]]
 *
 * ```
 * return [
 *
 *     'auth.rbac.configs' => [
 *         'db' => 'customDb',
 *         'cache' => [
 *             'class' => 'yii\caching\DbCache',
 *             'db' => ['dsn' => 'sqlite:@runtime/admin-cache.db'],
 *         ],
 *         'editMode' => true
 *     ]
 * ];
 * ```
 *
 * or use [[\Yii::$container]]
 *
 * ```
 * Yii::$container->set('sankam\rbac\components\Configs',[
 *     'db' => 'customDb',
 * ]);
 * ```
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Configs extends \yii\base\Object
{
    const CACHE_TAG = 'auth.rbac';

    /**
     * @var ManagerInterface .
     */
    public $authManager = 'authManager';

    /**
     * @var Cache Cache component.
     */
    public $cache = 'cache';

    /**
     * @var integer Cache duration. Default to a hour.
     */
    public $cacheDuration = 3600;

    /**
     * @var string Menu table name.
     */
    public $userTable = '{{%users}}';

    /**
     * @var integer Default status user signup. 10 mean active.
     */
    public $defaultUserStatus = 10;

    /**
     * @var boolean If true then AccessControl only check if route are registered.
     */
    public $onlyRegisteredRoute = false;

    /**
     * @var boolean If false then AccessControl will check without Rule.
     */
    public $strict = true;

    /**
     * @var array
     */
    public $options;

    /**
     * @var string
     */
    public $defaultAdminGrop = 'root';

    /**
     * @var string
     */
    public $defaultuserGroup = 'user';

    /**
     * @var array|false
     */
    public $advanced = [
            'backend' => [
                '@common/config/base.php',
                '@backend/config/base.php',
                '@backend/config/web.php',
            ],
            'frontend' => [
                '@common/config/base.php',
                '@frontend/config/base.php',
                '@frontend/config/web.php',
            ],
        ];

    /**
     * @var boolean If false you can add new items.
     */
    public $editMode = YII_ENV_DEV;

    /**
     * @var self Instance of self
     */
    private static $_instance;
    private static $_classes = [
        'cache' => 'yii\caching\Cache',
        'authManager' => 'yii\rbac\ManagerInterface',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        foreach (self::$_classes as $key => $class) {
            try {
                $this->{$key} = empty($this->{$key}) ? null : Instance::ensure($this->{$key}, $class);
            } catch (\Exception $exc) {
                $this->{$key} = null;
                Yii::error($exc->getMessage());
            }
        }
    }

    /**
     * Create instance of self
     * @return static
     */
    public static function instance()
    {
        if (self::$_instance === null) {
            $type = ArrayHelper::getValue(Yii::$app->params, 'auth.rbac.configs', []);
            if (is_array($type) && !isset($type['class'])) {
                $type['class'] = static::className();
            }

            return self::$_instance = Yii::createObject($type);
        }

        return self::$_instance;
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = static::instance();
        if ($instance->hasProperty($name)) {
            return $instance->$name;
        } else {
            if (count($arguments)) {
                $instance->options[$name] = reset($arguments);
            } else {
                return array_key_exists($name, $instance->options) ? $instance->options[$name] : null;
            }
        }
    }

    /**
     * @return Cache
     */
    public static function cache()
    {
        return static::instance()->cache;
    }

    /**
     * @return ManagerInterface
     */
    public static function authManager()
    {
        return static::instance()->authManager;
    }
    /**
     * @return integer
     */
    public static function cacheDuration()
    {
        return static::instance()->cacheDuration;
    }

    /**
     * @return string
     */
    public static function userTable()
    {
        return static::instance()->userTable;
    }

    /**
     * @return string
     */
    public static function defaultUserStatus()
    {
        return static::instance()->defaultUserStatus;
    }

    /**
     * @return string
     */
    public static function defaultUserGroup()
    {
        return static::instance()->defaultuserGroup;
    }

    /**
     * @return string
     */
    public static function defaultAdminGroup()
    {
        return static::instance()->defaultAdminGrop;
    }

    /**
     * @return boolean
     */
    public static function onlyRegisteredRoute()
    {
        return static::instance()->onlyRegisteredRoute;
    }

    /**
     * @return boolean
     */
    public static function strict()
    {
        return static::instance()->strict;
    }

    /**
     * @return boolean
     */
    public static function editMode()
    {
        return static::instance()->editMode;
    }
}
