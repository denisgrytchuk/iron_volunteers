<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Контакти';

?>



    <h1>Зворотній зв'язок</h1>

<?php
//debug($model);


?>

<?php  if(Yii::$app->session->hasFlash('success')):?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php  echo Yii::$app->session->getFlash('success');?>
    </div>
<?php endif; ?>

<?php  if(Yii::$app->session->hasFlash('error')):?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php  echo Yii::$app->session->getFlash('error');?>
    </div>
<?php endif; ?>

<?php $form=ActiveForm::begin();?>
<?= $form->field($model,'name')?>
<?= $form->field($model,'email')?>
<?= $form->field($model,'subject')?>
<?= $form->field($model,'text')->textarea()?>
<?= $form->field($model,'date')->hiddenInput(['value' => date('Y-m-d')]) ?>
<?= Html::submitButton('Відправити',['class'=>'btn btn-success'])  ?>
<?php ActiveForm::end()?>