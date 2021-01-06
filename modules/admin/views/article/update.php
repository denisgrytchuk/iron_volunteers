<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 22.01.2018
 * Time: 19:47
 */

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a><a class="badge badge-secondary" href="/admin/article/">Статті</a>
</div>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($article, 'idCategory')->dropDownList($arrCategory,['prompt'=>''])->label('Категорія')?>
<?= $form->field($article, 'title')->label('Заголовок')?>
<?= $form->field($article, 'photo')->fileInput()?>
<?= $form->field($article, 'change_photo')->checkbox([0,1])?>
<div class="article-img">
    <img src="<?=$article->photo?>">
</div>
<?php
echo $form->field($article, 'content')->widget(CKEditor::className(),[
    'editorOptions' => [
        'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
    ],
])->textarea(['rows' => 8, 'cols' => 5])->label('Контент');
?>
<?= $form->field($article, 'date')->textInput()?>
<?= $form->field($article, 'access')->checkbox([0,1])?>
<?= $form->field($article, 'main')->checkbox([0,1])->label('Зробити статтю головною')?>

<div class="form-group">
    <?= Html::submitButton('Оновити', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

