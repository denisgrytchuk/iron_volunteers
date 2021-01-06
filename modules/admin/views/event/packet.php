<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 11.02.2018
 * Time: 23:03
 */

$i=0

?>
<div class="history">
    <a class="badge badge-pill badge-secondary" href="/admin/">Адмінка</a>
    <a class="badge badge-secondary" href="/admin/event/">Події</a>
    <a class="badge badge-secondary" href="/admin/event/update?id=<?=$id?>">Редагування</a>
</div>
<div>
<table class="packet" >
    <tr>
        <td >Id</td>
        <td>Назва</td>
        <td>Картинка</td>
        <td></td>
    </tr>
    <?php foreach($packet as $pack){?>
        <tr>
            <td class="packet_id"><?=$pack->id?></td>
            <td><?=$pack->name?></td>
            <td class="packet_item"><img src="<?=$pack->photo?>"></td>
            <td><button id="<?=$i?>" name="<?=$id?>"class="btn-success btn packet_button"></button>
                <p class="packet_status" hidden>
                    <?php foreach($packet_event as $e){
                        if($e->idPacket == $pack->id){
                            echo '1';
                        }
                     } ?>
                </p>
            </td>
        </tr>
    <?php $i++;
    } ?>
</table>
</div>

<script src="/web/js/admin.js"></script>