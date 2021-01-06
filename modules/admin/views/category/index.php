<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Category;


$provider = new ActiveDataProvider([
    'query' => Category::find(),
    'pagination' => [
        'pageSize' => 10,
    ],
]);

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="/web/css/category.css" rel="stylesheet">

<div class="col-md-11 list">
    <div class="col-md-10">
        <?= GridView::widget([
            'dataProvider' => $provider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                //'name:ntext',
                //'url:ntext',
                //'category_image:ntext',
                // 'created_at',
                // 'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <div class="col-md-2 add">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->label('')?>

        <div class="form-group">
            <?= Html::submitButton('Додати нову категорію', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
