<?php


use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Реєстрація';

?>

<h1> Реєстрація волонтера </h1>

<?php $form = ActiveForm::begin([
    'id' => 'registration',
    'options' => ['class' => 'form-horizontal'],
]); ?>

<?= $form->field($model, 'username')->textInput()->label('Ім\'я') ?>

<?= $form->field($model, 'surname')->textInput()->label('Прізвище') ?>

<?= $form->field($model, 'email')->textInput()->label('E-mail')?>

<?= $form->field($model, 'sex')->dropDownList(['Чоловік','Жінка'])->label('Стать')?>

<?= $form->field($model, 'telephone')->textInput()->label('Телефон')->hint('Допустимий формат: +380*********') ?>

<?= $form->field($model,'birthday')->label('Дата народження')->hint('Допустимий формат: рік-місяць-дата') ?>

<?= $form->field($model, 't_shirt')->dropDownList(['XS','S','M','L','XL','XXL'])->label('Розмір футболки') ?>

<?= $form->field($model, 'city')->textInput()->label('Місце проживання') ?>

<?= $form->field($model, 'study')->textInput()->label('Навчальний заклад') ?>

<?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

<?= $form->field($model, 'password_repeat')->passwordInput()->label('Повторний пароль') ?>

<div class="checkbox_color">
<?= $form->field($model, 'agree')->checkbox()
    ->label('Заповнюючи цю анкету, я надаю згоду відповідно до Закону України 
«Про захист персональних даних» на збір та обробку моїх особистих персональних даних, незабороненим 
чинним законодавством України способом, з метою використання моїх персональних даних під час підготовки 
та проведення соціальних або спортивних заходів.') ?>
</div>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Зареєструватись', ['class' => 'btn btn-primary registration']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<script src="/web/js/main.js"></script>
