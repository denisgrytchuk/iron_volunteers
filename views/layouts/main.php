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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	

	<link rel="stylesheet" type="text/css" href="/web/slick/slick.css"/>
	<link href="/web/css/layout.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/web/slick/slick-theme.css"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="body-style">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Iron Volunteers Ukraine',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Головна', 'url' => ['/']],
            ['label' => 'Події', 'url' => ['/site/events']],
            ['label' => 'Новини', 'url' => ['/site/news']],          
            ['label' => 'Контакти', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
            ['label' => 'Реєстрація', 'url' => ['/site/registration']]
            ) : (
                '<li>'
                . Html::beginForm(['/cabinet'], 'post')
                . Html::submitButton(
                    'Особистий кабінет',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
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

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>


    </div>
</div>

<footer class="footer">
    <div class="col-md-offset-1">
        <p class="pull-left"> &copy; Iron Volunteers Ukraine <?= date('Y') ?></p>
    </div>
	<div class="icons col-md-offset-9">
		<div class="item social"><a href="https://www.facebook.com/groups/kyivvolunteers/"><img  src="/web/img/facebook_circle-512.png" alt="Picture3" ></a>
		</div>
		<div class="item social "><a href="https://www.instagram.com/iron_volunteers/"><img src="/web/img/ig-logo-email.png" alt="Picture3"></a>
		</div>
		<div class="item social"><a href="https://t.me/ironvolunteers"><img src="/web/img/t_logo.png" alt="Picture3" ></a>
		</div>
	</div>
</footer>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>