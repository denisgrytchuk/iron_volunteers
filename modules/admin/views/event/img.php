<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 26.01.2018
 * Time: 16:08
 */

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a><a class="badge badge-secondary" href="/admin/event/">Події</a>
</div>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($event, 'img')->fileInput()->label('Фото')?>
<?= $form->field($event, 'change_photo')->checkbox([0,1])->label('Чи змінювати фото?')?>
<div class="article-img">
    <img src="<?=$event->img?>">
</div>

<div class="form-group">
    <?= Html::submitButton('Додати фото', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
