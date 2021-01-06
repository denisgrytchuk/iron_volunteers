<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 19.01.2018
 * Time: 15:43
 */

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

/*
$provider = new ActiveDataProvider([
    'query' => \app\models\Event::find()->orderBy(['id'=>SORT_DESC]),
    'pagination' => [
        'pageSize' => 10,
    ],
]);*/

?>


<div class="col-md-2 col-md-offset-2 add">
    <a class="btn-success btn" href="/admin/event/add">Створити нову подію</a>
</div><br><hr><br>
<div class="list ">
    <div class="">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
            'columns' => [


                [
                    'attribute' => 'id',
                    'label' => 'Id',
                ],
                [
                    'attribute' => 'title',
                    'label' => 'Заголовок',
                ],

                [
                    'label' => 'Картинка',
                    'format' => 'raw',
                    'value' => function($data){
                        return Html::img($data['photo'],
                            ['width' => '160px',
                                'height' => '120px']);
                    },
                ],
                [
                    'attribute' => 'status',
                    'label' => 'Cтатус',
                    'content'=>function($data){
                        return $data->status?'Відкрита':'Закрита';
                    },
                ],
                [
                    'attribute' => 'date',
                    'label' => 'Дата',
                ],
				[
                    'label' => 'Статистика',
                    'format' => 'raw',
                    'value' => function($data){
                        return Html::a(
                            'Переглянути',
                            Yii::$app->homeUrl.'admin/event/statistic?id='.$data->id,
                            [
                                'target' => '_blank'
                            ]
                        );
                    }
                ],
                [
                    'label' => 'Скачати таблиці',
                    'format' => 'raw',
                    'value' => function($data){
                        return Html::a(
                            'Скачати',
                            Yii::$app->homeUrl.'admin/event/download?id='.$data->id,
                            [
                                'title' => 'Все буде нормально!',
                                'target' => '_blank'
                            ]
                        );
                    }
                ],
                //'name:ntext',
                //'url:ntext',
                //'category_image:ntext',
                // 'created_at',
                // 'updated_at',

                ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}'],
            ],
            'tableOptions' => [
                'class' => 'table table-striped table-bordered'
            ],
        ]); ?>
    </div>

</div>