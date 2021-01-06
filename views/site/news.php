<?php

$this->title = 'Новини';
?>

<link href="/web/css/index.css" rel="stylesheet">



<div class="col-md-8">
        <div class="col-md-12 center-col">
            <div class="col-md-12 block2">
                <?php foreach ($news as $new){?>
                    <div class="block1">
                        <h3><a class="center-item" href='/post/article/<?=$new->id?>'><?=$new->title?></a></h3>
                        <div class="center-item  col-md-12 div-photo"><img src="<?=$new->photo?>"></div>
                    </div>
                    <hr>
                <?php }?>
            </div>
            <div style=" text-align: center;"><?= yii\widgets\LinkPager::widget(['pagination'=>$pages])?></div>
        </div>
</div>
<div class="col-md-4 center-col news-category">
    <div class="accordion">
        <?php for($i=0;$i<count($category);$i++){?>
            <button class="col-md-12 accordion"><?=$category[$i]->name?></button>
            <!--button class="accordion"><a href='/web/post/<?=$category[$i]->id?>'><?=$category[$i]->name?></a></button-->
            <div class="col-md-12 panel"><p>
                    <!-- В циклі вказане число 5-->
                    <?php foreach ($list[$i] as $lis){?>
                        <div><a href='/post/article/<?=$lis->id?>'><?=$lis->title?></a></div><br>
                    <?php }?>
                </p>
            </div>
        <?php   } ?>
    </div>
</div>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        }
    }
</script>
