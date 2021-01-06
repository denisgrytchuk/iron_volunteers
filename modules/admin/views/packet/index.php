<?php


use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$dataProvider = new ActiveDataProvider([
'query' => \app\models\Packet::find(),
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
                    'label' => 'Картинка',
                    'format' => 'raw',
                    'value' => function($data){
                        return Html::img($data['photo'],
                            ['width' => '160px',
                                'height' => '120px']);
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
        <?= $form->field($model, 'photo')->fileInput()?>
        <?= $form->field($model, 'change_photo')->checkbox([0,1])?>

        <div class="form-group">
            <?= Html::submitButton('Додати новий атрибут', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>