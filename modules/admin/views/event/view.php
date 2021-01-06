<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 26.01.2018
 * Time: 15:33
 */

?>

<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a><a class="badge badge-secondary" href="/admin/event/">Події</a>
</div>
<div >

    <div class="col-md-12 center-col">
        <div>
            <h2><?= $event->title?></h2>
            <hr>
            <h4>ID:</h4>
            <div> <?=$event->id?></div>
            <div>
            <h4>Статус:</h4>
            <?=$event->status?'Відкрита реєстрація':'Закрита реєстрація'?></div>
            <h4>Фото:</h4>
            <div class="article-img">
                <img  src='<?= $event->photo?>'></img>
            </div>
			<h4>Фото:</h4>
            <div class="article-img">
                <img  src='<?= $event->img?>'></img>
            </div>
            <hr><h4>Контент:</h4>
            <div>
                <?= $event->content?>
            </div>
            <hr>
            <h4>Дата:</h4>
            <span><?=$event->date?></span>
        </div>
        <hr>
        <div>
            <h4>Пакет волонтера:</h4>
            <?php foreach ($packet as $pack){ ?>
                <div>
                    <div><?=$pack['name']?></div>
                    <div><img src="<?=$pack['photo']?>"></div>
                </div>
            <?php } ?>
        </div>
        <div>
            <h4>Підготовчі етапи:</h4>
            <?php foreach ($etap as $e){ ?>
                <div>
                    <div><?=$e->name?></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
