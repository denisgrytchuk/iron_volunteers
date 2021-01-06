<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Відновлення пароля';

?>

<?php  if(Yii::$app->session->hasFlash('email')):?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php  echo Yii::$app->session->getFlash('email');?>
    </div>
<?php endif; ?>
<?php  if(!Yii::$app->session->hasFlash('email')):?>
    <?php  if(Yii::$app->session->hasFlash('error')):?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php  echo Yii::$app->session->getFlash('error');?>
        </div>
    <?php endif; ?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($user, 'email')->textInput()->label('Введіть ваш email') ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Надіслати повідомлення', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
<?php endif; ?>
