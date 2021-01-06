<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 26.01.2018
 * Time: 13:28
 */


use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>



<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a><a class="badge badge-secondary" href="/admin/event/">Події</a>
</div>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'title')->label('Заголовок')?>
<?= $form->field($model, 'xls')->label('Назва excel-файла')?>
<?= $form->field($model, 'content')->textarea(['rows' => 6, 'cols' => 5])->label('Контент')?>
<?= $form->field($model, 'photo')->fileInput()?>
<?= $form->field($model, 'date')->textInput()?>
<?= $form->field($model, 'place')->textInput()?>
<?= $form->field($model, 'location')->textInput()?>
<?= $form->field($model, 'role')->textInput()?>


    <div class="form-group">
        <?= Html::submitButton('Створити', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

