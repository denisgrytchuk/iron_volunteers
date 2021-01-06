<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 08.02.2018
 * Time: 11:59
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\grid\GridView;
use yii\data\ActiveDataProvider;


$provider = new ActiveDataProvider([
    'query' => \app\models\Comment::find()->orderBy(['date'=>SORT_DESC]),
    'pagination' => [
        'pageSize' => 20,
    ],
]);

?>


<div class="col-md-12 ">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $provider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'id',
                    'label' => 'Id',
                ],
                [
                    'attribute' => 'idUser',
                    'label' => 'Коментатор',
                    'content'=>function($data,$provider){
                        return $data->getCommentator($provider);
                    },
                ],
                [
                    'attribute' => 'idArticle',
                    'label' => 'Cтаття',
                    'content'=>function($data,$provider){
                        return $data->getArticle($provider);
                    },
                ],
                [
                    'attribute' => 'content',
                    'label' => 'Коментар',
                ],
                [
                    'attribute' => 'date',
                    'label' => 'Дата коментування',
                ],
                [
                    'attribute' => 'public',
                    'label' => 'Cтатус',
                    'content'=>function($data){
                        return $data->public?'Опублікований':'Неопублікований';
                    },
                ],

                ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
            ],
        ]); ?>
    </div>
</div>