<?php
$this->title = 'Iron Volunteers Ukraine';
?>
<link href="/web/css/index.css" rel="stylesheet">




	<div class="slick_slider">
			<div class="item active">
				<img src="/web/img/IMG_4107.jpg" alt="Picture1" style="width:100%;">
			</div>

			<div class="item">
				<img src="/web/img/IMG_4089.jpg" alt="Picture2" style="width:100%;">
			</div>

			<div class="item">
				<img src="/web/img/IMG_4094.jpg" alt="Picture3" style="width:100%;">
			</div>
			<div class="item active">
				<img src="/web/img/IMG_4107.jpg" alt="Picture1" style="width:100%;">
			</div>

			<div class="item">
				<img src="/web/img/IMG_4089.jpg" alt="Picture2" style="width:100%;">
			</div>

			<div class="item">
				<img src="/web/img/IMG_4094.jpg" alt="Picture3" style="width:100%;">
			</div>
			<div class="item active">
				<img src="/web/img/IMG_4107.jpg" alt="Picture1" style="width:100%;">
			</div>

			<div class="item">
				<img src="/web/img/IMG_4089.jpg" alt="Picture2" style="width:100%;">
			</div>

			<div class="item">
				<img src="/web/img/IMG_4094.jpg" alt="Picture3" style="width:100%;">
			</div>
		</div>

<div class="row post" >
    <div class="col-md-8">
        <div class="col-md-10 center-item">
            <img class="enter-item" src='<?=$main->photo?>'>
            <p class="enter-item" ><?=$main->title?></p>
            <div class="more_detail"><a href="post/article/<?=$main->id?>"><h4>Дізнатись більше</h4></a></div>
        </div>
        <?php  foreach ($dates as $data) {
                if($data->id == $main->id){continue;}
            ?>
        <div class="col-md-5 center-item news-block">
            <img class="enter-item" src='<?=$data->photo?>'>
            <h5 class="enter-item" ><?=$data->title?></h5>
            <div class="more_detail"><a href="post/article/<?=$data->id?>"><h4>Дізнатись більше</h4></a></div>
        </div>
        <?php } ?>
    </div>

    <div class="col-md-4">
        <div class="col-md-12">
            <h3 class="center-item">Категорії</h3>
            <?php foreach ($category as $cat) { ?>
                <a class="btn btn-primary category_list" href='post/<?=$cat->id?>'><div ><?=$cat->name?></div></a>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<script type="text/javascript" src="/web/slick/slick.min.js"></script>
<script src="/web/js/main.js"></script>