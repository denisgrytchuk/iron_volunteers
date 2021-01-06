<?php

$this->title = 'Особистий кабінет';

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
        <div>
            <h4>Головні заходи</h4>
            <table>
                <tr>
                    <td>Подія</td>
                    <td>Основна роль</td>
                    <td>Альтернативна роль</td>
                    <td>Статус заходу</td>
                </tr>
                <?php foreach ($events as $event){?>
                    <tr>
                        <td><?=$event['title']?></td>
                        <td><?=$event['first_role']?></td>
                        <td><?=$event['second_role']?></td>
                        <td><?=$event['status']?'Доступний':'Завершений'?></td>
                        <td><button class="btn btn-danger">Скасувати</button></td>
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
                    <td>Статус етапу</td>

                </tr>
                <?php foreach ($etap as $e){?>
                    <tr>
                        <td><?=$e['title']?></td>
                        <td><?=$e['name']?></td>
                        <td><?=$event['status']?'Доступний':'Завершений'?></td>
                        <td><button class="btn btn-danger">Скасувати</button></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <div class="col-md-3">
        <a class="btn btn-primary" href="office/setting">Редагувати профіль</a>
        <hr>
        <a class="btn btn-primary" href="office/password">Поміняти пароль</a>
    </div>
</div>