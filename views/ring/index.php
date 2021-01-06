<?php


?>
<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a>
</div>

<div>
    <?php foreach ($event as $e){  ?>
        <div>
            <p><?=$e->title?></p>
            <a href="/ring/view?id=<?=$e->id?>">
                Перейти до списків обдзвону
            </a>
			<a href="/ring/acept?id=<?=$e->id?>">
                Підтвердження участі
            </a>
        </div>


    <?php  } ?>
</div>
