<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 04.01.2018
 * Time: 17:16
 */
?>

<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a><a class="badge badge-secondary" href="/admin/article/">Статті</a>
</div>
<div >

    <div class="col-md-8 center-col">
        <div>
            <h2><?= $article->title?></h2>
            <hr>
            <h4>ID:</h4>
            <div> <?=$article->id?></div>
            <h4>Статус:</h4>
            <div> <?=$article->access?'Опубліковий пост':'Неопублікований'?></div>
            <h4>Світлина:</h4>
            <div class="article-img">
                <img  src='<?= $article->photo?>'></img>
            </div>
            <hr><h4>Контент:</h4>
            <div>
                <?= $article->content?>
            </div>
            <hr>
            <h4>Дата:</h4>
            <span><?=$article->date?></span>
        </div>
        <hr>
        <div>
            <div>

            </div>
        </div>
    </div>
</div>