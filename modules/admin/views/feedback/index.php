<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\ContactForm;


$dataProvider = new ActiveDataProvider([
    'query' => ContactForm::find()->orderBy(['date'=>SORT_DESC]),
    'pagination' => [
        'pageSize' => 10,
    ],
]);

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="/web/css/category.css" rel="stylesheet">
<div class="col-md-11">
    <div class="col-md-10">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'id',
                    'label' => 'Id',
                ],
                [
                    'attribute' => 'name',
                    'label' => 'Ім\'я',
                ],
                [
                    'attribute' => 'email',
                    'label' => 'Email',
                ],
                [
                    'attribute' => 'subject',
                    'label' => 'Тема',
                ],
                [
                    'attribute' => 'text',
                    'label' => 'Текст',
                ],
                [
                    'attribute' => 'date',
                    'label' => 'Дата',
                ],
                //'name:ntext',
                //'url:ntext',
                //'category_image:ntext',
                // 'created_at',
                // 'updated_at',

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete}'],
            ],
        ]); ?>
    </div>

</div>
