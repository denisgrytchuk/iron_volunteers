<?php


use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$dataProvider = new ActiveDataProvider([
    'query' => \app\models\Etap::find(),
    'pagination' => [
        'pageSize' => 20,
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
                    'label' => 'Назва',
                ],
                [
                    'attribute' => 'idEtap',
                    'label' => 'Подія',
                    'content'=>function($data,$dataProvider){
                        return $data->getEvent($dataProvider);
                    },
                ],

                //'name:ntext',
                //'url:ntext',
                //'category_image:ntext',
                // 'created_at',
                // 'updated_at',

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}'],
            ],
        ]); ?>
    </div>
    <div class="col-md-2 add">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->label('')?>
        <?= $form->field($model, 'idEvent')->dropDownList($arrEvent,['prompt'=>''])->label('Категорія')?>

        <div class="form-group">
            <?= Html::submitButton('Додати новий атрибут', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>