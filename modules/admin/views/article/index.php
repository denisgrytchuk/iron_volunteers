<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 04.01.2018
 * Time: 16:54
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

use yii\grid\GridView;

use app\models\Article;


/*
$dataProvider = new ActiveDataProvider([
    'query' => Article::find()->orderBy(['date'=>SORT_DESC]),
    'pagination' => [
        'pageSize' => 5,
    ],
]);*/

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--link href="/web/css/category.css" rel="stylesheet"-->

<div class="col-md-2 col-md-offset-2 add">
    <a class="btn-success btn" href="/admin/article/add">Додати нову статтю</a>
</div><br><hr><br>
<div class="list ">
    <div class="">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,


            'columns' => [

                [
                    'attribute' => 'id',
                    'label' => 'Id',
					'options' => ['width' => '30'],
                ],
                [
                    'attribute' => 'idCategory',
                    'label' => 'Категорія',
                    'content'=>function($data,$dataProvider){
                        return $data->getCategory($dataProvider);
                    },
					'options' => ['width' => '120'],
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
                    'attribute' => 'access',
                    'label' => 'Cтатус',
                    'content'=>function($data){
                        return $data->access?'Опублікована':'Неопублікована';
                    },
                ],
                [
                    'attribute' => 'date',
                    'label' => 'Дата',
					'options' => ['width' => '110'],
                ],
                //'name:ntext',
                //'url:ntext',
                //'category_image:ntext',
                // 'created_at',
                // 'updated_at',

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    ],
            ],
            'tableOptions' => [
                'class' => 'table table-striped table-bordered',

            ],
        ]); ?>
        <?php Pjax::end() ?>
    </div>

</div>
