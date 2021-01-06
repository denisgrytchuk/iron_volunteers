<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 31.01.2018
 * Time: 17:21
 */

//var_dump($etapy[1]);exit();


$i=0;

?>

<div>
	<div>
		<h4><ul>Основний захід</ul></h4>
		<div>
			<?php foreach($array_part as $arr){ ?>
				<li><a href="/admin/event/get?file=<?=$xls.'_'.$i?>"><?=$arr?$arr:'Без ролі'?> - скачати список</a></li>
			<?php $i++;
			} ?>
		</div>
	</div>
	<div>
		<h4><ul>Підготовчі етапи</ul></h4>
		<div>
			<?php $i=0;
			foreach($etapy as $e){ ?>
				<li><a href="/admin/event/get?file=<?=$xls.'__'.$i?>"><?=$e['name']?> - скачати список</a></li>
			<?php $i++;
			} ?>
		</div>
	</div>
</div>
