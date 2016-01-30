<?php

namespace app\modules\admin\modules\rbac\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\modules\rbac\models\AuthAssignment;

/**
 * AuthAssignmentSearch represents the model behind the search form about `app\modules\admin\modules\rbac\models\AuthAssignment`.
 */
class AuthAssignmentSearch extends AuthAssignment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ [ 'item_name', 'user_id' ], 'safe' ],
            [ [ 'created_at' ], 'integer' ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search( $params )
    {
        $query = AuthAssignment::find();

        $dataProvider = new ActiveDataProvider( [
            'query' => $query,
        ] );

        if ( ! ( $this->load( $params ) && $this->validate() )) {
            return $dataProvider;
        }

        $query->andFilterWhere( [
            'created_at' => $this->created_at,
        ] );

        $query->andFilterWhere( [ 'like', 'item_name', $this->item_name ] )
              ->andFilterWhere( [ 'like', 'user_id', $this->user_id ] );

        return $dataProvider;
    }
}
