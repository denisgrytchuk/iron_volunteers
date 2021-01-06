<?php

$i=0;
?>


<div class="block list">
    <table>
        <tr>
            <td>Id</td>
            <td>Ім'я</td>
            <td>Прізвище</td>
            <td>Стать</td>
            <td>Email</td>
            <td>Телефон</td>
            <td>Розмір футболки</td>
            <td>Місце проживання</td>
            <td>Навчальний заклад</td>
            <td>Дата народження</td>
            <td>Доступ до обдзвону</td>
            <td>Чорний список</td>
            <td>Заходи</td>
        </tr>
        <?php foreach ($users as $user){?>
            <tr>
                <td><?=$user->id?></td>
                <td><?=$user->username?></td>
                <td><?=$user->surname?></td>
                <td><?=$user->sex?></td>
                <td><?=$user->email?></td>
                <td><?=$user->telephone?></td>
                <td><?=$user->t_shirt?></td>
                <td><?=$user->city?></td>
                <td><?=$user->study?></td>
                <td><?=$user->birthday?></td>
                <td><button id="<?=$user->id?>" name="<?=$i?>" class="access">Дозволений доступ</button>
                    <p class="access_name" hidden><?=$user->ringer?></p>
                </td>
                <td><button id="<?=$user->id?>" name="<?=$i?>" class="black_list">Чорний список</button>
                    <p class="black_name" hidden><?=$user->black?></p>
                </td>
                <td><a href="/admin/volunteers/events?id=<?=$user->id?>">Заходи</a></td>
            </tr>

        <?php $i++;
        } ?>
    </table>
</div>

<script src="/web/js/admin.js"></script>