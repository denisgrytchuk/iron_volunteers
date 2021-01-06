<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

    <div class="history">
        <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a><a class="badge badge-secondary" href="/admin/packet/">Пакет волонтера</a>
    </div>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->label('Назва атрибуту')?>
<?= $form->field($model, 'photo')->fileInput()?>
<?= $form->field($model, 'change_photo')->checkbox([0,1])?>
    <div class="article-img">
        <img src="<?=$model->photo?>">
    </div>
    <div class="form-group">
        <?= Html::submitButton('Оновити', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>