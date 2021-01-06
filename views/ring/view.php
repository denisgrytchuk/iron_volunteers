<?php

$i=0;
$j=0;
$k=0;

?>
<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a><a class="badge badge-secondary" href="/ring/">Обдзвони</a>
</div>
<link href="/web/css/ring.css" rel="stylesheet">
<link href="/web/css/call.css" rel="stylesheet">
<div class="block">
    <h4><?=$event->title ?></h4>
	<p class="id_event" hidden><?=$event->id?></p>
    <table>
        <tr>
			<td>№</td>
            <td>Ім'я</td>
            <td>Прізвище</td>
            <td>Телефон</td>            
            <td>Місце проживання</td>          
            <td>Основна роль</td>
            <td>Альтернативна роль</td>			
            <td colspan="2">Статус дзвінка</td>
            <td colspan="2">Статус заходу</td>
        </tr>
        <?php foreach ($participation as $part){?>
            <tr class="<?=$part['black']?'red':''?>">
				<td><?=$i?></td>
                <td><?=$part['username']?></td>
                <td><?=$part['surname']?></td>
                <td><?=$part['telephone']?></td>               
                <td><?=$part['city']?></td>
                <td><?=$part['first_role']?></td>
                <td><?=$part['second_role']?></td>
                <td colspan="2">
					<p class="default_call" hidden><?=$part['status_of_call']?></p>
                    <select class="target1" id="<?=$i?>">
                        <option value="1"></option>
                        <option value="2">Підтвердженно</option>
                        <option value="3">Відмова</option>
                        <option value="4">Передзвонити</option>
                        <option value="5">Відсутній зв'язок</option>
                        <option value="6">Невірний номер</option>
                    </select>
					<p class="part_call" hidden><?=$part['id']?></p>
                </td>
                <td colspan="2">
					<p class="default_event" hidden><?=$part['status_of_event']?></p>
                    <select class="target2" id="<?=$j?>">
                        <option value="1"></option>
                        <option value="2">Неявка</option>
                        <option value="3">Захворів</option>
                        <option value="4">Волонтерив</option>
						<option value="5">Активіст</option>
                    </select>
                </td>
            </tr>
			<?php foreach($etap as $e){ 
			if($e['idUser'] == $part['id']){?>
				<tr class="<?=$part['black']?'red':''?>">	
					<td></td>
					<td colspan="2"><?=$e['name']?></td>
					<td><?=$e['time']?></td>
					<td>
						<p class="default_etap" hidden><?=$e['status']?></p>
						<select class="target3" id="<?=$k?>">
							<option value="1"></option>
							<option value="2">Неявка</option>
							<option value="3">Захворів</option>
							<option value="4">Волонтерив</option>
							<option value="5">Активіст</option>
						</select>
						<p class="etap_status" hidden><?=$e['id']?></p>
					</td>
				</tr>
				
			<?php $k++;
			}
				
			} ?>
        <?php 
			$i++;
			$j++;
			
		} ?>
    </table>
</div>

<script src="/web/js/ring.js"></script>