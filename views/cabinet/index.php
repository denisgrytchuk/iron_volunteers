<?php

$this->title = 'Особистий кабінет';
$i=0;
$j=0;
?>

<link href="/web/css/ring.css" rel="stylesheet">
<div>
    <div class="col-md-9">
        <div>
            <h4>Особисті дані</h4>

                <div>
                    <div>Ім'я: <?=$user->username?></div>
                    <div>Прізвище: <?=$user->surname?></div>
                    <div>Email: <?=$user->email?></div>
                    <div>Стать: <?=$user->sex?></div>
                    <div>Телефоне: <?=$user->telephone?></div>
                    <div>Розмір футболки: <?=$user->t_shirt?></div>
                    <div>Дата народження: <?=$user->birthday?></div>
                    <div>Місце проживання: <?=$user->city?></div>
                    <div>Навчальний заклад: <?=$user->study?></div>
                </div>
        </div>        
    </div>
    <div class="col-md-3">
        <a class="btn btn-primary" href="cabinet/setting">Редагувати профіль</a>
        <hr>
        <a class="btn btn-primary" href="cabinet/password">Поміняти пароль</a>
    </div>
	<div class="col-md-12">
            <h4>Головні заходи</h4>
            <table class="col-md-12">
                <tr>
                    <td>Подія</td>
                    <td>Закріплена роль</td>
                </tr>
                <?php foreach ($events as $event){?>
                    <tr class="hidden_event">
                        <td><?=$event['title']?></td>
                        <td><?=$event['ended_role']?></td>
						<td><div class='btn btn-danger cancel_event' id="<?=$i?>">Відмовитись<br> від участі</div></td>    
						<p class='event_id' hidden><?=$event['id']?></p>
                    </tr>
                <?php 
					$i++;
				} ?>
            </table>
        </div>
        <div class="col-md-12">
            <h4>Підготовчі етапи</h4>
            <table class="col-md-12">
                <tr>
                    <td>Подія</td>
                    <td>Етап</td>

                </tr>
                <?php foreach ($etap as $e){?>
                    <tr class="hidden_etap">
                        <td><?=$e['title']?></td>
                        <td><?=$e['name']?></td>
                        <td><div class='btn btn-danger cancel_etap' id="<?=$j?>">Відмовитись<br> від участі</div></td>
						<p class='etap_id' hidden><?=$e['id']?></p>
                    </tr>
                <?php 
					$j++;
				} ?>
            </table>
        </div>
</div>

<script src="/web/js/cabinet.js"></script>