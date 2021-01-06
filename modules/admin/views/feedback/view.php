<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 03.01.2018
 * Time: 20:05
 */

//var_dump($messages);exit();
?>
<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a><a class="badge badge-secondary" href="/admin/feedback/">Зворотній зв'язок</a>
</div>
<div>
    <p>
        <?=$messages->id?>
    </p>
    <p>
        <?=$messages->name?>
    </p>
    <p>
        <?=$messages->email?>
    </p>
    <p>
        <?=$messages->subject?>
    </p>
    <p>
        <?=$messages->text?>
    </p>
    <p>
        <?=$messages->date?>
    </p>
</div>
