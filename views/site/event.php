<?php

$this->title = $event->title;
//var_dump($packets);exit();

$i=0;
?>

<link href="/web/css/index.css" rel="stylesheet">

<div class="history">
    <a class="badge badge-pill badge-secondary" href="/">Головна</a><a class="badge badge-secondary" href="/site/events">Події</a>
</div>
<div class="event_main">

    <div class="event_title"><h4><?=$event->title?></h4></div>
    <div class="event_img"><img src=" <?=$event->photo?>"></div>
    <div class="event_content"><?=$event->content?></div>
    <?php if($packets){?>
        <div>
            <h4 class="center-item">Пакет волонтера</h4>
			<div class="packet_main"> 
            <?php foreach($packets as $pack){?>
                <div class="packet_block col-md-5">
                    <div class="packet_text col-md-5"><?=$pack['name']?></div>
                    <div class="packet_img col-md-6"><img src="<?=$pack['photo']?>"></div>
                </div>
            <?php } ?>
			</div>
        </div>
    <?php } ?>
    <?php
        $flaq = false;
        foreach ($participation as $part){
            if($part->idEvent ==$event->id) {$flaq=true;}
        }
    ?>
    <?php if(!Yii::$app->user->isGuest && !$flaq){ ?>
    <?php if($etap){?>
        <div class="etap_main" >
            <div ><h4>Підготовчі етапи</h4></div>
            <?php foreach($etap as $et){?>
                <div class="etap_content">
                    <div class="etap_item"><?=$et->name?></div>
                    <button id="<?=$i?>" class="btn btn-primary etap_item btn_etap">Взяти участь</button>
                    <div class="etap_item hidden_div" hidden>Вкажіть час, в який вам зручно взяти участь</div>
                    <textarea class="etap_item hidden_textarea" hidden></textarea>
                    <p class="hidden_id" hidden><?=$et->id?></p>
                </div>
            <?php $i++;
            } ?>

        </div>
		<hr>
    <?php } ?>
    <form class="form_event"">
        <div class="event_check">
            <div class="event_role">
            <?php if ($event->role == '') {
            } else { ?>
                <h4>Основна роль</h4>
                <?php
                $roles = explode('/', $event->role);
                foreach ($roles as $role) {
                    ?>
                    <input type="radio" name="role" value="<?=$role?>"><?=$role?><br>

                <?php } ?>
                <?php
            }
            ?>
            </div>
            <div class="event_role">
            <?php if ($event->role == '') {
            } else { ?>
                <h4>Альтернативна роль</h4>
                <?php
                $roles = explode('/', $event->role);
                foreach ($roles as $role) {?>
                    <input type="radio" name="alt_role" value="<?=$role?>"><?=$role?><br>
                <?php } ?>

                <?php
            }
            ?>
            </div>
            <p hidden id="<?=$event->id?>" class="event"><?= Yii::$app->user->id ?></p>
            <p hidden id="<?=$event->id?>" class="role"><?= $event->role; ?></p>
        </div>
        </form>
        <div class="event_button"><button id="<?=$event->id?>" class="btn btn-success btn_event" >Зареєструватись</button></div>

    <?php } else if($flaq){?><div class="btn btn-success">Ви успішно зареєстровані</div> <?php
    }
    else
    {  ?>
        <div class="btn btn-warning">Для того, щоб взяти участь в будь-якому заході потрібно зареєструватись на сайті</div>
    <?php
    }
    ?>



</div>

<?php
$js = <<<JS
$("button.btn_event").click(
    function () {
        var btn_id = this.id;
        var is_role = $('p.role').text();
        var role = is_role ? $('input[name=role]:checked').val() : '';
        var alt_role = is_role ? $('input[name=alt_role]:checked').val() : '';
        var id = $('.hidden_id');
        var text = $('.hidden_textarea');
        var array_id =[];
        var array_text =[];
        for(var i=0;i<id.length;i++){
            array_id[i]=id.eq(i).text();
            array_text[i]=text.eq(i).val();
            
        }
        var data;
        if(!role && is_role){ 
			alert('Виберіть будь ласка бажану основну роль');
        }else if(!alt_role && is_role){ 
			alert('Виберіть будь ласка бажану альтернативну роль');
		}else if(role==alt_role){
			alert('Альтернативна роль повинна відрізнятись від основної ролі');	
		}else{
         data = {'idEvent' :btn_id , 'idUser': $('p.event').text(),'role': role,'alt_role':alt_role,'id':array_id,'text':array_text};
        $.ajax({
            url: "/site/event?id=" + btn_id,
            type: 'POST',
            data: data,
            success: function(res){
				$("div.etap_main").hide();
                $("button.btn_event").hide();
                $("form.form_event").remove();
				
                console.log(res);
                
            },
            error: function(){
                alert('Error!');
            }
        });
        }
        
    }
);

JS;

$this->registerJs($js);
?>

<script src="/web/js/event.js"></script>
