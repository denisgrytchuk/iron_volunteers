<?php

$i=0;


$array = explode('/',$event->role);
$coun = count($array);

?>
<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a><a class="badge badge-secondary" href="/ring/">Обдзвони</a>
</div>
<link href="/web/css/ring.css" rel="stylesheet">
<link href="/web/css/call.css" rel="stylesheet">
<div class="block">
    <h4><?=$event->title ?></h4>
	<p class="array" hidden><?=$event->role?></p>
	<p class="id_event" hidden><?=$event->id?></p>
    <table>
        <tr>
			<td>№</td>
            <td>Ім'я</td>
            <td>Прізвище</td>    
            <td>Основна роль</td>
            <td>Альтернативна роль</td>			
            <td>Статус дзвінка</td>
            <td>Статус заходу</td>
			<td colspan="2">Закріплена роль</td>		
        </tr>
        <?php foreach ($participation as $part){
			$j=2;
			?>
            <tr class="<?=$part['black']?'red':''?>" >
				<td><?=$i?></td>
                <td><?=$part['username']?></td>
                <td><?=$part['surname']?></td>              
                <td><?=$part['first_role']?></td>
                <td><?=$part['second_role']?></td>
                <td><?=$part['status_of_call']?></td>
                <td><?=$part['status_of_event']?></td>
				<td colspan="2">
					<p class="default_role" hidden><?=$part['ended_role']?></p>
					<p class="count_role" hidden><?=$coun?></p>
                    <select class="target" id="<?=$i?>">
                        <option value="1"></option>
                        <?php foreach($array as $arr){?>
							<option value='<?=$j?>'><?=$arr?></option>
					
						<?php	
							$j++;}	?>
                    </select>
					<p class="part_id" hidden><?=$part['id']?></p>
                </td>
            </tr>
		
		<?php		         
			$i++;			
		} ?>
    </table>
</div>

<script src="/web/js/acept.js"></script>