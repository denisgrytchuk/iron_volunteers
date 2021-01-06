<?php


namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;


/**
 * ContactForm is the model behind the contact form.
 */
class EventSearch extends Event
{

	public function rules()
    {
        return [
            ['id', 'integer'],
            [['title','date','content','status'], 'safe'],
        ];
    }
	
	public function search($params) {
    $query = Event::find();
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);
 
    /**
     * Настройка параметров сортировки
     * Важно: должна быть выполнена раньше $this->load($params)
     */
    $dataProvider->setSort([
        'attributes' => [
            'id',
            'title',
            'date',
			'status',
			'content',

        ]
    ]);
 
    if (!($this->load($params) && $this->validate())) {
        return $dataProvider;
    }
 
    /*$this->addCondition($query, 'id');
    $this->addCondition($query, 'title', true);
    $this->addCondition($query, 'status');
	$this->addCondition($query, 'date');
    $this->addCondition($query, 'idCategory');
	$this->addCondition($query, 'content');
    $this->addCondition($query, 'photo');
	*/
	/**/
    /* Настроим правила фильтрации */
	$query->andFilterWhere([
            'id' => $this->id
        ]);

    $query->andFilterWhere(['like', 'title', $this->title]);
	$query->andFilterWhere(['like', 'date', $this->date]);
	$query->andFilterWhere(['like', 'status', $this->status]);
	
    // фильтр по имени
    return $dataProvider;
}
}