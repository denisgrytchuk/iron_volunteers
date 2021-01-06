<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="T0VJc0REV2giFXAsHjA7JgcIFhAodTJbBTEuOXQOHjIOdR04NyZkJg==">
    <link href="/web/css/admin.css" rel="stylesheet">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="body-style">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Iron Volunteers',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Адмінка', 'url' => ['/admin']],
            Yii::$app->user->isGuest ? (
            ['label' => 'Вхід', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Вихід (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
    <div class="general_body container">
        <div class="nav_block">
            <div class="btn btn-secondary btn-lg btn-block"><a href="/admin/category/">Категорії</a></div>
            <div class="btn btn-secondary btn-lg btn-block"><a href="/admin/article/">Статті</a></div>
            <div class="btn btn-secondary btn-lg btn-block"><a href="/admin/comment/">Коментарії</a></div>
            <div class="btn btn-secondary btn-lg btn-block"><a href="/admin/feedback/">Зворотній зв'язок</a></div>
            <div class="btn btn-secondary btn-lg btn-block"><a href="/admin/event/">Події</a></div>
            <div class="btn btn-secondary btn-lg btn-block"><a href="/admin/volunteers/">Волонтери</a></div>
            <div class="btn btn-secondary btn-lg btn-block"><a href="/admin/packet/">Пакет волонтера</a></div>
            <div class="btn btn-secondary btn-lg btn-block"><a href="/admin/etap/">Підготовчі етапи</a></div>
            <div class="btn btn-secondary btn-lg btn-block"><a href="/ring/">Обдзвони списків</a></div>
        </div>
        <div class="container content_container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>
</div>

<!--footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Iron Volunteers <?= date('Y') ?></p>
    </div>
</footer-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php $this->title = 'Iron Volunteers Ukraine'; ?>

