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

<?= $form->field($event, 'title')->label('Заголовок')?>
<?= $form->field($event, 'photo')->fileInput()->label('Фото')?>
<?= $form->field($event, 'change_photo')->checkbox([0,1])->label('Чи змінювати фото?')?>
<div class="article-img">
    <img src="<?=$event->photo?>">
</div>
<?php
echo $form->field($event, 'content')->widget(CKEditor::className(),[
    'editorOptions' => [
        'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
    ],
])->textarea(['rows' => 8, 'cols' => 5])->label('Контент');
?>
<?= $form->field($event, 'date')->textInput()->label('Дата проведення заходу')?>
<?= $form->field($event, 'place')->textInput()->label('Місто проведення заходу')?>
<?= $form->field($event, 'location')->textInput()->label('Локація проведення заходу')?>
<?= $form->field($event, 'role')->textInput()->label('Ролі волонтерів')?>
<?= $form->field($event, 'status')->checkbox([0,1])->label('Відкрити реєстрацію')?>

<div class="form-group">
    <?= Html::submitButton('Оновити', ['class' => 'btn btn-primary']) ?>
</div>
<a class="btn btn-success" href="/admin/event/packet?id=<?=$id?>">Пакет волонтера</a>
<a class="btn btn-success" href="/admin/event/img?id=<?=$id?>">Додати фото</a>
<?php ActiveForm::end(); ?>
