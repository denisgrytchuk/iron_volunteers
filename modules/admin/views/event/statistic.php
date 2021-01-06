<?php

//var_dump($etapy);exit();
?>

<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a><a class="badge badge-secondary" href="/admin/event/">Події</a>
</div>
<div >
	<div>
		<p>Зареєстрова кількість волонтерів: <?=$general_count?></p>
		<p>Відмовилось від участі: <?=$passive_count?></p>
		<p>Активні заявки: <?=$active_count?></p>
		<?php foreach($count_role as $key => $value){?>
			<p> <?=$key==""?"Незатведжено - ":"Затверджено - ".$key?> : <?=$value?> <p>
		<?php }
		?>
	</div>
	<?php $i=0;
	foreach($etapy as $e){?>
		<hr>
		<div>
			<p>Підготовчий етап: <?=$e['name']?></p>
			<p>Зареєстрова кількість волонтерів: <?=$general_count_etap[$i]?></p>
			<p>Відмовилось від участі: <?=$passive_count_etap[$i]?></p>
			<p>Активні заявки: <?=$active_count_etap[$i]?></p>
		</div>	
	<?php $i++;
	} ?>
</div>
