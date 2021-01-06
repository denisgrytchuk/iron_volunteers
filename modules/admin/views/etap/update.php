<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a><a class="badge badge-secondary" href="/admin/etap/">Підготовчі етапи</a>
</div>

<?php $form = ActiveForm::begin(); ?>


<?= $form->field($model, 'name')->label('Назва етапу')?>
<?= $form->field($model, 'idEvent')->dropDownList($arrEvent,['prompt'=>''])->label('Подія')?>

<div class="form-group">
    <?= Html::submitButton('Оновити', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
