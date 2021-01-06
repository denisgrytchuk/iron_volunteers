<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Зміна пароля';

?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'password')->passwordInput()->label('Новий пароль') ?>

<?= $form->field($model, 'password_repeat')->passwordInput()->label('Повторний пароль') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Оновити', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>