<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Редагування профіля';



?>

    <h1> Редагування профіля </h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput()->label('Ім\'я') ?>

<?= $form->field($model, 'surname')->textInput()->label('Прізвище') ?>

<?= $form->field($model, 'email')->textInput()->label('E-mail')?>

<?= $form->field($model, 'telephone')->textInput()->label('Телефон') ?>

<?= $form->field($model,'birthday')->widget(DatePicker::className(),['pluginOptions' => [
    'format' => 'yyyy-m-dd',
    'todayHighlight' => true
]])->label('Дата народження') ?>

<?= $form->field($model, 't_shirt')->dropDownList(['XS','S','M','L','XL','XXL'])->label('Розмір футболки') ?>

<?= $form->field($model, 'city')->textInput()->label('Місце проживання') ?>

<?= $form->field($model, 'study')->textInput()->label('Навчальний заклад') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Оновити', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>