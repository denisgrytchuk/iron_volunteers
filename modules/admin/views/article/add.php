<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;




?>

<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a><a class="badge badge-secondary" href="/admin/article/">Статті</a>
</div>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'idCategory')->dropDownList($arrCategory,['prompt'=>''])->label('Категорія')?>
<?= $form->field($model, 'title')->label('Заголовок')?>
<?= $form->field($model, 'content')->textarea(['rows' => 6, 'cols' => 5])->label('Контент')?>
<?= $form->field($model, 'photo')->fileInput()?>
<?= $form->field($model, 'date')->textInput()?>


<div class="form-group">
    <?= Html::submitButton('Відправити', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
