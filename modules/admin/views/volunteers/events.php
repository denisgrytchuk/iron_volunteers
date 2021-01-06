<?php



?>

<link href="/web/css/admin.css" rel="stylesheet">
<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a><a class="badge badge-secondary" href="/admin/volunteers/">Волонтери</a>
</div>

<div>
    <div class="user_block">
        <div class="user_item">Ім'я: <?=$user['username']?></div>
        <div class="user_item">Прізвище: <?=$user['surname']?></div>
        <div class="user_item">Стать: <?=$user['sex']?></div>
        <div class="user_item">Email: <?=$user['email']?></div>
        <div class="user_item">Телефон: <?=$user['telephone']?></div>
        <div class="user_item">Розмір футболки: <?=$user['t_shirt']?></div>
        <div class="user_item">Місце проживання: <?=$user['city']?></div>
        <div class="user_item">Навчальний заклад: <?=$user['study']?></div>
        <div class="user_item">Дата народження: <?=$user['birthday']?></div>
        <div class="user_item">Може обдзвонювати подію: <?=$user['ringer']?></div>
        <div class="user_item">Чорний список<?=$user['black']?></div>
    </div>
    <div>
        <div>
            <h4>Головні заходи</h4>
            <table>
                <tr>
                    <td>Подія</td>
                    <td>Основна роль</td>
                    <td>Альтернативна роль</td>
					<td>Дата і час реєстрації</td>
                    <td>Статус дзвінка</td>
                    <td>Статус по заходу</td>
                </tr>
                <?php foreach ($events as $event){?>
                    <tr class="<?=$event['active']?'':'red'?>">
                        <td><?=$event['title']?></td>
                        <td><?=$event['first_role']?></td>
                        <td><?=$event['second_role']?></td>
						<td><?=$event['date_event']?></td>
                        <td><?=$event['status_of_call']?></td>
                        <td><?=$event['status_of_event']?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div>
            <h4>Підготовчі етапи</h4>
            <table>
                <tr>
                    <td>Подія</td>
                    <td>Етап</td>
                    <td>Статус</td>
                </tr>
                <?php foreach ($etap as $e){?>
                    <tr class="<?=$e['active']?'':'red'?>">
                        <td><?=$e['title']?></td>
                        <td><?=$e['name']?></td>
                        <td><?=$e['status']?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>

    </div>
</div>
