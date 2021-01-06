<?php


use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Зміна пароля';

?>


<?php $form = ActiveForm::begin(); ?>
<?php $form1 = ActiveForm::begin(); ?>

<div>
    <?php  if(Yii::$app->session->hasFlash('problem')):?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php  echo Yii::$app->session->getFlash('problem');?>
        </div>
    <?php endif; ?>
</div>

<?= $form->field($model, 'password')->passwordInput()->label('Старий пароль') ?>

<?= $form1->field($model1, 'password')->passwordInput()->label('Новий пароль') ?>

<?= $form1->field($model1, 'password_repeat')->passwordInput()->label('Повторний пароль') ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Продовжити', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>



