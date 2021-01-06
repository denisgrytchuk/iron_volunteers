<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 03.01.2018
 * Time: 18:44
 */
?>

<div class="col-sm-12 col md-12 col-lg-7">
    <form id="form" name="form" method="post" class="vacancies_form">
        <div class="title_form">Введіть нову назву категорії</div>

        <div class="main_part_form">
            <div class="part_1">
                <input id="id" name="id" type="text" value="id" style="display: none;">
                <input id="name" name="name" type="text" class="name" placeholder="<?=$category->name?>">
            </div>
            <div class="part_2">
                <div class="btn_send_div">
                    <input class="btn_send" type="submit" value="Відправити">
                </div>
            </div>
        </div>
    </form>
</div>
