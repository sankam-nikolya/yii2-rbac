<?php

namespace sankam\rbac\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use sankam\rbac\components\Configs;

/**
 * AssignmentSearch represents the model behind the search form about Assignment.
 * 
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Assignment extends Model
{
    public $id;
    public $username;
    public $email;
    public $roles;
    public $status;
    public $created_at;
    public $updated_at;
    public $logged_at;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Configs::instance()->userTable;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['username','email','roles','created_at', 'updated_at', 'logged_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rbac-admin', 'ID'),
            'username' => Yii::t('rbac-admin', 'Username'),
            'name' => Yii::t('rbac-admin', 'Name'),
        ];
    }

    /**
     * Create data provider for Assignment model.
     * @param  array                        $params
     * @param  \yii\db\ActiveRecord         $class
     * @param  string                       $usernameField
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params, $class, $usernameField)
    {
        $query = $class::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if(!empty($this->created_at)) {
            $query->andFilterWhere([
                'between',
                'created_at',
                strtotime($this->created_at . ' 00:00:00'),
                strtotime($this->created_at  . ' 23:59:59'),
            ]);
        }

        if(!empty($this->logged_at)) {
            $query->andFilterWhere([
                'between',
                'logged_at',
                strtotime($this->logged_at . ' 00:00:00'),
                strtotime($this->logged_at  . ' 23:59:59'),
            ]);
        }

        if(!empty($this->updated_at)) {
            $query->andFilterWhere([
                'between',
                'updated_at',
                strtotime($this->updated_at . ' 00:00:00'),
                strtotime($this->updated_at  . ' 23:59:59'),
            ]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status
        ]);

        if(!empty($this->roles)) {
            $itemTable = Yii::$app->authManager->itemTable;
            $assignmentTable = Yii::$app->authManager->assignmentTable;


            $query->leftJoin($assignmentTable, $assignmentTable . '.[[user_id]]=' . self::tableName() . '.id')
            ->andWhere(['item_name' => $this->roles]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);
            
        return $dataProvider;
    }
}
