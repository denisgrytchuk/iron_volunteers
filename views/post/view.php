<?php


$this->title = $category->name;
?>
<link href="/web/css/index.css" rel="stylesheet">

<h1 style="text-align: center;"><?=$category->name?></h1>
<div>

    <div class="col-md-8 center-col">
        <div class="col-md-8 col-md-offset-2">
            <?php foreach ($news as $new){?>
                <a href='/post/article/<?=$new->id?>'><div class="article"><?=$new->title?></p></div></a>
            <?php }?>

        </div>
        <div style=" text-align: center;"><?= yii\widgets\LinkPager::widget(['pagination'=>$pages])?></div>
    </div>

</div>