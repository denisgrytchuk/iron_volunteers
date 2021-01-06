<?php



$this->title = 'Події';

?>
<link href="/web/css/index.css" rel="stylesheet">
<link href="/web/css/event.css" rel="stylesheet">

<div class="event_container">
    <?php foreach($event as $e){?>
        <div class="event_attribute col-md-4">
            <div class="img_block col-md-11">
                <img src="<?= $e->img?>">
            </div>
			<div class="img_block col-md-11">
				<div><p>Дата: <?=$e->date?></p></div>
				<div><p>Місто: <?=$e->place?></p></div>
				<div><p>Локація: <?=$e->location?></p></div>
			</div>
            <div class="event_check_item">
                <a class=" btn btn-primary" href="/site/event?id=<?=$e->id?>" >Детальніше</a>
            </div>
        </div>
    <?php  } ?>
</div>

